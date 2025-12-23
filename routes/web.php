<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\InventarisController;
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

    // Rute yang bisa diakses SEMUA ROLE yang sudah login
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // --- KHUSUS ADMIN ---
    Route::middleware(['checkRole:admin'])->group(function () {
        Route::resource('user', UserController::class);
        Route::resource('kategori', KategoriPengaduanController::class);
        Route::resource('aset', AsetController::class);
    });

    // --- KHUSUS ADMIN & STAFF ---
    Route::middleware(['checkRole:admin,staff'])->group(function () {
        Route::resource('warga', WargaController::class);

        // Fitur utama memproses pengaduan
        Route::resource('tindak-lanjut', TindakLanjutController::class);

        // Melihat semua pengaduan
        Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
        Route::get('/pengaduan/{pengaduan_id}', [PengaduanController::class, 'show'])->name('pengaduan.show');

        // Melihat semua penilaian
        Route::get('/penilaian', [PenilaianlayananController::class, 'index'])->name('penilaian.index');
    });

    // --- KHUSUS WARGA ---
    Route::middleware(['checkRole:warga'])->group(function () {
        // Warga membuat pengaduan baru
        Route::get('/pengaduan/create', [PengaduanController::class, 'create'])->name('pengaduan.create');
        Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');

        // Warga memberi penilaian
        Route::get('/penilaian/create', [PenilaianlayananController::class, 'create'])->name('penilaian.create');
        Route::post('/penilaian', [PenilaianlayananController::class, 'store'])->name('penilaian.store');
    });

});
