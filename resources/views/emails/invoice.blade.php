<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Middleware\CheckRole;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\Admin\ReviewController as AdminReviewController;
use App\Http\Controllers\ShopController;

Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');


Route::middleware(['auth', CheckRole::class . ':admin'])->prefix('admin')->group(function () {
    Route::resource('reviews', AdminReviewController::class)->only(['index', 'destroy']);
    Route::post('reviews/{review}/reply', [AdminReviewController::class, 'reply'])->name('admin.reviews.reply');
});



Route::get('/', [ProductController::class, 'shopIndex'])->name('shop.index');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/checkout/invoice/{id}', [CheckoutController::class, 'invoice'])->name('checkout.invoice');
Route::post('/checkout/vnpay', [CheckoutController::class, 'vnpayPayment'])->name('checkout.vnpay');
Route::get('/checkout/vnpay-return', [CheckoutController::class, 'vnpayReturn'])->name('checkout.vnpay.return');

Route::middleware(['auth'])->group(function () {
    Route::resource('orders', OrderController::class)->only(['index', 'show', 'update', 'destroy']);
        Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.my');
    Route::post('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
});


// ADMIN: danh sách / tạo / xóa khuyến mãi
Route::middleware(['auth', \App\Http\Middleware\CheckRole::class . ':admin'])->group(function () {
    Route::get('/promotions',            [PromotionController::class, 'index'])->name('promotions.index');
    Route::get('/promotions/create',     [PromotionController::class, 'create'])->name('promotions.create'); // bonus UI
    Route::post('/promotions',           [PromotionController::class, 'store'])->name('promotions.store');
    Route::delete('/promotions/{promotion}', [PromotionController::class, 'destroy'])->name('promotions.destroy'); // tuỳ chọn
});

// USER: áp dụng khuyến mãi vào giỏ
Route::post('/cart/apply-promotion', [PromotionController::class, 'applyPromotion'])
    ->middleware('auth')
    ->name('cart.applyPromotion');


// Dashboard cho admin
Route::middleware(['auth', CheckRole::class . ':admin'])
    ->get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');


// CRUD cho admin
Route::middleware(['auth', CheckRole::class . ':admin'])->group(function () {
    Route::resource('products', ProductController::class)->except(['show']);
    Route::resource('categories', CategoryController::class);
});



Route::middleware('auth')->group(function () {
    Route::post('/products/{id}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/{review}/edit', [\App\Http\Controllers\ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/{review}', [\App\Http\Controllers\ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [\App\Http\Controllers\ReviewController::class, 'destroy'])->name('reviews.destroy');
});


// Báo cáo cho admin
Route::middleware(['auth', CheckRole::class . ':admin'])->prefix('admin')->group(function () {
    Route::get('/reports', [ReportController::class, 'index'])->name('admin.reports.index');
    Route::post('/reports/generate', [ReportController::class, 'generate'])->name('admin.reports.generate');
    Route::post('/reports/filter', [ReportController::class, 'filter'])->name('reports.filter');
    // Route::post('/reports/filter', [ReportController::class, 'filter'])->name('admin.reports.filter');
    Route::get('admin/reports/print', [\App\Http\Controllers\ReportController::class, 'print'])
    ->name('admin.reports.print');

});


Route::middleware(['auth', CheckRole::class . ':admin'])->prefix('admin')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('admin.orders.show');
    Route::post('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
});


// Giỏ hàng cho user
Route::middleware(['auth'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');

    Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update'); // Cập nhật số lượng
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove'); // Xóa sản phẩm

    // Bổ sung các route cho trạng thái
    Route::put('/cart/cancel/{id}', [CartController::class, 'cancel'])->name('cart.cancel');   // Hủy đơn
    Route::post('/cart/reorder/{id}', [CartController::class, 'reorder'])->name('cart.reorder'); // Đặt lại
});



// Hồ sơ người dùng
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';