<?php

namespace App\Http\Controllers;

use App\Models\KendaraanDinas;
use App\Models\Pegawai;
use App\Models\PerangkatDaerah;
use Illuminate\View\View;

class ApiDocsController extends Controller
{
    public function index(): View
    {
        $sampleKdo = KendaraanDinas::with(['perangkatDaerah', 'penanggungJawab'])->first();
        $samplePegawai = Pegawai::first();
        $sampleOpd = PerangkatDaerah::first();

        return view('api_docs.index', compact('sampleKdo', 'samplePegawai', 'sampleOpd'));
    }
}
