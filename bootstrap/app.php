<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(using: function () {
        $namespace = 'App\\Http\\Controllers';

        $version = config('core.version');

        Route::match(['get', 'post'], 'testing', "$namespace\\Controller@testing");

        Route::prefix(config('core.prefix.auth'))
            ->middleware(['web'])
            ->namespace("$namespace\\" . config('core.namespace.auth'))
            ->group(base_path('routes/auth.php'));

        Route::prefix(config('core.prefix.web') . "/$version")
            ->middleware(['web'])
            ->namespace("$namespace\\" . config('core.namespace.web'))
            ->group(base_path('routes/web.php'));

        Route::prefix(config('core.prefix.mobile') . "/$version")
            ->middleware(['web'])
            ->namespace("$namespace\\" . config('core.namespace.mobile'))
            ->group(base_path('routes/mobile.php'));
    })
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(["*"]);

        $middleware->alias([
            'auth.web' => \App\Http\Middleware\AuthenticateWeb::class,
            'auth.mobile' => \App\Http\Middleware\AuthenticateMobile::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
    })->withSchedule(function () {
        //
    })->create();
