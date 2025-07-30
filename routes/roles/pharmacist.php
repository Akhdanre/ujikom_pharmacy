<?php

use App\Http\Controllers\Web\MedicineController;
use App\Http\Controllers\Web\SellTransactionController;
use Illuminate\Support\Facades\Route;

// Pharmacist Routes
Route::middleware(['auth', 'pharmacist'])->group(function () {
    // Pharmacist Dashboard
    Route::get('/pharmacist/dashboard', function () {
        return view('pages.pharmacist.dashboard');
    })->name('pharmacist.dashboard');

    // Medicine Management (Read-only for pharmacist)
    Route::get('/pharmacist/medicines', [MedicineController::class, 'index'])->name('pharmacist.medicines.index');
    Route::get('/pharmacist/medicines/{medicine}', [MedicineController::class, 'show'])->name('pharmacist.medicines.show');
    Route::get('/pharmacist/medicines/search', [MedicineController::class, 'search'])->name('pharmacist.medicines.search');
    Route::get('/pharmacist/medicines/low-stock', [MedicineController::class, 'lowStock'])->name('pharmacist.medicines.low-stock');
    Route::get('/pharmacist/medicines/out-of-stock', [MedicineController::class, 'outOfStock'])->name('pharmacist.medicines.out-of-stock');
    Route::get('/pharmacist/medicines/expired', [MedicineController::class, 'expired'])->name('pharmacist.medicines.expired');
    Route::get('/pharmacist/medicines/expiring-soon', [MedicineController::class, 'expiringSoon'])->name('pharmacist.medicines.expiring-soon');

    // Sales Transactions
    Route::resource('pharmacist/sales-transactions', SellTransactionController::class)->names([
        'index' => 'pharmacist.sales-transactions.index',
        'create' => 'pharmacist.sales-transactions.create',
        'store' => 'pharmacist.sales-transactions.store',
        'show' => 'pharmacist.sales-transactions.show',
        'edit' => 'pharmacist.sales-transactions.edit',
        'update' => 'pharmacist.sales-transactions.update',
        'destroy' => 'pharmacist.sales-transactions.destroy',
    ]);

    // Pharmacist Profile
    Route::get('/pharmacist/profile', function () {
        return view('pages.pharmacist.profile');
    })->name('pharmacist.profile');

    // Pharmacist Settings
    Route::get('/pharmacist/settings', function () {
        return view('pages.pharmacist.settings');
    })->name('pharmacist.settings');

    // Basic Reports (Limited access)
    Route::get('/pharmacist/reports/sales', function () {
        return view('pages.pharmacist.reports.sales');
    })->name('pharmacist.reports.sales');

    Route::get('/pharmacist/reports/inventory', function () {
        return view('pages.pharmacist.reports.inventory');
    })->name('pharmacist.reports.inventory');
});
