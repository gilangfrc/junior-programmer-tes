@extends('layouts.app')

@section('title', 'Data Kendaraan Dinas Operasional (KDO)')

@section('content')
<div class="space-y-6">
    <!-- Header & Action -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center space-x-2">
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

    <!-- Enterprise Quick Status Filter Tabs -->
    <div class="flex items-center space-x-2 overflow-x-auto pb-1 no-print">
        <!-- Tab: Semua -->
        <a href="{{ route('kendaraan-dinas.index', array_merge(request()->except('kondisi', 'page'), [])) }}" class="inline-flex items-center space-x-2 px-3.5 py-2 rounded-xl text-xs font-bold transition-all flex-shrink-0 {{ !request('kondisi') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/25' : 'bg-white border border-slate-200/90 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm' }}">
            <span>Semua Armada</span>
            <span class="px-1.5 py-0.5 rounded-md text-[10px] {{ !request('kondisi') ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-600' }}">{{ $kondisiCounts['all'] }}</span>
        </a>
        
        <!-- Tab: Baik -->
        <a href="{{ route('kendaraan-dinas.index', array_merge(request()->except('kondisi', 'page'), ['kondisi' => 'Baik'])) }}" class="inline-flex items-center space-x-2 px-3.5 py-2 rounded-xl text-xs font-bold transition-all flex-shrink-0 {{ request('kondisi') === 'Baik' ? 'bg-emerald-600 text-white shadow-md shadow-emerald-600/25' : 'bg-white border border-slate-200/90 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm' }}">
            <span class="w-2 h-2 rounded-full {{ request('kondisi') === 'Baik' ? 'bg-white' : 'bg-emerald-500' }}"></span>
            <span>Baik</span>
            <span class="px-1.5 py-0.5 rounded-md text-[10px] {{ request('kondisi') === 'Baik' ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-600' }}">{{ $kondisiCounts['Baik'] }}</span>
        </a>

        <!-- Tab: Rusak Ringan -->
        <a href="{{ route('kendaraan-dinas.index', array_merge(request()->except('kondisi', 'page'), ['kondisi' => 'Rusak Ringan'])) }}" class="inline-flex items-center space-x-2 px-3.5 py-2 rounded-xl text-xs font-bold transition-all flex-shrink-0 {{ request('kondisi') === 'Rusak Ringan' ? 'bg-amber-500 text-white shadow-md shadow-amber-500/25' : 'bg-white border border-slate-200/90 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm' }}">
            <span class="w-2 h-2 rounded-full {{ request('kondisi') === 'Rusak Ringan' ? 'bg-white' : 'bg-amber-500' }}"></span>
            <span>Rusak Ringan</span>
            <span class="px-1.5 py-0.5 rounded-md text-[10px] {{ request('kondisi') === 'Rusak Ringan' ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-600' }}">{{ $kondisiCounts['Rusak Ringan'] }}</span>
        </a>

        <!-- Tab: Rusak Berat -->
        <a href="{{ route('kendaraan-dinas.index', array_merge(request()->except('kondisi', 'page'), ['kondisi' => 'Rusak Berat'])) }}" class="inline-flex items-center space-x-2 px-3.5 py-2 rounded-xl text-xs font-bold transition-all flex-shrink-0 {{ request('kondisi') === 'Rusak Berat' ? 'bg-rose-600 text-white shadow-md shadow-rose-600/25' : 'bg-white border border-slate-200/90 text-slate-600 hover:bg-slate-50 hover:text-slate-900 shadow-sm' }}">
            <span class="w-2 h-2 rounded-full {{ request('kondisi') === 'Rusak Berat' ? 'bg-white' : 'bg-rose-500' }}"></span>
            <span>Rusak Berat</span>
            <span class="px-1.5 py-0.5 rounded-md text-[10px] {{ request('kondisi') === 'Rusak Berat' ? 'bg-white/20 text-white' : 'bg-slate-100 text-slate-600' }}">{{ $kondisiCounts['Rusak Berat'] }}</span>
        </a>
    </div>

    <!-- Enterprise Filter & Search Control Bar -->
    <div class="bg-white p-3.5 rounded-2xl border border-slate-200/80 shadow-sm space-y-3 no-print">
        <form method="GET" action="{{ route('kendaraan-dinas.index') }}" id="filterKdoForm">
            @if(request('kondisi'))
                <input type="hidden" name="kondisi" value="{{ request('kondisi') }}">
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-12 gap-2.5">
                <!-- Search Input with Embedded Cari Button (lg:col-span-4) -->
                <div class="sm:col-span-2 lg:col-span-4 relative">
                    <input 
                        type="text" 
                        name="search" 
                        id="kdoSearchInput" 
                        value="{{ request('search') }}" 
                        autocomplete="off" 
                        placeholder="Cari plat nomor, merek, tipe, atau PNS..." 
                        class="form-control-smooth w-full text-xs rounded-xl border border-slate-200 py-2.5 pl-9 pr-16 text-slate-800 placeholder:text-slate-400"
                    >
                    <svg class="w-4 h-4 text-slate-400 absolute left-3 top-3 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    
                    <button type="submit" class="absolute right-1 top-1 bottom-1 px-3 rounded-lg bg-slate-900 hover:bg-slate-800 text-white text-xs font-bold transition-all shadow-xs flex items-center justify-center">
                        Cari
                    </button>
                </div>

                <!-- Perangkat Daerah Filter (lg:col-span-2) -->
                <div class="relative lg:col-span-2">
                    <select name="perangkat_daerah_id" onchange="this.form.submit()" class="form-control-smooth appearance-none w-full text-xs font-semibold rounded-xl border {{ request('perangkat_daerah_id') ? 'border-blue-500 bg-blue-50/70 text-blue-700' : 'border-slate-200 bg-slate-50/70 text-slate-700' }} py-2.5 pl-3 pr-7 cursor-pointer hover:bg-slate-100 transition-all truncate">
                        <option value="">Semua Instansi (OPD)</option>
                        @foreach($perangkatDaerahs as $pd)
                            <option value="{{ $pd->id }}" {{ request('perangkat_daerah_id') == $pd->id ? 'selected' : '' }}>
                                {{ $pd->singkatan ?? $pd->nama_instansi }}
                            </option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2 text-slate-400">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </div>

                <!-- Jenis Kendaraan Filter (lg:col-span-2) -->
                <div class="relative lg:col-span-2">
                    <select name="jenis_kendaraan" onchange="this.form.submit()" class="form-control-smooth appearance-none w-full text-xs font-semibold rounded-xl border {{ request('jenis_kendaraan') ? 'border-blue-500 bg-blue-50/70 text-blue-700' : 'border-slate-200 bg-slate-50/70 text-slate-700' }} py-2.5 pl-3 pr-7 cursor-pointer hover:bg-slate-100 transition-all truncate">
                        <option value="">Semua Jenis Kendaraan</option>
                        <option value="Roda 4" {{ request('jenis_kendaraan') === 'Roda 4' ? 'selected' : '' }}>Roda 4 (Mobil)</option>
                        <option value="Roda 2" {{ request('jenis_kendaraan') === 'Roda 2' ? 'selected' : '' }}>Roda 2 (Motor)</option>
                        <option value="Roda 6 / Truk / Bus" {{ request('jenis_kendaraan') === 'Roda 6 / Truk / Bus' ? 'selected' : '' }}>Roda 6 / Truk</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2 text-slate-400">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </div>

                <!-- Status Pemegang Filter (lg:col-span-2) -->
                <div class="relative lg:col-span-2">
                    <select name="status_pemegang" onchange="this.form.submit()" class="form-control-smooth appearance-none w-full text-xs font-semibold rounded-xl border {{ request('status_pemegang') ? 'border-blue-500 bg-blue-50/70 text-blue-700' : 'border-slate-200 bg-slate-50/70 text-slate-700' }} py-2.5 pl-3 pr-7 cursor-pointer hover:bg-slate-100 transition-all truncate">
                        <option value="">Status Pemegang</option>
                        <option value="assigned" {{ request('status_pemegang') === 'assigned' ? 'selected' : '' }}>Ada Pemegang PNS</option>
                        <option value="unassigned" {{ request('status_pemegang') === 'unassigned' ? 'selected' : '' }}>Pool Dinas (Belum Ada)</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2 text-slate-400">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </div>

                <!-- Sorting Order (lg:col-span-2) -->
                <div class="relative lg:col-span-2">
                    <select name="sort" onchange="this.form.submit()" class="form-control-smooth appearance-none w-full text-xs font-semibold rounded-xl border border-slate-200 bg-slate-50/70 text-slate-700 py-2.5 pl-3 pr-7 cursor-pointer hover:bg-slate-100 transition-all truncate">
                        <option value="terbaru" {{ request('sort') === 'terbaru' ? 'selected' : '' }}>Urut: Terbaru</option>
                        <option value="terlama" {{ request('sort') === 'terlama' ? 'selected' : '' }}>Urut: Terlama</option>
                        <option value="plat_asc" {{ request('sort') === 'plat_asc' ? 'selected' : '' }}>Plat (A-Z)</option>
                        <option value="tahun_desc" {{ request('sort') === 'tahun_desc' ? 'selected' : '' }}>Tahun Terbaru</option>
                        <option value="tahun_asc" {{ request('sort') === 'tahun_asc' ? 'selected' : '' }}>Tahun Terlama</option>
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2 text-slate-400">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </div>
                </div>
            </div>
        </form>

        <!-- Active Filter Removable Tags (Chips) -->
        @if(request()->hasAny(['search', 'kondisi', 'perangkat_daerah_id', 'jenis_kendaraan', 'status_pemegang']) && (request('search') || request('kondisi') || request('perangkat_daerah_id') || request('jenis_kendaraan') || request('status_pemegang')))
            <div class="pt-2.5 border-t border-slate-100 flex flex-wrap items-center gap-2 text-xs">
                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Filter Aktif:</span>
                
                @if(request('search'))
                    <span class="inline-flex items-center space-x-1 px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 font-medium">
                        <span>Pencarian: "<strong>{{ request('search') }}</strong>"</span>
                        <a href="{{ route('kendaraan-dinas.index', request()->except('search', 'page')) }}" class="hover:text-rose-600 font-bold ml-1 text-sm">&times;</a>
                    </span>
                @endif

                @if(request('kondisi'))
                    <span class="inline-flex items-center space-x-1 px-2.5 py-1 rounded-lg bg-blue-50 text-blue-700 font-medium border border-blue-200">
                        <span>Kondisi: <strong>{{ request('kondisi') }}</strong></span>
                        <a href="{{ route('kendaraan-dinas.index', request()->except('kondisi', 'page')) }}" class="hover:text-rose-600 font-bold ml-1 text-sm">&times;</a>
                    </span>
                @endif

                @if(request('perangkat_daerah_id'))
                    @php $selectedPd = $perangkatDaerahs->firstWhere('id', request('perangkat_daerah_id')); @endphp
                    <span class="inline-flex items-center space-x-1 px-2.5 py-1 rounded-lg bg-indigo-50 text-indigo-700 font-medium border border-indigo-200">
                        <span>OPD: <strong>{{ $selectedPd->singkatan ?? $selectedPd->nama_instansi }}</strong></span>
                        <a href="{{ route('kendaraan-dinas.index', request()->except('perangkat_daerah_id', 'page')) }}" class="hover:text-rose-600 font-bold ml-1 text-sm">&times;</a>
                    </span>
                @endif

                @if(request('jenis_kendaraan'))
                    <span class="inline-flex items-center space-x-1 px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 font-medium border border-slate-200">
                        <span>Jenis: <strong>{{ request('jenis_kendaraan') }}</strong></span>
                        <a href="{{ route('kendaraan-dinas.index', request()->except('jenis_kendaraan', 'page')) }}" class="hover:text-rose-600 font-bold ml-1 text-sm">&times;</a>
                    </span>
                @endif

                @if(request('status_pemegang'))
                    <span class="inline-flex items-center space-x-1 px-2.5 py-1 rounded-lg bg-slate-100 text-slate-700 font-medium border border-slate-200">
                        <span>Pemegang: <strong>{{ request('status_pemegang') === 'assigned' ? 'Ada Pegawai' : 'Pool Dinas' }}</strong></span>
                        <a href="{{ route('kendaraan-dinas.index', request()->except('status_pemegang', 'page')) }}" class="hover:text-rose-600 font-bold ml-1 text-sm">&times;</a>
                    </span>
                @endif

                <a href="{{ route('kendaraan-dinas.index') }}" class="text-[11px] font-bold text-rose-600 hover:text-rose-700 hover:underline ml-1">
                    Reset Semua
                </a>
            </div>
        @endif
    </div>

    <!-- Table Header Info Bar -->
    <div class="flex items-center justify-between text-xs text-slate-500 px-1">
        <div>
            Menampilkan <strong class="text-slate-800">{{ $kendaraanDinas->firstItem() ?? 0 }} - {{ $kendaraanDinas->lastItem() ?? 0 }}</strong> dari <strong class="text-slate-800">{{ $kendaraanDinas->total() }}</strong> unit KDO terdaftar
        </div>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm table-fixed">
                <colgroup>
                    <col class="w-12">
                    <col class="w-[28%]">
                    <col class="w-[21%]">
                    <col class="w-[21%]">
                    <col class="w-28">
                    <col class="w-36">
                    <col class="w-28">
                </colgroup>
                <thead class="bg-slate-50 text-slate-500 text-xs uppercase font-semibold border-b border-slate-200">
                    <tr>
                        <th class="px-2 py-3.5 text-center whitespace-nowrap">No</th>
                        <th class="px-3.5 py-3.5 whitespace-nowrap">No. Polisi & Spesifikasi</th>
                        <th class="px-3.5 py-3.5 whitespace-nowrap">Perangkat Daerah</th>
                        <th class="px-3.5 py-3.5 whitespace-nowrap">PNS Penanggung Jawab</th>
                        <th class="px-3.5 py-3.5 whitespace-nowrap">Warna & Tahun</th>
                        <th class="px-2 py-3.5 text-center whitespace-nowrap">Kondisi</th>
                        <th class="px-2 py-3.5 text-center whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($kendaraanDinas as $index => $kdo)
                    <tr class="hover:bg-slate-50/70 transition-colors">
                        <td class="px-2 py-3 text-xs text-slate-400 font-mono text-center">
                            {{ $kendaraanDinas->firstItem() + $index }}
                        </td>
                        <td class="px-3.5 py-3">
                            <div class="flex items-center space-x-2.5 min-w-0">
                                <span class="px-2 py-0.5 rounded font-mono font-bold text-xs bg-red-100 text-red-800 border border-red-200 shadow-sm whitespace-nowrap shrink-0">
                                    {{ $kdo->no_polisi }}
                                </span>
                                <div class="min-w-0 flex-1">
                                    <a href="{{ route('kendaraan-dinas.show', $kdo) }}" class="font-bold text-slate-900 text-xs hover:text-blue-600 transition-colors block truncate" title="{{ $kdo->merek }} {{ $kdo->tipe }}">
                                        {{ $kdo->merek }} {{ $kdo->tipe }}
                                    </a>
                                    <div class="text-[11px] text-slate-400 truncate" title="{{ $kdo->jenis_kendaraan }}">
                                        {{ $kdo->jenis_kendaraan }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-3.5 py-3 text-xs">
                            <span class="font-semibold text-slate-800 block truncate" title="{{ $kdo->perangkatDaerah->nama_instansi }}">{{ $kdo->perangkatDaerah->nama_instansi }}</span>
                            <div class="text-[11px] text-slate-400 truncate" title="Kode OPD: {{ $kdo->perangkatDaerah->kode_opd }}">Kode: {{ $kdo->perangkatDaerah->kode_opd }}</div>
                        </td>
                        <td class="px-3.5 py-3 text-xs">
                            @if($kdo->penanggungJawab)
                                <div class="font-medium text-slate-800 truncate" title="{{ $kdo->penanggungJawab->nama }}">{{ $kdo->penanggungJawab->nama }}</div>
                                <div class="text-[11px] text-slate-400 font-mono truncate" title="NIP: {{ $kdo->penanggungJawab->nip }}">NIP: {{ $kdo->penanggungJawab->nip }}</div>
                                <div class="text-[10px] text-slate-500 truncate" title="{{ $kdo->penanggungJawab->jabatan }}">{{ $kdo->penanggungJawab->jabatan }}</div>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] font-medium bg-slate-100 text-slate-600 border border-slate-200 whitespace-nowrap" title="Kendaraan operasional belum memiliki pemegang tetap">
                                    Belum ditugaskan
                                </span>
                            @endif
                        </td>
                        <td class="px-3.5 py-3 text-xs text-slate-600">
                            <div class="truncate" title="{{ $kdo->warna }}">{{ $kdo->warna }}</div>
                            <div class="text-slate-400 text-[11px] whitespace-nowrap">Tahun {{ $kdo->tahun_produksi }}</div>
                        </td>
                        <td class="px-2 py-3 text-xs text-center whitespace-nowrap">
                            @if($kdo->kondisi === 'Baik')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200 whitespace-nowrap" title="Kondisi: Baik (Siap Operasional)">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 shrink-0"></span>
                                    <span>Baik</span>
                                </span>
                            @elseif($kdo->kondisi === 'Rusak Ringan')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-amber-50 text-amber-700 border border-amber-200 whitespace-nowrap" title="Kondisi: Rusak Ringan (Perlu Servis Rutin)">
                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 shrink-0"></span>
                                    <span>Rusak Ringan</span>
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-semibold bg-rose-50 text-rose-700 border border-rose-200 whitespace-nowrap" title="Kondisi: Rusak Berat (Tidak Dapat Beroperasi)">
                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                    <span>Rusak Berat</span>
                                </span>
                            @endif
                        </td>
                        <td class="px-2 py-3 text-xs text-center whitespace-nowrap">
                            <div class="inline-flex items-center justify-center space-x-1">
                                <a href="{{ route('kendaraan-dinas.show', $kdo) }}" class="p-1.5 rounded-lg text-slate-400 hover:text-blue-600 hover:bg-blue-50 transition-colors" title="Lihat Detail (KIB)">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                </a>
                                <a href="{{ route('kendaraan-dinas.edit', $kdo) }}" class="p-1.5 rounded-lg text-slate-400 hover:text-amber-600 hover:bg-amber-50 transition-colors" title="Ubah Data Kendaraan">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <button type="button" onclick="openDeleteModal('{{ route('kendaraan-dinas.destroy', $kdo) }}', 'Kendaraan Dinas Plat {{ $kdo->no_polisi }} ({{ $kdo->merek }} {{ $kdo->tipe }})')" class="p-1.5 rounded-lg text-slate-400 hover:text-rose-600 hover:bg-rose-50 transition-colors" title="Hapus Data Kendaraan">
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
