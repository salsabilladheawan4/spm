<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\KategoriPengaduanController;
use App\Http\Controllers\PenilaianLayananController;
use App\Http\Controllers\TindakLanjutController;
use App\Http\Controllers\NotificationController;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => redirect()->route('auth.login'));

Route::get('/login', [AuthController::class, 'index'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | WARGA
    |--------------------------------------------------------------------------
    */
    Route::middleware('checkRole:warga')->group(function () {

        // Pengaduan
        Route::get('/pengaduan/create', [PengaduanController::class, 'create'])->name('pengaduan.create');
        Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');

        // Penilaian (HANYA WARGA)
        Route::get('/penilaian/create', [PenilaianLayananController::class, 'create'])->name('penilaian.create');
        Route::post('/penilaian', [PenilaianLayananController::class, 'store'])->name('penilaian.store');

        // Request Staff
        Route::post('/staff/request', [UserController::class, 'requestStaff'])->name('staff.request');
    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN & STAFF
    |--------------------------------------------------------------------------
    */
    Route::middleware('checkRole:admin,staff')->group(function () {

        // Pengaduan
        Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
        Route::get('/pengaduan/{id}', [PengaduanController::class, 'show'])->name('pengaduan.show');
        Route::get('/pengaduan/{id}/edit', [PengaduanController::class, 'edit'])->name('pengaduan.edit');
        Route::put('/pengaduan/{id}', [PengaduanController::class, 'update'])->name('pengaduan.update');
        Route::delete('/pengaduan/{id}', [PengaduanController::class, 'destroy'])->name('pengaduan.destroy');

        // Tindak lanjut
        Route::get('/tindak-lanjut/create', [TindakLanjutController::class, 'create'])->name('tindak-lanjut.create');
        Route::post('/tindak-lanjut', [TindakLanjutController::class, 'store'])->name('tindak-lanjut.store');

        // Penilaian (LIHAT & KELOLA)
        Route::get('/penilaian', [PenilaianLayananController::class, 'index'])->name('penilaian.index');
        Route::get('/penilaian/{id}/edit', [PenilaianLayananController::class, 'edit'])->name('penilaian.edit');
        Route::put('/penilaian/{id}', [PenilaianLayananController::class, 'update'])->name('penilaian.update');
        Route::delete('/penilaian/{id}', [PenilaianLayananController::class, 'destroy'])->name('penilaian.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | ADMIN ONLY
    |--------------------------------------------------------------------------
    */
    Route::middleware('checkRole:admin')->group(function () {

        Route::resource('user', UserController::class);

        Route::resource('kategori', KategoriPengaduanController::class)
            ->parameters(['kategori' => 'kategori_id']);

        Route::get('/admin/staff-request', [UserController::class, 'staffRequest'])
            ->name('staff.request.list');

        Route::post('/admin/staff-approve/{id}', [UserController::class, 'approveStaff'])
            ->name('staff.approve');

        Route::post('/admin/staff-reject/{id}', [UserController::class, 'rejectStaff'])
            ->name('staff.reject');
    });

    /*
    |--------------------------------------------------------------------------
    | NOTIFICATIONS (SEMUA ROLE)
    |--------------------------------------------------------------------------
    */
    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');
});

Route::get('/admin/staff-request', [UserController::class, 'staffRequest'])
    ->name('staff.request.list');
