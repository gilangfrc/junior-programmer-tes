<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKendaraanDinasRequest;
use App\Http\Requests\UpdateKendaraanDinasRequest;
use App\Http\Resources\KendaraanDinasResource;
use App\Models\KendaraanDinas;
use App\Models\RiwayatKondisi;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KendaraanDinasApiController extends Controller
{
    /**
     * Display a listing of Kendaraan Dinas Operasional (KDO).
     * Filters: search, kondisi, perangkat_daerah_id, jenis_kendaraan
     */
    public function index(Request $request): JsonResponse
    {
        $query = KendaraanDinas::with(['perangkatDaerah', 'penanggungJawab']);

        // Search query
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

        // Filter by kondisi (Baik, Rusak Ringan, Rusak Berat)
        if ($kondisi = $request->input('kondisi')) {
            $query->where('kondisi', $kondisi);
        }

        // Filter by Perangkat Daerah
        if ($pdId = $request->input('perangkat_daerah_id')) {
            $query->where('perangkat_daerah_id', $pdId);
        }

        // Filter by jenis kendaraan
        if ($jenis = $request->input('jenis_kendaraan')) {
            $query->where('jenis_kendaraan', $jenis);
        }

        $perPage = $request->input('per_page', 15);
        $data = $query->latest('id')->paginate($perPage);

        return response()->json([
            'success' => true,
            'message' => 'Daftar Kendaraan Dinas Operasional berhasil diambil',
            'data' => KendaraanDinasResource::collection($data->items()),
            'pagination' => [
                'current_page' => $data->currentPage(),
                'per_page' => $data->perPage(),
                'total' => $data->total(),
                'last_page' => $data->lastPage(),
            ],
        ], 200);
    }

    /**
     * Store a newly created Kendaraan Dinas.
     */
    public function store(StoreKendaraanDinasRequest $request): JsonResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('kendaraan_fotos', 'public');
            $validated['foto_path'] = $path;
        }

        $kdo = KendaraanDinas::create($validated);
        $kdo->load(['perangkatDaerah', 'penanggungJawab']);

        return response()->json([
            'success' => true,
            'message' => 'Data Kendaraan Dinas Operasional berhasil ditambahkan',
            'data' => new KendaraanDinasResource($kdo),
        ], 201);
    }

    /**
     * Display the specified Kendaraan Dinas.
     */
    public function show(string $id): JsonResponse
    {
        $kdo = KendaraanDinas::with(['perangkatDaerah', 'penanggungJawab', 'riwayatKondisi'])->find($id);

        if (! $kdo) {
            return response()->json([
                'success' => false,
                'message' => 'Data Kendaraan Dinas tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail Kendaraan Dinas berhasil diambil',
            'data' => new KendaraanDinasResource($kdo),
        ], 200);
    }

    /**
     * Update the specified Kendaraan Dinas.
     */
    public function update(UpdateKendaraanDinasRequest $request, string $id): JsonResponse
    {
        $kdo = KendaraanDinas::find($id);

        if (! $kdo) {
            return response()->json([
                'success' => false,
                'message' => 'Data Kendaraan Dinas tidak ditemukan',
            ], 404);
        }

        $validated = $request->validated();
        $oldKondisi = $kdo->kondisi;

        if ($request->hasFile('foto')) {
            if ($kdo->foto_path && Storage::disk('public')->exists($kdo->foto_path)) {
                Storage::disk('public')->delete($kdo->foto_path);
            }
            $path = $request->file('foto')->store('kendaraan_fotos', 'public');
            $validated['foto_path'] = $path;
        }

        $kdo->update($validated);

        // Jika kondisi berubah, catat ke riwayat kondisi secara otomatis
        if (isset($validated['kondisi']) && $validated['kondisi'] !== $oldKondisi) {
            RiwayatKondisi::create([
                'kendaraan_dinas_id' => $kdo->id,
                'tanggal_pemeriksaan' => now()->toDateString(),
                'kondisi_sebelum' => $oldKondisi,
                'kondisi_sesudah' => $validated['kondisi'],
                'catatan_kerusakan' => $validated['keterangan'] ?? 'Pembaruan kondisi operasional via API',
                'petugas_pemeriksa' => 'Admin Sistem BMD',
            ]);
        }

        $kdo->load(['perangkatDaerah', 'penanggungJawab', 'riwayatKondisi']);

        return response()->json([
            'success' => true,
            'message' => 'Data Kendaraan Dinas berhasil diperbarui',
            'data' => new KendaraanDinasResource($kdo),
        ], 200);
    }

    /**
     * Remove the specified Kendaraan Dinas.
     */
    public function destroy(string $id): JsonResponse
    {
        $kdo = KendaraanDinas::find($id);

        if (! $kdo) {
            return response()->json([
                'success' => false,
                'message' => 'Data Kendaraan Dinas tidak ditemukan',
            ], 404);
        }

        if ($kdo->foto_path && Storage::disk('public')->exists($kdo->foto_path)) {
            Storage::disk('public')->delete($kdo->foto_path);
        }

        $kdo->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Kendaraan Dinas berhasil dihapus',
        ], 200);
    }
}
