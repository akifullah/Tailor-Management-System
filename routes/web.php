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
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;


Route::get("/", function () {
    if (Auth::check()) {
        // Redirect based on user permissions
        $user = Auth::user();
        return redirect(getFirstAccessibleRoute($user));
    }
    return view("auth.login");
})->name("login");


Route::post("/login", [AuthController::class, "login"])->name("login-post");
Route::get("/logout", [AuthController::class, "logout"])->name("logout");


Route::middleware(["auth"])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.index');
    })->name("dashboard");

    // USERS - Require manage-users permission
    Route::middleware(['permission:manage-users'])->group(function () {
        Route::resource('users', UserController::class);
        Route::post('users/{user}/assign-roles-permissions', [UserController::class, 'assignRolesPermissions'])->name('users.assign-roles-permissions');
    });

    // CUSTOMERS - Require manage-customers permission
    Route::middleware(['permission:manage-customers'])->group(function () {
        Route::resource("customers", CustomerController::class);
        Route::get('/customers/{id}/measurements', [CustomerController::class, 'getMeasurementsByUser'])->name('customers.measurements');
    });
    
    // MEASUREMENTS - Require manage-measurements permission
    Route::middleware(['permission:manage-measurements'])->group(function () {
        Route::resource("naap", MeasurementsController::class);
        Route::resource('measurements', MeasurementController::class);
        Route::get('measurements/create/{customer?}', [MeasurementController::class, 'create'])
        ->name('measurements.create.withCustomer');
    });
    
    
    // TYPE - Require manage-types permission
    Route::middleware(['permission:manage-types'])->group(function () {
        Route::get("types/get", [TypeController::class, "getType"])->name('type.get');
        Route::resource("types", TypeController::class);
    });
    
    // field - Require manage-fields permission
    Route::middleware(['permission:manage-fields'])->group(function () {
        Route::get("fields/{id}", [FieldController::class, "getFieldsByTypeId"])->name('field.byType');
        Route::resource("fields", FieldController::class);
    });


    // Brand - Require manage-brands permission
    Route::middleware(['permission:manage-brands'])->group(function () {
        Route::resource("brands", \App\Http\Controllers\BrandController::class);
    });
    
    // Supplier - Require manage-suppliers permission
    Route::middleware(['permission:manage-suppliers'])->group(function () {
        Route::resource("suppliers", \App\Http\Controllers\SupplierController::class);
    });
    
    // category - Require manage-categories permission
    Route::middleware(['permission:manage-categories'])->group(function () {
        Route::resource("categories", \App\Http\Controllers\CategoryController::class);
    });
    
    // products - Require manage-products permission
    Route::middleware(['permission:manage-products'])->group(function () {
        Route::resource('products', \App\Http\Controllers\ProductController::class);
    });
    
    // orders - Require manage-orders permission
    Route::middleware(['permission:manage-orders'])->group(function () {
        Route::resource('orders', \App\Http\Controllers\OrderController::class);
        Route::put('order-items/{item}/status', [\App\Http\Controllers\OrderItemController::class, 'updateStatus'])->name('order-items.update-status');
        Route::get('orders/create/{customer?}', [OrderController::class, 'create'])
            ->name('orders.create.withCustomer');
    });
    
    // Reports - Require view-reports permission
    Route::middleware(['permission:view-reports'])->prefix('reports')->group(function () {
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

    // Purchases - Require manage-purchases permission
    Route::middleware(['permission:manage-purchases'])->group(function () {
        Route::resource('purchases', PurchaseController::class)->only(['index', 'create', 'store']);
    });
    
    // Payments - Require manage-payments permission
    Route::middleware(['permission:manage-payments'])->group(function () {
        Route::post('payments', [\App\Http\Controllers\PaymentController::class, 'store'])->name('payments.store');
        Route::get('payments', [\App\Http\Controllers\PaymentController::class, 'getPayments'])->name('payments.get');
    });
    
    // Roles & Permissions - Require manage-roles-permissions permission
    Route::middleware(['permission:manage-roles-permissions'])->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
    });
});
// Route::get("/types/get/{name}", [TypeController::class, "getType"])->name('type.get');


Route::get('/checkout', [CheckoutController::class, 'index']);
Route::post('/create-payment-intent', [CheckoutController::class, 'createPaymentIntent']);
