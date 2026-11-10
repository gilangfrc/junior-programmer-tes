@extends('layouts.app')

@section('title', 'Data Perangkat Daerah (PD / OPD)')

@section('content')
<div class="space-y-6">
    <!-- Header & Action -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center space-x-2">
                <span class="text-xs font-bold uppercase tracking-wider text-indigo-600 bg-indigo-50 px-2.5 py-1 rounded-full border border-indigo-200">
                    Entitas 3
                </span>
                <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Perangkat Daerah (PD / OPD)</h1>
            </div>
            <p class="text-sm text-slate-500 mt-1">Daftar dinas, badan, dan unit kerja pemilik serta pengguna Kendaraan Dinas Operasional.</p>
        </div>
        <a href="{{ route('perangkat-daerah.create') }}" class="inline-flex items-center space-x-2 text-xs font-semibold px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white transition-all shadow-md shadow-blue-500/25">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Tambah Perangkat Daerah</span>
        </a>
    </div>

    <!-- Search Bar -->
    <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-sm">
        <form method="GET" action="{{ route('perangkat-daerah.index') }}" class="flex flex-col sm:flex-row gap-3">
            <div class="flex-grow relative">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama instansi (Dinas Pendidikan, Kesehatan, PUPR) atau kode OPD..." class="w-full text-xs rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-2.5 pl-9 pr-3">
                <svg class="w-4 h-4 text-slate-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <button type="submit" class="text-xs font-semibold px-5 py-2.5 rounded-xl bg-slate-900 text-white hover:bg-slate-800 transition-colors">
                Cari
            </button>
            @if(request('search'))
                <a href="{{ route('perangkat-daerah.index') }}" class="text-xs px-3.5 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 transition-colors flex items-center justify-center">
                    Reset
                </a>
            @endif
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-slate-500 text-xs uppercase font-semibold border-b border-slate-200">
                    <tr>
                        <th class="px-5 py-3.5">Kode & Singkatan</th>
                        <th class="px-5 py-3.5">Nama Instansi Perangkat Daerah</th>
                        <th class="px-5 py-3.5">Kepala Dinas / Pimpinan</th>
                        <th class="px-5 py-3.5 text-center">Total KDO</th>
                        <th class="px-5 py-3.5 text-center">Total Pegawai</th>
                        <th class="px-5 py-3.5 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($perangkatDaerahs as $pd)
                    <tr class="hover:bg-slate-50/70 transition-colors">
                        <td class="px-5 py-4">
                            <span class="font-mono font-bold text-xs bg-slate-100 text-slate-700 px-2 py-0.5 rounded border border-slate-200">
                                {{ $pd->kode_opd }}
                            </span>
                            @if($pd->singkatan)
                                <div class="text-[11px] font-semibold text-blue-600 mt-1">{{ $pd->singkatan }}</div>
                            @endif
                        </td>
                        <td class="px-5 py-4">
                            <a href="{{ route('perangkat-daerah.show', $pd) }}" class="font-bold text-slate-900 text-xs hover:text-blue-600 transition-colors">
                                {{ $pd->nama_instansi }}
                            </a>
                            <div class="text-[11px] text-slate-400 mt-0.5">{{ $pd->alamat ?? '-' }}</div>
                        </td>
                        <td class="px-5 py-4 text-xs">
                            <div class="font-medium text-slate-800">{{ $pd->nama_kepala ?? '-' }}</div>
                            @if($pd->nip_kepala)
                                <div class="text-[11px] text-slate-400 font-mono">NIP: {{ $pd->nip_kepala }}</div>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-xs text-center">
                            <a href="{{ route('kendaraan-dinas.index', ['perangkat_daerah_id' => $pd->id]) }}" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-100 text-blue-800 hover:bg-blue-200 transition-colors">
                                {{ $pd->kendaraan_dinas_count }} Unit
                            </a>
                        </td>
                        <td class="px-5 py-4 text-xs text-center">
                            <a href="{{ route('pegawai.index', ['perangkat_daerah_id' => $pd->id]) }}" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-emerald-100 text-emerald-800 hover:bg-emerald-200 transition-colors">
                                {{ $pd->pegawais_count }} Orang
                            </a>
                        </td>
                        <td class="px-5 py-4 text-xs text-center">
                            <div class="flex items-center justify-center space-x-1.5">
                                <a href="{{ route('perangkat-daerah.show', $pd) }}" class="p-1.5 rounded-lg text-slate-500 hover:text-blue-600 hover:bg-blue-50 transition-colors" title="Lihat Detail">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>
                                <a href="{{ route('perangkat-daerah.edit', $pd) }}" class="p-1.5 rounded-lg text-slate-500 hover:text-amber-600 hover:bg-amber-50 transition-colors" title="Ubah Instansi">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form action="{{ route('perangkat-daerah.destroy', $pd) }}" method="POST" onsubmit="return confirm('Hapus Perangkat Daerah {{ $pd->nama_instansi }}?');" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 rounded-lg text-slate-500 hover:text-rose-600 hover:bg-rose-50 transition-colors" title="Hapus Instansi">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-5 py-12 text-center text-slate-400 text-xs">
                            Belum ada data Perangkat Daerah yang terdaftar.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($perangkatDaerahs->hasPages())
        <div class="px-5 py-4 border-t border-slate-100 bg-slate-50/50">
            {{ $perangkatDaerahs->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
