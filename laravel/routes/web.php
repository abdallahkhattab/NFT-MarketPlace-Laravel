<?php

use App\Models\PublicProfile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MetaMaskController;
use App\Http\Controllers\NFtMarketPlaceController;
use App\Http\Controllers\PublicProfileController;

Route::post('/get-nonce', [MetaMaskController::class, 'getNonce'])->name('get.nonce'); // Get nonce for wallet

Route::post('/authenticate', [MetaMaskController::class, 'authenticate'])->name('authenticate.wallet'); // Wallet authentication





Route::get('/profile/@{user:name}',[PublicProfileController::class,'index'])->name('public-profile');
Route::get('/profile/creator/{wallet}',[PublicProfileController::class,'creator'])->name('creator');

Route::get('/myprofile/@{user:name}',[PublicProfileController::class,'show'])->name('my-public-profile');



Route::get('/ranking', function () {
    return view('pages.ranking.ranking');
})->name('ranking');


Route::get('register', function(){
    return view('auth.register');
});


Route::get('connect-a-wallet',[MetaMaskController::class,'connect'])->name('wallet-connection');

Route::post('disconnect-wallet',[MetaMaskController::class,'disconnect']);



Route::get('marketplace' ,[NFtMarketPlaceController::class,'ListNft'])->middleware('auth')->name('marketplace');


/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');*/

/*
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});*/


Route::middleware('auth')->group(function () {
    Route::resource('/profile' , ProfileController::class);
});


Route::get('home' , [HomeController::class,'index'])->name('home');






Route::get('create-nft' , [NFtMarketPlaceController::class , 'create'])->name('create-nft');
Route::get('nft/nft-details/{tokenId}' , [NFtMarketPlaceController::class , 'showNFT'])->name('nft.show');
Route::post('/nft/upload-image', [NFTMarketplaceController::class, 'uploadImage'])->middleware('auth')->name('nft.upload-image');
Route::post('/nft/create-metadata', [NFTMarketplaceController::class, 'createMetadata'])->middleware('auth')->name('nft.create-metadata');

require __DIR__.'/auth.php';
