<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    DashboardController,
    UserController,
    WargaController,
    PengaduanController,
    KategoriPengaduanController,
    PenilaianLayananController,
    TindakLanjutController
};

/*
|--------------------------------------------------------------------------
| DEFAULT
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('auth.login');
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'index'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| SEMUA HARUS LOGIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('pengaduan', PengaduanController::class)
        ->parameters(['pengaduan' => 'pengaduan_id']);

    Route::resource('tindak-lanjut', TindakLanjutController::class)
        ->except(['index', 'show']);

    Route::resource('kategori', KategoriPengaduanController::class)
        ->parameters(['kategori' => 'kategori_id']);

    Route::resource('penilaian', PenilaianLayananController::class)
        ->parameters(['penilaian' => 'penilaian_id']);

    Route::resource('user', UserController::class);
    Route::resource('warga', WargaController::class);
});
