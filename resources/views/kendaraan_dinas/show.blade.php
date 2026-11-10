@extends('layouts.app')

@section('title', 'Detail KDO - ' . $kendaraanDinas->no_polisi)

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <!-- Breadcrumb & Header Action -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center space-x-2 text-xs text-slate-500 mb-1">
                <a href="{{ route('kendaraan-dinas.index') }}" class="hover:text-blue-600">Kendaraan Dinas</a>
                <span>/</span>
                <span class="text-slate-800 font-semibold font-mono">{{ $kendaraanDinas->no_polisi }}</span>
            </div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight flex items-center space-x-3">
                <span>{{ $kendaraanDinas->merek }} {{ $kendaraanDinas->tipe }}</span>
                <span class="px-3 py-0.5 rounded-lg font-mono font-bold text-xs bg-red-100 text-red-800 border border-red-200 shadow-sm">
                    {{ $kendaraanDinas->no_polisi }}
                </span>
            </h1>
            <p class="text-xs text-slate-500 mt-1">Kartu Inventaris Barang Milik Daerah (KIB KDO)</p>
        </div>

        <div class="flex items-center space-x-2">
            <a href="{{ route('kendaraan-dinas.bast', $kendaraanDinas) }}" target="_blank" class="inline-flex items-center space-x-1.5 text-xs font-semibold px-3 py-2 rounded-xl border border-slate-300 bg-white text-slate-700 hover:bg-slate-50 shadow-sm transition-all" title="Cetak Berita Acara Serah Terima">
                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                <span>Cetak BAST</span>
            </a>
            <a href="{{ route('kendaraan-dinas.edit', $kendaraanDinas) }}" class="inline-flex items-center space-x-1.5 text-xs font-semibold px-3.5 py-2 rounded-xl bg-amber-500 hover:bg-amber-400 text-white shadow-sm transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                <span>Ubah</span>
            </a>
            <form action="{{ route('kendaraan-dinas.destroy', $kendaraanDinas) }}" method="POST" onsubmit="return confirm('Hapus kendaraan {{ $kendaraanDinas->no_polisi }} dari inventaris?');" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="p-2 rounded-xl text-rose-600 bg-rose-50 hover:bg-rose-100 border border-rose-200 transition-colors" title="Hapus Kendaraan">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                </button>
            </form>
        </div>
    </div>

    <!-- Main Grid: Info Spek & Alokasi -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left: Spesifikasi Fisik (2 Cols) -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Spesifikasi Teknis Card -->
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <h2 class="font-bold text-slate-900 text-sm flex items-center space-x-2">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/></svg>
                        <span>Spesifikasi Teknis Kendaraan</span>
                    </h2>

                    @if($kendaraanDinas->kondisi === 'Baik')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                            <span class="w-2 h-2 rounded-full bg-emerald-600 mr-2"></span>
                            Kondisi Baik
                        </span>
                    @elseif($kendaraanDinas->kondisi === 'Rusak Ringan')
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-800">
                            <span class="w-2 h-2 rounded-full bg-amber-600 mr-2"></span>
                            Kondisi Rusak Ringan
                        </span>
                    @else
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-800">
                            <span class="w-2 h-2 rounded-full bg-rose-600 mr-2"></span>
                            Kondisi Rusak Berat
                        </span>
                    @endif
                </div>

                <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 text-xs">
                    <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                        <span class="text-slate-400 block font-medium">Merek Kendaraan</span>
                        <span class="font-bold text-slate-800 text-sm mt-0.5 block">{{ $kendaraanDinas->merek }}</span>
                    </div>
                    <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                        <span class="text-slate-400 block font-medium">Tipe / Model</span>
                        <span class="font-bold text-slate-800 text-sm mt-0.5 block">{{ $kendaraanDinas->tipe }}</span>
                    </div>
                    <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                        <span class="text-slate-400 block font-medium">Jenis Kendaraan</span>
                        <span class="font-bold text-slate-800 text-sm mt-0.5 block">{{ $kendaraanDinas->jenis_kendaraan }}</span>
                    </div>
                    <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                        <span class="text-slate-400 block font-medium">Tahun Pembuatan</span>
                        <span class="font-bold text-slate-800 text-sm mt-0.5 block">{{ $kendaraanDinas->tahun_produksi }}</span>
                    </div>
                    <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                        <span class="text-slate-400 block font-medium">Warna Fisik</span>
                        <span class="font-bold text-slate-800 text-sm mt-0.5 block">{{ $kendaraanDinas->warna }}</span>
                    </div>
                    <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                        <span class="text-slate-400 block font-medium">Jatuh Tempo Pajak</span>
                        <span class="font-bold text-slate-800 text-sm mt-0.5 block">
                            {{ $kendaraanDinas->tgl_pajak ? $kendaraanDinas->tgl_pajak->format('d/m/Y') : '-' }}
                        </span>
                    </div>
                </div>

                <div class="pt-2 grid grid-cols-1 sm:grid-cols-2 gap-3 text-xs">
                    <div class="p-3 rounded-xl border border-dashed border-slate-200">
                        <span class="text-slate-400 block">Nomor Rangka (VIN):</span>
                        <span class="font-mono font-bold text-slate-800 text-xs">{{ $kendaraanDinas->nomor_rangka ?? '-' }}</span>
                    </div>
                    <div class="p-3 rounded-xl border border-dashed border-slate-200">
                        <span class="text-slate-400 block">Nomor Mesin:</span>
                        <span class="font-mono font-bold text-slate-800 text-xs">{{ $kendaraanDinas->nomor_mesin ?? '-' }}</span>
                    </div>
                </div>

                @if($kendaraanDinas->keterangan)
                <div class="p-3.5 bg-blue-50/60 rounded-xl border border-blue-100 text-xs text-blue-900">
                    <span class="font-bold block mb-1">Catatan Khusus Operasional:</span>
                    <p class="text-slate-700 leading-relaxed">{{ $kendaraanDinas->keterangan }}</p>
                </div>
                @endif
            </div>

            <!-- Timeline Riwayat Pemeriksaan / Kondisi -->
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 space-y-4">
                <h2 class="font-bold text-slate-900 text-sm flex items-center justify-between pb-3 border-b border-slate-100">
                    <span class="flex items-center space-x-2">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                        <span>Riwayat Kondisi & Catatan Servis</span>
                    </span>
                    <span class="text-xs text-slate-400 font-normal">Audit Trail BMD</span>
                </h2>

                <div class="space-y-4">
                    @forelse($kendaraanDinas->riwayatKondisi as $riwayat)
                    <div class="relative pl-6 pb-2 border-l-2 border-slate-200 last:border-l-0">
                        <div class="absolute -left-1.5 top-0 w-3 h-3 rounded-full bg-blue-600"></div>
                        <div class="bg-slate-50 p-3.5 rounded-xl border border-slate-100 space-y-1.5">
                            <div class="flex items-center justify-between text-xs">
                                <span class="font-bold text-slate-800">{{ $riwayat->tanggal_pemeriksaan->translatedFormat('d F Y') }}</span>
                                <span class="px-2 py-0.5 rounded text-[11px] font-semibold bg-white border border-slate-200">
                                    {{ $riwayat->kondisi_sebelum }} &rarr; <span class="text-blue-700">{{ $riwayat->kondisi_sesudah }}</span>
                                </span>
                            </div>
                            <p class="text-xs text-slate-600">{{ $riwayat->catatan_kerusakan }}</p>
                            @if($riwayat->petugas_pemeriksa)
                                <div class="text-[11px] text-slate-400 flex items-center justify-between pt-1 border-t border-slate-100">
                                    <span>Pemeriksa: {{ $riwayat->petugas_pemeriksa }}</span>
                                    @if($riwayat->estimasi_biaya > 0)
                                        <span class="font-semibold text-slate-700">Estimasi: Rp {{ number_format($riwayat->estimasi_biaya, 0, ',', '.') }}</span>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                    @empty
                    <p class="text-xs text-slate-400 text-center py-4">Belum ada riwayat perubahan kondisi tercatat.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Right: Instansi & Pegawai Pemegang (1 Col) -->
        <div class="space-y-6">
            <!-- Card Perangkat Daerah -->
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-5 space-y-3">
                <div class="text-xs font-bold uppercase tracking-wider text-slate-400 flex items-center space-x-1.5">
                    <svg class="w-4 h-4 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    <span>Perangkat Daerah Pemilik</span>
                </div>
                <div>
                    <h3 class="font-bold text-slate-900 text-sm">{{ $kendaraanDinas->perangkatDaerah->nama_instansi }}</h3>
                    <p class="text-xs text-slate-500 font-mono mt-0.5">Kode OPD: {{ $kendaraanDinas->perangkatDaerah->kode_opd }}</p>
                </div>
                <div class="pt-2 border-t border-slate-100 text-xs space-y-1 text-slate-600">
                    <div><strong>Alamat:</strong> {{ $kendaraanDinas->perangkatDaerah->alamat ?? '-' }}</div>
                    <div><strong>Telepon:</strong> {{ $kendaraanDinas->perangkatDaerah->telepon ?? '-' }}</div>
                    <div><strong>Pimpinan:</strong> {{ $kendaraanDinas->perangkatDaerah->nama_kepala ?? '-' }}</div>
                </div>
                <a href="{{ route('perangkat-daerah.show', $kendaraanDinas->perangkatDaerah) }}" class="block text-center text-xs font-semibold text-indigo-600 hover:text-indigo-800 pt-2">
                    Lihat Profil Instansi &rarr;
                </a>
            </div>

            <!-- Card Pegawai PNS Penanggung Jawab -->
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-5 space-y-3">
                <div class="text-xs font-bold uppercase tracking-wider text-slate-400 flex items-center space-x-1.5">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    <span>PNS Penanggung Jawab</span>
                </div>

                @if($kendaraanDinas->penanggungJawab)
                <div>
                    <h3 class="font-bold text-slate-900 text-sm">{{ $kendaraanDinas->penanggungJawab->nama }}</h3>
                    <p class="text-xs text-slate-500 font-mono mt-0.5">NIP: {{ $kendaraanDinas->penanggungJawab->nip }}</p>
                </div>
                <div class="pt-2 border-t border-slate-100 text-xs space-y-1 text-slate-600">
                    <div><strong>Jabatan:</strong> {{ $kendaraanDinas->penanggungJawab->jabatan }}</div>
                    <div><strong>Golongan:</strong> {{ $kendaraanDinas->penanggungJawab->golongan }}</div>
                    <div><strong>Kontak:</strong> {{ $kendaraanDinas->penanggungJawab->no_hp ?? '-' }}</div>
                </div>
                <a href="{{ route('pegawai.show', $kendaraanDinas->penanggungJawab) }}" class="block text-center text-xs font-semibold text-emerald-600 hover:text-emerald-800 pt-2">
                    Lihat Profil Pegawai &rarr;
                </a>
                @else
                <div class="p-3 bg-amber-50 rounded-xl border border-amber-200 text-xs text-amber-800">
                    <p class="font-semibold">Unit Berada di Pool Dinas</p>
                    <p class="text-[11px] mt-1 text-amber-700">Kendaraan ini belum ditugaskan kepada pegawai tetap. Klik ubah untuk menunjuk penanggung jawab.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
