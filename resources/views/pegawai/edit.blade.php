@extends('layouts.app')

@section('title', 'Ubah Pegawai - ' . $pegawai->nama)

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <!-- Breadcrumb & Header -->
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center space-x-2 text-xs text-slate-500 mb-1">
                <a href="{{ route('pegawai.index') }}" class="hover:text-blue-600">Pegawai (PNS)</a>
                <span>/</span>
                <span class="text-slate-800 font-semibold">Ubah Data</span>
            </div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Ubah Data Pegawai PNS</h1>
            <p class="text-xs text-slate-500 mt-0.5">Edit informasi kepegawaian, jabatan, golongan, atau instansi.</p>
        </div>
        <a href="{{ route('pegawai.show', $pegawai) }}" class="text-xs font-semibold px-3 py-2 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 transition-colors">
            &larr; Lihat Detail
        </a>
    </div>

    <!-- Form Container -->
    <form action="{{ route('pegawai.update', $pegawai) }}" method="POST" class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 sm:p-8 space-y-5">
        @csrf
        @method('PUT')

        <!-- Perangkat Daerah -->
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Perangkat Daerah (Instansi Bertugas) <span class="text-rose-500">*</span></label>
            <select name="perangkat_daerah_id" required class="w-full text-xs rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-2.5 px-3">
                @foreach($perangkatDaerahs as $pd)
                    <option value="{{ $pd->id }}" {{ old('perangkat_daerah_id', $pegawai->perangkat_daerah_id) == $pd->id ? 'selected' : '' }}>
                        [{{ $pd->kode_opd }}] {{ $pd->nama_instansi }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- NIP -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Nomor Induk Pegawai (NIP) <span class="text-rose-500">*</span></label>
                <input type="text" name="nip" value="{{ old('nip', $pegawai->nip) }}" required class="w-full text-xs font-mono font-bold rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-2.5 px-3">
            </div>

            <!-- Nama -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap (beserta Gelar) <span class="text-rose-500">*</span></label>
                <input type="text" name="nama" value="{{ old('nama', $pegawai->nama) }}" required class="w-full text-xs rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-2.5 px-3">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Jabatan -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Jabatan Struktural / Fungsional <span class="text-rose-500">*</span></label>
                <input type="text" name="jabatan" value="{{ old('jabatan', $pegawai->jabatan) }}" required class="w-full text-xs rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-2.5 px-3">
            </div>

            <!-- Golongan -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Pangkat / Golongan Ruang <span class="text-rose-500">*</span></label>
                <input type="text" name="golongan" value="{{ old('golongan', $pegawai->golongan) }}" required class="w-full text-xs rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-2.5 px-3">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- No HP -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Nomor Telepon / WhatsApp</label>
                <input type="text" name="no_hp" value="{{ old('no_hp', $pegawai->no_hp) }}" class="w-full text-xs rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-2.5 px-3">
            </div>

            <!-- Email -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Email Dinas / Pribadi</label>
                <input type="email" name="email" value="{{ old('email', $pegawai->email) }}" class="w-full text-xs rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-2.5 px-3">
            </div>
        </div>

        <div class="pt-2">
            <label class="flex items-center space-x-2 text-xs text-slate-700 font-semibold cursor-pointer">
                <input type="checkbox" name="status_aktif" value="1" {{ old('status_aktif', $pegawai->status_aktif) ? 'checked' : '' }} class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                <span>Status Pegawai Aktif</span>
            </label>
        </div>

        <!-- Submit Buttons -->
        <div class="pt-4 border-t border-slate-100 flex items-center justify-end space-x-3">
            <a href="{{ route('pegawai.show', $pegawai) }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 text-xs font-semibold transition-colors">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-semibold transition-all shadow-md shadow-blue-500/25">
                Perbarui Data Pegawai
            </button>
        </div>
    </form>
</div>
@endsection
