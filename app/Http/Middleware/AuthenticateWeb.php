<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateWeb
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::guard('web')->check()) {
            errUnauthenticated();
        }

        $token = JWTAuth::getToken();
        if (!$token) {
            errUnauthenticated("Unable to get token");
        }

        $payload = JWTAuth::decode($token);
        if (!$payload) {
            errUnauthenticated("Unable to decode token");
        }

        if ($payload['url'] != request()->getHttpHost() . '/' . config('core.login.web')) {
            errUnauthenticated("This token is not for you!");
        }

        return $next($request);
    }
}
