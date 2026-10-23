<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Lms\LmsDashboardController;
use App\Http\Controllers\Public\HomeController;
use Illuminate\Support\Facades\Route;

// Halaman Publik Portofolio
Route::get('/', [HomeController::class, 'index'])->name('home');

// Autentikasi
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Area Administrator
Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
});

// Area LMS (Guru & Siswa)
Route::prefix('lms')->middleware(['auth', 'role:guru,siswa'])->name('lms.')->group(function () {
    Route::get('/', [LmsDashboardController::class, 'index'])->name('dashboard');
});
