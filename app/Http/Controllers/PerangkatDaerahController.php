<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePerangkatDaerahRequest;
use App\Http\Requests\UpdatePerangkatDaerahRequest;
use App\Models\PerangkatDaerah;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PerangkatDaerahController extends Controller
{
    public function index(Request $request): View
    {
        $query = PerangkatDaerah::withCount(['pegawais', 'kendaraanDinas']);

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_instansi', 'like', "%{$search}%")
                  ->orWhere('kode_opd', 'like', "%{$search}%")
                  ->orWhere('singkatan', 'like', "%{$search}%");
            });
        }

        $perangkatDaerahs = $query->latest('id')->paginate(10)->withQueryString();

        return view('perangkat_daerah.index', compact('perangkatDaerahs'));
    }

    public function create(): View
    {
        return view('perangkat_daerah.create');
    }

    public function store(StorePerangkatDaerahRequest $request): RedirectResponse
    {
        PerangkatDaerah::create($request->validated());

        return redirect()->route('perangkat-daerah.index')
            ->with('success', 'Data Perangkat Daerah berhasil ditambahkan.');
    }

    public function show(PerangkatDaerah $perangkatDaerah): View
    {
        $perangkatDaerah->load([
            'pegawais',
            'kendaraanDinas.penanggungJawab',
        ]);

        return view('perangkat_daerah.show', compact('perangkatDaerah'));
    }

    public function edit(PerangkatDaerah $perangkatDaerah): View
    {
        return view('perangkat_daerah.edit', compact('perangkatDaerah'));
    }

    public function update(UpdatePerangkatDaerahRequest $request, PerangkatDaerah $perangkatDaerah): RedirectResponse
    {
        $perangkatDaerah->update($request->validated());

        return redirect()->route('perangkat-daerah.index')
            ->with('success', 'Data Perangkat Daerah berhasil diperbarui.');
    }

    public function destroy(PerangkatDaerah $perangkatDaerah): RedirectResponse
    {
        // Validasi dependensi jika masih memiliki kendaraan
        if ($perangkatDaerah->kendaraanDinas()->count() > 0) {
            return redirect()->route('perangkat-daerah.index')
                ->with('error', 'Gagal menghapus! Instansi ini masih memiliki data Kendaraan Dinas tercatat.');
        }

        $perangkatDaerah->delete();

        return redirect()->route('perangkat-daerah.index')
            ->with('success', 'Data Perangkat Daerah berhasil dihapus.');
    }
}
