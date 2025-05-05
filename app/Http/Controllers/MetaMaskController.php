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
    public function connect()
    {
        return view('auth.connect-wallet'); 
    }

    /**
     * Generate and return nonce for the wallet.
     */
    public function getNonce(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'wallet_address' => 'required|string|regex:/^0x[a-fA-F0-9]{40}$/',
            'wallet_type' => 'nullable|string|in:metamask,walletconnect,coinbase',
            'status'=>'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

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
                    return response()->json([
                        'error' => 'You already have a different wallet connected. Please disconnect first.'
                    ], 403);
                }

                // Generate a raw nonce and create message with prefix
                $nonce = Str::random(32);
                $messagePrefix = "Authenticate to NFT Marketplace: ";
                $message = $messagePrefix . $nonce;

                $wallet->nonce = $nonce; // Store raw nonce
                $wallet->nonce_generated_at = now();
                $wallet->save();

                Log::info('Nonce generated for existing wallet', [
                    'wallet_address' => $walletAddress,
                    'nonce' => $nonce,
                    'message' => $message,
                ]);

                return response()->json([
                    'nonce' => $message, // Return prefixed message for signing
                    'wallet_exists' => true,
                ]);
            }

            // If not authenticated, check if wallet exists
            $existingWallet = Wallet::where('wallet_address', $walletAddress)->first();

            if ($existingWallet) {
                // Wallet exists, set a new nonce for authentication
                $nonce = Str::random(32);
                $messagePrefix = "Authenticate to NFT Marketplace: ";
                $message = $messagePrefix . $nonce;

                $existingWallet->nonce = $nonce;
                $existingWallet->nonce_generated_at = now();
                $existingWallet->save();

                Log::info('Nonce generated for existing wallet', [
                    'wallet_address' => $walletAddress,
                    'nonce' => $nonce,
                    'message' => $message,
                ]);

                return response()->json([
                    'nonce' => $message,
                    'wallet_exists' => true,
                ]);
            }

            // New wallet - create temporary nonce for first-time authentication
            $nonce = Str::random(32);
            $messagePrefix = "Register new wallet on NFT Marketplace: ";
            $message = $messagePrefix . $nonce;

            

            // Store raw nonce and full message in session
            session([
                'temp_nonce' => $nonce,
                'temp_message' => $message, // Store full message for verification
                'temp_wallet_address' => $walletAddress,
                'temp_wallet_type' => $walletType,
                'nonce_generated_at' => now(),
            ]);

            Log::info('Nonce generated for new wallet', [
                'wallet_address' => $walletAddress,
                'nonce' => $nonce,
                'message' => $message,
                'session_data' => session()->all(),
            ]);

            return response()->json([
                'nonce' => $message, // Return prefixed message for signing
                'wallet_exists' => false,
            ]);
        });
    }

    

    /**
     * Verify the signature and log the user in or register.
     */
    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'wallet_address' => 'required|string|regex:/^0x[a-fA-F0-9]{40}$/',
            'signature' => 'required|string|regex:/^0x[a-fA-F0-9]{130}$/',
            'wallet_type' => 'nullable|string|in:metamask,trustwallet,walletconnect,coinbase',
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'status'=> 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $walletAddress = strtolower($request->input('wallet_address'));
        $signature = $request->input('signature');
        $walletType = $request->input('wallet_type');
        $name = $request->input('name');
        $email = $request->input('email');

        // Log request data for debugging
        Log::info('Authenticate request', [
            'wallet_address' => $walletAddress,
            'wallet_type' => $walletType,
            'signature' => $signature,
            'has_name' => !!$name,
            'has_email' => !!$email,
        ]);

        // Check if user is already authenticated with this wallet
        $authenticated_user = Auth::user();
        if ($authenticated_user) {
            $wallet = Wallet::where('user_id', $authenticated_user->id)
                            ->where('wallet_address', $walletAddress)
                            ->first();

            if ($wallet) {
                return response()->json([
                    'success' => true,
                    'message' => 'Already authenticated',
                    'redirect' => route('marketplace'),
                ]);
            }
        }

        // Find the wallet
        $wallet = Wallet::where('wallet_address', $walletAddress)->first();

        if ($wallet) {
            // Existing wallet - verify with stored nonce
            if (!$wallet->nonce || !$wallet->nonce_generated_at) {
                $nonce = Str::random(32);
                $messagePrefix = "Authenticate to NFT Marketplace: ";
                $message = $messagePrefix . $nonce;

                $wallet->nonce = $nonce;
                $wallet->nonce_generated_at = now();
                $wallet->save();

                Log::warning('No valid nonce found for existing wallet. New nonce generated.', [
                    'wallet_address' => $walletAddress,
                    'new_nonce' => $nonce,
                    'new_message' => $message,
                ]);

                return response()->json([
                    'error' => 'No valid nonce found. New nonce generated.',
                    'new_nonce' => $message,
                    'retry' => true,
                ], 403);
            }

            // Create full message for verification
            $messagePrefix = "Authenticate to NFT Marketplace: ";
            $message = $messagePrefix . $wallet->nonce;

            $isValid = $this->verifySignature($message, $signature, $walletAddress);

            // Check if nonce is expired (15 minutes)
            $nonceExpired = now()->diffInMinutes($wallet->nonce_generated_at) > 15;

            if ($nonceExpired) {
                $nonce = Str::random(32);
                $message = $messagePrefix . $nonce;

                $wallet->nonce = $nonce;
                $wallet->nonce_generated_at = now();
                $wallet->save();

                Log::warning('Nonce expired for existing wallet. New nonce generated.', [
                    'wallet_address' => $walletAddress,
                    'new_nonce' => $nonce,
                    'new_message' => $message,
                ]);

                return response()->json([
                    'error' => 'Authentication timeout. New nonce generated.',
                    'new_nonce' => $message,
                    'retry' => true,
                ], 403);
            }

            if (!$isValid) {
                Log::error('Signature verification failed for existing wallet', [
                    'wallet_address' => $walletAddress,
                    'message' => $message,
                    'signature' => $signature,
                ]);

                return response()->json([
                    'error' => 'Signature verification failed',
                ], 403);
            }

            // Reset nonce for security
            $wallet->nonce = null;
            $wallet->nonce_generated_at = null;
            $wallet->save();

            // Log the user in
            Auth::login($wallet->user);

            Log::info('Authentication successful for existing wallet', [
                'wallet_address' => $walletAddress,
                'user_id' => $wallet->user->id,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Authentication successful',
                'redirect' => route('marketplace'),
            ]);
        } else {
            // New wallet - verify with temporary nonce from session
            $tempNonce = session('temp_nonce');
            $tempMessage = session('temp_message');
            $tempWalletAddress = session('temp_wallet_address');
            $nonceGeneratedAt = session('nonce_generated_at');

            // Check if session data is missing or invalid
            if (!$tempNonce || !$tempMessage || !$tempWalletAddress || !$nonceGeneratedAt) {
                $nonce = Str::random(32);
                $messagePrefix = "Register new wallet on NFT Marketplace: ";
                $message = $messagePrefix . $nonce;

                session([
                    'temp_nonce' => $nonce,
                    'temp_message' => $message,
                    'temp_wallet_address' => $walletAddress,
                    'temp_wallet_type' => $walletType,
                    'nonce_generated_at' => now(),
                ]);

                Log::warning('Invalid or missing session data. New nonce generated.', [
                    'wallet_address' => $walletAddress,
                    'new_nonce' => $nonce,
                    'new_message' => $message,
                    'session_data' => session()->all(),
                ]);

                return response()->json([
                    'error' => 'Session data missing or invalid. Please reconnect your wallet.',
                    'new_nonce' => $message,
                    'retry' => true,
                ], 403);
            }

            // Verify matching wallet address and nonce expiration (15 minutes)
            if ($tempWalletAddress !== $walletAddress || now()->diffInMinutes($nonceGeneratedAt) > 15) {
                $nonce = Str::random(32);
                $messagePrefix = "Register new wallet on NFT Marketplace: ";
                $message = $messagePrefix . $nonce;

                session([
                    'temp_nonce' => $nonce,
                    'temp_message' => $message,
                    'temp_wallet_address' => $walletAddress,
                    'temp_wallet_type' => $walletType,
                    'nonce_generated_at' => now(),
                ]);

                Log::warning('Session expired or invalid wallet address. New nonce generated.', [
                    'wallet_address' => $walletAddress,
                    'temp_wallet_address' => $tempWalletAddress,
                    'new_nonce' => $nonce,
                    'new_message' => $message,
                ]);

                return response()->json([
                    'error' => 'Registration session expired or invalid. New nonce generated.',
                    'new_nonce' => $message,
                    'retry' => true,
                ], 403);
            }

            $isValid = $this->verifySignature($tempMessage, $signature, $walletAddress);

            if (!$isValid) {
                Log::error('Signature verification failed for new wallet', [
                    'wallet_address' => $walletAddress,
                    'message' => $tempMessage,
                    'signature' => $signature,
                    'session_data' => session()->all(),
                ]);

                return response()->json([
                    'error' => 'Signature verification failed',
                ], 403);
            }

            // Clear temporary session data
            session()->forget(['temp_nonce', 'temp_message', 'temp_wallet_address', 'temp_wallet_type', 'nonce_generated_at']);

            // Registration logic - require email for new users
            if (!$email) {
                Log::info('Email required for registration', [
                    'wallet_address' => $walletAddress,
                ]);

                return response()->json([
                    'error' => 'Email is required for registration',
                    'registration_required' => true,
                ], 400);
            }

            // Check if email is already in use
            $existingUser = User::where('email', $email)->first();
            if ($existingUser) {
                Log::warning('Email already in use', [
                    'wallet_address' => $walletAddress,
                    'email' => $email,
                ]);

                return response()->json([
                    'error' => 'Email is already in use',
                    'registration_required' => true,
                ], 400);
            }

            // Create new user with provided information
            DB::transaction(function () use ($email, $name, $walletAddress, $walletType) {
                $randomName = 'crypto_' . time() . '_' . Str::random(4) . '_' . 'user' ; // e.g., 'name_1714748740_XYzDqA'
                $user = User::create([
                    'name' => $name ?: $randomName,
                    'email' => $email,
                    'password' => bcrypt(Str::random(32)),
                ]);

                Wallet::create([
                    'user_id' => $user->id,
                    'wallet_address' => $walletAddress,
                    'wallet_type' => $walletType,
                    'status'=> 'connected',
                ]);

                $user->profile()->create([]);

                Auth::login($user);

                Log::info('New user registered', [
                    'user_id' => $user->id,
                    'wallet_address' => $walletAddress,
                    'email' => $email,
                ]);
            });

            return response()->json([
                'success' => true,
                'message' => 'Registration successful',
                'redirect' => route('marketplace'),
            ]);
        }
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

            // Log inputs for debugging
            Log::info('Verifying signature', [
                'message' => $message,
                'signature' => $signature,
                'address' => $address,
            ]);

            // Hash the message with Ethereum's standard prefix
            $prefixedMessage = "\x19Ethereum Signed Message:\n" . strlen($message) . $message;
            $messageHash = Keccak::hash($prefixedMessage, 256);

            // Ensure signature has the correct format (0x + 130 characters)
            if (substr($signature, 0, 2) !== '0x' || strlen($signature) !== 132) {
                Log::error('Invalid signature format', [
                    'signature' => $signature,
                ]);
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
                Log::error('Invalid recovery ID', [
                    'recid' => $recid,
                    'v' => $v,
                ]);
                return false;
            }

            $pubKey = $ec->recoverPubKey($messageHash, [
                'r' => $r,
                's' => $s,
            ], $recid);

            // Derive the Ethereum address from the public key
            $publicKeyHex = $pubKey->encode('hex');

            // Remove the '04' prefix (uncompressed public key) and convert to binary
            $publicKeyBin = hex2bin(substr($publicKeyHex, 2));

            // Hash the public key
            $addressHash = Keccak::hash($publicKeyBin, 256);

            // Take the last 40 characters to get the address
            $recoveredAddress = '0x' . substr($addressHash, -40);

            // Compare the addresses (case-insensitive)
            $isValid = strtolower($recoveredAddress) === strtolower($address);

            Log::info('Signature verification result', [
                'recovered_address' => $recoveredAddress,
                'expected_address' => $address,
                'is_valid' => $isValid,
            ]);

            return $isValid;
        } catch (\Exception $e) {
            Log::error('Signature verification failed', [
                'error' => $e->getMessage(),
                'message' => $message,
                'signature' => $signature,
                'address' => $address,
                'stack_trace' => $e->getTraceAsString(),
            ]);
            return false;
        }
    }

    /**
     * Disconnect wallet from the account.
     */
    public function disconnect(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'Not authenticated'], 401);
        }

        // Log out the user
        Auth::logout();

        // Invalidate the session and regenerate the token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Clear wallet details
        Wallet::where('user_id', $user->id)->update([
            'wallet_address' => null,
            'wallet_type' => null,
            'nonce' => null,
            'nonce_generated_at' => null,
            'status' => 'disconnected'
        ]);

        Log::info('User logged out and wallet disconnected', [
            'user_id' => $user->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Logged out and wallet disconnected successfully',
            'redirect' => '/' // Redirect to connect wallet page
        ]);
    }

    private function recoverAddress($message, $signature)
    {
        // Placeholder; use a library like web3p/ethereum-tx for production
        return '0x' . substr(hash('sha256', $message . $signature), 0, 40);
    }
    
}