<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home.home');
});


Route::get('/public-profile', function () {
    return view('pages.profile.public-profile');
})->name('public-profile');


Route::get('/ranking', function () {
    return view('pages.ranking.ranking');
})->name('ranking');

Route::get('register', function(){
    return view('auth.register');
});

Route::get('connect-a-wallet', function(){
    return view('auth.connnect-wallet');
})->name('wallet-connection');

Route::get('markerplace',function(){
    return view('pages.marketplace.marketplace');
})->name('marketplace')->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('home' , [HomeController::class,'index'])->name('home');





require __DIR__.'/auth.php';
