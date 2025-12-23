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

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Resource Routes
    Route::resource('aset', AsetController::class);
    Route::resource('warga', WargaController::class);
    Route::resource('user', UserController::class);

    // Kategori Pengaduan
    Route::resource('kategori', KategoriPengaduanController::class)->parameters([
        'kategori' => 'kategori_id'
    ]);

    // Pengaduan
    Route::resource('pengaduan', PengaduanController::class)->parameters([
        'pengaduan' => 'pengaduan_id'
    ]);

    // Tindak Lanjut
    Route::resource('tindak-lanjut', TindakLanjutController::class)->parameters([
        'tindak-lanjut' => 'tindak_id'
    ]);

    // Penilaian
    Route::resource('penilaian', PenilaianlayananController::class);
});
