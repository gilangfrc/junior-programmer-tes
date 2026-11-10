@extends('layouts.app')

@section('title', 'Tambah Pegawai Negeri Sipil (PNS)')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <!-- Breadcrumb & Header -->
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center space-x-2 text-xs text-slate-500 mb-1">
                <a href="{{ route('pegawai.index') }}" class="hover:text-blue-600">Pegawai (PNS)</a>
                <span>/</span>
                <span class="text-slate-800 font-semibold">Tambah Baru</span>
            </div>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">Tambah Pegawai PNS</h1>
            <p class="text-xs text-slate-500 mt-0.5">Input data aparatur sipil negara sebagai penanggung jawab kendaraan dinas.</p>
        </div>
        <a href="{{ route('pegawai.index') }}" class="inline-flex items-center space-x-1.5 text-xs font-semibold px-3.5 py-2 rounded-xl border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 hover:border-slate-300 transition-all shadow-sm">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Kembali</span>
        </a>
    </div>

    <!-- Form Container -->
    <form action="{{ route('pegawai.store') }}" method="POST" class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 sm:p-9 space-y-6">
        @csrf

        <!-- Perangkat Daerah -->
        <div>
            <label class="block text-xs font-bold text-slate-700 mb-1.5">Perangkat Daerah (Instansi Bertugas) <span class="text-rose-500">*</span></label>
            <div class="relative">
                <select name="perangkat_daerah_id" required class="form-control-smooth appearance-none w-full text-xs font-medium rounded-xl border border-slate-200 py-2.5 pl-3.5 pr-11 text-slate-800 bg-white cursor-pointer">
                    <option value="">-- Pilih Instansi / OPD Tempat Bertugas --</option>
                    @foreach($perangkatDaerahs as $pd)
                        <option value="{{ $pd->id }}" {{ old('perangkat_daerah_id') == $pd->id ? 'selected' : '' }}>
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
                        value="{{ old('nip') }}" 
                        placeholder="Contoh: 198204152006041008" 
                        maxlength="18"
                        required 
                        class="form-control-smooth w-full text-xs font-mono font-bold rounded-xl border border-slate-200 py-2.5 px-3.5 text-slate-800 tracking-wider placeholder:text-slate-400 placeholder:font-normal placeholder:tracking-normal"
                    >
                    <div id="nipCheckIcon" class="absolute right-3.5 top-2.5 hidden pointer-events-none">
                        <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                </div>
                <div id="nipFeedback" class="text-[11px] text-slate-400 mt-1 flex items-center space-x-1">
                    <span>18 digit standar BKN (Format: YYYYMMDD YYYYMM X XXX)</span>
                </div>
            </div>

            <!-- Nama -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Nama Lengkap (beserta Gelar) <span class="text-rose-500">*</span></label>
                <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Contoh: Dr. H. Ahmad Fauzi, M.Si." required class="form-control-smooth w-full text-xs rounded-xl border border-slate-200 py-2.5 px-3.5 text-slate-800 placeholder:text-slate-400">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <!-- Jabatan -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Jabatan Struktural / Fungsional <span class="text-rose-500">*</span></label>
                <input type="text" name="jabatan" value="{{ old('jabatan') }}" placeholder="Contoh: Kepala Bidang Pembinaan SMP" required class="form-control-smooth w-full text-xs rounded-xl border border-slate-200 py-2.5 px-3.5 text-slate-800 placeholder:text-slate-400">
            </div>

            <!-- Golongan -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Pangkat / Golongan Ruang <span class="text-rose-500">*</span></label>
                <input type="text" name="golongan" value="{{ old('golongan') }}" placeholder="Contoh: IV/a (Pembina) atau III/c" required class="form-control-smooth w-full text-xs rounded-xl border border-slate-200 py-2.5 px-3.5 text-slate-800 placeholder:text-slate-400">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <!-- No HP -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Nomor Telepon / WhatsApp</label>
                <input type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="0812xxxxxxxx" class="form-control-smooth w-full text-xs rounded-xl border border-slate-200 py-2.5 px-3.5 text-slate-800 placeholder:text-slate-400">
            </div>

            <!-- Email -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Email Dinas / Pribadi</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="pegawai@instansi.go.id" class="form-control-smooth w-full text-xs rounded-xl border border-slate-200 py-2.5 px-3.5 text-slate-800 placeholder:text-slate-400">
            </div>
        </div>

        <div class="p-4 bg-slate-50/80 hover:bg-blue-50/30 rounded-2xl border border-slate-200/80 transition-all">
            <label class="custom-checkbox-wrapper flex items-center space-x-3.5 cursor-pointer select-none">
                <input type="checkbox" name="status_aktif" value="1" checked id="status_aktif">
                <div class="custom-checkbox-box">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                </div>
                <div>
                    <span class="text-xs font-bold text-slate-800 block">Status Pegawai Aktif</span>
                    <span class="text-[11px] text-slate-400 block mt-0.5">Memiliki wewenang resmi untuk ditugaskan memegang Kendaraan Dinas Operasional (KDO)</span>
                </div>
            </label>
        </div>

        <!-- Submit Buttons -->
        <div class="pt-5 border-t border-slate-100 flex items-center justify-end space-x-3">
            <a href="{{ route('pegawai.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 text-xs font-semibold transition-all">
                Batal
            </a>
            <button type="submit" class="px-7 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold transition-all shadow-md shadow-blue-500/25">
                Simpan Data Pegawai
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
        let val = e.target.value.replace(/\D/g, ''); // Digits only
        e.target.value = val;

        if (val.length === 18) {
            nipCheckIcon.classList.remove('hidden');
            nipInput.classList.add('border-emerald-400');
            nipFeedback.innerHTML = `<span class="inline-flex items-center gap-1 text-emerald-700 font-semibold"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg> Format 18 digit NIP valid</span>`;
        } else if (val.length > 0) {
            nipCheckIcon.classList.add('hidden');
            nipInput.classList.remove('border-emerald-400');
            nipFeedback.innerHTML = `<span class="text-amber-700 font-medium">Panjang NIP saat ini: ${val.length}/18 digit</span>`;
        } else {
            nipCheckIcon.classList.add('hidden');
            nipInput.classList.remove('border-emerald-400');
            nipFeedback.innerHTML = `<span class="text-slate-400">18 digit standar BKN (Format: YYYYMMDD YYYYMM X XXX)</span>`;
        }
    });
</script>
@endpush
