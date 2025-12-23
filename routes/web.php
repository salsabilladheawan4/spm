<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\KategoriPengaduanController;
use App\Http\Controllers\PenilaianlayananController;
use App\Http\Controllers\TindakLanjutController;

// Rute Publik (Tanpa Login)
Route::get('/', function () {
    return redirect()->route('auth.login');
});

Route::get('login', [AuthController::class, 'index'])->name('auth.login');
Route::post('login', [AuthController::class, 'login'])->name('login.submit');
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('register.submit');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Rute yang Memerlukan Login (Menggunakan middleware isLogin)
Route::middleware(['isLogin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 1. Letakkan rute KHUSUS WARGA (Create & Store) paling atas
    // agar tidak tertabrak rute ID
    Route::middleware(['checkRole:warga'])->group(function () {
        Route::get('/pengaduan/create', [PengaduanController::class, 'create'])->name('pengaduan.create');
        Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');

        Route::get('/penilaian/create', [PenilaianLayananController::class, 'create'])->name('penilaian.create');
        Route::post('/penilaian', [PenilaianLayananController::class, 'store'])->name('penilaian.store');
    });

    // 2. Rute KHUSUS ADMIN & STAFF (Index & Show)
    Route::middleware(['checkRole:admin,staff'])->group(function () {
        Route::resource('warga', WargaController::class);
        Route::resource('tindak-lanjut', TindakLanjutController::class);

        // Rute ini menggunakan {pengaduan_id}, jadi harus di bawah /create
        Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
        Route::get('/pengaduan/{pengaduan_id}', [PengaduanController::class, 'show'])->name('pengaduan.show');

        Route::get('/penilaian', [PenilaianLayananController::class, 'index'])->name('penilaian.index');
    });

    // 3. KHUSUS ADMIN
    Route::middleware(['checkRole:admin'])->group(function () {
        Route::resource('user', UserController::class);
        Route::resource('kategori', KategoriPengaduanController::class);
        Route::resource('aset', AsetController::class);
    });
});
