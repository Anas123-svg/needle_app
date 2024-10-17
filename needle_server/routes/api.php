<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistAuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EarningController;
use App\Http\Controllers\TattooSessionController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\FavouriteController;


// Artist routes
Route::post('/register', [ArtistAuthController::class, 'register']);
Route::post('/login', [ArtistAuthController::class, 'login']);

// Protected routes for authenticated artists
Route::middleware('auth:sanctum')->group(function () {
    Route::put('/update-details', [ArtistAuthController::class, 'updateDetails']);
    Route::delete('/delete-profile-image', [ArtistAuthController::class, 'deleteProfileImage']);
    Route::get('/artist/details', [ArtistAuthController::class, 'getArtistDetails']);
    Route::post('/artist/logout', [ArtistAuthController::class, 'logout']);
    Route::get('/artist/images', [GalleryController::class, 'getArtistImages']);

    // Gallery routes
    Route::post('/galleries', [GalleryController::class, 'createGallery']);
    Route::post('/galleries/{id}/images', [GalleryController::class, 'uploadImage']);
    Route::delete('/galleries/{id}', [GalleryController::class, 'deleteGallery']);
    Route::delete('/galleries/{id}/images/{index}', [GalleryController::class, 'deleteImage']);
    Route::get('/galleries', [GalleryController::class, 'getAllGalleries']);
    Route::post('/galleries/{id}/add-image', [GalleryController::class, 'addImage']);
    Route::get('/gallery/Images/{id}', [GalleryController::class, 'getGalleryImages']);

    // Earnings routes
    Route::get('/earnings', [EarningController::class, 'getEarnings']);
    Route::get('/earnings/{timeframe}', [EarningController::class, 'getEarningsByTimeFrame']);
    Route::post('/earnings', [EarningController::class, 'postEarning']);
    Route::put('/earnings/{id}', [EarningController::class, 'updateEarning']);
    Route::delete('/earnings/{id}', [EarningController::class, 'deleteEarning']);
    // clients
    Route::get('clients', [ClientController::class, 'index']);       
    Route::post('clients', [ClientController::class, 'store']);       
    Route::get('clients/{id}', [ClientController::class, 'show']);    
    Route::put('clients/{id}', [ClientController::class, 'update']);  
    Route::delete('clients/{id}', [ClientController::class, 'destroy']); 

    Route::get('tattoo-sessions', [TattooSessionController::class, 'index']); 
    Route::post('tattoo-sessions', [TattooSessionController::class, 'store']); 
    Route::get('tattoo-sessions/{id}', [TattooSessionController::class, 'show']);
    Route::put('tattoo-sessions/{id}', [TattooSessionController::class, 'update']);
    Route::delete('tattoo-sessions/{id}', [TattooSessionController::class, 'destroy']); 
    Route::post('/favourites', [FavouriteController::class, 'store']);
    Route::get('/favourites', [FavouriteController::class, 'show']);
    Route::delete('/favourites', [FavouriteController::class, 'destroy']);


});


Route::post('/artist/register', [ArtistAuthController::class, 'register']);
Route::post('/login', [ArtistAuthController::class, 'login']);

// Social login routes
Route::get('/auth/google', [ArtistAuthController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [ArtistAuthController::class, 'handleGoogleCallback']);


Route::post('artist/forgot-password', [ArtistAuthController::class, 'sendResetLinkEmail']);
Route::post('artist/reset-password', [ArtistAuthController::class, 'resetPassword']);
