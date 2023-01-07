<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\Customer\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    public function store(RegisterRequest $request)
    {
        $customer = Customer::create([
            'first-name' => $request->first_name,
            'last-name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'country' => $request->country,
            'city' => $request->city,
            'address' => $request->address
        ]);

        $customer->sendEmailVerificationNotification();

        // Redirect the user to the email verification notice page
        return redirect(route('verification.notice'));
    }
}
