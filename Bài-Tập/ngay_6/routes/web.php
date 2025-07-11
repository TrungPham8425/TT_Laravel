<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes cho Post management (yêu cầu auth và verified)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('posts', PostController::class);
});

// Routes cho Admin (yêu cầu auth, verified và admin role)
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/posts', [AdminController::class, 'posts'])->name('posts');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::patch('/users/{user}/role', [AdminController::class, 'changeUserRole'])->name('users.change-role');
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
