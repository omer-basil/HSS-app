<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean',
        ]);

        $credentials = request(['email', 'password']);

        if (Auth::guard('api')->check($credentials)) {
            $user = Auth::guard('api')->user();
        } elseif (Auth::guard('customer')->check($credentials)) {
            $user = Auth::guard('customer')->user();
        } else {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $tokenResult = $user->createToken('Laravel Password Grant Client');
        $accessToken = $tokenResult->accessToken;

        if ($request->remember_me) {
            $accessToken->expires_at = Carbon::now()->addWeeks(1);
        }

        $accessToken->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->accessToken->expires_at
            )->toDateTimeString(),
            'user' => $user,
        ]);
    }

}
