<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\MeasurementController;
use App\Http\Controllers\MeasurementsController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PaymentController;


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
    Route::get('measurements/create/{customer?}', [MeasurementController::class, 'create'])
    ->name('measurements.create.withCustomer');
    
    
    // TYPE
    Route::get("types/get", [TypeController::class, "getType"])->name('type.get');
    Route::resource("types", TypeController::class);
    
    // field
    Route::get("fields/{id}", [FieldController::class, "getFieldsByTypeId"])->name('field.byType');
    Route::resource("fields", FieldController::class);


    // Brand
    Route::resource("brands", \App\Http\Controllers\BrandController::class);
    
    // Supplier
    Route::resource("suppliers", \App\Http\Controllers\SupplierController::class);
    
    // category
    Route::resource("categories", \App\Http\Controllers\CategoryController::class);
    
    // products
    Route::resource('products', \App\Http\Controllers\ProductController::class);
    
    // orders
    Route::resource('orders', \App\Http\Controllers\OrderController::class);
    Route::put('order-items/{item}/status', [\App\Http\Controllers\OrderItemController::class, 'updateStatus'])->name('order-items.update-status');
    Route::get('orders/create/{customer?}', [OrderController::class, 'create'])
        ->name('orders.create.withCustomer');
    
    // Reports
    Route::prefix('reports')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\ReportController::class, 'dashboard'])->name('reports.dashboard');
        Route::get('/sales', [\App\Http\Controllers\ReportController::class, 'salesReport'])->name('reports.sales');
        Route::get('/customers', [\App\Http\Controllers\ReportController::class, 'customerReport'])->name('reports.customers');
        Route::get('/suppliers', [\App\Http\Controllers\ReportController::class, 'supplierReport'])->name('reports.suppliers');
        Route::get('/inventory-history', [\App\Http\Controllers\ReportController::class, 'inventoryHistory'])->name('reports.inventory-history');
        Route::get('/customers/{customer}/ledger', [ReportController::class, 'customerLedgerDetail'])->name('reports.customers.ledger');
        Route::get('/suppliers/{supplier}/ledger', [\App\Http\Controllers\ReportController::class, 'supplierLedgerDetail'])->name('reports.suppliers.ledger');
        Route::get('/transactions', [\App\Http\Controllers\ReportController::class, 'transactionsReport'])->name('reports.transactions');
        Route::get('/pending-transactions', [\App\Http\Controllers\ReportController::class, 'pendingTransactionsReport'])->name('reports.pending-transactions');
        Route::get('/completed-transactions', [\App\Http\Controllers\ReportController::class, 'completedTransactionsReport'])->name('reports.completed-transactions');
        Route::get('/user-transactions', [\App\Http\Controllers\ReportController::class, 'userTransactionsReport'])->name('reports.user-transactions');
        Route::get('/customer-transactions', [\App\Http\Controllers\ReportController::class, 'customerTransactionsReport'])->name('reports.customer-transactions');
        Route::get('/supplier-transactions', [\App\Http\Controllers\ReportController::class, 'supplierTransactionsReport'])->name('reports.supplier-transactions');
    });

    // Purchases
    Route::resource('purchases', PurchaseController::class)->only(['index', 'create', 'store']);
    
    // Payments
    Route::post('payments', [\App\Http\Controllers\PaymentController::class, 'store'])->name('payments.store');
    Route::get('payments', [\App\Http\Controllers\PaymentController::class, 'getPayments'])->name('payments.get');
});
// Route::get("/types/get/{name}", [TypeController::class, "getType"])->name('type.get');


Route::get('/checkout', [CheckoutController::class, 'index']);
Route::post('/create-payment-intent', [CheckoutController::class, 'createPaymentIntent']);
