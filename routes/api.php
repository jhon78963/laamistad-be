<?php

declare(strict_types=1);

use App\Auth\Interfaces\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Auth\Interfaces\Controllers\AuthController;

Route::prefix('v1')->name('api.v1.')->group(function () {
    Route::controller(AuthController::class)
        ->prefix('auth')
        ->name('auth.')
        ->group(function () {
            Route::post('register', 'register')->name('register');
            Route::post('login', 'login')->middleware('login.block')->name('login');
            Route::post('google', 'googleLogin')->name('google');
            Route::post('logout', 'logout')->name('logout');
        });

    Route::middleware('jwt')
        ->controller(AuthController::class)
        ->prefix('auth')
        ->name('auth.')
        ->group(function () {
            // Route::get('2fa/enable', 'enable2FA')->name('2fa.enable');
            // Route::post('2fa/verify', 'verify2FA')->name('2fa.verify');
            // Route::post('refresh-token', 'refreshToken')->name('refresh-token');
            // Route::get('profile', 'getProfile')->name('profile.show');
            // Route::patch('profile', 'updateProfile')->name('profile.update');

        });

    Route::middleware('jwt')
        ->controller(UserController::class)
        ->prefix('auth')
        ->name('auth.')
        ->group(function () {
            Route::post('/user/role', 'getRole');
        });
});
