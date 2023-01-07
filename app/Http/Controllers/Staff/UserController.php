<?php

namespace App\Http\Controllers\Staff;

use App\Models\User;
use App\Mail\StaffSignUp;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\Staff\UserResource;
use App\Http\Requests\Staff\StoreUserRequest;
use App\Http\Requests\Staff\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserResource::collection(User::get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request, Role $role)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            // Send the email again
            Mail::to($request->email)->send(new StaffSignUp());
            return redirect()->back()->with('success', 'Email sent successfully');
        }
        else
        {
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            
            $user->assignRole($request->input('role'));

            Mail::to($request->email)->send(new StaffSignUp());
        }
        
        return response()->json(['status' => 'Email has been delivered!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Staff\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Staff\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\Staff\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update([
            'first-name' => $request->input('first-name'),
            'last-name' => $request->input('last-name'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address')
        ]);

        return new UserResource($user);
    }

    public function addRole(Request $request, User $user, Role $role)
    {
        $user->assignRole($request->input('role'));
    }
  
    public function removeRole(Request $request, User $user, Role $role) 
    {
        $user->removeRole($request->input('role'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Staff\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response(null, 204);
    }
}
