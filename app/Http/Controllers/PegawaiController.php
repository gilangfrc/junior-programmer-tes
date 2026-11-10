<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePegawaiRequest;
use App\Http\Requests\UpdatePegawaiRequest;
use App\Models\Pegawai;
use App\Models\PerangkatDaerah;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PegawaiController extends Controller
{
    public function index(Request $request): View
    {
        $query = Pegawai::with('perangkatDaerah')->withCount('kendaraanDinas');

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('nip', 'like', "%{$search}%")
                  ->orWhere('jabatan', 'like', "%{$search}%");
            });
        }

        if ($pdId = $request->input('perangkat_daerah_id')) {
            $query->where('perangkat_daerah_id', $pdId);
        }

        $pegawais = $query->latest('id')->paginate(10)->withQueryString();
        $perangkatDaerahs = PerangkatDaerah::orderBy('nama_instansi')->get();

        return view('pegawai.index', compact('pegawais', 'perangkatDaerahs'));
    }

    public function create(): View
    {
        $perangkatDaerahs = PerangkatDaerah::orderBy('nama_instansi')->get();

        return view('pegawai.create', compact('perangkatDaerahs'));
    }

    public function store(StorePegawaiRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $validated['status_aktif'] = $request->has('status_aktif');

        Pegawai::create($validated);

        return redirect()->route('pegawai.index')
            ->with('success', 'Data Pegawai PNS berhasil ditambahkan.');
    }

    public function show(Pegawai $pegawai): View
    {
        $pegawai->load(['perangkatDaerah', 'kendaraanDinas']);

        return view('pegawai.show', compact('pegawai'));
    }

    public function edit(Pegawai $pegawai): View
    {
        $perangkatDaerahs = PerangkatDaerah::orderBy('nama_instansi')->get();

        return view('pegawai.edit', compact('pegawai', 'perangkatDaerahs'));
    }

    public function update(UpdatePegawaiRequest $request, Pegawai $pegawai): RedirectResponse
    {
        $validated = $request->validated();
        $validated['status_aktif'] = $request->has('status_aktif');

        $pegawai->update($validated);

        return redirect()->route('pegawai.index')
            ->with('success', 'Data Pegawai PNS berhasil diperbarui.');
    }

    public function destroy(Pegawai $pegawai): RedirectResponse
    {
        // Jika sedang memegang kendaraan, lepaskan relasi
        $pegawai->kendaraanDinas()->update(['penanggung_jawab_id' => null]);
        $pegawai->delete();

        return redirect()->route('pegawai.index')
            ->with('success', 'Data Pegawai PNS berhasil dihapus.');
    }
}
