@extends('layouts.app')

@section('title', 'Data Kendaraan Dinas Operasional (KDO)')

@section('content')
<div class="space-y-6">
    <!-- Header & Action -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center space-x-2">
                <span class="text-xs font-bold uppercase tracking-wider text-blue-600 bg-blue-50 px-2.5 py-1 rounded-full border border-blue-200">
                    Entitas 1
                </span>
                <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Kendaraan Dinas Operasional (KDO)</h1>
            </div>
            <p class="text-sm text-slate-500 mt-1">Daftar lengkap inventaris kendaraan bermotor dinas milik Perangkat Daerah.</p>
        </div>
        <div class="flex items-center space-x-2.5">
            <a href="{{ route('kendaraan-dinas.cetak', request()->all()) }}" target="_blank" class="inline-flex items-center space-x-2 text-xs font-semibold px-3.5 py-2.5 rounded-xl border border-slate-300 bg-white text-slate-700 hover:bg-slate-50 transition-all shadow-sm">
                <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
                <span>Cetak Rekap</span>
            </a>
            <a href="{{ route('kendaraan-dinas.create') }}" class="inline-flex items-center space-x-2 text-xs font-semibold px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white transition-all shadow-md shadow-blue-500/25">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                <span>Tambah Kendaraan</span>
            </a>
        </div>
    </div>

    <!-- Filter & Search Bar -->
    <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-sm">
        <form method="GET" action="{{ route('kendaraan-dinas.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">
            <!-- Search -->
            <div class="lg:col-span-2">
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Pencarian Cepat</label>
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari no polisi, merek, tipe, atau nama PNS..." class="form-control-smooth w-full text-xs rounded-xl border border-slate-200 py-2.5 pl-9 pr-3 text-slate-800 placeholder:text-slate-400">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </div>

            <!-- Filter Kondisi -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Kondisi Fisik</label>
                <div class="relative">
                    <select name="kondisi" class="form-control-smooth appearance-none w-full text-xs font-medium rounded-xl border border-slate-200 py-2.5 pl-3.5 pr-11 text-slate-800 bg-white cursor-pointer">
                        <option value="">-- Semua Kondisi --</option>
                        <option value="Baik" {{ request('kondisi') === 'Baik' ? 'selected' : '' }}>Baik</option>
                        <option value="Rusak Ringan" {{ request('kondisi') === 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                        <option value="Rusak Berat" {{ request('kondisi') === 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </div>
            </div>

            <!-- Filter Perangkat Daerah -->
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1.5">Perangkat Daerah</label>
                <div class="relative">
                    <select name="perangkat_daerah_id" class="form-control-smooth appearance-none w-full text-xs font-medium rounded-xl border border-slate-200 py-2.5 pl-3.5 pr-11 text-slate-800 bg-white cursor-pointer">
                        <option value="">-- Semua Dinas/OPD --</option>
                        @foreach($perangkatDaerahs as $pd)
                            <option value="{{ $pd->id }}" {{ request('perangkat_daerah_id') == $pd->id ? 'selected' : '' }}>
                                {{ $pd->singkatan ?? $pd->nama_instansi }}
                            </option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex items-end space-x-2">
                <button type="submit" class="flex-1 text-xs font-semibold px-4 py-2.5 rounded-xl bg-slate-900 text-white hover:bg-slate-800 transition-colors">
                    Filter Data
                </button>
                @if(request()->hasAny(['search', 'kondisi', 'perangkat_daerah_id', 'jenis_kendaraan']))
                    <a href="{{ route('kendaraan-dinas.index') }}" class="text-xs px-3 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 transition-colors" title="Reset Filter">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-slate-500 text-xs uppercase font-semibold border-b border-slate-200">
                    <tr>
                        <th class="px-5 py-3.5">No</th>
                        <th class="px-5 py-3.5">No. Polisi & Spesifikasi</th>
                        <th class="px-5 py-3.5">Perangkat Daerah</th>
                        <th class="px-5 py-3.5">PNS Penanggung Jawab</th>
                        <th class="px-5 py-3.5">Warna & Tahun</th>
                        <th class="px-5 py-3.5">Kondisi</th>
                        <th class="px-5 py-3.5 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($kendaraanDinas as $index => $kdo)
                    <tr class="hover:bg-slate-50/70 transition-colors">
                        <td class="px-5 py-4 text-xs text-slate-400 font-mono">
                            {{ $kendaraanDinas->firstItem() + $index }}
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex items-center space-x-3">
                                <span class="px-2.5 py-1 rounded font-mono font-bold text-xs bg-red-100 text-red-800 border border-red-200 shadow-sm whitespace-nowrap">
                                    {{ $kdo->no_polisi }}
                                </span>
                                <div>
                                    <a href="{{ route('kendaraan-dinas.show', $kdo) }}" class="font-bold text-slate-900 text-xs hover:text-blue-600 transition-colors">
                                        {{ $kdo->merek }} {{ $kdo->tipe }}
                                    </a>
                                    <div class="text-[11px] text-slate-400">
                                        {{ $kdo->jenis_kendaraan }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-4 text-xs">
                            <span class="font-semibold text-slate-800">{{ $kdo->perangkatDaerah->nama_instansi }}</span>
                            <div class="text-[11px] text-slate-400">Kode: {{ $kdo->perangkatDaerah->kode_opd }}</div>
                        </td>
                        <td class="px-5 py-4 text-xs">
                            @if($kdo->penanggungJawab)
                                <div class="font-medium text-slate-800">{{ $kdo->penanggungJawab->nama }}</div>
                                <div class="text-[11px] text-slate-400">NIP: {{ $kdo->penanggungJawab->nip }}</div>
                                <div class="text-[10px] text-slate-500">{{ $kdo->penanggungJawab->jabatan }}</div>
                            @else
                                <span class="inline-flex items-center text-[11px] text-amber-700 bg-amber-50 px-2 py-0.5 rounded-full font-medium">
                                    Belum ditugaskan
                                </span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-xs text-slate-600">
                            <div>{{ $kdo->warna }}</div>
                            <div class="text-slate-400 text-[11px]">Tahun {{ $kdo->tahun_produksi }}</div>
                        </td>
                        <td class="px-5 py-4 text-xs">
                            @if($kdo->kondisi === 'Baik')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-600 mr-1.5"></span>
                                    Baik
                                </span>
                            @elseif($kdo->kondisi === 'Rusak Ringan')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-600 mr-1.5"></span>
                                    Rusak Ringan
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-rose-100 text-rose-800">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-600 mr-1.5"></span>
                                    Rusak Berat
                                </span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-xs text-center">
                            <div class="flex items-center justify-center space-x-1.5">
                                <a href="{{ route('kendaraan-dinas.show', $kdo) }}" class="p-1.5 rounded-lg text-slate-500 hover:text-blue-600 hover:bg-blue-50 transition-colors" title="Lihat Detail">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>
                                <a href="{{ route('kendaraan-dinas.edit', $kdo) }}" class="p-1.5 rounded-lg text-slate-500 hover:text-amber-600 hover:bg-amber-50 transition-colors" title="Ubah Data">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <button type="button" onclick="openDeleteModal('{{ route('kendaraan-dinas.destroy', $kdo) }}', 'Kendaraan Dinas Plat {{ $kdo->no_polisi }} ({{ $kdo->merek }} {{ $kdo->tipe }})')" class="p-1.5 rounded-lg text-slate-500 hover:text-rose-600 hover:bg-rose-50 transition-colors" title="Hapus Data">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-5 py-12 text-center text-slate-400 text-xs">
                            <svg class="w-12 h-12 mx-auto text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"/></svg>
                            Tidak ada data Kendaraan Dinas yang sesuai dengan filter atau kriteria pencarian.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($kendaraanDinas->hasPages())
        <div class="px-5 py-4 border-t border-slate-100 bg-slate-50/50">
            {{ $kendaraanDinas->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
