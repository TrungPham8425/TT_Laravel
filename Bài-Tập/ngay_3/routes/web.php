<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

// Trang danh sách tác giả
Route::get('/authors', [AuthorController::class, 'index'])->name('authors.index');

// Trang danh sách bài viết
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// Trang chi tiết bài viết (theo slug)
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
