<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatKondisi extends Model
{
    use HasFactory;

    protected $table = 'riwayat_kondisis';

    protected $fillable = [
        'kendaraan_dinas_id',
        'tanggal_pemeriksaan',
        'kondisi_sebelum',
        'kondisi_sesudah',
        'catatan_kerusakan',
        'petugas_pemeriksa',
        'estimasi_biaya',
    ];

    protected $casts = [
        'tanggal_pemeriksaan' => 'date',
        'estimasi_biaya' => 'decimal:2',
    ];

    public function kendaraanDinas(): BelongsTo
    {
        return $this->belongsTo(KendaraanDinas::class, 'kendaraan_dinas_id');
    }
}
