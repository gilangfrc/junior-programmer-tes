<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKendaraanDinasRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'perangkat_daerah_id' => ['required', 'exists:perangkat_daerahs,id'],
            'penanggung_jawab_id' => ['nullable', 'exists:pegawais,id'],
            'no_polisi' => ['required', 'string', 'max:20', 'unique:kendaraan_dinas,no_polisi'],
            'merek' => ['required', 'string', 'max:100'],
            'tipe' => ['required', 'string', 'max:100'],
            'jenis_kendaraan' => ['required', 'in:Roda 2,Roda 4,Roda 6 / Truk / Bus'],
            'tahun_produksi' => ['required', 'integer', 'min:1980', 'max:' . (date('Y') + 1)],
            'warna' => ['required', 'string', 'max:50'],
            'kondisi' => ['required', 'in:Baik,Rusak Ringan,Rusak Berat'],
            'nomor_rangka' => ['nullable', 'string', 'max:100'],
            'nomor_mesin' => ['nullable', 'string', 'max:100'],
            'tgl_pajak' => ['nullable', 'date'],
            'keterangan' => ['nullable', 'string', 'max:1000'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
        ];
    }

    public function messages(): array
    {
        return [
            'perangkat_daerah_id.required' => 'Perangkat Daerah pemilik kendaraan wajib dipilih.',
            'no_polisi.required' => 'Nomor polisi kendaraan wajib diisi.',
            'no_polisi.unique' => 'Nomor polisi sudah terdaftar.',
            'merek.required' => 'Merek kendaraan wajib diisi.',
            'tipe.required' => 'Tipe / model kendaraan wajib diisi.',
            'jenis_kendaraan.required' => 'Jenis kendaraan wajib dipilih.',
            'tahun_produksi.required' => 'Tahun produksi wajib diisi.',
            'warna.required' => 'Warna kendaraan wajib diisi.',
            'kondisi.required' => 'Kondisi kendaraan wajib dipilih.',
        ];
    }
}
