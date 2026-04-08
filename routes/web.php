<?php

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Middleware\EnsureAdmin;

Route::get('/', [AuthController::class, 'showHome'])->name('home');
Route::get('/menu', [ProductController::class, 'index'])->name('menu');
Route::get('/promo', function () {
    return view('promo');
})->name('promo');
Route::get('/cart', [CartController::class, 'index'])->name('cart');

// Cart API routes (AJAX)
Route::middleware('auth')->group(function () {
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart/summary', [CartController::class, 'summary'])->name('cart.summary');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::get('/api/cart/count', [CartController::class, 'count'])->name('api.cart.count');
});

Route::post('/checkout', function () {
    if (!Auth::check()) {
        return redirect()->route('login')->with('message', 'Silakan login terlebih dahulu untuk melakukan checkout');
    }
    // Proses checkout
    return redirect()->route('riwayat')->with('success', 'Pesanan berhasil dibuat!');
})->name('checkout');
Route::get('/kontak', function () {
    return view('kontak');
})->name('kontak');
Route::get('/riwayat', [OrderController::class, 'history'])->name('riwayat')->middleware('auth');
Route::get('/api/orders/history', [OrderController::class, 'historyJson'])->name('api.orders.history')->middleware('auth');
Route::get('/payment', function () {
    return view('payment');
})->name('payment');

// Review routes
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');

// Admin routes
Route::middleware([Authenticate::class, EnsureAdmin::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/pesanan-baru', [AdminController::class, 'newOrders'])->name('admin.new-orders');
    Route::post('/admin/orders/{id}/verify', [AdminController::class, 'verifyOrder'])->name('admin.orders.verify');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
