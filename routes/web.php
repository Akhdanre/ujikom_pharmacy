<?php

use App\Presentation\Controllers\Web\MedicineController;
use App\Presentation\Controllers\Auth\LoginController;
use App\Presentation\Controllers\Auth\RegisterController;
use App\Presentation\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/medicine/{id}', [HomeController::class, 'show'])->name('medicine.detail');
Route::get('/category/{category}', [HomeController::class, 'category'])->name('category');

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware([
    'auth',
    'admin',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Medicine Routes
    Route::resource('medicines', MedicineController::class);
    
    // Additional Medicine Routes
    Route::get('medicines/search', [MedicineController::class, 'search'])->name('medicines.search');
    Route::get('medicines/low-stock', [MedicineController::class, 'lowStock'])->name('medicines.low-stock');
    Route::get('medicines/out-of-stock', [MedicineController::class, 'outOfStock'])->name('medicines.out-of-stock');
    Route::get('medicines/expired', [MedicineController::class, 'expired'])->name('medicines.expired');
    Route::get('medicines/expiring-soon', [MedicineController::class, 'expiringSoon'])->name('medicines.expiring-soon');
    Route::get('medicines/inventory/report', [MedicineController::class, 'inventoryReport'])->name('medicines.inventory-report');
});

require __DIR__.'/auth.php';
