<?php

use App\Models\PublicProfile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MetaMaskController;
use App\Http\Controllers\PublicProfileController;

Route::post('/get-nonce', [MetaMaskController::class, 'getNonce'])->name('get.nonce'); // Get nonce for wallet

Route::post('/authenticate', [MetaMaskController::class, 'authenticate'])->name('authenticate.wallet'); // Wallet authentication




Route::get('/profile/@{user:name}',[PublicProfileController::class,'index'])->name('public-profile');
Route::get('/myprofile/@{user:name}',[PublicProfileController::class,'show'])->name('my-public-profile');



Route::get('/ranking', function () {
    return view('pages.ranking.ranking');
})->name('ranking');

Route::get('register', function(){
    return view('auth.register');
});


Route::get('connect-a-wallet',[MetaMaskController::class,'connect'])->name('wallet-connection');

Route::post('disconnect-wallet',[MetaMaskController::class,'disconnect']);

Route::get('markerplace',function(){
    return view('pages.marketplace.marketplace');
})->name('marketplace')->middleware('auth');

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





require __DIR__.'/auth.php';
