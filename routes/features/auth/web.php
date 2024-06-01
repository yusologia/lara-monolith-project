<?php

use App\Http\Controllers\Auth\WebController;
use Illuminate\Support\Facades\Route;

Route::prefix("web")
    ->group(function () {

        Route::post("login", [WebController::class, "login"]);

        Route::middleware('auth.web:api')
            ->group(function () {

                Route::get('profile', [WebController::class, "profile"]);
                Route::post('logout', [WebController::class, "logout"]);
                Route::patch('change-password', [WebController::class, "changePassword"]);

            });

    });
