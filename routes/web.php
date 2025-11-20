<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\AuthController;

// Halaman utama
Route::get('/', [MonitoringController::class, 'index'])->name('home');

// ✅ Route Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ✅ Route yang hanya bisa diakses setelah login
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/karyawan', function () {
        return view('karyawan');
    });

    Route::get('/pekerjaan', function () {
        return view('pekerjaan');
    });

    Route::get('/aktivitas', function () {
        return view('aktivitas');
    });

    Route::get('/arsip', function () {
        return view('arsip');
    });
});
