<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePegawaiRequest;
use App\Http\Requests\UpdatePegawaiRequest;
use App\Http\Resources\PegawaiResource;
use App\Models\Pegawai;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PegawaiApiController extends Controller
{
    /**
     * Display a listing of Pegawai PNS.
     */
    public function index(Request $request): JsonResponse
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

        $perPage = $request->input('per_page', 15);
        $data = $query->latest('id')->paginate($perPage);

        return response()->json([
            'success' => true,
            'message' => 'Daftar Pegawai PNS berhasil diambil',
            'data' => PegawaiResource::collection($data->items()),
            'pagination' => [
                'current_page' => $data->currentPage(),
                'per_page' => $data->perPage(),
                'total' => $data->total(),
                'last_page' => $data->lastPage(),
            ],
        ], 200);
    }

    /**
     * Store a newly created Pegawai.
     */
    public function store(StorePegawaiRequest $request): JsonResponse
    {
        $pegawai = Pegawai::create($request->validated());
        $pegawai->load('perangkatDaerah');

        return response()->json([
            'success' => true,
            'message' => 'Data Pegawai PNS berhasil ditambahkan',
            'data' => new PegawaiResource($pegawai),
        ], 201);
    }

    /**
     * Display the specified Pegawai.
     */
    public function show(string $id): JsonResponse
    {
        $pegawai = Pegawai::with(['perangkatDaerah', 'kendaraanDinas'])->find($id);

        if (! $pegawai) {
            return response()->json([
                'success' => false,
                'message' => 'Data Pegawai PNS tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail Pegawai PNS berhasil diambil',
            'data' => new PegawaiResource($pegawai),
        ], 200);
    }

    /**
     * Update the specified Pegawai.
     */
    public function update(UpdatePegawaiRequest $request, string $id): JsonResponse
    {
        $pegawai = Pegawai::find($id);

        if (! $pegawai) {
            return response()->json([
                'success' => false,
                'message' => 'Data Pegawai PNS tidak ditemukan',
            ], 404);
        }

        $pegawai->update($request->validated());
        $pegawai->load('perangkatDaerah');

        return response()->json([
            'success' => true,
            'message' => 'Data Pegawai PNS berhasil diperbarui',
            'data' => new PegawaiResource($pegawai),
        ], 200);
    }

    /**
     * Remove the specified Pegawai.
     */
    public function destroy(string $id): JsonResponse
    {
        $pegawai = Pegawai::find($id);

        if (! $pegawai) {
            return response()->json([
                'success' => false,
                'message' => 'Data Pegawai PNS tidak ditemukan',
            ], 404);
        }

        $pegawai->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Pegawai PNS berhasil dihapus',
        ], 200);
    }
}
