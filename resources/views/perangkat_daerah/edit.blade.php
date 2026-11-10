@extends('layouts.app')

@section('title', 'Ubah Perangkat Daerah - ' . $perangkatDaerah->nama_instansi)

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <!-- Breadcrumb & Header -->
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center space-x-2 text-xs text-slate-500 mb-1">
                <a href="{{ route('perangkat-daerah.index') }}" class="hover:text-blue-600">Perangkat Daerah</a>
                <span>/</span>
                <span class="text-slate-800 font-semibold">{{ $perangkatDaerah->singkatan ?? $perangkatDaerah->nama_instansi }}</span>
                <span>/</span>
                <span class="text-slate-800 font-semibold">Ubah Data</span>
            </div>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">Ubah Perangkat Daerah</h1>
            <p class="text-xs text-slate-500 mt-0.5">Edit profil instansi, kontak kantor, atau pejabat kepala dinas.</p>
        </div>
        <a href="{{ route('perangkat-daerah.show', $perangkatDaerah) }}" class="inline-flex items-center space-x-1.5 text-xs font-semibold px-3.5 py-2 rounded-xl border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 hover:border-slate-300 transition-all shadow-sm">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            <span>Lihat Detail</span>
        </a>
    </div>

    <!-- Form Container -->
    <form action="{{ route('perangkat-daerah.update', $perangkatDaerah) }}" method="POST" class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 sm:p-9 space-y-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            <!-- Kode OPD -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Kode OPD <span class="text-rose-500">*</span></label>
                <input type="text" name="kode_opd" value="{{ old('kode_opd', $perangkatDaerah->kode_opd) }}" required class="form-control-smooth w-full text-xs font-mono font-bold rounded-xl border border-slate-200 py-2.5 px-3.5 text-slate-800">
            </div>

            <!-- Nama Instansi -->
            <div class="sm:col-span-2">
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Nama Instansi Resmi <span class="text-rose-500">*</span></label>
                <input type="text" name="nama_instansi" value="{{ old('nama_instansi', $perangkatDaerah->nama_instansi) }}" required class="form-control-smooth w-full text-xs rounded-xl border border-slate-200 py-2.5 px-3.5 text-slate-800">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <!-- Singkatan -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Nama Singkatan / Akronim</label>
                <input type="text" name="singkatan" value="{{ old('singkatan', $perangkatDaerah->singkatan) }}" class="form-control-smooth w-full text-xs rounded-xl border border-slate-200 py-2.5 px-3.5 text-slate-800">
            </div>

            <!-- Telepon -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Nomor Telepon Kantor</label>
                <input type="text" name="telepon" value="{{ old('telepon', $perangkatDaerah->telepon) }}" class="form-control-smooth w-full text-xs rounded-xl border border-slate-200 py-2.5 px-3.5 text-slate-800">
            </div>
        </div>

        <!-- Alamat -->
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1.5">Alamat Kantor Dinas</label>
            <textarea name="alamat" rows="2" class="form-control-smooth w-full text-xs rounded-xl border border-slate-200 p-3.5 text-slate-800 leading-relaxed">{{ old('alamat', $perangkatDaerah->alamat) }}</textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 pt-3 border-t border-slate-100">
            <!-- Nama Kepala -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Nama Kepala Dinas / Pimpinan</label>
                <input type="text" name="nama_kepala" value="{{ old('nama_kepala', $perangkatDaerah->nama_kepala) }}" class="form-control-smooth w-full text-xs rounded-xl border border-slate-200 py-2.5 px-3.5 text-slate-800">
            </div>

            <!-- NIP Kepala -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">NIP Kepala Dinas</label>
                <input type="text" name="nip_kepala" value="{{ old('nip_kepala', $perangkatDaerah->nip_kepala) }}" class="form-control-smooth w-full text-xs font-mono rounded-xl border border-slate-200 py-2.5 px-3.5 text-slate-800">
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="pt-5 border-t border-slate-100 flex items-center justify-end space-x-3">
            <a href="{{ route('perangkat-daerah.show', $perangkatDaerah) }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 text-xs font-semibold transition-all">
                Batal
            </a>
            <button type="submit" class="px-7 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold transition-all shadow-md shadow-blue-500/25">
                Perbarui Perangkat Daerah
            </button>
        </div>
    </form>
</div>
@endsection
