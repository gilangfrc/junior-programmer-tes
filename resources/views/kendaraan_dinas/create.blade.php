@extends('layouts.app')

@section('title', 'Tambah Kendaraan Dinas Operasional')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Breadcrumb & Header -->
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center space-x-2 text-xs text-slate-500 mb-1">
                <a href="{{ route('kendaraan-dinas.index') }}" class="hover:text-blue-600">Kendaraan Dinas</a>
                <span>/</span>
                <span class="text-slate-800 font-semibold">Tambah Baru</span>
            </div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Tambah Kendaraan Dinas Operasional</h1>
            <p class="text-xs text-slate-500 mt-0.5">Input data aset kendaraan bermotor dinas (BMD) baru ke sistem.</p>
        </div>
        <a href="{{ route('kendaraan-dinas.index') }}" class="text-xs font-semibold px-3 py-2 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 transition-colors">
            &larr; Kembali
        </a>
    </div>

    <!-- Form Container -->
    <form action="{{ route('kendaraan-dinas.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 sm:p-8 space-y-6">
        @csrf

        <!-- Section 1: Identitas & Klasifikasi Kendaraan -->
        <div>
            <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider pb-2 border-b border-slate-100 flex items-center space-x-2">
                <span class="w-6 h-6 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center text-xs font-extrabold">1</span>
                <span>Spesifikasi & Identitas Fisik Kendaraan</span>
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
                <!-- No Polisi -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Nomor Polisi (Plat Merah) <span class="text-rose-500">*</span></label>
                    <input type="text" name="no_polisi" value="{{ old('no_polisi') }}" placeholder="Contoh: B 1024 PQ" required class="w-full text-xs font-mono font-bold rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-2.5 px-3 uppercase">
                    <p class="text-[10px] text-slate-400 mt-1">Gunakan spasi antar kode wilayah dan angka.</p>
                </div>

                <!-- Merek -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Merek Kendaraan <span class="text-rose-500">*</span></label>
                    <input type="text" name="merek" value="{{ old('merek') }}" placeholder="Contoh: Toyota, Honda, Mitsubishi" required class="w-full text-xs rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-2.5 px-3">
                </div>

                <!-- Tipe/Model -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Tipe / Model <span class="text-rose-500">*</span></label>
                    <input type="text" name="tipe" value="{{ old('tipe') }}" placeholder="Contoh: Innova Venturer 2.4 A/T" required class="w-full text-xs rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-2.5 px-3">
                </div>

                <!-- Jenis Kendaraan -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Jenis Kendaraan <span class="text-rose-500">*</span></label>
                    <select name="jenis_kendaraan" required class="w-full text-xs rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-2.5 px-3">
                        <option value="Roda 4" {{ old('jenis_kendaraan') === 'Roda 4' ? 'selected' : '' }}>Roda 4 (Mobil Dinas / Minibus / SUV)</option>
                        <option value="Roda 2" {{ old('jenis_kendaraan') === 'Roda 2' ? 'selected' : '' }}>Roda 2 (Sepeda Motor Operasional)</option>
                        <option value="Roda 6 / Truk / Bus" {{ old('jenis_kendaraan') === 'Roda 6 / Truk / Bus' ? 'selected' : '' }}>Roda 6 / Truk / Bus / Ambulans Khusus</option>
                    </select>
                </div>

                <!-- Tahun Produksi -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Tahun Produksi <span class="text-rose-500">*</span></label>
                    <input type="number" name="tahun_produksi" value="{{ old('tahun_produksi', date('Y')) }}" min="1980" max="{{ date('Y') + 1 }}" required class="w-full text-xs rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-2.5 px-3">
                </div>

                <!-- Warna Kendaraan -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Warna Kendaraan <span class="text-rose-500">*</span></label>
                    <input type="text" name="warna" value="{{ old('warna') }}" placeholder="Contoh: Hitam Metalik, Silver, Putih" required class="w-full text-xs rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-2.5 px-3">
                </div>

                <!-- Kondisi -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Kondisi / Status Fisik <span class="text-rose-500">*</span></label>
                    <select name="kondisi" required class="w-full text-xs rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-2.5 px-3 font-semibold">
                        <option value="Baik" {{ old('kondisi') === 'Baik' ? 'selected' : '' }} class="text-emerald-700">Baik (Siap Operasional)</option>
                        <option value="Rusak Ringan" {{ old('kondisi') === 'Rusak Ringan' ? 'selected' : '' }} class="text-amber-700">Rusak Ringan (Perlu Perawatan Rutin)</option>
                        <option value="Rusak Berat" {{ old('kondisi') === 'Rusak Berat' ? 'selected' : '' }} class="text-rose-700">Rusak Berat (Mati Total / Tidak Beroperasi)</option>
                    </select>
                </div>

                <!-- Jatuh Tempo Pajak/STNK -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Jatuh Tempo Pajak STNK</label>
                    <input type="date" name="tgl_pajak" value="{{ old('tgl_pajak') }}" class="w-full text-xs rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-2.5 px-3">
                </div>

                <!-- Upload Foto -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Foto Fisik Unit (Opsional)</label>
                    <input type="file" name="foto" accept="image/*" class="w-full text-xs text-slate-500 file:mr-2 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>
            </div>
        </div>

        <!-- Section 2: Kepemilikan & Penanggung Jawab -->
        <div class="pt-2">
            <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider pb-2 border-b border-slate-100 flex items-center space-x-2">
                <span class="w-6 h-6 rounded-lg bg-indigo-100 text-indigo-700 flex items-center justify-center text-xs font-extrabold">2</span>
                <span>Alokasi Instansi & Penanggung Jawab (PNS)</span>
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                <!-- Perangkat Daerah -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Perangkat Daerah (Instansi Pemilik) <span class="text-rose-500">*</span></label>
                    <select name="perangkat_daerah_id" required class="w-full text-xs rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-2.5 px-3">
                        <option value="">-- Pilih Perangkat Daerah (OPD) --</option>
                        @foreach($perangkatDaerahs as $pd)
                            <option value="{{ $pd->id }}" {{ old('perangkat_daerah_id') == $pd->id ? 'selected' : '' }}>
                                [{{ $pd->kode_opd }}] {{ $pd->nama_instansi }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Penanggung Jawab (PNS) -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Pegawai Penanggung Jawab (PNS)</label>
                    <select name="penanggung_jawab_id" class="w-full text-xs rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-2.5 px-3">
                        <option value="">-- Belum Ditugaskan / Pool Dinas --</option>
                        @foreach($pegawais as $pns)
                            <option value="{{ $pns->id }}" {{ old('penanggung_jawab_id') == $pns->id ? 'selected' : '' }}>
                                {{ $pns->nama }} (NIP: {{ $pns->nip }}) - {{ $pns->perangkatDaerah->singkatan ?? $pns->perangkatDaerah->nama_instansi }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-[10px] text-slate-400 mt-1">Dapat dikosongkan jika kendaraan berada di pool dinas tanpa pemegang tetap.</p>
                </div>
            </div>
        </div>

        <!-- Section 3: Data Teknis & Catatan BMD -->
        <div class="pt-2">
            <h3 class="text-sm font-bold text-slate-900 uppercase tracking-wider pb-2 border-b border-slate-100 flex items-center space-x-2">
                <span class="w-6 h-6 rounded-lg bg-slate-100 text-slate-700 flex items-center justify-center text-xs font-extrabold">3</span>
                <span>Nomor Identifikasi Mesin/Rangka & Keterangan</span>
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Nomor Rangka (VIN)</label>
                    <input type="text" name="nomor_rangka" value="{{ old('nomor_rangka') }}" placeholder="Nomor rangka sesuai STNK/BPKB" class="w-full text-xs font-mono rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-2.5 px-3 uppercase">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1">Nomor Mesin</label>
                    <input type="text" name="nomor_mesin" value="{{ old('nomor_mesin') }}" placeholder="Nomor mesin sesuai STNK/BPKB" class="w-full text-xs font-mono rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-2.5 px-3 uppercase">
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 mb-1">Catatan Tambahan / Riwayat Penggunaan</label>
                    <textarea name="keterangan" rows="3" placeholder="Informasi peruntukan operasional, kondisi spesifik, atau kelengkapan surat-surat..." class="w-full text-xs rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 p-3">{{ old('keterangan') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Submit Buttons -->
        <div class="pt-4 border-t border-slate-100 flex items-center justify-end space-x-3">
            <a href="{{ route('kendaraan-dinas.index') }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 text-xs font-semibold transition-colors">
                Batal
            </a>
            <button type="submit" class="px-6 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-semibold transition-all shadow-md shadow-blue-500/25">
                Simpan Data Kendaraan
            </button>
        </div>
    </form>
</div>
@endsection
