@extends('layouts.app')

@section('title', 'Detail Perangkat Daerah - ' . $perangkatDaerah->nama_instansi)

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <!-- Breadcrumb & Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center space-x-2 text-xs text-slate-500 mb-1">
                <a href="{{ route('perangkat-daerah.index') }}" class="hover:text-blue-600">Perangkat Daerah</a>
                <span>/</span>
                <span class="text-slate-800 font-semibold">{{ $perangkatDaerah->singkatan ?? $perangkatDaerah->nama_instansi }}</span>
            </div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight flex items-center space-x-3">
                <span>{{ $perangkatDaerah->nama_instansi }}</span>
                <span class="px-2.5 py-0.5 rounded-lg font-mono font-bold text-xs bg-slate-100 text-slate-700 border border-slate-200">
                    {{ $perangkatDaerah->kode_opd }}
                </span>
            </h1>
            <p class="text-xs text-slate-500 mt-1">Profil Satuan Kerja Perangkat Daerah (SKPD / OPD) Pengelola Aset</p>
        </div>

        <div class="flex items-center space-x-2">
            <a href="{{ route('kendaraan-dinas.cetak', ['perangkat_daerah_id' => $perangkatDaerah->id]) }}" target="_blank" class="inline-flex items-center space-x-1.5 text-xs font-semibold px-3 py-2 rounded-xl border border-slate-300 bg-white text-slate-700 hover:bg-slate-50 shadow-sm transition-all">
                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                <span>Cetak Aset OPD</span>
            </a>
            <a href="{{ route('perangkat-daerah.edit', $perangkatDaerah) }}" class="inline-flex items-center space-x-1.5 text-xs font-semibold px-3.5 py-2 rounded-xl bg-amber-500 hover:bg-amber-400 text-white shadow-sm transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                <span>Ubah</span>
            </a>
            <button type="button" onclick="openDeleteModal('{{ route('perangkat-daerah.destroy', $perangkatDaerah) }}', 'Perangkat Daerah: {{ $perangkatDaerah->nama_instansi }} (Kode: {{ $perangkatDaerah->kode_opd }})', 'Penghapusan akan ditolak jika masih terdapat data Kendaraan Dinas tercatat di bawah instansi ini.')" class="p-2 rounded-xl text-rose-600 bg-rose-50 hover:bg-rose-100 border border-rose-200 transition-colors" title="Hapus Instansi">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            </button>
        </div>
    </div>

    <!-- Info Card -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 space-y-4">
        <h2 class="font-bold text-slate-900 text-sm border-b border-slate-100 pb-3">Informasi Instansi Perangkat Daerah</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-xs">
            <div class="bg-slate-50 p-3.5 rounded-xl border border-slate-100">
                <span class="text-slate-400 block font-medium">Kode Resmi OPD</span>
                <span class="font-mono font-bold text-slate-800 text-sm mt-0.5 block">{{ $perangkatDaerah->kode_opd }}</span>
            </div>
            <div class="bg-slate-50 p-3.5 rounded-xl border border-slate-100">
                <span class="text-slate-400 block font-medium">Singkatan / Akronim</span>
                <span class="font-bold text-slate-800 text-sm mt-0.5 block">{{ $perangkatDaerah->singkatan ?? '-' }}</span>
            </div>
            <div class="bg-slate-50 p-3.5 rounded-xl border border-slate-100">
                <span class="text-slate-400 block font-medium">Telepon Kantor</span>
                <span class="font-bold text-slate-800 text-sm mt-0.5 block">{{ $perangkatDaerah->telepon ?? '-' }}</span>
            </div>
            <div class="bg-slate-50 p-3.5 rounded-xl border border-slate-100 sm:col-span-2">
                <span class="text-slate-400 block font-medium">Alamat Kantor</span>
                <span class="font-bold text-slate-800 text-sm mt-0.5 block">{{ $perangkatDaerah->alamat ?? '-' }}</span>
            </div>
            <div class="bg-slate-50 p-3.5 rounded-xl border border-slate-100">
                <span class="text-slate-400 block font-medium">Kepala Dinas / Pimpinan</span>
                <span class="font-bold text-slate-800 text-sm mt-0.5 block">{{ $perangkatDaerah->nama_kepala ?? '-' }}</span>
                @if($perangkatDaerah->nip_kepala)
                    <span class="text-[11px] text-slate-400 font-mono">NIP: {{ $perangkatDaerah->nip_kepala }}</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Dual Tabbed / Split Section: Aset KDO & Daftar Pegawai -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Aset Kendaraan Dinas -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div>
                    <h2 class="font-bold text-slate-900 text-sm">Armada KDO Milik Instansi</h2>
                    <p class="text-xs text-slate-500">Aset kendaraan operasional terdata</p>
                </div>
                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800">
                    {{ $perangkatDaerah->kendaraanDinas->count() }} Unit
                </span>
            </div>

            <div class="space-y-2.5 max-h-[400px] overflow-y-auto">
                @forelse($perangkatDaerah->kendaraanDinas as $kdo)
                <div class="p-3 rounded-xl border border-slate-100 bg-slate-50/60 hover:bg-slate-50 flex items-center justify-between transition-colors">
                    <div class="flex items-center space-x-3">
                        <span class="font-mono font-bold text-xs px-2 py-0.5 bg-red-100 text-red-800 rounded border border-red-200">
                            {{ $kdo->no_polisi }}
                        </span>
                        <div>
                            <div class="font-bold text-slate-900 text-xs">{{ $kdo->merek }} {{ $kdo->tipe }}</div>
                            <div class="text-[11px] text-slate-400">
                                @if($kdo->penanggungJawab)
                                    Pemegang: {{ $kdo->penanggungJawab->nama }}
                                @else
                                    <span class="text-amber-600">Pool Dinas</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        @if($kdo->kondisi === 'Baik')
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800">Baik</span>
                        @elseif($kdo->kondisi === 'Rusak Ringan')
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-amber-100 text-amber-800">Rusak Ringan</span>
                        @else
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-rose-100 text-rose-800">Rusak Berat</span>
                        @endif
                        <div class="mt-1">
                            <a href="{{ route('kendaraan-dinas.show', $kdo) }}" class="text-[11px] text-blue-600 font-semibold hover:underline">Detail</a>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-xs text-slate-400 text-center py-6">Belum ada aset kendaraan dinas tercatat di instansi ini.</p>
                @endforelse
            </div>
        </div>

        <!-- Daftar Pegawai PNS -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 space-y-4">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <div>
                    <h2 class="font-bold text-slate-900 text-sm">Pegawai PNS di Instansi Ini</h2>
                    <p class="text-xs text-slate-500">Aparatur sipil negara yang bertugas</p>
                </div>
                <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800">
                    {{ $perangkatDaerah->pegawais->count() }} Orang
                </span>
            </div>

            <div class="space-y-2.5 max-h-[400px] overflow-y-auto">
                @forelse($perangkatDaerah->pegawais as $pns)
                <div class="p-3 rounded-xl border border-slate-100 bg-slate-50/60 hover:bg-slate-50 flex items-center justify-between transition-colors">
                    <div>
                        <div class="font-bold text-slate-900 text-xs">{{ $pns->nama }}</div>
                        <div class="text-[11px] text-slate-500">{{ $pns->jabatan }}</div>
                        <div class="text-[10px] font-mono text-slate-400">NIP: {{ $pns->nip }} &bull; Gol: {{ $pns->golongan }}</div>
                    </div>
                    <div class="text-right">
                        <a href="{{ route('pegawai.show', $pns) }}" class="text-xs font-semibold text-blue-600 hover:underline">
                            Lihat Profil &rarr;
                        </a>
                    </div>
                </div>
                @empty
                <p class="text-xs text-slate-400 text-center py-6">Belum ada pegawai PNS terdaftar di instansi ini.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
