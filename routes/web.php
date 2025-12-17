<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    DashboardController,
    AsetController,
    UserController,
    WargaController,
    PengaduanController,
    InventarisController,
    KategoriPengaduanController,
    KategoriPelayananController,
    PenilaianLayananController
};

// ==========================
// DEFAULT
// ==========================
Route::get('/', function () {
    return redirect()->route('auth.login');
});

// ==========================
// AUTH (TANPA LOGIN)
// ==========================
Route::get('/login', [AuthController::class, 'index'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==========================
// SEMUA YANG BUTUH LOGIN
// ==========================
Route::middleware(['auth'])->group(function () {

    // DASHBOARD
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // MASTER DATA
    Route::resource('aset', AsetController::class);
    Route::resource('user', UserController::class);
    Route::resource('warga', WargaController::class);

    // ======================
    // PENGADUAN
    // ======================
    Route::resource('kategori', KategoriPengaduanController::class)->parameters([
        'kategori' => 'kategori_id'
    ]);

    Route::resource('pengaduan', PengaduanController::class)->parameters([
        'pengaduan' => 'pengaduan_id'
    ]);

    // ======================
    // KATEGORI PELAYANAN
    // ======================
    // Route::resource('kategoripelayanan', KategoriPelayananController::class)->parameters([
    //     'kategoripelayanan' => 'kategori_id'
    // ]);

    // ======================
    // PENILAIAN LAYANAN
    // ======================
    Route::resource('penilaian', PenilaianLayananController::class)->parameters([
        'penilaian' => 'penilaian_id'
    ]);
});
