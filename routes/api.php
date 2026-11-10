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
| Seluruh rute API diberi name prefix 'api.' agar TIDAK bentrok dengan
| rute Web Views (Blade) seperti kendaraan-dinas.index, pegawai.index, dll.
|--------------------------------------------------------------------------
*/

Route::prefix('v1')->name('api.v1.')->group(function () {
    Route::get('/dashboard/stats', [DashboardApiController::class, 'index'])->name('dashboard.stats');
    Route::apiResource('perangkat-daerah', PerangkatDaerahApiController::class);
    Route::apiResource('pegawai', PegawaiApiController::class);
    Route::apiResource('kendaraan-dinas', KendaraanDinasApiController::class);
});

// Alias default /api/... dengan prefix nama 'api.'
Route::name('api.')->group(function () {
    Route::get('/dashboard/stats', [DashboardApiController::class, 'index'])->name('dashboard.stats');
    Route::apiResource('perangkat-daerah', PerangkatDaerahApiController::class);
    Route::apiResource('pegawai', PegawaiApiController::class);
    Route::apiResource('kendaraan-dinas', KendaraanDinasApiController::class);
});
