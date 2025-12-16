<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\MeasurementController;
use App\Http\Controllers\MeasurementsController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SewingOrderController;
use App\Http\Controllers\WorkerLedgerController;
use App\Http\Controllers\WorkerTypeController;

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
        Route::resource('orders', OrderController::class);
        Route::get('orders/{order}/print', [OrderController::class, 'print'])->name('orders.print');
        Route::put('order-items/{item}/status', [OrderItemController::class, 'updateStatus'])->name('order-items.update-status');
        Route::get('orders/create/{customer?}', [OrderController::class, 'create'])
            ->name('orders.create.withCustomer');
        Route::post('orders/{order}/return', [OrderController::class, 'returnOrder'])->name('orders.return');
        Route::post('order-items/{item}/return', [OrderItemController::class, 'returnItem'])->name('order-items.return');
        Route::post('order-items/{item}/cancel', [OrderController::class, 'cancelItem'])->name('order-items.cancel');
    });

    // sewing orders - Require manage-sewing-orders permission
    Route::middleware(['permission:manage-sewing-orders'])->group(function () {
        Route::resource('sewing-orders', SewingOrderController::class);
        Route::get('sewing-orders/{sewing_order}/print', [SewingOrderController::class, 'print'])->name('sewing-orders.print');
        Route::get('sewing-orders/create/{customer?}', [SewingOrderController::class, 'create'])->name('sewing-orders.create.withCustomer');
        Route::put('sewing-order-items/{item}/status', [SewingOrderController::class, 'updateItemStatus'])->name('sewing-order-items.update-status');
        // Route for storing a refund for a sewing order (for AJAX)
        Route::post('refunds', [\App\Http\Controllers\SewingOrderController::class, 'createRefund'])->name('refunds.store');

        // Route to update the status of a sewing order (PATCH)
        Route::patch('sewing-orders/{sewing_order}/update-status', [SewingOrderController::class, 'updateStatus'])->name('sewing-orders.update-status');
        Route::get('sewing-order-items/{item}/print-measurement', [SewingOrderController::class, 'printMeasurement'])->name('sewing-order-items.print-measurement');
        Route::put('sewing-order-items/{item}/assign-measurement', [SewingOrderController::class, 'assignMeasurement'])->name('sewing-order-items.assign-measurement');
    });

    Route::middleware(['permission:manage-workers'])->group(function () {
        Route::get('workers/ledger', [WorkerLedgerController::class, 'indexForAdmin'])->name('admin.workers.ledger.index');
        Route::get('workers/{worker}/ledger', [WorkerLedgerController::class, 'showForAdmin'])->name('admin.workers.ledger.show');
        Route::post('workers/{worker}/ledger/payments', [WorkerLedgerController::class, 'addPaymentForAdmin'])->name('admin.workers.ledger.payments.store');
        Route::post('workers/types/{workerType}', [WorkerTypeController::class, 'destroy'])->name('workers.types.destroy');
        Route::resource('workers/types', WorkerTypeController::class)->names('workers.types');
    });

    Route::middleware(['permission:worker-dashboard'])->group(function () {
        Route::get('worker/dashboard', [SewingOrderController::class, 'workerDashboard'])->name('worker.dashboard');
        Route::put('worker/sewing-order-items/{item}/update-status', [SewingOrderController::class, 'updateWorkerStatus'])->name('worker.sewing-order-items.update-status');
        Route::get('worker/ledger', [WorkerLedgerController::class, 'myLedger'])->name('worker.ledger');
    });

    // Reports - Require view-reports permission
    Route::prefix('reports')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\ReportController::class, 'dashboard'])
            ->middleware('permission:view-reports-dashboard')
            ->name('reports.dashboard');
        Route::get('/sales', [\App\Http\Controllers\ReportController::class, 'salesReport'])
            ->middleware('permission:view-reports-sales')
            ->name('reports.sales');
        Route::get('/customers', [\App\Http\Controllers\ReportController::class, 'customerReport'])
            ->middleware('permission:view-reports-customers')
            ->name('reports.customers');
        Route::get('/suppliers', [\App\Http\Controllers\ReportController::class, 'supplierReport'])
            ->middleware('permission:view-reports-suppliers')
            ->name('reports.suppliers');
        Route::get('/inventory-history', [\App\Http\Controllers\ReportController::class, 'inventoryHistory'])
            ->middleware('permission:view-reports-inventory-history')
            ->name('reports.inventory-history');
        Route::get('/customers/{customer}/ledger', [ReportController::class, 'customerLedgerDetail'])
            ->middleware('permission:view-reports-customer-ledger')
            ->name('reports.customers.ledger');
        Route::get('/suppliers/{supplier}/ledger', [\App\Http\Controllers\ReportController::class, 'supplierLedgerDetail'])
            ->middleware('permission:view-reports-supplier-ledger')
            ->name('reports.suppliers.ledger');
        Route::get('/transactions', [\App\Http\Controllers\ReportController::class, 'transactionsReport'])
            ->middleware('permission:view-reports-transactions')
            ->name('reports.transactions');
        Route::get('/pending-transactions', [\App\Http\Controllers\ReportController::class, 'pendingTransactionsReport'])
            ->middleware('permission:view-reports-pending-transactions')
            ->name('reports.pending-transactions');
        Route::get('/completed-transactions', [\App\Http\Controllers\ReportController::class, 'completedTransactionsReport'])
            ->middleware('permission:view-reports-completed-transactions')
            ->name('reports.completed-transactions');
        Route::get('/user-transactions', [\App\Http\Controllers\ReportController::class, 'userTransactionsReport'])
            ->middleware('permission:view-reports-user-transactions')
            ->name('reports.user-transactions');
        Route::get('/customer-transactions', [\App\Http\Controllers\ReportController::class, 'customerTransactionsReport'])
            ->middleware('permission:view-reports-customer-transactions')
            ->name('reports.customer-transactions');
        Route::get('/supplier-transactions', [\App\Http\Controllers\ReportController::class, 'supplierTransactionsReport'])
            ->middleware('permission:view-reports-supplier-transactions')
            ->name('reports.supplier-transactions');
    });

    // Purchases - Require manage-purchases permission
    Route::middleware(['permission:manage-purchases'])->group(function () {
        Route::resource('purchases', PurchaseController::class)->only(['index', 'create', 'store']);
    });

    // Payments - Require manage-payments permission
    Route::middleware(['permission:manage-payments'])->group(function () {
        Route::post('payments', [\App\Http\Controllers\PaymentController::class, 'store'])->name('payments.store');
        Route::get('payments', [\App\Http\Controllers\PaymentController::class, 'getPayments'])->name('payments.get');
        Route::post('payments/{payment}/refund', [\App\Http\Controllers\PaymentController::class, 'createRefund'])->name('payments.refund');
    });

    // Roles & Permissions - Require manage-roles-permissions permission
    Route::middleware(['permission:manage-roles-permissions'])->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);
    });

    // Expenses
    Route::middleware(['permission:manage-expenses'])->group(function () {
        Route::resource('expenses', \App\Http\Controllers\ExpenseController::class);
    });
});
// Route::get("/types/get/{name}", [TypeController::class, "getType"])->name('type.get');
