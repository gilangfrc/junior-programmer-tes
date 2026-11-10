<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePerangkatDaerahRequest;
use App\Http\Requests\UpdatePerangkatDaerahRequest;
use App\Http\Resources\PerangkatDaerahResource;
use App\Models\PerangkatDaerah;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PerangkatDaerahApiController extends Controller
{
    /**
     * Display a listing of Perangkat Daerah.
     */
    public function index(Request $request): JsonResponse
    {
        $query = PerangkatDaerah::withCount(['pegawais', 'kendaraanDinas']);

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_instansi', 'like', "%{$search}%")
                  ->orWhere('kode_opd', 'like', "%{$search}%")
                  ->orWhere('singkatan', 'like', "%{$search}%");
            });
        }

        $perPage = $request->input('per_page', 15);
        $data = $query->latest('id')->paginate($perPage);

        return response()->json([
            'success' => true,
            'message' => 'Daftar Perangkat Daerah berhasil diambil',
            'data' => PerangkatDaerahResource::collection($data->items()),
            'pagination' => [
                'current_page' => $data->currentPage(),
                'per_page' => $data->perPage(),
                'total' => $data->total(),
                'last_page' => $data->lastPage(),
            ],
        ], 200);
    }

    /**
     * Store a newly created Perangkat Daerah.
     */
    public function store(StorePerangkatDaerahRequest $request): JsonResponse
    {
        $pd = PerangkatDaerah::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Data Perangkat Daerah berhasil ditambahkan',
            'data' => new PerangkatDaerahResource($pd),
        ], 201);
    }

    /**
     * Display the specified Perangkat Daerah.
     */
    public function show(string $id): JsonResponse
    {
        $pd = PerangkatDaerah::withCount(['pegawais', 'kendaraanDinas'])->find($id);

        if (! $pd) {
            return response()->json([
                'success' => false,
                'message' => 'Data Perangkat Daerah tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail Perangkat Daerah berhasil diambil',
            'data' => new PerangkatDaerahResource($pd),
        ], 200);
    }

    /**
     * Update the specified Perangkat Daerah.
     */
    public function update(UpdatePerangkatDaerahRequest $request, string $id): JsonResponse
    {
        $pd = PerangkatDaerah::find($id);

        if (! $pd) {
            return response()->json([
                'success' => false,
                'message' => 'Data Perangkat Daerah tidak ditemukan',
            ], 404);
        }

        $pd->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Data Perangkat Daerah berhasil diperbarui',
            'data' => new PerangkatDaerahResource($pd),
        ], 200);
    }

    /**
     * Remove the specified Perangkat Daerah.
     */
    public function destroy(string $id): JsonResponse
    {
        $pd = PerangkatDaerah::find($id);

        if (! $pd) {
            return response()->json([
                'success' => false,
                'message' => 'Data Perangkat Daerah tidak ditemukan',
            ], 404);
        }

        $pd->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Perangkat Daerah berhasil dihapus',
        ], 200);
    }
}
