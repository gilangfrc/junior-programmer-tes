<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pegawai extends Model
{
    use HasFactory;

    protected $table = 'pegawais';

    protected $fillable = [
        'perangkat_daerah_id',
        'nip',
        'nama',
        'jabatan',
        'golongan',
        'no_hp',
        'email',
        'status_aktif',
    ];

    protected $casts = [
        'status_aktif' => 'boolean',
    ];

    /**
     * Relasi ke instansi Perangkat Daerah tempat bertugas
     */
    public function perangkatDaerah(): BelongsTo
    {
        return $this->belongsTo(PerangkatDaerah::class, 'perangkat_daerah_id');
    }

    /**
     * Relasi ke Kendaraan Dinas yang dipertanggungjawabkan
     */
    public function kendaraanDinas(): HasMany
    {
        return $this->hasMany(KendaraanDinas::class, 'penanggung_jawab_id');
    }
}
