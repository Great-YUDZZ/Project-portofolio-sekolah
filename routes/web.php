<?php

use App\Http\Controllers\Admin\AdminContentController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Lms\LmsDashboardController;
use App\Http\Controllers\Public\AchievementController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\EcosystemController;
use App\Http\Controllers\Public\GalleryController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\MajorController;
use App\Http\Controllers\Public\ProfileController;
use App\Http\Controllers\Public\PublicationController;
use App\Http\Controllers\Public\SearchController;
use App\Http\Controllers\Public\StaffController;
use App\Http\Controllers\Public\StudentWorkController;
use Illuminate\Support\Facades\Route;

// Halaman Publik Portofolio
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/profil', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/sdm', [StaffController::class, 'index'])->name('staff.index');
Route::get('/jurusan', [MajorController::class, 'index'])->name('majors.index');
Route::get('/jurusan/{slug}', [MajorController::class, 'show'])->name('majors.show');
Route::get('/karya', [StudentWorkController::class, 'index'])->name('works.index');
Route::get('/prestasi', [AchievementController::class, 'index'])->name('achievements.index');
Route::get('/publikasi', [PublicationController::class, 'index'])->name('publications.index');
Route::get('/publikasi/{slug}', [PublicationController::class, 'show'])->name('publications.show');
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact.index');
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');
Route::get('/ekosistem', [EcosystemController::class, 'index'])->name('ecosystem.index');
Route::get('/cari', [SearchController::class, 'index'])->name('search.index');

// Autentikasi
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Area Administrator
Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/konten', [AdminContentController::class, 'index'])->name('content');
    Route::post('/konten/publikasi', [AdminContentController::class, 'storePost'])->name('posts.store');
    Route::delete('/konten/publikasi/{post}', [AdminContentController::class, 'destroyPost'])->name('posts.destroy');
    Route::post('/konten/karya', [AdminContentController::class, 'storeWork'])->name('works.store');
    Route::delete('/konten/karya/{work}', [AdminContentController::class, 'destroyWork'])->name('works.destroy');
    Route::post('/konten/prestasi', [AdminContentController::class, 'storeAchievement'])->name('achievements.store');
    Route::delete('/konten/prestasi/{achievement}', [AdminContentController::class, 'destroyAchievement'])->name('achievements.destroy');
    Route::patch('/konten/pesan/{message}/baca', [AdminContentController::class, 'markMessageRead'])->name('messages.read');
    Route::post('/konten/pengaturan', [AdminContentController::class, 'updateSettings'])->name('settings.update');
});

// Area LMS (Guru & Siswa)
Route::prefix('lms')->middleware(['auth', 'role:guru,siswa'])->name('lms.')->group(function () {
    Route::get('/', [LmsDashboardController::class, 'index'])->name('dashboard');
});
