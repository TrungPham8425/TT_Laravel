<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

// Route kiểm tra TranslatorInterface
Route::get('/greeting', [HomeController::class, 'index']);
