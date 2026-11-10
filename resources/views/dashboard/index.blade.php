@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Dashboard Eksekutif KDO</h1>
            <p class="text-sm text-slate-500 mt-1">Monitoring & Inventarisasi Kendaraan Dinas Operasional Pemerintah Daerah (BMD).</p>
        </div>
        <div class="flex items-center space-x-2.5">
            <a href="{{ route('kendaraan-dinas.cetak') }}" target="_blank" class="inline-flex items-center space-x-2 text-xs font-semibold px-3.5 py-2.5 rounded-xl border border-slate-300 bg-white text-slate-700 hover:bg-slate-50 hover:border-slate-400 transition-all shadow-sm">
                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                <span>Cetak Rekap BMD</span>
            </a>
            <a href="{{ route('kendaraan-dinas.create') }}" class="inline-flex items-center space-x-2 text-xs font-semibold px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white transition-all shadow-md shadow-blue-500/25">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Tambah Unit Baru</span>
            </a>
        </div>
    </div>

    <!-- 4 Key Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Total Kendaraan -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm relative overflow-hidden group hover:border-blue-300 transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Total Armada KDO</p>
                    <h3 class="text-3xl font-extrabold text-slate-900 mt-1">{{ $totalKdo }}</h3>
                    <p class="text-xs text-slate-500 mt-1">Tersebar di {{ $totalOpd }} Perangkat Daerah</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" /></svg>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="text-slate-500">PNS Penanggung Jawab:</span>
                <span class="font-bold text-slate-700">{{ $totalPegawai }} Orang</span>
            </div>
        </div>

        <!-- Kondisi Baik -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm relative overflow-hidden group hover:border-emerald-300 transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Kondisi Baik</p>
                    <h3 class="text-3xl font-extrabold text-emerald-600 mt-1">{{ $kondisiCounts['Baik'] }} <span class="text-sm font-medium text-slate-400">Unit</span></h3>
                    <p class="text-xs text-emerald-600 font-semibold mt-1">{{ $persentaseBaik }}% Siap Operasional</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="text-slate-500">Status Kelayakan:</span>
                <span class="px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-700 font-bold">Prima</span>
            </div>
        </div>

        <!-- Kondisi Rusak Ringan -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm relative overflow-hidden group hover:border-amber-300 transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Rusak Ringan</p>
                    <h3 class="text-3xl font-extrabold text-amber-600 mt-1">{{ $kondisiCounts['Rusak Ringan'] }} <span class="text-sm font-medium text-slate-400">Unit</span></h3>
                    <p class="text-xs text-amber-600 font-semibold mt-1">Perlu Servis Rutin</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="text-slate-500">Tindakan:</span>
                <span class="px-2 py-0.5 rounded-full bg-amber-100 text-amber-800 font-bold">Jadwalkan Bengkel</span>
            </div>
        </div>

        <!-- Kondisi Rusak Berat -->
        <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm relative overflow-hidden group hover:border-rose-300 transition-all">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">Rusak Berat</p>
                    <h3 class="text-3xl font-extrabold text-rose-600 mt-1">{{ $kondisiCounts['Rusak Berat'] }} <span class="text-sm font-medium text-slate-400">Unit</span></h3>
                    <p class="text-xs text-rose-600 font-semibold mt-1">Tidak Dapat Beroperasi</p>
                </div>
                <div class="w-12 h-12 rounded-2xl bg-rose-50 text-rose-600 flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
            </div>
            <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs">
                <span class="text-slate-500">Tindakan:</span>
                <span class="px-2 py-0.5 rounded-full bg-rose-100 text-rose-800 font-bold">Ajukan Peremajaan / Lelang</span>
            </div>
        </div>
    </div>

    <!-- Health Breakdown Bar -->
    <div class="bg-white p-5 rounded-2xl border border-slate-200/80 shadow-sm space-y-3">
        <div class="flex items-center justify-between text-sm">
            <span class="font-bold text-slate-800">Distribusi Kondisi Armada Kendaraan Dinas</span>
            <div class="flex items-center space-x-4 text-xs font-medium">
                <span class="flex items-center space-x-1.5"><span class="w-3 h-3 rounded-full bg-emerald-500 inline-block"></span> <span>Baik ({{ $kondisiCounts['Baik'] }})</span></span>
                <span class="flex items-center space-x-1.5"><span class="w-3 h-3 rounded-full bg-amber-500 inline-block"></span> <span>Rusak Ringan ({{ $kondisiCounts['Rusak Ringan'] }})</span></span>
                <span class="flex items-center space-x-1.5"><span class="w-3 h-3 rounded-full bg-rose-500 inline-block"></span> <span>Rusak Berat ({{ $kondisiCounts['Rusak Berat'] }})</span></span>
            </div>
        </div>
        <div class="w-full bg-slate-100 h-3.5 rounded-full overflow-hidden flex">
            @php
                $persenBaik = $totalKdo > 0 ? ($kondisiCounts['Baik'] / $totalKdo) * 100 : 0;
                $persenRingan = $totalKdo > 0 ? ($kondisiCounts['Rusak Ringan'] / $totalKdo) * 100 : 0;
                $persenBerat = $totalKdo > 0 ? ($kondisiCounts['Rusak Berat'] / $totalKdo) * 100 : 0;
            @endphp
            <div style="width: {{ $persenBaik }}%" class="bg-emerald-500 h-full transition-all" title="Baik: {{ $kondisiCounts['Baik'] }} unit"></div>
            <div style="width: {{ $persenRingan }}%" class="bg-amber-500 h-full transition-all" title="Rusak Ringan: {{ $kondisiCounts['Rusak Ringan'] }} unit"></div>
            <div style="width: {{ $persenBerat }}%" class="bg-rose-500 h-full transition-all" title="Rusak Berat: {{ $kondisiCounts['Rusak Berat'] }} unit"></div>
        </div>
    </div>

    <!-- Dual Table Layout: Recent KDO & Rekap Per OPD -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left: 5 Kendaraan Terbaru (2 Cols) -->
        <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden flex flex-col">
            <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h2 class="font-bold text-slate-900">Kendaraan Dinas Terdaftar Terakhir</h2>
                    <p class="text-xs text-slate-500">Unit operasional yang baru ditambahkan ke sistem</p>
                </div>
                <a href="{{ route('kendaraan-dinas.index') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-700 flex items-center space-x-1">
                    <span>Lihat Semua</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <div class="overflow-x-auto flex-grow">
                <table class="w-full text-left text-sm table-fixed">
                    <colgroup>
                        <col class="w-[36%]">
                        <col class="w-[20%]">
                        <col class="w-[22%]">
                        <col class="w-28">
                        <col class="w-16">
                    </colgroup>
                    <thead class="bg-slate-50/75 text-slate-500 text-xs uppercase font-semibold border-b border-slate-100">
                        <tr>
                            <th class="px-3.5 py-3 whitespace-nowrap">Plat & Kendaraan</th>
                            <th class="px-3 py-3 whitespace-nowrap">Perangkat Daerah</th>
                            <th class="px-3 py-3 whitespace-nowrap">Penanggung Jawab</th>
                            <th class="px-2 py-3 text-center whitespace-nowrap">Kondisi</th>
                            <th class="px-3 py-3 text-right whitespace-nowrap">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($kdoTerbaru as $kdo)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="px-3.5 py-3">
                                <div class="flex items-center space-x-2.5 min-w-0">
                                    <span class="px-2 py-0.5 rounded font-mono font-bold text-xs bg-red-100 text-red-800 border border-red-200 shadow-sm whitespace-nowrap shrink-0">
                                        {{ $kdo->no_polisi }}
                                    </span>
                                    <div class="min-w-0 flex-1">
                                        <div class="font-bold text-slate-900 text-xs truncate" title="{{ $kdo->merek }} {{ $kdo->tipe }}">{{ $kdo->merek }} {{ $kdo->tipe }}</div>
                                        <div class="text-[11px] text-slate-400 truncate">Thn {{ $kdo->tahun_produksi }} &bull; {{ $kdo->jenis_kendaraan }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-3 py-3 text-xs">
                                <span class="font-medium text-slate-800 block truncate" title="{{ $kdo->perangkatDaerah->nama_instansi }}">{{ $kdo->perangkatDaerah->singkatan ?? $kdo->perangkatDaerah->nama_instansi }}</span>
                            </td>
                            <td class="px-3 py-3 text-xs">
                                @if($kdo->penanggungJawab)
                                    <div class="font-medium text-slate-800 truncate" title="{{ $kdo->penanggungJawab->nama }}">{{ $kdo->penanggungJawab->nama }}</div>
                                    <div class="text-[10px] text-slate-400 font-mono truncate">NIP: {{ $kdo->penanggungJawab->nip }}</div>
                                @else
                                    <span class="inline-flex items-center text-[11px] text-amber-700 bg-amber-50 px-2 py-0.5 rounded-md font-medium border border-amber-200 whitespace-nowrap">
                                        Belum ditugaskan
                                    </span>
                                @endif
                            </td>
                            <td class="px-2 py-3 text-xs text-center whitespace-nowrap">
                                @if($kdo->kondisi === 'Baik')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-100 text-emerald-800 whitespace-nowrap">
                                        Baik
                                    </span>
                                @elseif($kdo->kondisi === 'Rusak Ringan')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-semibold bg-amber-100 text-amber-800 whitespace-nowrap">
                                        Rusak Ringan
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[11px] font-semibold bg-rose-100 text-rose-800 whitespace-nowrap">
                                        Rusak Berat
                                    </span>
                                @endif
                            </td>
                            <td class="px-3 py-3 text-right text-xs whitespace-nowrap">
                                <a href="{{ route('kendaraan-dinas.show', $kdo) }}" class="text-blue-600 hover:text-blue-800 font-semibold">Detail</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-5 py-8 text-center text-slate-400 text-xs">
                                Belum ada data kendaraan dinas tercatat.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Right: Rekapitulasi per OPD (1 Col) -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden flex flex-col">
            <div class="p-5 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h2 class="font-bold text-slate-900">Rekapitulasi per Dinas</h2>
                    <p class="text-xs text-slate-500">Distribusi aset per instansi</p>
                </div>
                <a href="{{ route('perangkat-daerah.index') }}" class="text-xs font-semibold text-blue-600 hover:text-blue-700">Lihat OPD</a>
            </div>

            <div class="p-4 space-y-3 overflow-y-auto max-h-[380px]">
                @foreach($rekapOpd as $opd)
                <div class="p-3 rounded-xl border border-slate-100 bg-slate-50/50 hover:bg-slate-50 transition-all flex items-center justify-between">
                    <div>
                        <div class="font-bold text-slate-800 text-xs">{{ $opd->nama_instansi }}</div>
                        <div class="text-[11px] text-slate-400 mt-0.5">
                            {{ $opd->pegawais_count }} Pegawai PNS
                        </div>
                    </div>
                    <div class="text-right">
                        <a href="{{ route('kendaraan-dinas.index', ['perangkat_daerah_id' => $opd->id]) }}" class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-blue-50 text-blue-700 hover:bg-blue-100 transition-colors">
                            {{ $opd->kendaraan_dinas_count }} Unit
                        </a>
                        @if($opd->rusak_count > 0)
                            <div class="text-[10px] text-rose-500 font-semibold mt-0.5">
                                {{ $opd->rusak_count }} Perlu Servis
                            </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
