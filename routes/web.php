<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MeasurementController;
use App\Http\Controllers\MeasurementsController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
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

    // USERS
    Route::resource('users', UserController::class);

    // CUSTOMERS
    Route::resource("customers", CustomerController::class);
    Route::get('/customers/{id}/measurements', [CustomerController::class, 'getMeasurementsByUser'])->name('customers.measurements');

    // MEASUREMENTS
    Route::resource("naap", MeasurementsController::class);
    Route::resource('measurements', MeasurementController::class);


    // TYPE
    Route::get("types/get", [TypeController::class, "getType"])->name('type.get');
    Route::resource("types", TypeController::class);
});
// Route::get("/types/get/{name}", [TypeController::class, "getType"])->name('type.get');


Route::get('/checkout', [CheckoutController::class, 'index']);
Route::post('/create-payment-intent', [CheckoutController::class, 'createPaymentIntent']);
