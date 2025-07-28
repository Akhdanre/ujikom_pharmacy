<?php

use App\Livewire\Medicine\MedicineIndex;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Presentation\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/medicine/{id}', [HomeController::class, 'show'])->name('medicine.detail');
Route::get('/category/{category}', [HomeController::class, 'category'])->name('category');

// Auth Routes
Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'admin',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // DDD Medicine Routes
    Route::get('/medicines', MedicineIndex::class)->name('medicines.index');
});

require __DIR__.'/auth.php';
