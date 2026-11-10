<?php

use App\Http\Controllers\ApiDocsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KendaraanDinasController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PerangkatDaerahController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - SIM-KDO Pengelolaan Kendaraan Dinas Operasional (BMD)
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Fitur Cetak Rekapitulasi & BAST Kendaraan Dinas (Nilai Tambah)
Route::get('/kendaraan-dinas/cetak', [KendaraanDinasController::class, 'cetakLaporan'])->name('kendaraan-dinas.cetak');
Route::get('/kendaraan-dinas/{kendaraan_dina}/bast', [KendaraanDinasController::class, 'beritaAcara'])->name('kendaraan-dinas.bast');

// CRUD Resources Utama
Route::resource('kendaraan-dinas', KendaraanDinasController::class);
Route::resource('pegawai', PegawaiController::class);
Route::resource('perangkat-daerah', PerangkatDaerahController::class);

// Dokumentasi & Interaktif API Tester
Route::get('/api-docs', [ApiDocsController::class, 'index'])->name('api-docs');
