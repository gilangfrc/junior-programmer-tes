<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KendaraanDinas extends Model
{
    use HasFactory;

    protected $table = 'kendaraan_dinas';

    protected $fillable = [
        'perangkat_daerah_id',
        'penanggung_jawab_id',
        'no_polisi',
        'merek',
        'tipe',
        'jenis_kendaraan',
        'tahun_produksi',
        'warna',
        'kondisi',
        'nomor_rangka',
        'nomor_mesin',
        'tgl_pajak',
        'keterangan',
        'foto_path',
    ];

    protected $casts = [
        'tahun_produksi' => 'integer',
        'tgl_pajak' => 'date',
    ];

    /**
     * Relasi ke instansi Perangkat Daerah pemilik aset
     */
    public function perangkatDaerah(): BelongsTo
    {
        return $this->belongsTo(PerangkatDaerah::class, 'perangkat_daerah_id');
    }

    /**
     * Relasi ke Pegawai (PNS) penanggung jawab
     */
    public function penanggungJawab(): BelongsTo
    {
        return $this->belongsTo(Pegawai::class, 'penanggung_jawab_id');
    }

    /**
     * Relasi ke catatan riwayat kondisi & pemeliharaan
     */
    public function riwayatKondisi(): HasMany
    {
        return $this->hasMany(RiwayatKondisi::class, 'kendaraan_dinas_id')->latest('tanggal_pemeriksaan');
    }
}
