<?php

use App\Http\Controllers\AsetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriPengaduanController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PenilaianLayananController;
use App\Http\Controllers\TindakLanjutController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // --- GRUP KHUSUS WARGA (Hanya Bisa Melapor) ---
    Route::middleware(['checkRole:warga'])->group(function () {
        Route::get('/pengaduan/create', [PengaduanController::class, 'create'])->name('pengaduan.create');
        Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
        Route::get('/penilaian/create', [PenilaianLayananController::class, 'create'])->name('penilaian.create');
        Route::post('/penilaian', [PenilaianLayananController::class, 'store'])->name('penilaian.store');
    });

    // --- GRUP ADMIN & STAFF (Bisa Mengelola Laporan) ---
    Route::middleware(['checkRole:admin,staff'])->group(function () {
        // Data Pengaduan
        Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
        Route::get('/pengaduan/{pengaduan_id}', [PengaduanController::class, 'show'])->name('pengaduan.show');

        // --- INI ADALAH RUTE YANG SEBELUMNYA HILANG ---
        Route::get('/pengaduan/{pengaduan_id}/edit', [PengaduanController::class, 'edit'])->name('pengaduan.edit');
        Route::put('/pengaduan/{pengaduan_id}', [PengaduanController::class, 'update'])->name('pengaduan.update');
        // ----------------------------------------------

        Route::delete('/pengaduan/{pengaduan_id}', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');

        // Tindak Lanjut
        Route::get('/tindak-lanjut/create', [TindakLanjutController::class, 'create'])->name('tindak-lanjut.create');
        Route::post('/tindak-lanjut', [TindakLanjutController::class, 'store'])->name('tindak-lanjut.store');

        // Penilaian (Melihat daftar ulasan)
        Route::get('/penilaian', [PenilaianLayananController::class, 'index'])->name('penilaian.index');
        Route::get('/penilaian/{penilaian_id}/edit', [PenilaianLayananController::class, 'edit'])->name('penilaian.edit');
        Route::put('/penilaian/{penilaian_id}', [PenilaianLayananController::class, 'update'])->name('penilaian.update');
        Route::delete('/penilaian/{penilaian_id}', [PenilaianLayananController::class, 'destroy'])->name('penilaian.destroy');
    });

    // --- GRUP KHUSUS ADMIN (Manajemen Sistem) ---
    Route::middleware(['checkRole:admin'])->group(function () {
        Route::resource('user', UserController::class);
        Route::resource('aset', AsetController::class);
        Route::resource('kategori', KategoriPengaduanController::class)->parameters([
            'kategori' => 'kategori_id',
        ]);
    });
});
