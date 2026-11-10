@extends('layouts.app')

@section('title', 'Data Pegawai Negeri Sipil (PNS)')

@section('content')
<div class="space-y-6">
    <!-- Header & Action -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center space-x-2">
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-600 bg-emerald-50 px-2.5 py-1 rounded-full border border-emerald-200">
                    Entitas 2
                </span>
                <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Pegawai Negeri Sipil (PNS)</h1>
            </div>
            <p class="text-sm text-slate-500 mt-1">Data aparatur sipil negara penanggung jawab kendaraan dinas operasional.</p>
        </div>
        <a href="{{ route('pegawai.create') }}" class="inline-flex items-center space-x-2 text-xs font-semibold px-4 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white transition-all shadow-md shadow-blue-500/25">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Tambah Pegawai</span>
        </a>
    </div>

    <!-- Filter & Search Bar -->
    <div class="bg-white p-4 sm:p-5 rounded-2xl border border-slate-200/80 shadow-sm">
        <form method="GET" action="{{ route('pegawai.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
            <div class="lg:col-span-2">
                <label class="block text-xs font-semibold text-slate-600 mb-1">Cari Pegawai</label>
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan nama, NIP, atau jabatan..." class="w-full text-xs rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-2.5 pl-9 pr-3">
                    <svg class="w-4 h-4 text-slate-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Perangkat Daerah</label>
                <select name="perangkat_daerah_id" class="w-full text-xs rounded-xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-blue-500 py-2.5 px-3">
                    <option value="">-- Semua Dinas/OPD --</option>
                    @foreach($perangkatDaerahs as $pd)
                        <option value="{{ $pd->id }}" {{ request('perangkat_daerah_id') == $pd->id ? 'selected' : '' }}>
                            {{ $pd->singkatan ?? $pd->nama_instansi }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-end space-x-2">
                <button type="submit" class="flex-1 text-xs font-semibold px-4 py-2.5 rounded-xl bg-slate-900 text-white hover:bg-slate-800 transition-colors">
                    Filter
                </button>
                @if(request()->hasAny(['search', 'perangkat_daerah_id']))
                    <a href="{{ route('pegawai.index') }}" class="text-xs px-3 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 transition-colors">
                        Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-slate-500 text-xs uppercase font-semibold border-b border-slate-200">
                    <tr>
                        <th class="px-5 py-3.5">No</th>
                        <th class="px-5 py-3.5">Nama & NIP Pegawai</th>
                        <th class="px-5 py-3.5">Jabatan & Golongan</th>
                        <th class="px-5 py-3.5">Perangkat Daerah (Instansi)</th>
                        <th class="px-5 py-3.5">Kontak</th>
                        <th class="px-5 py-3.5 text-center">KDO Dipegang</th>
                        <th class="px-5 py-3.5 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($pegawais as $index => $pegawai)
                    <tr class="hover:bg-slate-50/70 transition-colors">
                        <td class="px-5 py-4 text-xs text-slate-400 font-mono">
                            {{ $pegawais->firstItem() + $index }}
                        </td>
                        <td class="px-5 py-4">
                            <a href="{{ route('pegawai.show', $pegawai) }}" class="font-bold text-slate-900 text-xs hover:text-blue-600 transition-colors">
                                {{ $pegawai->nama }}
                            </a>
                            <div class="font-mono text-[11px] text-slate-400 mt-0.5">NIP. {{ $pegawai->nip }}</div>
                        </td>
                        <td class="px-5 py-4 text-xs">
                            <div class="font-medium text-slate-800">{{ $pegawai->jabatan }}</div>
                            <span class="inline-block mt-0.5 px-2 py-0.5 rounded text-[10px] font-bold bg-slate-100 text-slate-700">
                                Gol. {{ $pegawai->golongan }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-xs">
                            <span class="font-medium text-slate-800">{{ $pegawai->perangkatDaerah->nama_instansi }}</span>
                            <div class="text-[11px] text-slate-400">{{ $pegawai->perangkatDaerah->singkatan }}</div>
                        </td>
                        <td class="px-5 py-4 text-xs text-slate-600">
                            <div>{{ $pegawai->no_hp ?? '-' }}</div>
                            <div class="text-[11px] text-slate-400">{{ $pegawai->email ?? '-' }}</div>
                        </td>
                        <td class="px-5 py-4 text-xs text-center">
                            @if($pegawai->kendaraan_dinas_count > 0)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-100 text-blue-800">
                                    {{ $pegawai->kendaraan_dinas_count }} Unit
                                </span>
                            @else
                                <span class="text-slate-400 text-xs">-</span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-xs text-center">
                            <div class="flex items-center justify-center space-x-1.5">
                                <a href="{{ route('pegawai.show', $pegawai) }}" class="p-1.5 rounded-lg text-slate-500 hover:text-blue-600 hover:bg-blue-50 transition-colors" title="Lihat Detail">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>
                                <a href="{{ route('pegawai.edit', $pegawai) }}" class="p-1.5 rounded-lg text-slate-500 hover:text-amber-600 hover:bg-amber-50 transition-colors" title="Ubah Pegawai">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <button type="button" onclick="openDeleteModal('{{ route('pegawai.destroy', $pegawai) }}', 'Pegawai PNS: {{ $pegawai->nama }} (NIP. {{ $pegawai->nip }})', 'Jika pegawai ini sedang memegang kendaraan, tanggung jawab kendaraan akan otomatis dilepas.')" class="p-1.5 rounded-lg text-slate-500 hover:text-rose-600 hover:bg-rose-50 transition-colors" title="Hapus Pegawai">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-5 py-12 text-center text-slate-400 text-xs">
                            Belum ada data Pegawai PNS yang terdaftar.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($pegawais->hasPages())
        <div class="px-5 py-4 border-t border-slate-100 bg-slate-50/50">
            {{ $pegawais->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
