<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Wallet;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Services\PinataService;
use Illuminate\Support\Facades\Auth;
use App\Services\NFTMarketplaceService;

class PublicProfileController extends Controller
{

    protected $nftService;
    protected $pinataService;

    public function __construct(NFTMarketplaceService $nftService, PinataService $pinataService)
    {
        $this->nftService = $nftService;
        $this->pinataService = $pinataService;
    }

    public function index(Request $request, User $user)
    {
        // $wallet_address  = Wallet::where('user_id',$user->id)->get('wallet_address');
        $wallets = $user->wallet()->get(['wallet_address']);

        $web3Config = $this->nftService->getWeb3Config();

        $fullAddress = null;
        $shortAddress = null;

        if ($wallets->isNotEmpty()) {
            $fullAddress = $wallets[0]->wallet_address;
            $shortAddress = substr($fullAddress, 0, 6) . '...' . substr($fullAddress, -4);
        }

        $profile = Profile::where('user_id', $user->id)->first();


        // dd($profile->avatar);

        return view('pages.profile.public-profile', compact('user', 'fullAddress', 'shortAddress', 'profile', 'web3Config'));
    }


    public function creator($wallet)
    {
        $web3Config = $this->nftService->getWeb3Config();

        $user = User::whereHas('wallet', function ($query) use ($wallet) {
            $query->where('wallet_address', $wallet);
        })->first();

        $wallets = $user->wallet()->get(['wallet_address']);

        
        $fullAddress = null;
        $shortAddress = null;

        if ($wallets->isNotEmpty()) {
            $fullAddress = $wallets[0]->wallet_address;
            $shortAddress = substr($fullAddress, 0, 6) . '...' . substr($fullAddress, -4);
        }


        $profile = $user->profile->first();

        if (!$user) {
            abort(404, 'User not found for this wallet.');
        }

        return view('pages.profile.public-profile', compact('user', 'fullAddress', 'shortAddress', 'profile', 'web3Config'));

    }



    public function show(Request $request, User $user)
    {
        if (Auth::id() !== $user->id) {
            abort(403, 'Unauthorized access to profile');
        }

        $wallets = $user->wallet()->get(['wallet_address']);

        $fullAddress = null;
        $shortAddress = null;

        if ($wallets->isNotEmpty()) {
            $fullAddress = $wallets[0]->wallet_address;
            $shortAddress = substr($fullAddress, 0, 6) . '...' . substr($fullAddress, -4);
        }

        $profile = Profile::where('user_id', $user->id)->first();

        return view('pages.profile.public-profile', compact('user', 'fullAddress', 'shortAddress', 'profile'));
    }
}
