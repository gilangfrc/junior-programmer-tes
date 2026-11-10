<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KendaraanDinasResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'no_polisi' => $this->no_polisi,
            'merek' => $this->merek,
            'tipe' => $this->tipe,
            'nama_kendaraan' => "{$this->merek} {$this->tipe}",
            'jenis_kendaraan' => $this->jenis_kendaraan,
            'tahun_produksi' => (int) $this->tahun_produksi,
            'warna' => $this->warna,
            'kondisi' => $this->kondisi,
            'nomor_rangka' => $this->nomor_rangka,
            'nomor_mesin' => $this->nomor_mesin,
            'tgl_pajak' => $this->tgl_pajak?->format('Y-m-d'),
            'keterangan' => $this->keterangan,
            'foto_url' => $this->foto_path ? asset('storage/' . $this->foto_path) : null,
            'perangkat_daerah' => $this->whenLoaded('perangkatDaerah', function () {
                return [
                    'id' => $this->perangkatDaerah->id,
                    'kode_opd' => $this->perangkatDaerah->kode_opd,
                    'nama_instansi' => $this->perangkatDaerah->nama_instansi,
                    'singkatan' => $this->perangkatDaerah->singkatan,
                ];
            }),
            'penanggung_jawab' => $this->whenLoaded('penanggungJawab', function () {
                if (! $this->penanggungJawab) {
                    return null;
                }

                return [
                    'id' => $this->penanggungJawab->id,
                    'nip' => $this->penanggungJawab->nip,
                    'nama' => $this->penanggungJawab->nama,
                    'jabatan' => $this->penanggungJawab->jabatan,
                    'golongan' => $this->penanggungJawab->golongan,
                    'no_hp' => $this->penanggungJawab->no_hp,
                ];
            }),
            'riwayat_kondisi' => $this->whenLoaded('riwayatKondisi'),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
