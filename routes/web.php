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
use App\Http\Controllers\PelayananController;
use App\Http\Controllers\KategoriPelayananController;

Route::get('/', function () {
    return redirect()->route('auth.login');
});

// Route untuk auth
Route::get('login', [AuthController::class, 'index'])->name('auth.login');
Route::post('login', [AuthController::class, 'login'])->name('login.submit');
Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register', [AuthController::class, 'register'])->name('register.submit');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');


// Route untuk dashboard admin (setelah login)
// [PERUBAHAN] Middleware 'auth' telah dihapus
// Route::get('/dashboard', [InventarisController::class, 'index'])->name('dashboard');
// Route::get('/home', [InventarisController::class, 'index']);

Route::resource('aset', AsetController::class);
Route::resource('warga', WargaController::class);
Route::resource('user', UserController::class);

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    // Route untuk Warga (Sudah kamu miliki, pastikan ada)
    Route::resource('warga', WargaController::class);

    // Route untuk Kategori Pengaduan (CRUD)
    // Parameter 'kategori' akan otomatis memetakan ke destroy($kategori), edit($kategori), dst
    Route::resource('kategori', KategoriPengaduanController::class)->parameters([
        'kategori' => 'kategori_id'
    ]);
    // Note: parameters() di atas opsional, tapi berguna jika route model binding error karena nama kolom bukan 'id'

    // Route untuk Pengaduan (CRUD)
    Route::resource('pengaduan', PengaduanController::class)->parameters([
        'pengaduan' => 'pengaduan_id'
    ]);


    // Route untuk Pelayanan dan Kategori Pelayanan di dalam middleware 'auth'
    Route::middleware(['auth'])->group(function () {

        // CRUD Kategori Pelayanan
        Route::resource('kategoripelayanan', KategoriPelayananController::class)->parameters([
            'kategoripelayanan' => 'kategori_id'
        ]);

        // CRUD Pelayanan
        Route::resource('pelayanan', PelayananController::class)->parameters([
            'pelayanan' => 'id'
        ]);
    });
});
