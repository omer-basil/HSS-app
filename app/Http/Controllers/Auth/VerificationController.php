<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Customer\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Access\AuthorizationException;

class VerificationController extends Controller
{
    public function show()
    {
        return view('auth.verify');
    }

    public function verify(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'hash' => 'required',
        ]);

        if (User::where('id', $request->id)->exists()) {
            $user = User::where('id', $request->id)->first();
        } elseif (Customer::where('id', $request->id)->exists()) {
            $user = Customer::where('id', $request->id)->first();
        } else {
            return response()->json([
                'message' => 'We can\'t find a user with that ID.'
            ], 404);
        }

        if (!hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            return response()->json([
                'message' => 'This verification link is invalid.'
            ], 404);
        }

        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'This email has already been verified.'
            ], 404);
        }

        $user->markEmailAsVerified();

        return response()->json($user);
    }


    public function resend(Request $request)
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

        if ($user->hasVerifiedEmail()) {
            return response()->json([
                'message' => 'This email has already been verified.'
            ], 422);
        }

        $user->sendEmailVerificationNotification();

        return response()->json([
            'message' => 'Verification email resent.'
        ]);
    }


}
