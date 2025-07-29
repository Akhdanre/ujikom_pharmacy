<?php

use App\Presentation\Controllers\Web\MedicineController;
use App\Presentation\Controllers\Web\SellTransactionController;
use App\Presentation\Controllers\Web\BuyTransactionController;
use App\Presentation\Controllers\Auth\LoginController;
use App\Presentation\Controllers\Auth\RegisterController;
use App\Presentation\Controllers\EcommerceController;
use Illuminate\Support\Facades\Route;

// Public E-commerce Routes (Tokopedia/Shopee Style)
Route::get('/', [EcommerceController::class, 'index'])->name('home');
Route::get('/products', [EcommerceController::class, 'products'])->name('products');
Route::get('/product/{id}', [EcommerceController::class, 'productDetail'])->name('product.detail');
Route::get('/category/{category}', [EcommerceController::class, 'category'])->name('category');
Route::get('/search', [EcommerceController::class, 'search'])->name('search');
Route::get('/cart', [EcommerceController::class, 'cart'])->name('cart');
Route::get('/checkout', [EcommerceController::class, 'checkout'])->name('checkout');
Route::get('/about', [EcommerceController::class, 'about'])->name('about');
Route::get('/contact', [EcommerceController::class, 'contact'])->name('contact');

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
    'admin'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.dashboard.index');
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

    // Transaction Routes
    Route::resource('transactions', SellTransactionController::class);

    // Buy Transaction Routes
    Route::resource('buy-transactions', BuyTransactionController::class);
});

require __DIR__ . '/auth.php';
