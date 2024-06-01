<?php

namespace App\Algorithms\Auth;

use App\Models\Account\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationAlgo
{
    /**
     * @param string $guard
     */
    public function __construct(public string $guard)
    {
    }


    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|mixed|void
     */
    public function login(Request $request)
    {
        try {

            $token = Auth::guard($this->guard)->attempt($request->only('email', 'password'));
            if (!$token) {
                errCredentialIncorrect("Please check your email or password!!");
            }

            $user = Auth::user();
            if (!$user) {
                errUnauthenticated("Can\'t get the user data!!");
            }

            return success([
                'token' => $token,
                'type' => 'bearer'
            ]);

        } catch (\Exception $exception) {
            exception($exception);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse|mixed|void
     */
    public function logout()
    {
        try {

            $user = Auth::guard($this->guard)->user();
            if (!$user) {
                errUnauthenticated("User not found");
            }

            Auth::logout();

            return success();

        } catch (\Exception $exception) {
            exception($exception);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse|mixed|void
     */
    public function profile()
    {
        try {

            $user = Auth::guard($this->guard)->user();
            if (!$user) {
                errUnauthenticated("User not found");
            }

            return success([
                'id' => $user->id,
                'email' => $user->email,
                'createdAt' => $user->createdAt?->format('d/m/Y H:i'),
            ]);

        } catch (\Exception $exception) {
            exception($exception);
        }
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse|mixed|void
     */
    public function changePassword(Request $request)
    {
        try {

            $user = Auth::guard($this->guard)->user();
            if (!$user) {
                errUnauthenticated("User not found");
            }

            if (!Hash::check($request->oldPassword, $user->password)) {
                errAuthChangePassword("Your old password is wrong!!");
            }

            $user->update(['password' => Hash::make($request->newPassword)]);

            return success();

        } catch (\Exception $exception) {
            exception($exception);
        }
    }

}
