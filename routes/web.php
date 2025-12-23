<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\TindakLanjutController;
use App\Http\Controllers\KategoriPengaduanController;
use App\Http\Controllers\PenilaianLayananController;

// 1. RUTE PUBLIK (Bisa diakses tanpa login)
Route::get('/', function () {
    return redirect()->route('auth.login');
});

Route::get('login', [AuthController::class, 'index'])->name('auth.login');
Route::post('login', [AuthController::class, 'login'])->name('login.submit');
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('register.submit');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// 2. RUTE TERPROTEKSI (Harus Login)
Route::middleware(['isLogin'])->group(function () {

    // Dashboard bisa diakses semua role yang login
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // --- GRUP WARGA ---
    // Pastikan rute /create berada DI ATAS rute resource atau rute dengan parameter {id}
    Route::middleware(['checkRole:warga'])->group(function () {
        Route::get('/pengaduan/create', [PengaduanController::class, 'create'])->name('pengaduan.create');
        Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
    });

    // --- GRUP ADMIN & STAFF (Operasional) ---
    Route::middleware(['checkRole:admin,staff'])->group(function () {
        // Data Pengaduan (Index & Detail)
        Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
        Route::get('/pengaduan/{pengaduan_id}', [PengaduanController::class, 'show'])->name('pengaduan.show');
        Route::delete('/pengaduan/{pengaduan_id}', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');

        // Tindak Lanjut
        Route::get('/tindak-lanjut/create', [TindakLanjutController::class, 'create'])->name('tindak-lanjut.create');
        Route::post('/tindak-lanjut', [TindakLanjutController::class, 'store'])->name('tindak-lanjut.store');

        // Penilaian (Melihat daftar ulasan)
        Route::get('/penilaian', [PenilaianLayananController::class, 'index'])->name('penilaian.index');
    });

    // --- GRUP KHUSUS ADMIN (Manajemen Sistem) ---
    Route::middleware(['checkRole:admin'])->group(function () {
        Route::resource('user', UserController::class);
        Route::resource('aset', AsetController::class);
        Route::resource('kategori', KategoriPengaduanController::class)->parameters([
            'kategori' => 'kategori_id'
        ]);
    });

});
