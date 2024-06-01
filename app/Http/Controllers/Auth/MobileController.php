<?php

namespace App\Http\Controllers\Auth;

use App\Algorithms\Auth\AuthenticationAlgo;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;

class MobileController extends Controller
{
    public function __construct(protected string $guard = 'mobile')
    {
    }

    /**
     * @param LoginRequest $request
     *
     * @return \Illuminate\Http\JsonResponse|mixed|null
     */
    public function login(LoginRequest $request)
    {
        $algo = new AuthenticationAlgo($this->guard);
        return $algo->login($request);
    }

    /**
     * @return \Illuminate\Http\JsonResponse|mixed|null
     */
    public function profile()
    {
        $algo = new AuthenticationAlgo($this->guard);
        return $algo->profile();
    }

    /**
     * @return \Illuminate\Http\JsonResponse|mixed|null
     */
    public function logout()
    {
        $algo = new AuthenticationAlgo($this->guard);
        return $algo->logout();
    }

    /**
     * @param ChangePasswordRequest $request
     *
     * @return \Illuminate\Http\JsonResponse|mixed|null
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        $algo = new AuthenticationAlgo($this->guard);
        return $algo->changePassword($request);
    }

}
