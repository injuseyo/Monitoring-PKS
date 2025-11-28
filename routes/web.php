<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AktivitasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\PekerjaanController;
use App\Http\Controllers\ArsipController;   

// Halaman utama
Route::get('/', [MonitoringController::class, 'index'])->name('home');

// ✅ Route Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ✅ Route yang hanya bisa diakses setelah login
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route Karyawan - tambahkan yang kurang
    Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');
    Route::post('/karyawan', [KaryawanController::class, 'store'])->name('karyawan.store');
    Route::put('/karyawan/{id}', [KaryawanController::class, 'update'])->name('karyawan.update');
    Route::delete('/karyawan/{id}', [KaryawanController::class, 'destroy'])->name('karyawan.destroy');

    Route::get('/pekerjaan', [PekerjaanController::class, 'index'])->name('pekerjaan.index');

    Route::get('/aktivitas', [AktivitasController::class, 'index'])->name('aktivitas.index');

    Route::get('/arsip', [ArsipController::class, 'index'])->name('arsip.index');
});