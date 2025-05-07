<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NFtMarketPlaceController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/nft/upload-image', [NFTMarketplaceController::class, 'uploadImage'])->name('nft.upload-image');
Route::post('/nft/create-metadata', [NFTMarketplaceController::class, 'createMetadata'])->name('nft.create-metadata');

