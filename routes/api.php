<?php

use App\Http\Controllers\Api\DashboardApiController;
use App\Http\Controllers\Api\KendaraanDinasApiController;
use App\Http\Controllers\Api\PegawaiApiController;
use App\Http\Controllers\Api\PerangkatDaerahApiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| REST API Routes - Pengelolaan Kendaraan Dinas Operasional (KDO - BMD)
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->group(function () {
    // Ringkasan Statistik Dashboard BMD
    Route::get('/dashboard/stats', [DashboardApiController::class, 'index']);

    // Master Data Perangkat Daerah (PD / OPD)
    Route::apiResource('perangkat-daerah', PerangkatDaerahApiController::class);

    // Data Pegawai Negeri Sipil (PNS)
    Route::apiResource('pegawai', PegawaiApiController::class);

    // Data Kendaraan Dinas Operasional (KDO)
    Route::apiResource('kendaraan-dinas', KendaraanDinasApiController::class);
});

// Alias default tanpa v1 untuk kemudahan pengujian
Route::get('/dashboard/stats', [DashboardApiController::class, 'index']);
Route::apiResource('perangkat-daerah', PerangkatDaerahApiController::class);
Route::apiResource('pegawai', PegawaiApiController::class);
Route::apiResource('kendaraan-dinas', KendaraanDinasApiController::class);
