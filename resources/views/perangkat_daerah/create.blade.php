@extends('layouts.app')

@section('title', 'Tambah Perangkat Daerah (PD / OPD)')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <!-- Breadcrumb & Header -->
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center space-x-2 text-xs text-slate-500 mb-1">
                <a href="{{ route('perangkat-daerah.index') }}" class="hover:text-blue-600">Perangkat Daerah</a>
                <span>/</span>
                <span class="text-slate-800 font-semibold">Tambah Baru</span>
            </div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Tambah Perangkat Daerah</h1>
            <p class="text-xs text-slate-500 mt-0.5">Daftarkan dinas, badan, atau satuan kerja pengelola aset kendaraan baru.</p>
        </div>
        <a href="{{ route('perangkat-daerah.index') }}" class="text-xs font-semibold px-3 py-2 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 transition-colors">
            &larr; Kembali
        </a>
    </div>

    <!-- Form Container -->
    <form action="{{ route('perangkat-daerah.store') }}" method="POST" class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 sm:p-8 space-y-5">
        @csrf

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <!-- Kode OPD -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Kode OPD <span class="text-rose-500">*</span></label>
                <input type="text" name="kode_opd" value="{{ old('kode_opd') }}" placeholder="Contoh: 1.01.01" required class="w-full text-xs font-mono font-bold rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-2.5 px-3">
            </div>

            <!-- Nama Instansi -->
            <div class="sm:col-span-2">
                <label class="block text-xs font-bold text-slate-700 mb-1">Nama Instansi Resmi <span class="text-rose-500">*</span></label>
                <input type="text" name="nama_instansi" value="{{ old('nama_instansi') }}" placeholder="Contoh: Dinas Pendidikan" required class="w-full text-xs rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-2.5 px-3">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Singkatan -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Nama Singkatan / Akronim</label>
                <input type="text" name="singkatan" value="{{ old('singkatan') }}" placeholder="Contoh: Disdik, Dinkes, PUPR" class="w-full text-xs rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-2.5 px-3">
            </div>

            <!-- Telepon -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Nomor Telepon Kantor</label>
                <input type="text" name="telepon" value="{{ old('telepon') }}" placeholder="(021) 555-xxxx" class="w-full text-xs rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-2.5 px-3">
            </div>
        </div>

        <!-- Alamat -->
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Alamat Kantor</label>
            <textarea name="alamat" rows="2" placeholder="Jl. Raya Perkantoran Pemda..." class="w-full text-xs rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 p-3">{{ old('alamat') }}</textarea>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2 border-t border-slate-100">
            <!-- Nama Kepala -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Nama Kepala Dinas / Pimpinan</label>
                <input type="text" name="nama_kepala" value="{{ old('nama_kepala') }}" placeholder="Beserta gelar akademik..." class="w-full text-xs rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-2.5 px-3">
            </div>

            <!-- NIP Kepala -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">NIP Kepala Dinas</label>
                <input type="text" name="nip_kepala" value="{{ old('nip_kepala') }}" placeholder="18 Digit NIP..." class="w-full text-xs font-mono rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-2.5 px-3">
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="pt-4 border-t border-slate-100 flex items-center justify-end space-x-3">
            <a href="{{ route('perangkat-daerah.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 text-xs font-semibold transition-colors">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-semibold transition-all shadow-md shadow-blue-500/25">
                Simpan Perangkat Daerah
            </button>
        </div>
    </form>
</div>
@endsection
