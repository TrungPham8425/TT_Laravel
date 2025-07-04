<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Nhóm route dành cho admin, bảo vệ bởi middleware 'auth' và 'check.role:admin'
Route::middleware(['auth', 'check.role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Resource controller cho bài viết, chỉ sử dụng các method cần thiết
    Route::resource('posts', App\Http\Controllers\PostController::class)
        ->only(['index', 'create', 'store', 'show'])
        ->names([
            'index' => 'posts.index', // Trang danh sách bài viết
            'create' => 'posts.create', // Trang tạo bài viết mới
            'store' => 'posts.store',
            'show' => 'posts.show',
        ]);

    // Route model binding theo slug cho bài viết
    Route::get('posts/{post:slug}', [App\Http\Controllers\PostController::class, 'show'])
        ->name('posts.show');

    // Route dashboard admin (single action controller)
    Route::get('dashboard', App\Http\Controllers\DashboardController::class)
        ->name('dashboard');
});

// Route fallback cho các đường dẫn không tồn tại, trả về view 404 tuỳ chỉnh
Route::fallback(function () {
    // Trả về view resources/views/errors/404.blade.php
    return response()->view('errors.404', [], 404);
});

// Route hiển thị form đăng nhập
Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

// Route xử lý đăng nhập
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->middleware('guest');

// Route đăng xuất
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Route hiển thị form đăng ký
Route::get('/register', function () {
    return view('auth.register');
})->name('register')->middleware('guest');

// Route xử lý đăng ký
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register'])->middleware('guest');
