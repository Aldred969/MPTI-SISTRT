<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\WargaController;
use App\Http\Controllers\Admin\IuranController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\KegiatanController;

Route::get('/', function () {
    return view('welcome');
});

// Main dashboard router (role based)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Profile routes (Laravel Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin area routes (secured by role check)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard page
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Warga (Citizen) CRUD
    Route::resource('warga', WargaController::class)->except(['show']);

    // Iuran (Fee) Management
    Route::get('iuran/warga/{warga_id}', [IuranController::class, 'history'])->name('iuran.history');
    Route::patch('iuran/{id}/pay', [IuranController::class, 'pay'])->name('iuran.pay');
    Route::get('iuran/report', [IuranController::class, 'report'])->name('iuran.report');
    Route::get('iuran/total', [IuranController::class, 'total'])->name('iuran.total');
    Route::resource('iuran', IuranController::class)->except(['index', 'show']);

    // Laporan (Complaint) Responses
    Route::resource('laporan', LaporanController::class)->only(['index', 'edit', 'update']);

    // Kegiatan (Events) CRUD
    Route::resource('kegiatan', KegiatanController::class);
});

// Warga area routes (secured by role check)
Route::middleware(['auth', 'warga'])->prefix('warga')->name('warga.')->group(function () {
    // Dashboard page
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Iuran (Fee) History
    Route::get('iuran', [\App\Http\Controllers\Warga\IuranController::class, 'index'])->name('iuran.index');

    // Laporan (Complaint) submissions
    Route::resource('laporan', \App\Http\Controllers\Warga\LaporanController::class)->only(['index', 'create', 'store']);

    // Kegiatan (Events) listing
    Route::get('kegiatan', [\App\Http\Controllers\Warga\KegiatanController::class, 'index'])->name('kegiatan.index');
});

require __DIR__.'/auth.php';
