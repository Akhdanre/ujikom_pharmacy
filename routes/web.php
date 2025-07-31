<?php

use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\UserHomeController;
use App\Http\Controllers\Ecommerce\HomeController;
use App\Http\Controllers\Ecommerce\ProductsController;
use App\Http\Controllers\Ecommerce\ProductDetailController;
use App\Http\Controllers\Ecommerce\CartController;
use App\Http\Controllers\Ecommerce\SearchController;
use App\Http\Controllers\Ecommerce\AboutController;
use App\Http\Controllers\Ecommerce\ContactController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('home');

// Ecommerce Products
Route::get('/ecommerce/products', [ProductsController::class, 'index'])->name('ecommerce.products');

// Ecommerce Product Detail
Route::get('/ecommerce/products/{id}', [ProductDetailController::class, 'show'])->name('ecommerce.product.detail');

// Ecommerce Cart
Route::get('/ecommerce/cart', [CartController::class, 'index'])->name('ecommerce.cart');
Route::post('/ecommerce/cart/add', [CartController::class, 'addToCart'])->name('ecommerce.cart.add');
Route::put('/ecommerce/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('ecommerce.cart.update-quantity');
Route::delete('/ecommerce/cart/remove-item', [CartController::class, 'removeItem'])->name('ecommerce.cart.remove-item');
Route::post('/ecommerce/cart/apply-coupon', [CartController::class, 'applyCoupon'])->name('ecommerce.cart.apply-coupon');

// Ecommerce Search
Route::get('/ecommerce/search', [SearchController::class, 'index'])->name('ecommerce.search');
Route::get('/ecommerce/search/suggestions', [SearchController::class, 'suggestions'])->name('ecommerce.search.suggestions');

// Ecommerce About
Route::get('/ecommerce/about', [AboutController::class, 'index'])->name('ecommerce.about');

// Ecommerce Contact
Route::get('/ecommerce/contact', [ContactController::class, 'index'])->name('ecommerce.contact');
Route::post('/ecommerce/contact/send-message', [ContactController::class, 'sendMessage'])->name('ecommerce.contact.send-message');
Route::post('/ecommerce/contact/subscribe-newsletter', [ContactController::class, 'subscribeNewsletter'])->name('ecommerce.contact.subscribe-newsletter');



// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// Admin Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AdminLoginController::class, 'index'])->name('admin.login');
    Route::post('/admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
});

Route::middleware('auth')->group(function () {
    Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Medicines
    Route::resource('medicines', MedicineController::class);
    
    // Categories
    Route::resource('categories', CategoryController::class);
    
    // Customers
    Route::resource('customers', CustomerController::class);
    
    // Sales
    Route::resource('sales', SaleController::class);
    
    // Purchases
    Route::resource('purchases', PurchaseController::class);
    
    // Inventory
    Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');
    
    // Reports
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    
    // Users
    Route::resource('users', UserController::class);
    
    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
});


// Include role-based routes
require __DIR__ . '/roles/user.php';
require __DIR__ . '/roles/pharmacist.php';
require __DIR__ . '/roles/admin.php';

require __DIR__ . '/auth.php';
