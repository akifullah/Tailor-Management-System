<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MeasurementsController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get("/", function () {
    if (Auth::check()) {
        // Redirect to intended URL or dashboard
        return redirect()->route('dashboard');
    }
    return view("auth.login");
})->name("login");


Route::post("/login", [AuthController::class, "login"])->name("login-post");
Route::get("/logout", [AuthController::class, "logout"])->name("logout");


Route::middleware(["auth"])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name("dashboard");

    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::resource("customers", CustomerController::class);

    Route::resource("measurements", MeasurementsController::class);
    
});
