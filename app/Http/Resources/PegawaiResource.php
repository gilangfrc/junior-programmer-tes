<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PegawaiResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'perangkat_daerah_id' => $this->perangkat_daerah_id,
            'instansi' => $this->whenLoaded('perangkatDaerah', function () {
                return [
                    'id' => $this->perangkatDaerah->id,
                    'kode_opd' => $this->perangkatDaerah->kode_opd,
                    'nama_instansi' => $this->perangkatDaerah->nama_instansi,
                    'singkatan' => $this->perangkatDaerah->singkatan,
                ];
            }),
            'nip' => $this->nip,
            'nama' => $this->nama,
            'jabatan' => $this->jabatan,
            'golongan' => $this->golongan,
            'no_hp' => $this->no_hp,
            'email' => $this->email,
            'status_aktif' => (bool) $this->status_aktif,
            'total_kendaraan_dipegang' => $this->whenCounted('kendaraanDinas'),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
