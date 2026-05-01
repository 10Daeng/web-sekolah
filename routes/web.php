<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front;

/*
|--------------------------------------------------------------------------
| Web Routes - SIST (Sistem Informasi Sekolah Terpadu)
|--------------------------------------------------------------------------
|
| Semua route frontend publik dan admin.
|
*/

// ──────────────────────────────────────────────
// FRONTEND PUBLIK
// ──────────────────────────────────────────────
Route::name('front.')->group(function () {

    // Beranda
    Route::get('/', [Front\HomeController::class, 'index'])->name('home');

    // Profil Sekolah
    Route::get('/profil', [Front\ProfilController::class, 'index'])->name('profil');

    // Berita & Pengumuman
    Route::prefix('berita')->name('berita.')->group(function () {
        Route::get('/', [Front\BeritaController::class, 'index'])->name('index');
        Route::get('/{slug}', [Front\BeritaController::class, 'show'])->name('show');
    });

    // Galeri
    Route::get('/galeri', [Front\GaleriController::class, 'index'])->name('galeri');

    // Kalender Akademik
    Route::get('/kalender', [Front\KalenderController::class, 'index'])->name('kalender');

    // PPDB Publik
    Route::prefix('ppdb')->name('ppdb.')->group(function () {
        Route::get('/', [Front\PpdbController::class, 'index'])->name('index');
        Route::get('/daftar', [Front\PpdbController::class, 'create'])->name('daftar');
        Route::post('/daftar', [Front\PpdbController::class, 'store'])->name('store')->middleware('throttle:3,1');
        Route::get('/cek-status', [Front\PpdbController::class, 'cekStatus'])->name('cek-status');
        Route::post('/cek-status', [Front\PpdbController::class, 'cekStatusPost'])->name('cek-status.post')->middleware('throttle:5,1');
    });
});


// ──────────────────────────────────────────────
// DASHBOARD GURU
// ──────────────────────────────────────────────
Route::prefix('guru')->middleware(['auth', 'role:guru'])->name('guru.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\GuruDashboardController::class, 'index'])->name('dashboard');
});

// ──────────────────────────────────────────────
// DASHBOARD SISWA
// ──────────────────────────────────────────────
Route::prefix('siswa')->middleware(['auth', 'role:siswa|wali_murid'])->name('siswa.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\SiswaDashboardController::class, 'index'])->name('dashboard');
});

// ──────────────────────────────────────────────
// ADMIN PANEL (Filament atau Custom)
// ──────────────────────────────────────────────
Route::prefix('admin')->middleware(['auth', 'role:super_admin|admin_tu|guru'])->name('admin.')->group(function () {

    // Dashboard
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Berita & Pengumuman CRUD
    Route::resource('posts', App\Http\Controllers\Admin\PostController::class);

    // Galeri
    Route::resource('albums', App\Http\Controllers\Admin\AlbumController::class);
    Route::resource('albums.media', App\Http\Controllers\Admin\MediaController::class)->shallow();

    // Kalender Akademik
    Route::resource('calendars', App\Http\Controllers\Admin\CalendarController::class);

    // PPDB Manajemen
    Route::prefix('ppdb')->name('registrations.')->group(function () {
        Route::get('/pendaftar', [App\Http\Controllers\Admin\RegistrationController::class, 'index'])->name('index');
        Route::get('/pendaftar/{registration}', [App\Http\Controllers\Admin\RegistrationController::class, 'show'])->name('show');
        Route::post('/pendaftar/{registration}/verifikasi', [App\Http\Controllers\Admin\RegistrationController::class, 'verify'])->name('verify');
        Route::put('/pendaftar/{registration}/status', [App\Http\Controllers\Admin\RegistrationController::class, 'updateStatus'])->name('status');
        Route::get('/export', [App\Http\Controllers\Admin\RegistrationController::class, 'export'])->name('export');
        Route::get('/pengumuman', [App\Http\Controllers\Admin\RegistrationController::class, 'announcement'])->name('announcement');
    });

    // Materi & Tugas
    Route::resource('documents', App\Http\Controllers\Admin\DocumentController::class);

    // Prestasi
    Route::resource('achievements', App\Http\Controllers\Admin\AchievementController::class);

    // Master Data
    Route::prefix('master')->name('master.')->group(function () {
        Route::resource('academic-years', App\Http\Controllers\Admin\AcademicYearController::class);
        Route::resource('classes', App\Http\Controllers\Admin\ClassController::class);
        Route::resource('subjects', App\Http\Controllers\Admin\SubjectController::class);
        Route::resource('students', App\Http\Controllers\Admin\StudentController::class);
        Route::resource('teachers', App\Http\Controllers\Admin\TeacherController::class);
    });

    // Manajemen User & Role
    Route::resource('users', App\Http\Controllers\Admin\UserController::class);
    Route::resource('roles', App\Http\Controllers\Admin\RoleController::class);

    // Pengaturan Sekolah
    Route::get('/settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');

    // Audit Log (Super Admin only)
    Route::get('/audit-logs', [App\Http\Controllers\Admin\AuditLogController::class, 'index'])
        ->middleware('role:super_admin')
        ->name('audit-logs.index');
});


// ──────────────────────────────────────────────
// AUTHENTICATION (Fortify)
// ──────────────────────────────────────────────
Route::prefix('auth')->group(function () {
    Route::get('/login', function () { return view('auth.login'); })->name('login');
    Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
    Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
});
