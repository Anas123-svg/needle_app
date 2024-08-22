<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistAuthController;

use App\Http\Controllers\EarningController;

// Artist routes
Route::post('/register', [ArtistAuthController::class, 'register']);
Route::post('/login', [ArtistAuthController::class, 'login']);

// Protected routes for authenticated artists
Route::middleware('auth:sanctum')->group(function () {
    Route::put('/update-details', [ArtistAuthController::class, 'updateDetails']);
    Route::delete('/delete-profile-image', [ArtistAuthController::class, 'deleteProfileImage']);

    // Earnings routes
    Route::get('/earnings', [EarningController::class, 'getEarnings']);
    Route::get('/earnings/{timeframe}', [EarningController::class, 'getEarningsByTimeFrame']);
    Route::post('/earnings', [EarningController::class, 'postEarning']);
    Route::put('/earnings/{id}', [EarningController::class, 'updateEarning']);
    Route::delete('/earnings/{id}', [EarningController::class, 'deleteEarning']);
});


Route::post('/artist/register', [ArtistAuthController::class, 'register']);
Route::post('/login', [ArtistAuthController::class, 'login']);

// Social login routes
Route::get('/auth/google', [ArtistAuthController::class, 'redirectToGoogle']);
Route::get('/auth/google/callback', [ArtistAuthController::class, 'handleGoogleCallback']);


Route::post('artist/forgot-password', [ArtistAuthController::class, 'sendResetLinkEmail']);
Route::post('artist/reset-password', [ArtistAuthController::class, 'resetPassword']);
