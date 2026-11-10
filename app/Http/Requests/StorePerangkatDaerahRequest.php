<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePerangkatDaerahRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kode_opd' => ['required', 'string', 'max:50', 'unique:perangkat_daerahs,kode_opd'],
            'nama_instansi' => ['required', 'string', 'max:255'],
            'singkatan' => ['nullable', 'string', 'max:50'],
            'alamat' => ['nullable', 'string', 'max:500'],
            'telepon' => ['nullable', 'string', 'max:30'],
            'nama_kepala' => ['nullable', 'string', 'max:255'],
            'nip_kepala' => ['nullable', 'string', 'max:30'],
        ];
    }

    public function messages(): array
    {
        return [
            'kode_opd.required' => 'Kode OPD wajib diisi.',
            'kode_opd.unique' => 'Kode OPD sudah terdaftar.',
            'nama_instansi.required' => 'Nama instansi wajib diisi.',
        ];
    }
}
