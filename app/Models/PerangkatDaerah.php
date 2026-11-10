<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PerangkatDaerah extends Model
{
    use HasFactory;

    protected $table = 'perangkat_daerahs';

    protected $fillable = [
        'kode_opd',
        'nama_instansi',
        'singkatan',
        'alamat',
        'telepon',
        'nama_kepala',
        'nip_kepala',
    ];

    /**
     * Relasi ke seluruh Pegawai di instansi ini
     */
    public function pegawais(): HasMany
    {
        return $this->hasMany(Pegawai::class, 'perangkat_daerah_id');
    }

    /**
     * Relasi ke seluruh Kendaraan Dinas aset instansi ini
     */
    public function kendaraanDinas(): HasMany
    {
        return $this->hasMany(KendaraanDinas::class, 'perangkat_daerah_id');
    }
}
