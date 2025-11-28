<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PekerjaanController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\AktivitasController; // <-- tambahkan ini

// Halaman utama
Route::get('/', [MonitoringController::class, 'index'])->name('home');

// ROUTE AUTH
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');

    Route::post('/karyawan', [KaryawanController::class, 'store'])
        ->name('karyawan.store');

    Route::put('/karyawan/{karyawan}', [KaryawanController::class, 'update'])
        ->name('karyawan.update');

    Route::delete('/karyawan/{karyawan}', [KaryawanController::class, 'destroy'])
        ->name('karyawan.destroy');


    // ================== AKTIVITAS ===================
    Route::get('/aktivitas', [AktivitasController::class, 'index'])
        ->name('aktivitas.index');

    Route::post('/aktivitas', [AktivitasController::class, 'store'])
        ->name('aktivitas.store');


    // ================== ARSIP =======================
    Route::get('/arsip', function () {
        return view('arsip');
    });
});
