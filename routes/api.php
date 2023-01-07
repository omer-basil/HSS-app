<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Staff\ItemController;
use App\Http\Controllers\Staff\RoleController;
use App\Http\Controllers\Staff\SizeController;
use App\Http\Controllers\Staff\UserController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Staff\ColourController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Staff\PermissionController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Staff\GivePermissionController;



// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::middleware('auth:api')->group(function(){
//     Route::post('/users/{user:id}/add', [UserController::class, 'addRole'])->name('user.addRole');
//     Route::delete('/users/{user:id}/delete', [UserController::class, 'removeRole'])->name('user.removeRole');
//     Route::apiResource('/users', UserController::class);

//     Route::delete('/roles/{role:id}/add', [RoleController::class, 'addPermission'])->name('role.addPermission');
//     Route::delete('/roles/{role:id}/delete', [RoleController::class, 'removePermission'])->name('role.removePermission');
//     Route::apiResource('/roles', RoleController::class);

//     Route::apiResource('/permissions', PermissionController::class);

//     Route::apiResource('/items', ItemController::class);
//     Route::apiResource('/sizes', SizeController::class);
//     Route::apiResource('/items/{item:id}/stock', ColourController::class);

//     Route::apiResource('/orders', OrderController::class);
    
// });

// //authentication 
// Route::group(['prefix' => 'auth'], function () {
//     Route::post('register', [RegisterController::class, 'store'])->name('register');
//     Route::post('login', [LoginController::class, 'login'])->name('login');
//     Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
//     Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
//     Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
//     Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

//     Route::group(['middleware' => ['auth:api']], function () {
//         Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
//         Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');    
//     });
// });

// Route::middleware('auth:api')
//     ->get('logout', [LogoutController::class, 'logout'])
//     ->name('logout');



// Authentication
Route::group(['prefix' => 'auth'], function () {
    Route::post('register', [RegisterController::class, 'store'])->name('register');
    Route::post('login', [LoginController::class, 'login'])->name('login');
    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');
    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

    Route::group(['middleware' => ['auth:api']], function () {
        Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
        Route::post('email/resend', [VerificationController::class, 'resend'])->name('verification.resend');    
    });
});

Route::middleware('auth:api')->get('logout', [LogoutController::class, 'logout'])->name('logout');

// Protected routes
Route::middleware('auth:api')->group(function(){
    Route::post('/users/{user:id}/add', [UserController::class, 'addRole'])->name('user.addRole');
    Route::delete('/users/{user:id}/delete', [UserController::class, 'removeRole'])->name('user.removeRole');
    Route::apiResource('/users', UserController::class);

    Route::delete('/roles/{role:id}/add', [RoleController::class, 'addPermission'])->name('role.addPermission');
    Route::delete('/roles/{role:id}/delete', [RoleController::class, 'removePermission'])->name('role.removePermission');
    Route::apiResource('/roles', RoleController::class);

    Route::apiResource('/permissions', PermissionController::class);

    Route::apiResource('/items', ItemController::class);
    Route::apiResource('/sizes', SizeController::class);
    Route::apiResource('/items/{item:id}/stock', ColourController::class);

    Route::apiResource('/orders', OrderController::class);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
