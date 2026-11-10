@extends('layouts.app')

@section('title', 'Tambah Pegawai Negeri Sipil (PNS)')

@section('content')
<div class="max-w-2xl mx-auto space-y-6">
    <!-- Breadcrumb & Header -->
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center space-x-2 text-xs text-slate-500 mb-1">
                <a href="{{ route('pegawai.index') }}" class="hover:text-blue-600">Pegawai (PNS)</a>
                <span>/</span>
                <span class="text-slate-800 font-semibold">Tambah Baru</span>
            </div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Tambah Pegawai PNS</h1>
            <p class="text-xs text-slate-500 mt-0.5">Input data aparatur sipil negara sebagai penanggung jawab kendaraan dinas.</p>
        </div>
        <a href="{{ route('pegawai.index') }}" class="text-xs font-semibold px-3 py-2 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 transition-colors">
            &larr; Kembali
        </a>
    </div>

    <!-- Form Container -->
    <form action="{{ route('pegawai.store') }}" method="POST" class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 sm:p-8 space-y-5">
        @csrf

        <!-- Perangkat Daerah -->
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1">Perangkat Daerah (Instansi Bertugas) <span class="text-rose-500">*</span></label>
            <select name="perangkat_daerah_id" required class="w-full text-xs rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-2.5 px-3">
                <option value="">-- Pilih Instansi / OPD --</option>
                @foreach($perangkatDaerahs as $pd)
                    <option value="{{ $pd->id }}" {{ old('perangkat_daerah_id') == $pd->id ? 'selected' : '' }}>
                        [{{ $pd->kode_opd }}] {{ $pd->nama_instansi }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- NIP -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Nomor Induk Pegawai (NIP) <span class="text-rose-500">*</span></label>
                <input type="text" name="nip" value="{{ old('nip') }}" placeholder="18 Digit NIP BKN" required class="w-full text-xs font-mono font-bold rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-2.5 px-3">
                <p class="text-[10px] text-slate-400 mt-1">Format 18 digit standar BKN.</p>
            </div>

            <!-- Nama -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Nama Lengkap (beserta Gelar) <span class="text-rose-500">*</span></label>
                <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Contoh: Dr. H. Ahmad Fauzi, M.Si." required class="w-full text-xs rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-2.5 px-3">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- Jabatan -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Jabatan Struktural / Fungsional <span class="text-rose-500">*</span></label>
                <input type="text" name="jabatan" value="{{ old('jabatan') }}" placeholder="Contoh: Kepala Bidang Pembinaan SMP" required class="w-full text-xs rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-2.5 px-3">
            </div>

            <!-- Golongan -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Pangkat / Golongan Ruang <span class="text-rose-500">*</span></label>
                <input type="text" name="golongan" value="{{ old('golongan') }}" placeholder="Contoh: IV/a (Pembina) atau III/c" required class="w-full text-xs rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-2.5 px-3">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <!-- No HP -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Nomor Telepon / WhatsApp</label>
                <input type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="0812xxxxxxxx" class="w-full text-xs rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-2.5 px-3">
            </div>

            <!-- Email -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Email Dinas / Pribadi</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="pegawai@instansi.go.id" class="w-full text-xs rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-2.5 px-3">
            </div>
        </div>

        <div class="pt-2">
            <label class="flex items-center space-x-2 text-xs text-slate-700 font-semibold cursor-pointer">
                <input type="checkbox" name="status_aktif" value="1" checked class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                <span>Status Pegawai Aktif (Bisa ditugaskan memegang kendaraan)</span>
            </label>
        </div>

        <!-- Submit Buttons -->
        <div class="pt-4 border-t border-slate-100 flex items-center justify-end space-x-3">
            <a href="{{ route('pegawai.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 text-xs font-semibold transition-colors">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-semibold transition-all shadow-md shadow-blue-500/25">
                Simpan Pegawai
            </button>
        </div>
    </form>
</div>
@endsection
