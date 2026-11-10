@extends('layouts.app')

@section('title', 'Detail Pegawai - ' . $pegawai->nama)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Breadcrumb & Header -->
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center space-x-2 text-xs text-slate-500 mb-1">
                <a href="{{ route('pegawai.index') }}" class="hover:text-blue-600">Pegawai (PNS)</a>
                <span>/</span>
                <span class="text-slate-800 font-semibold">{{ $pegawai->nama }}</span>
            </div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight flex items-center space-x-3">
                <span>{{ $pegawai->nama }}</span>
                @if($pegawai->status_aktif)
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                        Aktif
                    </span>
                @else
                    <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-600">
                        Tidak Aktif
                    </span>
                @endif
            </h1>
            <p class="text-xs font-mono text-slate-500 mt-1">NIP: {{ $pegawai->nip }} &bull; Golongan: {{ $pegawai->golongan }}</p>
        </div>

        <div class="flex items-center space-x-2">
            <a href="{{ route('pegawai.edit', $pegawai) }}" class="inline-flex items-center space-x-1.5 text-xs font-semibold px-3.5 py-2 rounded-xl bg-amber-500 hover:bg-amber-400 text-white shadow-sm transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                <span>Ubah</span>
            </a>
            <button type="button" onclick="openDeleteModal('{{ route('pegawai.destroy', $pegawai) }}', 'Pegawai PNS: {{ $pegawai->nama }} (NIP. {{ $pegawai->nip }})', 'Jika pegawai ini sedang memegang kendaraan, tanggung jawab kendaraan akan otomatis dilepas.')" class="p-2 rounded-xl text-rose-600 bg-rose-50 hover:bg-rose-100 border border-rose-200 transition-colors" title="Hapus Pegawai">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            </button>
        </div>
    </div>

    <!-- Info Profil Card -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 space-y-4">
        <h2 class="font-bold text-slate-900 text-sm border-b border-slate-100 pb-3">Profil Kepegawaian</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-xs">
            <div class="bg-slate-50 p-3.5 rounded-xl border border-slate-100">
                <span class="text-slate-400 block font-medium">Instansi Bertugas</span>
                <span class="font-bold text-slate-800 text-sm mt-0.5 block">{{ $pegawai->perangkatDaerah->nama_instansi }}</span>
                <span class="text-[11px] text-slate-500 font-mono">Kode: {{ $pegawai->perangkatDaerah->kode_opd }}</span>
            </div>
            <div class="bg-slate-50 p-3.5 rounded-xl border border-slate-100">
                <span class="text-slate-400 block font-medium">Jabatan</span>
                <span class="font-bold text-slate-800 text-sm mt-0.5 block">{{ $pegawai->jabatan }}</span>
            </div>
            <div class="bg-slate-50 p-3.5 rounded-xl border border-slate-100">
                <span class="text-slate-400 block font-medium">Pangkat / Golongan</span>
                <span class="font-bold text-slate-800 text-sm mt-0.5 block">{{ $pegawai->golongan }}</span>
            </div>
            <div class="bg-slate-50 p-3.5 rounded-xl border border-slate-100">
                <span class="text-slate-400 block font-medium">Nomor Telepon / WhatsApp</span>
                <span class="font-bold text-slate-800 text-sm mt-0.5 block">{{ $pegawai->no_hp ?? '-' }}</span>
            </div>
            <div class="bg-slate-50 p-3.5 rounded-xl border border-slate-100 sm:col-span-2">
                <span class="text-slate-400 block font-medium">Alamat Email</span>
                <span class="font-bold text-slate-800 text-sm mt-0.5 block">{{ $pegawai->email ?? '-' }}</span>
            </div>
        </div>
    </div>

    <!-- Kendaraan Dinas yang Dipertanggungjawabkan -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 space-y-4">
        <div class="flex items-center justify-between pb-3 border-b border-slate-100">
            <div>
                <h2 class="font-bold text-slate-900 text-sm">Kendaraan Dinas yang Dipertanggungjawabkan</h2>
                <p class="text-xs text-slate-500">Daftar unit KDO yang berada di bawah tanggung jawab pegawai ini</p>
            </div>
            <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800">
                {{ $pegawai->kendaraanDinas->count() }} Unit
            </span>
        </div>

        @if($pegawai->kendaraanDinas->count() > 0)
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500 uppercase font-semibold border-b border-slate-100">
                    <tr>
                        <th class="px-4 py-2.5">Nomor Polisi</th>
                        <th class="px-4 py-2.5">Merek & Tipe</th>
                        <th class="px-4 py-2.5">Tahun / Warna</th>
                        <th class="px-4 py-2.5">Kondisi</th>
                        <th class="px-4 py-2.5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($pegawai->kendaraanDinas as $kdo)
                    <tr class="hover:bg-slate-50/60">
                        <td class="px-4 py-3 font-mono font-bold text-red-700">
                            {{ $kdo->no_polisi }}
                        </td>
                        <td class="px-4 py-3 font-semibold text-slate-800">
                            {{ $kdo->merek }} {{ $kdo->tipe }}
                        </td>
                        <td class="px-4 py-3 text-slate-600">
                            {{ $kdo->tahun_produksi }} &bull; {{ $kdo->warna }}
                        </td>
                        <td class="px-4 py-3">
                            @if($kdo->kondisi === 'Baik')
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-100 text-emerald-800">Baik</span>
                            @elseif($kdo->kondisi === 'Rusak Ringan')
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-800">Rusak Ringan</span>
                            @else
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-rose-100 text-rose-800">Rusak Berat</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('kendaraan-dinas.show', $kdo) }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                                Lihat Unit &rarr;
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="py-8 text-center text-slate-400 text-xs">
            Pegawai ini saat ini tidak memiliki kendaraan dinas operasional yang dipertanggungjawabkan.
        </div>
        @endif
    </div>
</div>
@endsection
