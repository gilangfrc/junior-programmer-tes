<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KendaraanDinas;
use App\Models\Pegawai;
use App\Models\PerangkatDaerah;
use Illuminate\Http\JsonResponse;

class DashboardApiController extends Controller
{
    /**
     * Get ringkasan statistik BMD & KDO
     */
    public function index(): JsonResponse
    {
        $totalKdo = KendaraanDinas::count();
        $totalPegawai = Pegawai::count();
        $totalPerangkatDaerah = PerangkatDaerah::count();

        // Distribusi kondisi KDO
        $kondisiCounts = [
            'baik' => KendaraanDinas::where('kondisi', 'Baik')->count(),
            'rusak_ringan' => KendaraanDinas::where('kondisi', 'Rusak Ringan')->count(),
            'rusak_berat' => KendaraanDinas::where('kondisi', 'Rusak Berat')->count(),
        ];

        // Distribusi jenis kendaraan
        $jenisCounts = [
            'roda_2' => KendaraanDinas::where('jenis_kendaraan', 'Roda 2')->count(),
            'roda_4' => KendaraanDinas::where('jenis_kendaraan', 'Roda 4')->count(),
            'roda_6_keatas' => KendaraanDinas::where('jenis_kendaraan', 'Roda 6 / Truk / Bus')->count(),
        ];

        // Status Penanggung Jawab
        $terpasang = KendaraanDinas::whereNotNull('penanggung_jawab_id')->count();
        $belumTerpasang = KendaraanDinas::whereNull('penanggung_jawab_id')->count();

        // Rekap per OPD
        $rekapOpd = PerangkatDaerah::withCount(['kendaraanDinas', 'pegawais'])
            ->get()
            ->map(function ($opd) {
                return [
                    'id' => $opd->id,
                    'kode_opd' => $opd->kode_opd,
                    'nama_instansi' => $opd->nama_instansi,
                    'singkatan' => $opd->singkatan,
                    'total_kendaraan' => $opd->kendaraan_dinas_count,
                    'total_pegawai' => $opd->pegawais_count,
                ];
            });

        return response()->json([
            'success' => true,
            'message' => 'Statistik Dashboard BMD berhasil diambil',
            'data' => [
                'total_kdo' => $totalKdo,
                'total_pegawai' => $totalPegawai,
                'total_perangkat_daerah' => $totalPerangkatDaerah,
                'kondisi' => $kondisiCounts,
                'jenis_kendaraan' => $jenisCounts,
                'penanggung_jawab' => [
                    'tercatat' => $terpasang,
                    'belum_ditugaskan' => $belumTerpasang,
                ],
                'rekap_per_opd' => $rekapOpd,
            ],
        ], 200);
    }
}
