<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicProfileController extends Controller
{
    public function index(Request $request,User $user)
    {
        // $wallet_address  = Wallet::where('user_id',$user->id)->get('wallet_address');
        $wallets = $user->wallet()->get(['wallet_address']);

        $fullAddress = null;
        $shortAddress = null;
        
        if ($wallets->isNotEmpty()) {
            $fullAddress = $wallets[0]->wallet_address;
            $shortAddress = substr($fullAddress, 0, 6) . '...' . substr($fullAddress, -4);
        }

        $profile = Profile::where('user_id' , $user->id)->first();


       // dd($profile->avatar);
           
        return view('pages.profile.public-profile', compact('user', 'fullAddress', 'shortAddress','profile'));
        }


        public function show(Request $request , User $user)
        {
            return view('pages.profile.public-profile');
        }
}
