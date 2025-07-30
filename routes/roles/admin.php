<?php

use App\Http\Controllers\Medicine\MedicineController;
use App\Http\Controllers\SellTransaction\SellTransactionController;
use App\Http\Controllers\BuyTransaction\BuyTransactionController;
use Illuminate\Support\Facades\Route;

// Admin Routes
Route::middleware(['auth', 'admin'])->group(function () {
    // Admin Dashboard
    Route::get('/admin/dashboard', function () {
        return view('pages.admin.dashboard');
    })->name('admin.dashboard');

    // Medicine Management (Full access)
    Route::resource('admin/medicines', MedicineController::class)->names([
        'index' => 'admin.medicines.index',
        'create' => 'admin.medicines.create',
        'store' => 'admin.medicines.store',
        'show' => 'admin.medicines.show',
        'edit' => 'admin.medicines.edit',
        'update' => 'admin.medicines.update',
        'destroy' => 'admin.medicines.destroy',
    ]);

    // Additional Medicine Routes
    Route::get('admin/medicines/search', [MedicineController::class, 'search'])->name('admin.medicines.search');
    Route::get('admin/medicines/low-stock', [MedicineController::class, 'lowStock'])->name('admin.medicines.low-stock');
    Route::get('admin/medicines/out-of-stock', [MedicineController::class, 'outOfStock'])->name('admin.medicines.out-of-stock');
    Route::get('admin/medicines/expired', [MedicineController::class, 'expired'])->name('admin.medicines.expired');
    Route::get('admin/medicines/expiring-soon', [MedicineController::class, 'expiringSoon'])->name('admin.medicines.expiring-soon');
    Route::get('admin/medicines/inventory/report', [MedicineController::class, 'inventoryReport'])->name('admin.medicines.inventory-report');

    // Sales Transactions
    Route::resource('admin/sales-transactions', SellTransactionController::class)->names([
        'index' => 'admin.sales-transactions.index',
        'create' => 'admin.sales-transactions.create',
        'store' => 'admin.sales-transactions.store',
        'show' => 'admin.sales-transactions.show',
        'edit' => 'admin.sales-transactions.edit',
        'update' => 'admin.sales-transactions.update',
        'destroy' => 'admin.sales-transactions.destroy',
    ]);

    // Buy Transactions
    Route::resource('admin/buy-transactions', BuyTransactionController::class)->names([
        'index' => 'admin.buy-transactions.index',
        'create' => 'admin.buy-transactions.create',
        'store' => 'admin.buy-transactions.store',
        'show' => 'admin.buy-transactions.show',
        'edit' => 'admin.buy-transactions.edit',
        'update' => 'admin.buy-transactions.update',
        'destroy' => 'admin.buy-transactions.destroy',
    ]);

    // User Management
    Route::get('/admin/users', function () {
        return view('pages.admin.users.index');
    })->name('admin.users.index');

    Route::get('/admin/users/create', function () {
        return view('pages.admin.users.create');
    })->name('admin.users.create');

    Route::get('/admin/users/{user}', function () {
        return view('pages.admin.users.show');
    })->name('admin.users.show');

    Route::get('/admin/users/{user}/edit', function () {
        return view('pages.admin.users.edit');
    })->name('admin.users.edit');

    // Category Management
    Route::get('/admin/categories', function () {
        return view('pages.admin.categories.index');
    })->name('admin.categories.index');

    Route::get('/admin/categories/create', function () {
        return view('pages.admin.categories.create');
    })->name('admin.categories.create');

    Route::get('/admin/categories/{category}', function () {
        return view('pages.admin.categories.show');
    })->name('admin.categories.show');

    Route::get('/admin/categories/{category}/edit', function () {
        return view('pages.admin.categories.edit');
    })->name('admin.categories.edit');

    // Supplier Management
    Route::get('/admin/suppliers', function () {
        return view('pages.admin.suppliers.index');
    })->name('admin.suppliers.index');

    Route::get('/admin/suppliers/create', function () {
        return view('pages.admin.suppliers.create');
    })->name('admin.suppliers.create');

    Route::get('/admin/suppliers/{supplier}', function () {
        return view('pages.admin.suppliers.show');
    })->name('admin.suppliers.show');

    Route::get('/admin/suppliers/{supplier}/edit', function () {
        return view('pages.admin.suppliers.edit');
    })->name('admin.suppliers.edit');

    // Reports
    Route::get('/admin/reports/sales', function () {
        return view('pages.admin.reports.sales');
    })->name('admin.reports.sales');

    Route::get('/admin/reports/inventory', function () {
        return view('pages.admin.reports.inventory');
    })->name('admin.reports.inventory');

    Route::get('/admin/reports/financial', function () {
        return view('pages.admin.reports.financial');
    })->name('admin.reports.financial');

    Route::get('/admin/reports/users', function () {
        return view('pages.admin.reports.users');
    })->name('admin.reports.users');

    // Settings
    Route::get('/admin/settings', function () {
        return view('pages.admin.settings');
    })->name('admin.settings');

    Route::get('/admin/settings/system', function () {
        return view('pages.admin.settings.system');
    })->name('admin.settings.system');

    Route::get('/admin/settings/backup', function () {
        return view('pages.admin.settings.backup');
    })->name('admin.settings.backup');
});
