<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\Panel\AuditLogController;
use App\Http\Controllers\Panel\DashboardController;
use App\Http\Controllers\Panel\GalleryController as PanelGalleryController;
use App\Http\Controllers\Panel\MediaUploadController;
use App\Http\Controllers\Panel\PostController;
use App\Http\Controllers\Panel\ReviewController;
use App\Http\Controllers\Panel\ServerMonitorController;
use App\Http\Controllers\Panel\StaffController as PanelStaffController;
use App\Http\Controllers\Panel\UserController;
use App\Http\Controllers\Public\AchievementController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\EcosystemController;
use App\Http\Controllers\Public\ExtracurricularController;
use App\Http\Controllers\Public\FacilityController;
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
Route::get('/sejarah', [ProfileController::class, 'history'])->name('history.index');
Route::get('/visi-misi', [ProfileController::class, 'visionMission'])->name('vision-mission.index');
Route::get('/fasilitas', [FacilityController::class, 'index'])->name('facilities.index');
Route::get('/sdm', [StaffController::class, 'index'])->name('staff.index');
Route::get('/jurusan', [MajorController::class, 'index'])->name('majors.index');
Route::get('/jurusan/{slug}', [MajorController::class, 'show'])->name('majors.show');
Route::get('/karya', [StudentWorkController::class, 'index'])->name('works.index');
Route::get('/prestasi', [AchievementController::class, 'index'])->name('achievements.index');
Route::get('/ekstrakurikuler', [ExtracurricularController::class, 'index'])->name('extracurriculars.index');
Route::get('/ekstra', fn () => redirect()->route('extracurriculars.index'));
Route::get('/publikasi', [PublicationController::class, 'index'])->name('publications.index');
Route::get('/publikasi/{slug}', [PublicationController::class, 'show'])->name('publications.show');
Route::get('/galeri', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact.index');
Route::post('/kontak', [ContactController::class, 'store'])->middleware('throttle:10,1')->name('contact.store');
Route::get('/ekosistem', [EcosystemController::class, 'index'])->name('ecosystem.index');
Route::get('/cari', [SearchController::class, 'index'])->name('search.index');

// Autentikasi Pengguna & Registrasi Siswa
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    Route::get('/daftar', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/daftar', [RegisterController::class, 'register'])->name('register.post');
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Autentikasi Dua Faktor (2FA TOTP)
Route::middleware(['auth', 'active'])->group(function () {
    Route::get('/two-factor/setup', [TwoFactorController::class, 'setup'])->name('two-factor.setup');
    Route::post('/two-factor/setup', [TwoFactorController::class, 'confirmSetup'])->name('two-factor.setup.confirm');
    Route::get('/two-factor/challenge', [TwoFactorController::class, 'challenge'])->name('two-factor.challenge');
    Route::post('/two-factor/challenge', [TwoFactorController::class, 'verifyChallenge'])->name('two-factor.challenge.verify');
});

// Area Panel Terpadu (Admin, Guru, Siswa)
Route::prefix('admin')->middleware(['auth', 'active', 'role:admin,guru,siswa', '2fa'])->name('panel.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Manajemen Berita & Pengumuman
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');

    // Unggah Media Asinkron untuk Tiptap Editor
    Route::post('/media/upload', [MediaUploadController::class, 'upload'])->middleware('throttle:20,1')->name('media.upload');

    // Moderasi & Persetujuan Berita Siswa (Admin & Guru)
    Route::get('/review', [ReviewController::class, 'index'])->name('review.index');
    Route::get('/review/{post}', [ReviewController::class, 'show'])->name('review.show');
    Route::post('/review/{post}/approve', [ReviewController::class, 'approve'])->name('review.approve');
    Route::post('/review/{post}/reject', [ReviewController::class, 'reject'])->name('review.reject');

    // Manajemen Staf & Tenaga Pendidik (Admin)
    Route::get('/staff', [PanelStaffController::class, 'index'])->name('staff.index');
    Route::get('/staff/create', [PanelStaffController::class, 'create'])->name('staff.create');
    Route::post('/staff', [PanelStaffController::class, 'store'])->name('staff.store');
    Route::get('/staff/{staff}/edit', [PanelStaffController::class, 'edit'])->name('staff.edit');
    Route::put('/staff/{staff}', [PanelStaffController::class, 'update'])->name('staff.update');
    Route::delete('/staff/{staff}', [PanelStaffController::class, 'destroy'])->name('staff.destroy');

    // Manajemen Galeri Kegiatan (Admin & Guru)
    Route::get('/gallery', [PanelGalleryController::class, 'index'])->name('gallery.index');
    Route::post('/gallery', [PanelGalleryController::class, 'store'])->name('gallery.store');
    Route::get('/gallery/{gallery}', [PanelGalleryController::class, 'show'])->name('gallery.show');
    Route::post('/gallery/{gallery}/photos', [PanelGalleryController::class, 'uploadPhotos'])->name('gallery.photos.upload');
    Route::delete('/gallery/{gallery}/photos/{photo}', [PanelGalleryController::class, 'destroyPhoto'])->name('gallery.photos.destroy');
    Route::delete('/gallery/{gallery}', [PanelGalleryController::class, 'destroy'])->name('gallery.destroy');

    // Manajemen Akun & Verifikasi Siswa (Admin & Guru)
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create-guru', [UserController::class, 'createGuru'])->name('users.create-guru');
    Route::post('/users/guru', [UserController::class, 'storeGuru'])->name('users.store-guru');
    Route::post('/users/{user}/activate', [UserController::class, 'activateStudent'])->name('users.activate');
    Route::post('/users/{user}/reject', [UserController::class, 'rejectStudent'])->name('users.reject');
    Route::post('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Pemantau Beban Server (Admin)
    Route::get('/server', [ServerMonitorController::class, 'index'])->name('server.index');
    Route::get('/server/poll', [ServerMonitorController::class, 'poll'])->name('server.poll');

    // Catatan Audit Keamanan (Admin)
    Route::get('/audit', [AuditLogController::class, 'index'])->name('audit.index');

    // Pesan Masuk Humas (Admin)
    Route::get('/messages', [\App\Http\Controllers\Panel\MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [\App\Http\Controllers\Panel\MessageController::class, 'show'])->name('messages.show');
    Route::patch('/messages/{message}/read', [\App\Http\Controllers\Panel\MessageController::class, 'markRead'])->name('messages.read');
    Route::patch('/messages/{message}/unread', [\App\Http\Controllers\Panel\MessageController::class, 'markUnread'])->name('messages.unread');
    Route::delete('/messages/{message}', [\App\Http\Controllers\Panel\MessageController::class, 'destroy'])->name('messages.destroy');
});

// Area Administrator Legacy (Kompatibilitas Konten Lama)
Route::prefix('admin')->middleware(['auth', 'active', 'role:admin', '2fa'])->name('admin.')->group(function () {
    Route::get('/konten', [\App\Http\Controllers\Admin\AdminContentController::class, 'index'])->name('content');
    Route::post('/konten/publikasi', [\App\Http\Controllers\Admin\AdminContentController::class, 'storePost'])->name('posts.store');
    Route::delete('/konten/publikasi/{post}', [\App\Http\Controllers\Admin\AdminContentController::class, 'destroyPost'])->name('posts.destroy');
    Route::post('/konten/karya', [\App\Http\Controllers\Admin\AdminContentController::class, 'storeWork'])->name('works.store');
    Route::delete('/konten/karya/{work}', [\App\Http\Controllers\Admin\AdminContentController::class, 'destroyWork'])->name('works.destroy');
    Route::post('/konten/prestasi', [\App\Http\Controllers\Admin\AdminContentController::class, 'storeAchievement'])->name('achievements.store');
    Route::delete('/konten/prestasi/{achievement}', [\App\Http\Controllers\Admin\AdminContentController::class, 'destroyAchievement'])->name('achievements.destroy');
    Route::patch('/konten/pesan/{message}/baca', [\App\Http\Controllers\Admin\AdminContentController::class, 'markMessageRead'])->name('messages.read');
    Route::post('/konten/pengaturan', [\App\Http\Controllers\Admin\AdminContentController::class, 'updateSettings'])->name('settings.update');
});

// Alias & Redirect untuk kompatibilitas tautan lama
Route::get('/admin/dashboard', fn () => redirect()->route('panel.dashboard'))->middleware(['auth', 'active', '2fa'])->name('admin.dashboard');
Route::get('/lms', fn () => redirect()->route('panel.dashboard'))->middleware(['auth', 'active', '2fa']);
