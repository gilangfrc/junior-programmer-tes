<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKendaraanDinasRequest;
use App\Http\Requests\UpdateKendaraanDinasRequest;
use App\Models\KendaraanDinas;
use App\Models\Pegawai;
use App\Models\PerangkatDaerah;
use App\Models\RiwayatKondisi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class KendaraanDinasController extends Controller
{
    public function index(Request $request): View
    {
        $query = KendaraanDinas::with(['perangkatDaerah', 'penanggungJawab']);

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('no_polisi', 'like', "%{$search}%")
                  ->orWhere('merek', 'like', "%{$search}%")
                  ->orWhere('tipe', 'like', "%{$search}%")
                  ->orWhereHas('penanggungJawab', function ($sub) use ($search) {
                      $sub->where('nama', 'like', "%{$search}%")
                          ->orWhere('nip', 'like', "%{$search}%");
                  })
                  ->orWhereHas('perangkatDaerah', function ($sub) use ($search) {
                      $sub->where('nama_instansi', 'like', "%{$search}%")
                          ->orWhere('singkatan', 'like', "%{$search}%");
                  });
            });
        }

        if ($kondisi = $request->input('kondisi')) {
            $query->where('kondisi', $kondisi);
        }

        if ($pdId = $request->input('perangkat_daerah_id')) {
            $query->where('perangkat_daerah_id', $pdId);
        }

        if ($jenis = $request->input('jenis_kendaraan')) {
            $query->where('jenis_kendaraan', $jenis);
        }

        $kendaraanDinas = $query->latest('id')->paginate(10)->withQueryString();
        $perangkatDaerahs = PerangkatDaerah::orderBy('nama_instansi')->get();

        return view('kendaraan_dinas.index', compact('kendaraanDinas', 'perangkatDaerahs'));
    }

    public function create(): View
    {
        $perangkatDaerahs = PerangkatDaerah::orderBy('nama_instansi')->get();
        $pegawais = Pegawai::where('status_aktif', true)->orderBy('nama')->get();

        return view('kendaraan_dinas.create', compact('perangkatDaerahs', 'pegawais'));
    }

    public function store(StoreKendaraanDinasRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('foto')) {
            $validated['foto_path'] = $request->file('foto')->store('kendaraan_fotos', 'public');
        }

        $kdo = KendaraanDinas::create($validated);

        // Catat kondisi awal
        RiwayatKondisi::create([
            'kendaraan_dinas_id' => $kdo->id,
            'tanggal_pemeriksaan' => now()->toDateString(),
            'kondisi_sebelum' => $kdo->kondisi,
            'kondisi_sesudah' => $kdo->kondisi,
            'catatan_kerusakan' => 'Pencatatan awal inventaris Barang Milik Daerah (BMD).',
            'petugas_pemeriksa' => 'Admin Pengelola BMD',
        ]);

        return redirect()->route('kendaraan-dinas.index')
            ->with('success', "Kendaraan Dinas {$kdo->no_polisi} berhasil ditambahkan.");
    }

    public function show(KendaraanDinas $kendaraanDina): View
    {
        $kendaraanDinas = $kendaraanDina->load([
            'perangkatDaerah',
            'penanggungJawab',
            'riwayatKondisi',
        ]);

        return view('kendaraan_dinas.show', compact('kendaraanDinas'));
    }

    public function edit(KendaraanDinas $kendaraanDina): View
    {
        $kendaraanDinas = $kendaraanDina;
        $perangkatDaerahs = PerangkatDaerah::orderBy('nama_instansi')->get();
        $pegawais = Pegawai::where('status_aktif', true)->orderBy('nama')->get();

        return view('kendaraan_dinas.edit', compact('kendaraanDinas', 'perangkatDaerahs', 'pegawais'));
    }

    public function update(UpdateKendaraanDinasRequest $request, KendaraanDinas $kendaraanDina): RedirectResponse
    {
        $validated = $request->validated();
        $oldKondisi = $kendaraanDina->kondisi;

        if ($request->hasFile('foto')) {
            if ($kendaraanDina->foto_path && Storage::disk('public')->exists($kendaraanDina->foto_path)) {
                Storage::disk('public')->delete($kendaraanDina->foto_path);
            }
            $validated['foto_path'] = $request->file('foto')->store('kendaraan_fotos', 'public');
        }

        $kendaraanDina->update($validated);

        if (isset($validated['kondisi']) && $validated['kondisi'] !== $oldKondisi) {
            RiwayatKondisi::create([
                'kendaraan_dinas_id' => $kendaraanDina->id,
                'tanggal_pemeriksaan' => now()->toDateString(),
                'kondisi_sebelum' => $oldKondisi,
                'kondisi_sesudah' => $validated['kondisi'],
                'catatan_kerusakan' => $validated['keterangan'] ?? 'Pembaruan kondisi status kendaraan',
                'petugas_pemeriksa' => 'Admin Pengelola BMD',
            ]);
        }

        return redirect()->route('kendaraan-dinas.index')
            ->with('success', "Data Kendaraan Dinas {$kendaraanDina->no_polisi} berhasil diperbarui.");
    }

    public function destroy(KendaraanDinas $kendaraanDina): RedirectResponse
    {
        if ($kendaraanDina->foto_path && Storage::disk('public')->exists($kendaraanDina->foto_path)) {
            Storage::disk('public')->delete($kendaraanDina->foto_path);
        }

        $noPolisi = $kendaraanDina->no_polisi;
        $kendaraanDina->delete();

        return redirect()->route('kendaraan-dinas.index')
            ->with('success', "Kendaraan Dinas {$noPolisi} berhasil dihapus dari inventaris.");
    }

    /**
     * Cetak Berita Acara Rekapitulasi Inventaris KDO (Print View)
     */
    public function cetakLaporan(Request $request): View
    {
        $query = KendaraanDinas::with(['perangkatDaerah', 'penanggungJawab']);

        if ($pdId = $request->input('perangkat_daerah_id')) {
            $query->where('perangkat_daerah_id', $pdId);
        }
        if ($kondisi = $request->input('kondisi')) {
            $query->where('kondisi', $kondisi);
        }

        $kdos = $query->orderBy('perangkat_daerah_id')->get();
        $filterOpd = $pdId ? PerangkatDaerah::find($pdId) : null;

        return view('kendaraan_dinas.cetak', compact('kdos', 'filterOpd'));
    }

    /**
     * Cetak Berita Acara Serah Terima (BAST) per Unit Kendaraan
     */
    public function beritaAcara(KendaraanDinas $kendaraanDina): View
    {
        $kdo = $kendaraanDina->load(['perangkatDaerah', 'penanggungJawab']);

        return view('kendaraan_dinas.bast', compact('kdo'));
    }
}
