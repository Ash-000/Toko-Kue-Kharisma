<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\NotificationController;

// Halaman Publik
Route::get('/', [AuthController::class, 'showHome'])->name('home');
Route::get('/menu', [ProductController::class, 'index'])->name('menu');
// Route::get('/promo', fn() => view('promo'))->name('promo'); // Disabled
Route::get('/kontak', fn() => view('kontak'))->name('kontak');
Route::get('/ulasan', [ReviewController::class, 'index'])->name('reviews.index');
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/api/cart/count', [CartController::class, 'count'])->name('api.cart.count');
Route::get('/menu/{product:slug}', [ProductController::class, 'show'])->name('product.detail');

// Auth (Guest)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
});

// Auth (Logged In)
Route::middleware('auth')->group(function () {
    // Profil & Keamanan
    Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password', [AuthController::class, 'updatePassword'])->name('profile.password');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Keranjang & Checkout
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
    Route::get('/cart/summary', [CartController::class, 'summary'])->name('cart.summary');
    
    // Pesanan & Pembayaran
    Route::post('/checkout', [OrderController::class, 'store'])->name('checkout');
    Route::get('/riwayat', [OrderController::class, 'history'])->name('riwayat'); // Jalur ke riwayat
    Route::get('/api/orders/history', [OrderController::class, 'historyJson'])->name('api.orders.history');
    
    Route::get('/payment/upload/{orderId}', [PaymentController::class, 'show'])->name('payment.upload');
    Route::post('/payment/upload', [PaymentController::class, 'uploadProof'])->name('payment.upload-proof');

    // Cek status order untuk polling QRIS
    Route::get('/api/order/{orderNumber}/status', [OrderController::class, 'checkStatus'])->name('order.status');
    
    // Cancel order (untuk QRIS yang dibatalkan)
    Route::post('/api/order/{orderNumber}/cancel', [OrderController::class, 'cancelOrder'])->name('order.cancel');

    // Notifikasi user
    Route::get('/api/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/api/notifications/read-all', [NotificationController::class, 'markAllRead'])->name('notifications.read-all');
    Route::post('/api/notifications/{id}/read', [NotificationController::class, 'markRead'])->name('notifications.read');
});


Route::post('/midtrans/notification', [MidtransController::class, 'notification'])->name('midtrans.notification');

// Sandbox only: simulate QRIS payment & proxy QR image
if (app()->environment('local')) {
    Route::get('/dev/simulate-qris/{midtransOrderId}', [MidtransController::class, 'simulateQris'])->name('dev.simulate.qris');
    Route::get('/dev/qris-image/{midtransOrderId}', [MidtransController::class, 'qrisImage'])->name('dev.qris.image');
    // Update status order langsung (untuk testing tanpa webhook)
    Route::get('/dev/pay-order/{orderNumber}', [MidtransController::class, 'devPayOrder'])->name('dev.pay.order');
}