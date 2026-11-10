@extends('layouts.app')

@section('title', 'Ubah Kendaraan Dinas - ' . $kendaraanDinas->no_polisi)

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Breadcrumb & Header -->
    <div class="flex items-center justify-between">
        <div>
            <div class="flex items-center space-x-2 text-xs text-slate-500 mb-1">
                <a href="{{ route('kendaraan-dinas.index') }}" class="hover:text-blue-600">Kendaraan Dinas</a>
                <span>/</span>
                <span class="text-slate-800 font-semibold font-mono">{{ $kendaraanDinas->no_polisi }}</span>
                <span>/</span>
                <span class="text-slate-800 font-semibold">Ubah Data</span>
            </div>
            <h1 class="text-2xl font-black text-slate-900 tracking-tight">Ubah Data Kendaraan Dinas</h1>
            <p class="text-xs text-slate-500 mt-0.5">Edit spesifikasi, mutasi penanggung jawab, atau perbarui status kondisi fisik.</p>
        </div>
        <a href="{{ route('kendaraan-dinas.show', $kendaraanDinas) }}" class="inline-flex items-center space-x-1.5 text-xs font-semibold px-3.5 py-2 rounded-xl border border-slate-200 bg-white text-slate-600 hover:bg-slate-50 hover:border-slate-300 transition-all shadow-sm">
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
            <span>Lihat Detail</span>
        </a>
    </div>

    <!-- Form Card -->
    <form action="{{ route('kendaraan-dinas.update', $kendaraanDinas) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-3xl border border-slate-200/80 shadow-sm p-6 sm:p-9 space-y-8">
        @csrf
        @method('PUT')

        <!-- Section 1: Identitas & Klasifikasi Kendaraan -->
        <div class="space-y-5">
            <div class="flex items-center space-x-2.5 pb-3 border-b border-slate-100">
                <span class="w-7 h-7 rounded-xl bg-blue-50 text-blue-600 border border-blue-200 flex items-center justify-center text-xs font-black">1</span>
                <div>
                    <h3 class="text-sm font-bold text-slate-900">Spesifikasi & Identitas Fisik Kendaraan</h3>
                    <p class="text-[11px] text-slate-400">Data teknis dan nomor polisi registrasi armada dinas</p>
                </div>
            </div>

            <!-- Plat Nomor dengan Live Validator & Visual Preview -->
            <div class="p-4 sm:p-5 rounded-2xl bg-gradient-to-br from-slate-50 to-slate-100/60 border border-slate-200/80 space-y-3">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                    <div class="flex-1">
                        <label class="block text-xs font-bold text-slate-700 mb-1">
                            Nomor Polisi (Plat Merah) <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <input 
                                type="text" 
                                id="no_polisi" 
                                name="no_polisi" 
                                value="{{ old('no_polisi', $kendaraanDinas->no_polisi) }}" 
                                required 
                                autocomplete="off"
                                class="form-control-smooth w-full text-sm font-mono font-bold rounded-xl border border-slate-200 py-2.5 px-3.5 uppercase tracking-wider text-slate-900"
                            >
                            <div id="platCheckIcon" class="absolute right-3.5 top-3 pointer-events-none">
                                <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            </div>
                        </div>
                    </div>

                    <!-- Live Plat Preview Badge -->
                    <div class="sm:w-56 flex-shrink-0 flex flex-col items-center sm:items-end">
                        <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1">Live Preview Plat:</span>
                        <div class="plat-merah-badge px-4 py-2 rounded-xl text-center min-w-[170px] shadow-md">
                            <span id="platBadgeText" class="text-sm tracking-widest">{{ strtoupper($kendaraanDinas->no_polisi) }}</span>
                            <div class="text-[8px] tracking-normal font-sans text-red-200 flex justify-between px-1 mt-0.5 border-t border-red-500/40 pt-0.5">
                                <span>KDO-BMD</span>
                                <span id="pajakBadgeText">{{ $kendaraanDinas->tgl_pajak ? $kendaraanDinas->tgl_pajak->format('m.y') : date('m.y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Validation Feedback Indicator -->
                <div id="platFeedback" class="text-xs flex items-center space-x-1.5 text-emerald-700 font-semibold transition-all">
                    <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    <span>Format nomor polisi valid dan terdaftar.</span>
                </div>
            </div>

            <!-- Grid Field Spesifikasi -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <!-- Merek -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Merek Kendaraan <span class="text-rose-500">*</span></label>
                    <input type="text" name="merek" value="{{ old('merek', $kendaraanDinas->merek) }}" required class="form-control-smooth w-full text-xs rounded-xl border border-slate-200 py-2.5 px-3.5 text-slate-800">
                </div>

                <!-- Tipe/Model -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Tipe / Model <span class="text-rose-500">*</span></label>
                    <input type="text" name="tipe" value="{{ old('tipe', $kendaraanDinas->tipe) }}" required class="form-control-smooth w-full text-xs rounded-xl border border-slate-200 py-2.5 px-3.5 text-slate-800">
                </div>

                <!-- Jenis Kendaraan (Custom Select with generous arrow padding) -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Jenis Kendaraan <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <select name="jenis_kendaraan" required class="form-control-smooth appearance-none w-full text-xs rounded-xl border border-slate-200 py-2.5 pl-3.5 pr-11 text-slate-800 bg-white cursor-pointer font-medium">
                            <option value="Roda 4" {{ old('jenis_kendaraan', $kendaraanDinas->jenis_kendaraan) === 'Roda 4' ? 'selected' : '' }}>Roda 4 (Mobil Dinas / Minibus / SUV)</option>
                            <option value="Roda 2" {{ old('jenis_kendaraan', $kendaraanDinas->jenis_kendaraan) === 'Roda 2' ? 'selected' : '' }}>Roda 2 (Sepeda Motor Operasional)</option>
                            <option value="Roda 6 / Truk / Bus" {{ old('jenis_kendaraan', $kendaraanDinas->jenis_kendaraan) === 'Roda 6 / Truk / Bus' ? 'selected' : '' }}>Roda 6 / Truk / Bus / Khusus</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                </div>

                <!-- Tahun Produksi -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Tahun Produksi <span class="text-rose-500">*</span></label>
                    <input type="number" name="tahun_produksi" value="{{ old('tahun_produksi', $kendaraanDinas->tahun_produksi) }}" min="1980" max="{{ date('Y') + 1 }}" required class="form-control-smooth w-full text-xs rounded-xl border border-slate-200 py-2.5 px-3.5 text-slate-800">
                </div>

                <!-- Warna Kendaraan -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Warna Kendaraan <span class="text-rose-500">*</span></label>
                    <input type="text" name="warna" value="{{ old('warna', $kendaraanDinas->warna) }}" required class="form-control-smooth w-full text-xs rounded-xl border border-slate-200 py-2.5 px-3.5 text-slate-800">
                </div>

                <!-- Kondisi (Custom Select with generous arrow padding) -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Kondisi / Status Fisik <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <select name="kondisi" required class="form-control-smooth appearance-none w-full text-xs font-bold rounded-xl border border-slate-200 py-2.5 pl-3.5 pr-11 text-slate-800 bg-white cursor-pointer">
                            <option value="Baik" {{ old('kondisi', $kendaraanDinas->kondisi) === 'Baik' ? 'selected' : '' }}>Baik (Siap Operasional)</option>
                            <option value="Rusak Ringan" {{ old('kondisi', $kendaraanDinas->kondisi) === 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan (Perlu Servis Berkala)</option>
                            <option value="Rusak Berat" {{ old('kondisi', $kendaraanDinas->kondisi) === 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat (Tidak Dapat Beroperasi)</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                </div>

                <!-- Jatuh Tempo Pajak/STNK -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Jatuh Tempo Pajak STNK</label>
                    <input type="date" id="tgl_pajak" name="tgl_pajak" value="{{ old('tgl_pajak', $kendaraanDinas->tgl_pajak?->format('Y-m-d')) }}" class="form-control-smooth w-full text-xs rounded-xl border border-slate-200 py-2.5 px-3.5 text-slate-800">
                </div>

                <!-- Custom Styled Image Upload Box -->
                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Ganti Foto Fisik Unit</label>
                    
                    <div id="imageDropzone" onclick="document.getElementById('foto_input').click()" class="border-2 border-dashed border-slate-200 hover:border-blue-400 rounded-2xl p-4 bg-slate-50/50 hover:bg-blue-50/20 transition-all cursor-pointer flex items-center space-x-4 group">
                        <input type="file" id="foto_input" name="foto" accept="image/jpeg,image/png,image/webp" class="hidden" onchange="previewImage(this)">
                        
                        <!-- Upload Icon / Preview Thumbnail -->
                        <div id="imagePreviewContainer" class="w-16 h-16 rounded-xl bg-white border border-slate-200 flex items-center justify-center text-slate-400 flex-shrink-0 group-hover:text-blue-500 group-hover:border-blue-300 transition-all overflow-hidden shadow-sm">
                            @if($kendaraanDinas->foto_path)
                                <img id="imagePreview" src="{{ asset('storage/' . $kendaraanDinas->foto_path) }}" class="w-full h-full object-cover" alt="Foto Unit">
                                <svg id="defaultUploadIcon" class="w-7 h-7 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            @else
                                <svg id="defaultUploadIcon" class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <img id="imagePreview" class="w-full h-full object-cover hidden" alt="Preview Foto">
                            @endif
                        </div>

                        <!-- Labels -->
                        <div class="flex-1">
                            <div class="text-xs font-bold text-slate-800 group-hover:text-blue-600 transition-colors" id="fileNameLabel">
                                {{ $kendaraanDinas->foto_path ? 'Klik untuk mengganti foto unit yang tersimpan' : 'Klik untuk upload foto unit atau seret ke sini' }}
                            </div>
                            <p class="text-[11px] text-slate-400 mt-0.5" id="fileSizeLabel">Format didukung: PNG, JPG, WEBP hingga maksimal 3MB</p>
                        </div>

                        <span class="text-xs font-semibold px-3 py-1.5 rounded-lg bg-white border border-slate-200 text-slate-700 shadow-sm group-hover:bg-blue-600 group-hover:text-white group-hover:border-blue-600 transition-all">
                            Pilih Foto
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 2: Kepemilikan & Penanggung Jawab -->
        <div class="space-y-5 pt-3">
            <div class="flex items-center space-x-2.5 pb-3 border-b border-slate-100">
                <span class="w-7 h-7 rounded-xl bg-blue-50 text-blue-600 border border-blue-200 flex items-center justify-center text-xs font-black">2</span>
                <div>
                    <h3 class="text-sm font-bold text-slate-900">Alokasi Instansi & Penanggung Jawab (PNS)</h3>
                    <p class="text-[11px] text-slate-400">Penetapan Perangkat Daerah pemilik dan pegawai pemegang hak pakai</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <!-- Perangkat Daerah (Custom Select) -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Perangkat Daerah (Instansi Pemilik) <span class="text-rose-500">*</span></label>
                    <div class="relative">
                        <select name="perangkat_daerah_id" required class="form-control-smooth appearance-none w-full text-xs rounded-xl border border-slate-200 py-2.5 pl-3.5 pr-11 text-slate-800 bg-white cursor-pointer font-medium">
                            @foreach($perangkatDaerahs as $pd)
                                <option value="{{ $pd->id }}" {{ old('perangkat_daerah_id', $kendaraanDinas->perangkat_daerah_id) == $pd->id ? 'selected' : '' }}>
                                    [{{ $pd->kode_opd }}] {{ $pd->nama_instansi }}
                                </option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>
                </div>

                <!-- Penanggung Jawab PNS (Searchable Custom Dropdown) -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Pegawai Penanggung Jawab (PNS)</label>
                    <div class="relative" id="pnsDropdownWrapper">
                        <!-- Hidden input for form submission -->
                        <input type="hidden" name="penanggung_jawab_id" id="penanggung_jawab_id" value="{{ old('penanggung_jawab_id', $kendaraanDinas->penanggung_jawab_id) }}">

                        <!-- Trigger Button -->
                        <button 
                            type="button" 
                            id="pnsTriggerBtn" 
                            onclick="togglePnsDropdown()" 
                            class="form-control-smooth w-full text-xs rounded-xl border border-slate-200 py-2.5 pl-3.5 pr-10 text-left bg-white flex items-center justify-between cursor-pointer focus:outline-none"
                        >
                            <div class="flex items-center space-x-2 truncate" id="pnsSelectedDisplay">
                                @if($kendaraanDinas->penanggungJawab)
                                    <span class="w-2 h-2 rounded-full bg-blue-600 flex-shrink-0"></span>
                                    <span class="font-bold text-slate-800 text-xs truncate">{{ $kendaraanDinas->penanggungJawab->nama }}</span>
                                    <span class="text-[10px] text-slate-400 font-mono truncate hidden sm:inline">(NIP. {{ $kendaraanDinas->penanggungJawab->nip }})</span>
                                    <span class="px-1.5 py-0.5 rounded bg-blue-50 text-blue-700 text-[10px] font-bold border border-blue-200 ml-1 flex-shrink-0">
                                        {{ $kendaraanDinas->penanggungJawab->perangkatDaerah->singkatan ?? $kendaraanDinas->penanggungJawab->perangkatDaerah->nama_instansi }}
                                    </span>
                                @else
                                    <span class="w-2 h-2 rounded-full bg-slate-300 flex-shrink-0"></span>
                                    <span class="text-slate-500 font-medium truncate">-- Belum Ditugaskan / Pool Dinas --</span>
                                @endif
                            </div>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400">
                                <svg id="pnsChevron" class="w-4 h-4 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </button>

                        <!-- Custom Searchable Dropdown Popover -->
                        <div 
                            id="pnsDropdownPopover" 
                            class="absolute left-0 right-0 top-full mt-1.5 bg-white rounded-2xl border border-slate-200 shadow-2xl z-50 hidden overflow-hidden transition-all duration-200"
                        >
                            <!-- Search Input Header -->
                            <div class="p-2.5 bg-slate-50 border-b border-slate-100">
                                <div class="relative">
                                    <input 
                                        type="text" 
                                        id="pnsSearchBox" 
                                        placeholder="Ketik nama pegawai, NIP, atau dinas..." 
                                        autocomplete="off" 
                                        oninput="filterPnsList(this.value)"
                                        class="w-full text-xs rounded-xl border border-slate-200 py-2 pl-8 pr-3 text-slate-800 bg-white focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                                    >
                                    <svg class="w-4 h-4 text-slate-400 absolute left-2.5 top-2.5 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                </div>
                            </div>

                            <!-- List of PNS Options -->
                            <div class="max-h-60 overflow-y-auto divide-y divide-slate-100" id="pnsOptionsContainer">
                                <!-- Option: Belum Ditugaskan / Pool Dinas -->
                                <div 
                                    onclick="selectPnsItem('', '-- Belum Ditugaskan / Pool Dinas --', '', 'Pool Dinas')"
                                    class="pns-item px-3.5 py-2.5 hover:bg-blue-50/70 cursor-pointer flex items-center justify-between transition-colors"
                                    data-id=""
                                    data-search="belum ditugaskan pool dinas tanpa pemegang"
                                >
                                    <div class="flex items-center space-x-2">
                                        <span class="w-2 h-2 rounded-full bg-slate-300"></span>
                                        <span class="text-xs font-semibold text-slate-600">-- Belum Ditugaskan / Pool Dinas --</span>
                                    </div>
                                    <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-slate-100 text-slate-600">Pool</span>
                                </div>

                                <!-- Pegawai PNS List -->
                                @foreach($pegawais as $pns)
                                    <div 
                                        onclick="selectPnsItem('{{ $pns->id }}', '{{ addslashes($pns->nama) }}', '{{ $pns->nip }}', '{{ $pns->perangkatDaerah->singkatan ?? $pns->perangkatDaerah->nama_instansi }}')"
                                        class="pns-item px-3.5 py-2.5 hover:bg-blue-50/70 cursor-pointer flex items-center justify-between transition-colors"
                                        data-id="{{ $pns->id }}"
                                        data-search="{{ strtolower($pns->nama . ' ' . $pns->nip . ' ' . $pns->jabatan . ' ' . ($pns->perangkatDaerah->singkatan ?? '') . ' ' . $pns->perangkatDaerah->nama_instansi) }}"
                                    >
                                        <div class="min-w-0 pr-2">
                                            <div class="font-bold text-xs text-slate-900 truncate">{{ $pns->nama }}</div>
                                            <div class="text-[10px] text-slate-400 font-mono">NIP: {{ $pns->nip }} &bull; {{ $pns->jabatan }}</div>
                                        </div>
                                        <span class="flex-shrink-0 text-[10px] font-bold px-2 py-0.5 rounded bg-blue-50 text-blue-700 border border-blue-200">
                                            {{ $pns->perangkatDaerah->singkatan ?? Str::limit($pns->perangkatDaerah->nama_instansi, 12) }}
                                        </span>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Empty Search Result -->
                            <div id="pnsEmptyState" class="hidden p-6 text-center text-xs text-slate-400">
                                Tidak ada pegawai PNS yang cocok dengan pencarian.
                            </div>
                        </div>
                    </div>
                    <p class="text-[10px] text-slate-400 mt-1">Kosongkan jika kendaraan berada di pool dinas tanpa pemegang tetap.</p>
                </div>
            </div>
        </div>

        <!-- Section 3: Data Teknis & Catatan BMD -->
        <div class="space-y-5 pt-3">
            <div class="flex items-center space-x-2.5 pb-3 border-b border-slate-100">
                <span class="w-7 h-7 rounded-xl bg-blue-50 text-blue-600 border border-blue-200 flex items-center justify-center text-xs font-black">3</span>
                <div>
                    <h3 class="text-sm font-bold text-slate-900">Identifikasi Mesin/Rangka & Catatan Khusus</h3>
                    <p class="text-[11px] text-slate-400">Nomor rangka dan mesin sesuai BPKB/STNK untuk inventarisasi resmi</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Nomor Rangka (VIN)</label>
                    <input type="text" name="nomor_rangka" value="{{ old('nomor_rangka', $kendaraanDinas->nomor_rangka) }}" class="form-control-smooth w-full text-xs font-mono font-medium rounded-xl border border-slate-200 py-2.5 px-3.5 text-slate-800 uppercase">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Nomor Mesin</label>
                    <input type="text" name="nomor_mesin" value="{{ old('nomor_mesin', $kendaraanDinas->nomor_mesin) }}" class="form-control-smooth w-full text-xs font-mono font-medium rounded-xl border border-slate-200 py-2.5 px-3.5 text-slate-800 uppercase">
                </div>

                <div class="sm:col-span-2">
                    <label class="block text-xs font-bold text-slate-700 mb-1.5">Catatan Tambahan / Peruntukan Dinas</label>
                    <textarea name="keterangan" rows="3" class="form-control-smooth w-full text-xs rounded-xl border border-slate-200 p-3.5 text-slate-800 leading-relaxed">{{ old('keterangan', $kendaraanDinas->keterangan) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="pt-5 border-t border-slate-100 flex items-center justify-end space-x-3">
            <a href="{{ route('kendaraan-dinas.show', $kendaraanDinas) }}" class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 text-xs font-semibold transition-all">
                Batal
            </a>
            <button type="submit" class="px-7 py-2.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white text-xs font-bold transition-all shadow-md shadow-blue-500/25">
                Perbarui Data Kendaraan
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    // Real-time Indonesian License Plate (Plat Nomor) Validator & Formatter
    const noPolisiInput = document.getElementById('no_polisi');
    const platBadgeText = document.getElementById('platBadgeText');
    const platFeedback = document.getElementById('platFeedback');
    const platCheckIcon = document.getElementById('platCheckIcon');
    const tglPajakInput = document.getElementById('tgl_pajak');
    const pajakBadgeText = document.getElementById('pajakBadgeText');

    const platRegex = /^[A-Z]{1,2}\s[0-9]{1,4}\s[A-Z]{1,3}$/;

    noPolisiInput.addEventListener('input', function(e) {
        let val = e.target.value.toUpperCase();
        e.target.value = val;
        platBadgeText.textContent = val.trim() || 'B 1024 PQ';

        if (platRegex.test(val.trim())) {
            noPolisiInput.classList.remove('border-rose-400');
            noPolisiInput.classList.add('border-emerald-400');
            platCheckIcon.classList.remove('hidden');
            platFeedback.innerHTML = `
                <svg class="w-4 h-4 text-emerald-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                <span class="text-emerald-700 font-semibold">Format nomor polisi valid dan sesuai standar Plat Merah.</span>
            `;
        } else if (val.trim().length > 0) {
            platCheckIcon.classList.add('hidden');
            noPolisiInput.classList.remove('border-emerald-400');
            platFeedback.innerHTML = `
                <svg class="w-4 h-4 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                <span class="text-amber-700 font-medium">Format: <strong>[Kode Wilayah] [1-4 Angka] [1-3 Huruf Seri]</strong>. Contoh: <em>B 1024 PQ</em></span>
            `;
        }
    });

    if (tglPajakInput) {
        tglPajakInput.addEventListener('change', function(e) {
            if (e.target.value) {
                const parts = e.target.value.split('-');
                if (parts.length === 3) {
                    pajakBadgeText.textContent = `${parts[1]}.${parts[0].slice(-2)}`;
                }
            }
        });
    }

    function previewImage(input) {
        const preview = document.getElementById('imagePreview');
        const defaultIcon = document.getElementById('defaultUploadIcon');
        const fileNameLabel = document.getElementById('fileNameLabel');
        const fileSizeLabel = document.getElementById('fileSizeLabel');

        if (input.files && input.files[0]) {
            const file = input.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                if (defaultIcon) defaultIcon.classList.add('hidden');
            };

            reader.readAsDataURL(file);

            fileNameLabel.textContent = file.name;
            const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
            fileSizeLabel.textContent = `Ukuran: ${sizeInMB} MB &bull; Siap diperbarui`;
        }
    }

    // Custom Searchable PNS Dropdown Logic
    function togglePnsDropdown() {
        const popover = document.getElementById('pnsDropdownPopover');
        const chevron = document.getElementById('pnsChevron');
        const isHidden = popover.classList.contains('hidden');

        if (isHidden) {
            popover.classList.remove('hidden');
            chevron.classList.add('rotate-180');
            const searchBox = document.getElementById('pnsSearchBox');
            searchBox.value = '';
            filterPnsList('');
            setTimeout(() => searchBox.focus(), 50);
        } else {
            closePnsDropdown();
        }
    }

    function closePnsDropdown() {
        const popover = document.getElementById('pnsDropdownPopover');
        const chevron = document.getElementById('pnsChevron');
        if (popover) {
            popover.classList.add('hidden');
            chevron.classList.remove('rotate-180');
        }
    }

    function filterPnsList(query) {
        const q = query.toLowerCase().trim();
        const items = document.querySelectorAll('.pns-item');
        let visibleCount = 0;

        items.forEach(item => {
            const searchData = item.getAttribute('data-search') || '';
            if (searchData.includes(q)) {
                item.classList.remove('hidden');
                visibleCount++;
            } else {
                item.classList.add('hidden');
            }
        });

        const emptyState = document.getElementById('pnsEmptyState');
        if (visibleCount === 0) {
            emptyState.classList.remove('hidden');
        } else {
            emptyState.classList.add('hidden');
        }
    }

    function selectPnsItem(id, nama, nip, instansi) {
        const hiddenInput = document.getElementById('penanggung_jawab_id');
        const display = document.getElementById('pnsSelectedDisplay');

        hiddenInput.value = id;

        if (id) {
            display.innerHTML = `
                <span class="w-2 h-2 rounded-full bg-blue-600 flex-shrink-0"></span>
                <span class="font-bold text-slate-800 text-xs truncate">${nama}</span>
                <span class="text-[10px] text-slate-400 font-mono truncate hidden sm:inline">(NIP. ${nip})</span>
                <span class="px-1.5 py-0.5 rounded bg-blue-50 text-blue-700 text-[10px] font-bold border border-blue-200 ml-1 flex-shrink-0">${instansi}</span>
            `;
        } else {
            display.innerHTML = `
                <span class="w-2 h-2 rounded-full bg-slate-300 flex-shrink-0"></span>
                <span class="text-slate-500 font-medium truncate">-- Belum Ditugaskan / Pool Dinas --</span>
            `;
        }

        closePnsDropdown();
    }

    // Close on click outside & Escape key
    document.addEventListener('click', function(e) {
        const wrapper = document.getElementById('pnsDropdownWrapper');
        if (wrapper && !wrapper.contains(e.target)) {
            closePnsDropdown();
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closePnsDropdown();
        }
    });
</script>
@endpush
