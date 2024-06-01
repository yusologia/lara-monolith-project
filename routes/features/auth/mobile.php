<?php

use App\Http\Controllers\Auth\MobileController;
use Illuminate\Support\Facades\Route;

Route::prefix("mobile")
    ->group(function () {

        Route::post("login", [MobileController::class, "login"]);

        Route::middleware('auth.mobile:api')
            ->group(function () {

                Route::get('profile', [MobileController::class, "profile"]);
                Route::post('logout', [MobileController::class, "logout"]);
                Route::patch('change-password', [MobileController::class, "changePassword"]);

            });

    });
