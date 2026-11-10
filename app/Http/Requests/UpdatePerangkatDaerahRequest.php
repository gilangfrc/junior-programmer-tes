<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePerangkatDaerahRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $param = $this->route('perangkat_daerah') ?? $this->route('id');
        $id = is_object($param) ? $param->id : ($param ?? $this->id);

        return [
            'kode_opd' => [
                'required',
                'string',
                'max:50',
                Rule::unique('perangkat_daerahs', 'kode_opd')->ignore($id),
            ],
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
            'kode_opd.unique' => 'Kode OPD sudah digunakan oleh instansi lain.',
            'nama_instansi.required' => 'Nama instansi wajib diisi.',
        ];
    }
}
