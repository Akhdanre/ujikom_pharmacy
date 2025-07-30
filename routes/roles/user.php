<?php


use Illuminate\Support\Facades\Route;

// User/Buyer Routes
Route::middleware(['auth', 'user'])->group(function () {
    // User Dashboard
    Route::get('/user/dashboard', function () {
        return view('pages.user.dashboard');
    })->name('user.dashboard');

    // User Profile
    Route::get('/user/profile', function () {
        return view('pages.user.profile');
    })->name('user.profile');

    // User Orders
    Route::get('/user/orders', function () {
        return view('pages.user.orders');
    })->name('user.orders');

    // User Order History
    Route::get('/user/order-history', function () {
        return view('pages.user.order-history');
    })->name('user.order-history');

    // User Wishlist
    Route::get('/user/wishlist', function () {
        return view('pages.user.wishlist');
    })->name('user.wishlist');

    // User Settings
    Route::get('/user/settings', function () {
        return view('pages.user.settings');
    })->name('user.settings');
});
