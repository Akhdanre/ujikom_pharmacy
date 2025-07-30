<?php


use App\Http\Controllers\UserHome\UserHomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserHomeController::class, 'index'])->name('home');
Route::get('/products', [UserHomeController::class, 'products'])->name('products');
Route::get('/product/{id}', [UserHomeController::class, 'productDetail'])->name('product.detail');
Route::get('/category/{category}', [UserHomeController::class, 'category'])->name('category');
Route::get('/search', [UserHomeController::class, 'search'])->name('search');
Route::get('/cart', [UserHomeController::class, 'cart'])->name('cart');
Route::get('/checkout', [UserHomeController::class, 'checkout'])->name('checkout');
Route::get('/about', [UserHomeController::class, 'about'])->name('about');
Route::get('/contact', [UserHomeController::class, 'contact'])->name('contact');

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Role-based redirect after login
Route::get('/dashboard', function () {
    $user = Auth::user();

    if (!$user) {
        return redirect()->route('login');
    }

    return match ($user->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'pharmacist' => redirect()->route('pharmacist.dashboard'),
        'buyer' => redirect()->route('user.dashboard'),
        default => redirect()->route('home')
    };
})->name('dashboard')->middleware('auth');

// Include role-based routes
require __DIR__ . '/roles/user.php';
require __DIR__ . '/roles/pharmacist.php';
require __DIR__ . '/roles/admin.php';

require __DIR__ . '/auth.php';
