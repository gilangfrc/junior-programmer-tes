<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PerangkatDaerahResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'kode_opd' => $this->kode_opd,
            'nama_instansi' => $this->nama_instansi,
            'singkatan' => $this->singkatan,
            'alamat' => $this->alamat,
            'telepon' => $this->telepon,
            'nama_kepala' => $this->nama_kepala,
            'nip_kepala' => $this->nip_kepala,
            'total_pegawai' => $this->whenCounted('pegawais'),
            'total_kendaraan' => $this->whenCounted('kendaraanDinas'),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
