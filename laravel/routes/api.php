<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
$namespaceApiV1 = 'App\Http\Controllers\Api\V1';

/**
 * API v1
 */
Route::prefix('v1')->as('api.')->group(function () {
    /**
     * Routes for authentication
     */
    Route::controller(AuthController::class)->group(function () {
        Route::post('register', 'register');
        Route::post('login', 'login')->name('login');
        Route::middleware('auth:sanctum')->group(function () {
            Route::post('logout', 'logout')->name('logout');
            Route::get('user', 'authenticatedUser')->name('user');
        });
    });

    /**
     * Protected routes
     */
    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('events', EventController::class)->names('events');
        Route::apiResource('registrations', RegistrationController::class)->names('registrations');
        Route::apiResource('locations', LocationController::class)->names('locations');
    });
});

/**
 * Fallback function
 * Keep this at the end of the file
 */
Route::fallback(function () {
    return response()->json([
        'message' => 'Page Not Found. If error persists, contact info@platformdroneracing.nl', ], 404);
});
