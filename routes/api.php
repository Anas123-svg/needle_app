<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\TattooSessionController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PortfolioImageCategoryController;
use App\Http\Controllers\PortfolioImageController;
use App\Http\Controllers\BookAppointmentController;

//update

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->group(function () {

    Route::post('/artist/update-password', [UserController::class, 'updatePassword']);
    Route::get('/artist/statistics', [UserController::class, 'getEarningsData']);
    //artists routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/artist', [UserController::class, 'show']);
    //Route::post('/user', [UserController::class, 'store']);
    Route::put('/artist/update', [UserController::class, 'update']);
    Route::delete('/user/{id}', [UserController::class, 'destroy']);
    //tax routes
    Route::get('/taxes', [TaxController::class, 'index']);
    Route::post('/taxes', [TaxController::class, 'store']);
    Route::post('/taxes/show', [TaxController::class, 'show']);
    Route::put('/taxes/update', [TaxController::class, 'update']);
    Route::delete('/taxes/destroy', [TaxController::class, 'destroy']);
    //rates routes
    Route::get('/rates', [RateController::class, 'index']);
    Route::post('/rates', [RateController::class, 'store']);
    Route::get('/rate/{id}', [RateController::class, 'show']);
    Route::put('/rate/{id}', [RateController::class, 'update']);
    Route::delete('/rate/{id}', [RateController::class, 'destroy']);
    //customers routes
    Route::get('/customers', [CustomerController::class, 'index']);
    Route::post('/customers', [CustomerController::class, 'store']);
    Route::get('/customers/{id}', [CustomerController::class, 'show']);
    Route::put('/customers/{id}', [CustomerController::class, 'update']);
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy']);

    //tattoo session routes
    Route::get('/tattoo-sessions', [TattooSessionController::class, 'index']);
    Route::post('/tattoo-sessions', [TattooSessionController::class, 'store']);
    Route::get('/tattoo-sessions/{id}', [TattooSessionController::class, 'show']);
    Route::put('/tattoo-sessions/{id}', [TattooSessionController::class, 'update']);
    Route::delete('/tattoo-sessions/{id}', [TattooSessionController::class, 'destroy']);
    // portfolio image category routes
    Route::get('user/portfolio-image-categories', [PortfolioImageCategoryController::class, 'userCategories']); ///portfolio categories for logged in artist
    Route::get('portfolio-image-categories', [PortfolioImageCategoryController::class, 'index']);
    Route::get('portfolio-image-categories/{id}', [PortfolioImageCategoryController::class, 'show']); //portfolio category by id
    Route::post('portfolio-image-categories', [PortfolioImageCategoryController::class, 'store']);// create portfolio image category
    Route::put('portfolio-image-categories/{id}', [PortfolioImageCategoryController::class, 'update']);//update
    //Route::patch('portfolio-image-categories/{id}', [PortfolioImageCategoryController::class, 'update']);
    Route::delete('portfolio-image-categories/{id}', [PortfolioImageCategoryController::class, 'destroy']); //delete
    // portfolio images routes
    Route::get('portfolio-images', [PortfolioImageController::class, 'index']); //get all portfolio images for logged in user
    Route::get('portfolio-images/favourites', [PortfolioImageController::class, 'getFavourites']); //get favourite portfolio images
    Route::get('portfolio-images/category/{categoryId}', [PortfolioImageController::class, 'getByCategory']); //get portfolio images by category
    Route::post('portfolio-images', [PortfolioImageController::class, 'store']);//create portfolio image
    Route::get('portfolio-images/{id}', [PortfolioImageController::class, 'show']);//get portfolio image by id
    Route::put('portfolio-images/{id}', [PortfolioImageController::class, 'update']);//update
    Route::delete('portfolio-images/{id}', [PortfolioImageController::class, 'destroy']);//delete


    //book appointment routes

    Route::get('/book-appointments', [BookAppointmentController::class, 'index']);
    Route::post('/book-appointments', [BookAppointmentController::class, 'store']);
    Route::get('/book-appointments/{id}', [BookAppointmentController::class, 'show']);
    Route::put('/book-appointments/{id}', [BookAppointmentController::class, 'update']);
    Route::delete('/book-appointments/{id}', [BookAppointmentController::class, 'destroy']);

});
