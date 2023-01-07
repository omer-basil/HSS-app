<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Customer\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);

        if (User::where('email', $request->email)->exists()) {
            $user = User::where('email', $request->email)->first();
        } elseif (Customer::where('email', $request->email)->exists()) {
            $user = Customer::where('email', $request->email)->first();
        } else {
            return response()->json([
                'message' => 'We can\'t find a user with that e-mail address.'
            ], 404);
        }

        $token = Str::random(60);
        $user->forceFill([
            'reset_password_token' => Hash::make($token),
        ])->save();

        $user->sendPasswordResetNotification($token);

        return response()->json([
            'message' => 'We have e-mailed your password reset link!'
        ]);
    }
}
