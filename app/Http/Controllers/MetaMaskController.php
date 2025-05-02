<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use kornrunner\Keccak;
use Elliptic\EC;

class MetaMaskController extends Controller
{
    /**
     * Generate and return nonce for the wallet.
     */
    public function getNonce(Request $request)
    {
        $request->validate([
            'wallet_address' => 'required|string',
            'wallet_type' => 'nullable|string',
        ]);
        
        $walletAddress = strtolower($request->input('wallet_address'));
        $walletType = $request->input('wallet_type');
        $user = Auth::user();
        
        return DB::transaction(function () use ($user, $walletAddress, $walletType) {
            // Handle authenticated user with existing wallet
            if ($user) {
                $wallet = Wallet::where('user_id', $user->id)->first();
    
                if (!$wallet) {
                    $wallet = Wallet::create([
                        'user_id' => $user->id,
                        'wallet_address' => $walletAddress,
                        'wallet_type' => $walletType,
                    ]);
                } elseif ($wallet->wallet_address !== $walletAddress) {
                    $wallet->update([
                        'wallet_address' => $walletAddress,
                        'wallet_type' => $walletType,
                    ]);
                }
    
                // Set and save nonce
                $wallet->nonce = Str::random(32);
                $wallet->save();
    
                return response()->json(['nonce' => $wallet->nonce]);
            }
            
            // If not authenticated, create user based on wallet address
            $email = $walletAddress . '@example.com';
            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => 'Crypto User',
                    'password' => bcrypt(Str::random(16)),
                ]
            );
    
            $wallet = Wallet::firstOrCreate(
                ['wallet_address' => $walletAddress],
                [
                    'user_id' => $user->id,
                    'wallet_type' => $walletType,
                ]
            );
            
            // Log the user in after account creation
            Auth::login($user);
    
            // Set and save nonce
            $wallet->nonce = Str::random(32);
            $wallet->save();
    
           // return response()->json(['nonce' => $wallet->nonce]);
           return redirect()->route('marketplace');
        });
    }
    
    /**
     * Verify the signature and log the user in.
     */
    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'wallet_address' => 'required|string',
            'signature' => 'required|string',
            'wallet_type'=> 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $walletAddress = strtolower($request->input('wallet_address'));
        $walletType = $request->input('wallet_type');
        $signature = $request->input('signature');

        $authenticated_user = Auth::user();
        $wallet = Wallet::where('user_id', $authenticated_user->id)->first();

        if ($authenticated_user && $wallet && $wallet->wallet_address) {
            return redirect()->route('marketplace')->with(['message' => 'Wallet connected successfully']);
        }

        $wallet = Wallet::where('wallet_address', $walletAddress)->first();

        if (!$wallet) {
            // If no wallet, create user and wallet
            $email = $walletAddress . '@example.com';
            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => 'Crypto User',
                    'password' => bcrypt(Str::random(16)),
                ]
            );
    
            $wallet = Wallet::firstOrCreate(
                ['wallet_address' => $walletAddress],
                [
                    'user_id' => $user->id,
                    'wallet_type' => $walletType,
                ]
            );
    
            // Set and save nonce
            $wallet->nonce = Str::random(32);
            $wallet->save();
    
            return response()->json(['nonce' => $wallet->nonce]);
        }

        // Verify signature
        $isValid = $this->verifySignature($wallet->nonce, $signature, $walletAddress);
        if (!$isValid) {
            return response()->json(['error' => 'Signature verification failed'], 403);
        }
    
        // Reset nonce for security
        $wallet->nonce = Str::random(32);
        $wallet->save();
    
        // Log the user in
        Auth::login($wallet->user);
        return redirect()->route('marketplace');
    }

    /**
     * Verify the signature.
     */
    private function verifySignature($message, $signature, $address)
    {
        try {
            // Check if the required packages are installed
            if (!class_exists('kornrunner\Keccak') || !class_exists('Elliptic\EC')) {
                Log::error('Required packages not installed: kornrunner/keccak or simplito/elliptic-php');
                return false;
            }

            // Convert message to string to ensure proper encoding
            $message = (string) $message;
            
            // Hash the message with Ethereum's standard prefix
            $prefixedMessage = "\x19Ethereum Signed Message:\n" . strlen($message) . $message;
            $messageHash = Keccak::hash($prefixedMessage, 256);
        
            // Ensure signature has the correct format (0x + 130 characters)
            if (substr($signature, 0, 2) !== '0x' || strlen($signature) !== 132) {
                Log::error('Invalid signature format: ' . $signature);
                return false;
            }
            
            // Split the signature into r, s, and v components
            $r = substr($signature, 2, 64);
            $s = substr($signature, 66, 64);
            $v = hexdec(substr($signature, 130, 2));
            
            // Adjust v for Ethereum's implementation
            if ($v < 27) {
                $v += 27;
            }
            
            // Create EC instance for secp256k1 curve
            $ec = new EC('secp256k1');
            
            // Recover the public key
            $recid = $v - 27;
            if ($recid !== 0 && $recid !== 1) {
                Log::error('Invalid recovery ID: ' . $recid);
                return false;
            }
            
            $pubKey = $ec->recoverPubKey($messageHash, [
                'r' => $r,
                's' => $s
            ], $recid);
        
            // Derive the Ethereum address from the public key
            $publicKeyHex = $pubKey->encode('hex');
            
            // Remove the first two characters (04 prefix) and convert to binary
            $publicKeyBin = hex2bin(substr($publicKeyHex, 2));
            
            // Hash the public key
            $addressHash = Keccak::hash($publicKeyBin, 256);
            
            // Take the last 40 characters to get the address
            $recoveredAddress = '0x' . substr($addressHash, -40);
        
            // Compare the addresses (case-insensitive)
            return strtolower($recoveredAddress) === strtolower($address);
        } catch (\Exception $e) {
            // Log the error with more details
            Log::error('Signature verification failed: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            Log::error('Message: ' . $message);
            Log::error('Signature: ' . $signature);
            Log::error('Address: ' . $address);
            return false;
        }
    }
}
