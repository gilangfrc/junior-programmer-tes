<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePegawaiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'perangkat_daerah_id' => ['required', 'exists:perangkat_daerahs,id'],
            'nip' => ['required', 'string', 'max:30', 'unique:pegawais,nip'],
            'nama' => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'max:255'],
            'golongan' => ['required', 'string', 'max:50'],
            'no_hp' => ['nullable', 'string', 'max:25'],
            'email' => ['nullable', 'email', 'max:100'],
            'status_aktif' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'perangkat_daerah_id.required' => 'Instansi Perangkat Daerah wajib dipilih.',
            'perangkat_daerah_id.exists' => 'Perangkat Daerah tidak valid.',
            'nip.required' => 'NIP pegawai wajib diisi.',
            'nip.unique' => 'NIP sudah terdaftar.',
            'nama.required' => 'Nama pegawai wajib diisi.',
            'jabatan.required' => 'Jabatan pegawai wajib diisi.',
            'golongan.required' => 'Golongan pegawai wajib diisi.',
        ];
    }
}
