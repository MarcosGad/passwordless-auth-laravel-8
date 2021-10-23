<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('register', [AuthController::class, 'registerForm'])->name('registerForm');
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::get('verify', [AuthController::class, 'verify'])->name('verify');

Route::get('login', [AuthController::class, 'loginForm'])->name('loginForm');
Route::post('send-link', [AuthController::class, 'sendLink'])->name('sendLink');
Route::get('login-verify', [AuthController::class, 'login'])->name('loginVerify');

Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');