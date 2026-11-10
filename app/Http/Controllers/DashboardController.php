<?php

namespace App\Http\Controllers;

use App\Models\KendaraanDinas;
use App\Models\Pegawai;
use App\Models\PerangkatDaerah;
use App\Models\RiwayatKondisi;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Tampilan utama Dashboard SIM-KDO (BMD)
     */
    public function index(): View
    {
        $totalKdo = KendaraanDinas::count();
        $totalPegawai = Pegawai::count();
        $totalOpd = PerangkatDaerah::count();

        $kondisiCounts = [
            'Baik' => KendaraanDinas::where('kondisi', 'Baik')->count(),
            'Rusak Ringan' => KendaraanDinas::where('kondisi', 'Rusak Ringan')->count(),
            'Rusak Berat' => KendaraanDinas::where('kondisi', 'Rusak Berat')->count(),
        ];

        $persentaseBaik = $totalKdo > 0 ? round(($kondisiCounts['Baik'] / $totalKdo) * 100, 1) : 0;

        $kdoTerbaru = KendaraanDinas::with(['perangkatDaerah', 'penanggungJawab'])
            ->latest('id')
            ->take(5)
            ->get();

        $rekapOpd = PerangkatDaerah::withCount(['kendaraanDinas', 'pegawais'])
            ->withCount([
                'kendaraanDinas as rusak_count' => function ($query) {
                    $query->whereIn('kondisi', ['Rusak Ringan', 'Rusak Berat']);
                },
            ])
            ->get();

        $riwayatTerbaru = RiwayatKondisi::with('kendaraanDinas')
            ->latest('tanggal_pemeriksaan')
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'totalKdo',
            'totalPegawai',
            'totalOpd',
            'kondisiCounts',
            'persentaseBaik',
            'kdoTerbaru',
            'rekapOpd',
            'riwayatTerbaru'
        ));
    }
}
