<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Customer\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;

class ResetPasswordController extends Controller
{
    public function reset(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());

        if (User::where('email', $request->email)->exists()) {
            $user = User::where('email', $request->email)->first();
        } elseif (Customer::where('email', $request->email)->exists()) {
            $user = Customer::where('email', $request->email)->first();
        } else {
            return response()->json([
                'message' => 'We can\'t find a user with that e-mail address.'
            ], 404);
        }

        $passwordReset = PasswordReset::where([
            ['token', $request->reset_password_token],
            ['email', $request->email]
        ])->first();

        if (!$passwordReset) {
            return response()->json([
                'message' => 'This password reset token is invalid.'
            ], 404);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json($user);
    }
}
