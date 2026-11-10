@extends('layouts.app')

@section('title', 'Ubah Pegawai - ' . $pegawai->nama)

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <!-- Breadcrumb & Header -->
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center space-x-2 text-xs text-slate-500 mb-1">
                <a href="{{ route('pegawai.index') }}" class="hover:text-blue-600">Pegawai (PNS)</a>
                <span>/</span>
                <span class="text-slate-800 font-semibold">{{ $pegawai->nama }}</span>
                <span>/</span>
                <span class="text-slate-800 font-semibold">Ubah Data</span>
            </div>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">Ubah Data Pegawai PNS</h1>
            <p class="text-xs text-slate-500 mt-0.5">Edit informasi kepegawaian, jabatan, golongan, atau instansi.</p>
        </div>
        <a href="{{ route('pegawai.show', $pegawai) }}" class="inline-flex items-center space-x-1.5 text-xs font-semibold px-3.5 py-2 rounded-xl border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 hover:border-slate-300 transition-all shadow-sm">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            <span>Lihat Detail</span>
        </a>
    </div>

    <!-- Form Container -->
    <form action="{{ route('pegawai.update', $pegawai) }}" method="POST" class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 sm:p-9 space-y-6">
        @csrf
        @method('PUT')

        <!-- Perangkat Daerah -->
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1.5">Perangkat Daerah (Instansi Bertugas) <span class="text-rose-500">*</span></label>
            <div class="relative">
                <select name="perangkat_daerah_id" required class="form-control-smooth appearance-none w-full text-xs font-medium rounded-xl border border-slate-200 py-2.5 pl-3.5 pr-11 text-slate-800 bg-white cursor-pointer">
                    @foreach($perangkatDaerahs as $pd)
                        <option value="{{ $pd->id }}" {{ old('perangkat_daerah_id', $pegawai->perangkat_daerah_id) == $pd->id ? 'selected' : '' }}>
                            [{{ $pd->kode_opd }}] {{ $pd->nama_instansi }}
                        </option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <!-- NIP with Live Validator -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Nomor Induk Pegawai (NIP) <span class="text-rose-500">*</span></label>
                <div class="relative">
                    <input 
                        type="text" 
                        id="nip_input"
                        name="nip" 
                        value="{{ old('nip', $pegawai->nip) }}" 
                        maxlength="18"
                        required 
                        class="form-control-smooth w-full text-xs font-mono font-bold rounded-xl border border-slate-200 py-2.5 px-3.5 text-slate-800 tracking-wider"
                    >
                    <div id="nipCheckIcon" class="absolute right-3.5 top-2.5 pointer-events-none">
                        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                </div>
                <div id="nipFeedback" class="text-[11px] text-emerald-700 font-semibold mt-1 flex items-center space-x-1">
                    <span>✓ Format 18 digit NIP terdaftar</span>
                </div>
            </div>

            <!-- Nama -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Nama Lengkap (beserta Gelar) <span class="text-rose-500">*</span></label>
                <input type="text" name="nama" value="{{ old('nama', $pegawai->nama) }}" required class="form-control-smooth w-full text-xs rounded-xl border border-slate-200 py-2.5 px-3.5 text-slate-800">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <!-- Jabatan -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Jabatan Struktural / Fungsional <span class="text-rose-500">*</span></label>
                <input type="text" name="jabatan" value="{{ old('jabatan', $pegawai->jabatan) }}" required class="form-control-smooth w-full text-xs rounded-xl border border-slate-200 py-2.5 px-3.5 text-slate-800">
            </div>

            <!-- Golongan -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Pangkat / Golongan Ruang <span class="text-rose-500">*</span></label>
                <input type="text" name="golongan" value="{{ old('golongan', $pegawai->golongan) }}" required class="form-control-smooth w-full text-xs rounded-xl border border-slate-200 py-2.5 px-3.5 text-slate-800">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <!-- No HP -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Nomor Telepon / WhatsApp</label>
                <input type="text" name="no_hp" value="{{ old('no_hp', $pegawai->no_hp) }}" class="form-control-smooth w-full text-xs rounded-xl border border-slate-200 py-2.5 px-3.5 text-slate-800">
            </div>

            <!-- Email -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Email Dinas / Pribadi</label>
                <input type="email" name="email" value="{{ old('email', $pegawai->email) }}" class="form-control-smooth w-full text-xs rounded-xl border border-slate-200 py-2.5 px-3.5 text-slate-800">
            </div>
        </div>

        <div class="p-3.5 bg-slate-50 rounded-2xl border border-slate-100">
            <label class="flex items-center space-x-3 text-xs text-slate-700 font-semibold cursor-pointer">
                <input type="checkbox" name="status_aktif" value="1" {{ old('status_aktif', $pegawai->status_aktif) ? 'checked' : '' }} class="rounded-lg border-slate-300 text-blue-600 focus:ring-blue-500 w-4 h-4">
                <span>Status Pegawai Aktif</span>
            </label>
        </div>

        <!-- Submit Buttons -->
        <div class="pt-5 border-t border-slate-100 flex items-center justify-end space-x-3">
            <a href="{{ route('pegawai.show', $pegawai) }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 text-xs font-semibold transition-all">
                Batal
            </a>
            <button type="submit" class="px-7 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold transition-all shadow-md shadow-blue-500/25">
                Perbarui Data Pegawai
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    const nipInput = document.getElementById('nip_input');
    const nipCheckIcon = document.getElementById('nipCheckIcon');
    const nipFeedback = document.getElementById('nipFeedback');

    nipInput.addEventListener('input', function(e) {
        let val = e.target.value.replace(/\D/g, '');
        e.target.value = val;

        if (val.length === 18) {
            nipCheckIcon.classList.remove('hidden');
            nipInput.classList.add('border-emerald-400');
            nipFeedback.innerHTML = `<span class="text-emerald-700 font-semibold">✓ Format 18 digit NIP valid</span>`;
        } else if (val.length > 0) {
            nipCheckIcon.classList.add('hidden');
            nipInput.classList.remove('border-emerald-400');
            nipFeedback.innerHTML = `<span class="text-amber-700 font-medium">Panjang NIP saat ini: ${val.length}/18 digit</span>`;
        } else {
            nipCheckIcon.classList.add('hidden');
            nipInput.classList.remove('border-emerald-400');
            nipFeedback.innerHTML = `<span class="text-slate-400">18 digit standar BKN</span>`;
        }
    });
</script>
@endpush
