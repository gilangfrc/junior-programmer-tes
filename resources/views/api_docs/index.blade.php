@extends('layouts.app')

@section('title', 'Dokumentasi REST API & Interactive Tester')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center space-x-2">
                <span class="text-xs font-bold uppercase tracking-wider text-blue-700 bg-blue-50 px-2.5 py-1 rounded-full border border-blue-200">
                    RESTful API v1
                </span>
                <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Dokumentasi & Interactive API Tester</h1>
            </div>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">Uji coba langsung seluruh endpoint REST API Kendaraan Dinas Operasional (KDO - BMD) Pemerintah Daerah.</p>
        </div>
        <div class="flex items-center space-x-2">
            <div class="flex items-center bg-slate-900 text-slate-200 text-xs px-3 py-1.5 rounded-xl border border-slate-800 font-mono shadow-sm">
                <span class="text-slate-400 mr-1.5">Base URL:</span>
                <span class="text-emerald-400 font-bold select-all">{{ url('/api') }}</span>
                <button type="button" onclick="copyToClipboard('{{ url('/api') }}', this)" class="ml-2 p-1 text-slate-400 hover:text-white rounded transition-colors" title="Salin Base URL">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Instructions / Guide Card -->
    <div class="bg-gradient-to-r from-slate-900 via-slate-800 to-indigo-950 text-white rounded-2xl p-5 shadow-sm border border-slate-800">
        <div class="flex items-start space-x-3.5">
            <div class="w-9 h-9 rounded-xl bg-blue-500/20 text-blue-400 flex items-center justify-center flex-shrink-0 mt-0.5 border border-blue-500/30">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div class="space-y-1">
                <h3 class="font-bold text-sm text-white">Petunjuk Pengujian Endpoint untuk Tim Penilai / Penguji</h3>
                <p class="text-xs text-slate-300 leading-relaxed">
                    Sistem ini mengimplementasikan spesifikasi RESTful API CRUD penuh (Create, Read, Update, Delete) untuk 3 entitas utama (KDO, PNS, Perangkat Daerah) serta statistik eksekutif. Klik tombol pengujian untuk mengirim HTTP Request secara real-time. Console interaktif di kanan akan menampilkan HTTP Status Code, latency (ms), format JSON, serta perintah cURL ekuivalen.
                </p>
                <div class="flex flex-wrap items-center gap-2 pt-2 text-[11px] font-mono">
                    <span class="inline-flex items-center px-2 py-0.5 rounded bg-blue-500/20 text-blue-300 border border-blue-500/30">GET (Read)</span>
                    <span class="inline-flex items-center px-2 py-0.5 rounded bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">POST (Create)</span>
                    <span class="inline-flex items-center px-2 py-0.5 rounded bg-amber-500/20 text-amber-300 border border-amber-500/30">PUT (Update & Audit Trail)</span>
                    <span class="inline-flex items-center px-2 py-0.5 rounded bg-rose-500/20 text-rose-300 border border-rose-500/30">DELETE (Delete)</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Tabs (Client Side) -->
    <div class="flex items-center space-x-2 border-b border-slate-200 pb-3 overflow-x-auto text-xs">
        <button type="button" onclick="filterCategory('all')" id="tab-all" class="category-tab px-3.5 py-1.5 rounded-lg font-semibold bg-blue-600 text-white shadow-xs transition-colors whitespace-nowrap">
            Semua Endpoint (20)
        </button>
        <button type="button" onclick="filterCategory('kdo')" id="tab-kdo" class="category-tab px-3.5 py-1.5 rounded-lg font-medium text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition-colors whitespace-nowrap">
            Kendaraan Dinas (7)
        </button>
        <button type="button" onclick="filterCategory('pegawai')" id="tab-pegawai" class="category-tab px-3.5 py-1.5 rounded-lg font-medium text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition-colors whitespace-nowrap">
            Pegawai PNS (6)
        </button>
        <button type="button" onclick="filterCategory('perangkat-daerah')" id="tab-perangkat-daerah" class="category-tab px-3.5 py-1.5 rounded-lg font-medium text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition-colors whitespace-nowrap">
            Perangkat Daerah (6)
        </button>
        <button type="button" onclick="filterCategory('dashboard')" id="tab-dashboard" class="category-tab px-3.5 py-1.5 rounded-lg font-medium text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition-colors whitespace-nowrap">
            Dashboard & Stats (1)
        </button>
    </div>

    <!-- Main Grid: Endpoint Cards (Left) & Live Console Result (Right) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        <!-- Endpoint List (7 Cols) -->
        <div class="lg:col-span-7 space-y-6">

            <!-- Group 1: Kendaraan Dinas (KDO) -->
            <div class="endpoint-group bg-white rounded-2xl border border-slate-200/80 shadow-xs p-5 space-y-3" data-category="kdo">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div class="flex items-center space-x-2">
                        <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                        <h2 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Kendaraan Dinas Operasional (KDO)</h2>
                    </div>
                    <span class="text-[11px] font-mono text-slate-400">CRUD & Audit Trail</span>
                </div>

                <!-- GET /api/kendaraan-dinas -->
                <div class="p-3.5 rounded-xl border border-slate-200/90 bg-slate-50/60 hover:bg-slate-50 space-y-2 transition-colors">
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center space-x-2 min-w-0">
                            <span class="px-2 py-0.5 rounded text-[11px] font-bold font-mono bg-blue-50 text-blue-700 border border-blue-200 shrink-0">GET</span>
                            <code class="text-xs font-mono font-semibold text-slate-800 truncate">/api/kendaraan-dinas</code>
                        </div>
                        <button type="button" onclick="testApi('GET', '/api/kendaraan-dinas')" class="px-3 py-1.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold shadow-xs transition-colors shrink-0">
                            Test List
                        </button>
                    </div>
                    <p class="text-[11px] text-slate-500">Mendapatkan seluruh daftar armada kendaraan dinas beserta relasi OPD dan PNS penanggung jawab (paginated).</p>
                </div>

                <!-- GET /api/kendaraan-dinas with Filter Rusak Berat -->
                <div class="p-3.5 rounded-xl border border-slate-200/90 bg-slate-50/60 hover:bg-slate-50 space-y-2 transition-colors">
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center space-x-2 min-w-0">
                            <span class="px-2 py-0.5 rounded text-[11px] font-bold font-mono bg-blue-50 text-blue-700 border border-blue-200 shrink-0">GET</span>
                            <code class="text-xs font-mono font-semibold text-slate-800 truncate">/api/kendaraan-dinas?kondisi=Rusak+Berat</code>
                        </div>
                        <button type="button" onclick="testApi('GET', '/api/kendaraan-dinas?kondisi=Rusak+Berat')" class="px-3 py-1.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold shadow-xs transition-colors shrink-0">
                            Test Filter
                        </button>
                    </div>
                    <p class="text-[11px] text-slate-500">Filter cepat armada yang berkondisi Rusak Berat untuk kebutuhan pengajuan peremajaan atau lelang.</p>
                </div>

                <!-- GET /api/kendaraan-dinas with Search -->
                <div class="p-3.5 rounded-xl border border-slate-200/90 bg-slate-50/60 hover:bg-slate-50 space-y-2 transition-colors">
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center space-x-2 min-w-0">
                            <span class="px-2 py-0.5 rounded text-[11px] font-bold font-mono bg-blue-50 text-blue-700 border border-blue-200 shrink-0">GET</span>
                            <code class="text-xs font-mono font-semibold text-slate-800 truncate">/api/kendaraan-dinas?search=Innova</code>
                        </div>
                        <button type="button" onclick="testApi('GET', '/api/kendaraan-dinas?search=Innova')" class="px-3 py-1.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold shadow-xs transition-colors shrink-0">
                            Test Search
                        </button>
                    </div>
                    <p class="text-[11px] text-slate-500">Pencarian multi-kolom mencakup plat nomor, merek, tipe, maupun nama PNS pemegang.</p>
                </div>

                <!-- GET /api/kendaraan-dinas/{id} (Detail + Audit Trail) -->
                <div class="p-3.5 rounded-xl border border-slate-200/90 bg-slate-50/60 hover:bg-slate-50 space-y-2 transition-colors">
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center space-x-2 min-w-0 flex-1">
                            <span class="px-2 py-0.5 rounded text-[11px] font-bold font-mono bg-blue-50 text-blue-700 border border-blue-200 shrink-0">GET</span>
                            <code class="text-xs font-mono font-semibold text-slate-800 truncate">/api/kendaraan-dinas/<input type="number" id="detailKdoId" value="{{ $sampleKdo?->id ?? 1 }}" min="1" class="w-14 px-1.5 py-0.5 text-xs font-mono border border-slate-300 rounded text-center bg-white focus:ring-1 focus:ring-blue-500 focus:outline-hidden"></code>
                        </div>
                        <button type="button" onclick="testDetailKdo()" class="px-3 py-1.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold shadow-xs transition-colors shrink-0">
                            Test Detail
                        </button>
                    </div>
                    <p class="text-[11px] text-slate-500">Detail spesifikasi teknis unit KDO, relasi instansi OPD, PNS penanggung jawab, serta seluruh data <strong>Riwayat Kondisi (Audit Trail BMD)</strong>.</p>
                </div>

                <!-- POST /api/kendaraan-dinas -->
                <div class="p-3.5 rounded-xl border border-emerald-200 bg-emerald-50/30 hover:bg-emerald-50/50 space-y-2 transition-colors">
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center space-x-2 min-w-0">
                            <span class="px-2 py-0.5 rounded text-[11px] font-bold font-mono bg-emerald-50 text-emerald-700 border border-emerald-200 shrink-0">POST</span>
                            <code class="text-xs font-mono font-semibold text-slate-800 truncate">/api/kendaraan-dinas</code>
                        </div>
                        <button type="button" onclick="testPostKdo()" class="px-3 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold shadow-xs transition-colors shrink-0">
                            Test Create (201)
                        </button>
                    </div>
                    <p class="text-[11px] text-slate-600">Menambahkan unit KDO baru (otomatis mencatat audit trail awal). ID unit baru otomatis diisikan ke kolom PUT & DELETE.</p>
                </div>

                <!-- PUT /api/kendaraan-dinas/{id} (Update Condition + Audit Trail) -->
                <div class="p-3.5 rounded-xl border border-amber-200 bg-amber-50/30 hover:bg-amber-50/50 space-y-2 transition-colors">
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center space-x-2 min-w-0 flex-1">
                            <span class="px-2 py-0.5 rounded text-[11px] font-bold font-mono bg-amber-50 text-amber-700 border border-amber-200 shrink-0">PUT</span>
                            <code class="text-xs font-mono font-semibold text-slate-800 truncate">/api/kendaraan-dinas/<input type="number" id="putKdoId" value="{{ $sampleKdo?->id ?? 1 }}" min="1" class="w-14 px-1.5 py-0.5 text-xs font-mono border border-amber-300 rounded text-center bg-white focus:ring-1 focus:ring-amber-500 focus:outline-hidden"></code>
                        </div>
                        <button type="button" onclick="testPutKdo()" class="px-3 py-1.5 rounded-lg bg-amber-600 hover:bg-amber-700 text-white text-xs font-semibold shadow-xs transition-colors shrink-0">
                            Test Update + Audit Trail
                        </button>
                    </div>
                    <p class="text-[11px] text-amber-900/80">
                        <strong>Uji Coba Audit Trail Otomatis:</strong> Mengubah status kondisi kendaraan via API (toggle Baik &harr; Rusak Ringan). Perubahan langsung masuk ke tabel <code>riwayat_kondisis</code>.
                    </p>
                </div>

                <!-- DELETE /api/kendaraan-dinas/{id} -->
                <div class="p-3.5 rounded-xl border border-rose-200 bg-rose-50/30 hover:bg-rose-50/50 space-y-2 transition-colors">
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center space-x-2 min-w-0 flex-1">
                            <span class="px-2 py-0.5 rounded text-[11px] font-bold font-mono bg-rose-50 text-rose-700 border border-rose-200 shrink-0">DELETE</span>
                            <code class="text-xs font-mono font-semibold text-slate-800 truncate">/api/kendaraan-dinas/<input type="number" id="deleteKdoId" value="{{ $sampleKdo?->id ?? 1 }}" min="1" class="w-14 px-1.5 py-0.5 text-xs font-mono border border-rose-300 rounded text-center bg-white focus:ring-1 focus:ring-rose-500 focus:outline-hidden"></code>
                        </div>
                        <button type="button" onclick="openApiDeleteConfirm('kdo', 'deleteKdoId', '/api/kendaraan-dinas/', 'Kendaraan Dinas Operasional')" class="px-3 py-1.5 rounded-lg bg-rose-600 hover:bg-rose-700 text-white text-xs font-semibold shadow-xs transition-colors shrink-0">
                            Test Delete (200)
                        </button>
                    </div>
                    <p class="text-[11px] text-rose-900/80">Menghapus data kendaraan dinas operasional beserta lampiran fotonya (disarankan uji pada ID hasil POST).</p>
                </div>
            </div>

            <!-- Group 2: Pegawai Negeri Sipil (PNS) -->
            <div class="endpoint-group bg-white rounded-2xl border border-slate-200/80 shadow-xs p-5 space-y-3" data-category="pegawai">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div class="flex items-center space-x-2">
                        <span class="w-2 h-2 rounded-full bg-indigo-600"></span>
                        <h2 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Pegawai Negeri Sipil (PNS)</h2>
                    </div>
                    <span class="text-[11px] font-mono text-slate-400">Penanggung Jawab KDO</span>
                </div>

                <!-- GET /api/pegawai -->
                <div class="p-3.5 rounded-xl border border-slate-200/90 bg-slate-50/60 hover:bg-slate-50 space-y-2 transition-colors">
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center space-x-2 min-w-0">
                            <span class="px-2 py-0.5 rounded text-[11px] font-bold font-mono bg-blue-50 text-blue-700 border border-blue-200 shrink-0">GET</span>
                            <code class="text-xs font-mono font-semibold text-slate-800 truncate">/api/pegawai</code>
                        </div>
                        <button type="button" onclick="testApi('GET', '/api/pegawai')" class="px-3 py-1.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold shadow-xs transition-colors shrink-0">
                            Test List
                        </button>
                    </div>
                    <p class="text-[11px] text-slate-500">Mendapatkan daftar aparatur sipil negara penanggung jawab kendaraan dinas beserta instansi OPD bertugas.</p>
                </div>

                <!-- GET /api/pegawai?search=Surya -->
                <div class="p-3.5 rounded-xl border border-slate-200/90 bg-slate-50/60 hover:bg-slate-50 space-y-2 transition-colors">
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center space-x-2 min-w-0">
                            <span class="px-2 py-0.5 rounded text-[11px] font-bold font-mono bg-blue-50 text-blue-700 border border-blue-200 shrink-0">GET</span>
                            <code class="text-xs font-mono font-semibold text-slate-800 truncate">/api/pegawai?search=Surya</code>
                        </div>
                        <button type="button" onclick="testApi('GET', '/api/pegawai?search=Surya')" class="px-3 py-1.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold shadow-xs transition-colors shrink-0">
                            Test Search
                        </button>
                    </div>
                    <p class="text-[11px] text-slate-500">Pencarian data pegawai berdasarkan Nama, NIP, atau Jabatan.</p>
                </div>

                <!-- GET /api/pegawai/{id} -->
                <div class="p-3.5 rounded-xl border border-slate-200/90 bg-slate-50/60 hover:bg-slate-50 space-y-2 transition-colors">
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center space-x-2 min-w-0 flex-1">
                            <span class="px-2 py-0.5 rounded text-[11px] font-bold font-mono bg-blue-50 text-blue-700 border border-blue-200 shrink-0">GET</span>
                            <code class="text-xs font-mono font-semibold text-slate-800 truncate">/api/pegawai/<input type="number" id="detailPegawaiId" value="{{ $samplePegawai?->id ?? 1 }}" min="1" class="w-14 px-1.5 py-0.5 text-xs font-mono border border-slate-300 rounded text-center bg-white focus:ring-1 focus:ring-blue-500 focus:outline-hidden"></code>
                        </div>
                        <button type="button" onclick="testDetailPegawai()" class="px-3 py-1.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold shadow-xs transition-colors shrink-0">
                            Test Detail
                        </button>
                    </div>
                    <p class="text-[11px] text-slate-500">Detail profil lengkap PNS beserta daftar unit kendaraan dinas yang dipertanggungjawabkan.</p>
                </div>

                <!-- POST /api/pegawai -->
                <div class="p-3.5 rounded-xl border border-emerald-200 bg-emerald-50/30 hover:bg-emerald-50/50 space-y-2 transition-colors">
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center space-x-2 min-w-0">
                            <span class="px-2 py-0.5 rounded text-[11px] font-bold font-mono bg-emerald-50 text-emerald-700 border border-emerald-200 shrink-0">POST</span>
                            <code class="text-xs font-mono font-semibold text-slate-800 truncate">/api/pegawai</code>
                        </div>
                        <button type="button" onclick="testPostPegawai()" class="px-3 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold shadow-xs transition-colors shrink-0">
                            Test Create (201)
                        </button>
                    </div>
                    <p class="text-[11px] text-slate-600">Menambahkan data pegawai penanggung jawab baru dengan NIP unik. ID baru otomatis diisikan ke PUT & DELETE.</p>
                </div>

                <!-- PUT /api/pegawai/{id} -->
                <div class="p-3.5 rounded-xl border border-amber-200 bg-amber-50/30 hover:bg-amber-50/50 space-y-2 transition-colors">
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center space-x-2 min-w-0 flex-1">
                            <span class="px-2 py-0.5 rounded text-[11px] font-bold font-mono bg-amber-50 text-amber-700 border border-amber-200 shrink-0">PUT</span>
                            <code class="text-xs font-mono font-semibold text-slate-800 truncate">/api/pegawai/<input type="number" id="putPegawaiId" value="{{ $samplePegawai?->id ?? 1 }}" min="1" class="w-14 px-1.5 py-0.5 text-xs font-mono border border-amber-300 rounded text-center bg-white focus:ring-1 focus:ring-amber-500 focus:outline-hidden"></code>
                        </div>
                        <button type="button" onclick="testPutPegawai()" class="px-3 py-1.5 rounded-lg bg-amber-600 hover:bg-amber-700 text-white text-xs font-semibold shadow-xs transition-colors shrink-0">
                            Test Update (200)
                        </button>
                    </div>
                    <p class="text-[11px] text-amber-900/80">Memperbarui informasi status aktif atau jabatan pegawai penanggung jawab secara dinamis via REST API.</p>
                </div>

                <!-- DELETE /api/pegawai/{id} -->
                <div class="p-3.5 rounded-xl border border-rose-200 bg-rose-50/30 hover:bg-rose-50/50 space-y-2 transition-colors">
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center space-x-2 min-w-0 flex-1">
                            <span class="px-2 py-0.5 rounded text-[11px] font-bold font-mono bg-rose-50 text-rose-700 border border-rose-200 shrink-0">DELETE</span>
                            <code class="text-xs font-mono font-semibold text-slate-800 truncate">/api/pegawai/<input type="number" id="deletePegawaiId" value="{{ $samplePegawai?->id ?? 1 }}" min="1" class="w-14 px-1.5 py-0.5 text-xs font-mono border border-rose-300 rounded text-center bg-white focus:ring-1 focus:ring-rose-500 focus:outline-hidden"></code>
                        </div>
                        <button type="button" onclick="openApiDeleteConfirm('pegawai', 'deletePegawaiId', '/api/pegawai/', 'Pegawai Negeri Sipil (PNS)')" class="px-3 py-1.5 rounded-lg bg-rose-600 hover:bg-rose-700 text-white text-xs font-semibold shadow-xs transition-colors shrink-0">
                            Test Delete (200)
                        </button>
                    </div>
                    <p class="text-[11px] text-rose-900/80">Menghapus data pegawai. Kendaraan yang sebelumnya dipegang otomatis berpindah ke Pool Dinas (nullOnDelete).</p>
                </div>
            </div>

            <!-- Group 3: Perangkat Daerah (PD / OPD) -->
            <div class="endpoint-group bg-white rounded-2xl border border-slate-200/80 shadow-xs p-5 space-y-3" data-category="perangkat-daerah">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div class="flex items-center space-x-2">
                        <span class="w-2 h-2 rounded-full bg-violet-600"></span>
                        <h2 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Perangkat Daerah (PD / OPD)</h2>
                    </div>
                    <span class="text-[11px] font-mono text-slate-400">Instansi Pemilik Aset</span>
                </div>

                <!-- GET /api/perangkat-daerah -->
                <div class="p-3.5 rounded-xl border border-slate-200/90 bg-slate-50/60 hover:bg-slate-50 space-y-2 transition-colors">
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center space-x-2 min-w-0">
                            <span class="px-2 py-0.5 rounded text-[11px] font-bold font-mono bg-blue-50 text-blue-700 border border-blue-200 shrink-0">GET</span>
                            <code class="text-xs font-mono font-semibold text-slate-800 truncate">/api/perangkat-daerah</code>
                        </div>
                        <button type="button" onclick="testApi('GET', '/api/perangkat-daerah')" class="px-3 py-1.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold shadow-xs transition-colors shrink-0">
                            Test List
                        </button>
                    </div>
                    <p class="text-[11px] text-slate-500">Mendapatkan daftar Satuan Kerja Perangkat Daerah (SKPD/Dinas) beserta rekap total pegawai dan jumlah armada KDO.</p>
                </div>

                <!-- GET /api/perangkat-daerah?search=Dinas -->
                <div class="p-3.5 rounded-xl border border-slate-200/90 bg-slate-50/60 hover:bg-slate-50 space-y-2 transition-colors">
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center space-x-2 min-w-0">
                            <span class="px-2 py-0.5 rounded text-[11px] font-bold font-mono bg-blue-50 text-blue-700 border border-blue-200 shrink-0">GET</span>
                            <code class="text-xs font-mono font-semibold text-slate-800 truncate">/api/perangkat-daerah?search=Pendidikan</code>
                        </div>
                        <button type="button" onclick="testApi('GET', '/api/perangkat-daerah?search=Pendidikan')" class="px-3 py-1.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold shadow-xs transition-colors shrink-0">
                            Test Search
                        </button>
                    </div>
                    <p class="text-[11px] text-slate-500">Pencarian instansi berdasarkan nama OPD, kode resmi OPD, atau akronim/singkatan.</p>
                </div>

                <!-- GET /api/perangkat-daerah/{id} -->
                <div class="p-3.5 rounded-xl border border-slate-200/90 bg-slate-50/60 hover:bg-slate-50 space-y-2 transition-colors">
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center space-x-2 min-w-0 flex-1">
                            <span class="px-2 py-0.5 rounded text-[11px] font-bold font-mono bg-blue-50 text-blue-700 border border-blue-200 shrink-0">GET</span>
                            <code class="text-xs font-mono font-semibold text-slate-800 truncate">/api/perangkat-daerah/<input type="number" id="detailOpdId" value="{{ $sampleOpd?->id ?? 1 }}" min="1" class="w-14 px-1.5 py-0.5 text-xs font-mono border border-slate-300 rounded text-center bg-white focus:ring-1 focus:ring-blue-500 focus:outline-hidden"></code>
                        </div>
                        <button type="button" onclick="testDetailOpd()" class="px-3 py-1.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold shadow-xs transition-colors shrink-0">
                            Test Detail
                        </button>
                    </div>
                    <p class="text-[11px] text-slate-500">Detail profil instansi OPD mencakup kode resmi, pimpinan, nomor kontak, serta total inventaris KDO & PNS.</p>
                </div>

                <!-- POST /api/perangkat-daerah -->
                <div class="p-3.5 rounded-xl border border-emerald-200 bg-emerald-50/30 hover:bg-emerald-50/50 space-y-2 transition-colors">
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center space-x-2 min-w-0">
                            <span class="px-2 py-0.5 rounded text-[11px] font-bold font-mono bg-emerald-50 text-emerald-700 border border-emerald-200 shrink-0">POST</span>
                            <code class="text-xs font-mono font-semibold text-slate-800 truncate">/api/perangkat-daerah</code>
                        </div>
                        <button type="button" onclick="testPostOpd()" class="px-3 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-semibold shadow-xs transition-colors shrink-0">
                            Test Create (201)
                        </button>
                    </div>
                    <p class="text-[11px] text-slate-600">Menambahkan Satuan Kerja Perangkat Daerah (SKPD/Badan/Dinas) baru. ID baru otomatis diisikan ke PUT & DELETE.</p>
                </div>

                <!-- PUT /api/perangkat-daerah/{id} -->
                <div class="p-3.5 rounded-xl border border-amber-200 bg-amber-50/30 hover:bg-amber-50/50 space-y-2 transition-colors">
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center space-x-2 min-w-0 flex-1">
                            <span class="px-2 py-0.5 rounded text-[11px] font-bold font-mono bg-amber-50 text-amber-700 border border-amber-200 shrink-0">PUT</span>
                            <code class="text-xs font-mono font-semibold text-slate-800 truncate">/api/perangkat-daerah/<input type="number" id="putOpdId" value="{{ $sampleOpd?->id ?? 1 }}" min="1" class="w-14 px-1.5 py-0.5 text-xs font-mono border border-amber-300 rounded text-center bg-white focus:ring-1 focus:ring-amber-500 focus:outline-hidden"></code>
                        </div>
                        <button type="button" onclick="testPutOpd()" class="px-3 py-1.5 rounded-lg bg-amber-600 hover:bg-amber-700 text-white text-xs font-semibold shadow-xs transition-colors shrink-0">
                            Test Update (200)
                        </button>
                    </div>
                    <p class="text-[11px] text-amber-900/80">Memperbarui alamat kantor, kontak telepon, maupun pejabat pimpinan Perangkat Daerah.</p>
                </div>

                <!-- DELETE /api/perangkat-daerah/{id} -->
                <div class="p-3.5 rounded-xl border border-rose-200 bg-rose-50/30 hover:bg-rose-50/50 space-y-2 transition-colors">
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center space-x-2 min-w-0 flex-1">
                            <span class="px-2 py-0.5 rounded text-[11px] font-bold font-mono bg-rose-50 text-rose-700 border border-rose-200 shrink-0">DELETE</span>
                            <code class="text-xs font-mono font-semibold text-slate-800 truncate">/api/perangkat-daerah/<input type="number" id="deleteOpdId" value="{{ $sampleOpd?->id ?? 1 }}" min="1" class="w-14 px-1.5 py-0.5 text-xs font-mono border border-rose-300 rounded text-center bg-white focus:ring-1 focus:ring-rose-500 focus:outline-hidden"></code>
                        </div>
                        <button type="button" onclick="openApiDeleteConfirm('opd', 'deleteOpdId', '/api/perangkat-daerah/', 'Perangkat Daerah (OPD)')" class="px-3 py-1.5 rounded-lg bg-rose-600 hover:bg-rose-700 text-white text-xs font-semibold shadow-xs transition-colors shrink-0">
                            Test Delete (200)
                        </button>
                    </div>
                    <p class="text-[11px] text-rose-900/80">Menghapus instansi OPD (cascade terhadap unit aset OPD tsb; sangat disarankan uji pada ID hasil POST).</p>
                </div>
            </div>

            <!-- Group 4: Dashboard Stats -->
            <div class="endpoint-group bg-white rounded-2xl border border-slate-200/80 shadow-xs p-5 space-y-3" data-category="dashboard">
                <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                    <div class="flex items-center space-x-2">
                        <span class="w-2 h-2 rounded-full bg-slate-600"></span>
                        <h2 class="text-xs font-bold text-slate-800 uppercase tracking-wider">Statistik & Monitoring Eksekutif</h2>
                    </div>
                    <span class="text-[11px] font-mono text-slate-400">BMD Overview</span>
                </div>
                
                <div class="p-3.5 rounded-xl border border-slate-200/90 bg-slate-50/60 hover:bg-slate-50 space-y-2 transition-colors">
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center space-x-2 min-w-0">
                            <span class="px-2 py-0.5 rounded text-[11px] font-bold font-mono bg-blue-50 text-blue-700 border border-blue-200 shrink-0">GET</span>
                            <code class="text-xs font-mono font-semibold text-slate-800 truncate">/api/dashboard/stats</code>
                        </div>
                        <button type="button" onclick="testApi('GET', '/api/dashboard/stats')" class="px-3 py-1.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold shadow-xs transition-colors shrink-0">
                            Test Stats
                        </button>
                    </div>
                    <p class="text-[11px] text-slate-500">Mendapatkan ringkasan total armada, rasio kelayakan kendaraan operasional, distribusi kondisi fisik, dan statistik per OPD.</p>
                </div>
            </div>
        </div>

        <!-- Live Response Console (5 Cols, Sticky) -->
        <div class="lg:col-span-5">
            <div class="bg-slate-900 rounded-2xl border border-slate-800 shadow-xl overflow-hidden sticky top-20">
                <!-- Console Top Header -->
                <div class="p-3.5 bg-slate-950 border-b border-slate-800 flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <span class="w-3 h-3 rounded-full bg-rose-500"></span>
                        <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                        <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
                        <span class="text-xs font-mono font-bold text-slate-300 ml-2">Live Response Console</span>
                    </div>
                    <div id="statusBadge" class="hidden text-xs font-mono font-bold px-2.5 py-0.5 rounded-full">
                        200 OK
                    </div>
                </div>

                <!-- Request Info & Metrics -->
                <div class="p-3 bg-slate-900/90 border-b border-slate-800 text-[11px] font-mono text-slate-400 flex items-center justify-between">
                    <span id="requestMethodUrl" class="truncate font-semibold text-slate-300">Menunggu eksekusi endpoint...</span>
                    <span id="responseDuration" class="text-emerald-400 font-bold ml-2 shrink-0"></span>
                </div>

                <!-- Action Bar for Console Output -->
                <div class="px-4 py-2 bg-slate-950/70 border-b border-slate-800 flex items-center justify-between text-[11px]">
                    <span class="text-slate-400 font-mono">Response Payload (JSON):</span>
                    <button type="button" onclick="copyJsonOutput()" class="inline-flex items-center space-x-1 text-slate-300 hover:text-white font-medium transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                        <span id="copyJsonBtnText">Salin JSON</span>
                    </button>
                </div>

                <!-- JSON Body Output -->
                <div class="p-4 overflow-x-auto max-h-[460px] bg-slate-950/40">
                    <pre id="jsonOutput" class="text-xs font-mono text-emerald-400 leading-relaxed whitespace-pre-wrap">// Klik salah satu tombol pengujian di sebelah kiri untuk melihat hasil eksekusi...</pre>
                </div>

                <!-- cURL Command Box -->
                <div class="p-3 bg-slate-950 border-t border-slate-800">
                    <div class="flex items-center justify-between mb-1.5">
                        <span class="text-[10px] uppercase font-bold text-slate-400 tracking-wider">Equivalent cURL Command:</span>
                        <button type="button" onclick="copyCurlOutput()" class="inline-flex items-center space-x-1 text-[11px] text-blue-400 hover:text-blue-300 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                            <span id="copyCurlBtnText">Salin cURL</span>
                        </button>
                    </div>
                    <code id="curlOutput" class="text-[11px] font-mono text-slate-300 block bg-slate-900 p-2.5 rounded-xl border border-slate-800 break-all select-all">
                        curl -X GET "{{ url('/api/dashboard/stats') }}" -H "Accept: application/json"
                    </code>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Enterprise Modal for API DELETE Confirmation -->
<div id="apiDeleteModal" class="fixed inset-0 z-50 hidden items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs transition-opacity">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 shadow-2xl border border-slate-200 transform transition-all space-y-4">
        <div class="flex items-start space-x-3.5">
            <div class="w-10 h-10 rounded-full bg-rose-50 border border-rose-200 text-rose-600 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
            </div>
            <div>
                <h3 class="text-base font-bold text-slate-900">Konfirmasi Penghapusan via REST API</h3>
                <p id="apiDeleteModalDesc" class="text-xs text-slate-500 mt-1 leading-relaxed"></p>
            </div>
        </div>
        <div class="p-3 bg-amber-50 border border-amber-200 rounded-xl text-[11px] text-amber-800 leading-relaxed">
            <strong>Tips Pengujian:</strong> Untuk menjaga keutuhan data utama aplikasi, disarankan menjalankan tombol <strong>POST (Create)</strong> terlebih dahulu agar sistem otomatis menguji penghapusan pada ID data uji yang baru dibuat.
        </div>
        <div class="flex items-center justify-end space-x-2.5 pt-2 border-t border-slate-100">
            <button type="button" onclick="closeApiDeleteModal()" class="px-4 py-2 text-xs font-semibold text-slate-600 bg-slate-100 hover:bg-slate-200 rounded-xl transition-colors">
                Batal
            </button>
            <button type="button" id="confirmApiDeleteBtn" class="px-4 py-2 text-xs font-semibold text-white bg-rose-600 hover:bg-rose-700 rounded-xl shadow-xs transition-colors">
                Eksekusi DELETE
            </button>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const SAMPLE_OPD_ID = {{ $sampleOpd?->id ?? 1 }};
    const SAMPLE_PEGAWAI_ID = {{ $samplePegawai?->id ?? 'null' }};
    let pendingApiDeletePath = null;

    // Tab Filter
    function filterCategory(cat) {
        document.querySelectorAll('.category-tab').forEach(tab => {
            tab.className = 'category-tab px-3.5 py-1.5 rounded-lg font-medium text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition-colors whitespace-nowrap';
        });

        const activeTab = document.getElementById('tab-' + cat);
        if (activeTab) {
            activeTab.className = 'category-tab px-3.5 py-1.5 rounded-lg font-semibold bg-blue-600 text-white shadow-xs transition-colors whitespace-nowrap';
        }

        const groups = document.querySelectorAll('.endpoint-group');
        groups.forEach(group => {
            if (cat === 'all' || group.getAttribute('data-category') === cat) {
                group.style.display = 'block';
            } else {
                group.style.display = 'none';
            }
        });
    }

    // Core Test API Runner
    async function testApi(method, path, body = null) {
        const fullUrl = window.location.origin + path;
        const jsonOutput = document.getElementById('jsonOutput');
        const statusBadge = document.getElementById('statusBadge');
        const reqInfo = document.getElementById('requestMethodUrl');
        const durationInfo = document.getElementById('responseDuration');
        const curlBox = document.getElementById('curlOutput');

        reqInfo.textContent = `${method} ${path}`;
        jsonOutput.textContent = '// Menghubungi server...';
        durationInfo.textContent = '...';

        let curlCmd = `curl -X ${method} "${fullUrl}" -H "Accept: application/json"`;
        if (body) {
            curlCmd += ` -H "Content-Type: application/json" -d '${JSON.stringify(body)}'`;
        }
        curlBox.textContent = curlCmd;

        const startTime = performance.now();

        try {
            const options = {
                method: method,
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            };
            if (body) {
                options.body = JSON.stringify(body);
            }

            const response = await fetch(fullUrl, options);
            const endTime = performance.now();
            const duration = Math.round(endTime - startTime);
            const data = await response.json();

            statusBadge.classList.remove('hidden', 'bg-emerald-500/20', 'text-emerald-400', 'border-emerald-500/30', 'bg-rose-500/20', 'text-rose-400', 'border-rose-500/30', 'bg-amber-500/20', 'text-amber-400', 'border-amber-500/30');
            
            if (response.ok) {
                statusBadge.className = 'text-xs font-mono font-bold px-2.5 py-0.5 rounded-full bg-emerald-500/20 text-emerald-400 border border-emerald-500/30';
                statusBadge.textContent = `${response.status} ${response.statusText || (response.status === 201 ? 'Created' : 'OK')}`;
            } else if (response.status >= 400 && response.status < 500) {
                statusBadge.className = 'text-xs font-mono font-bold px-2.5 py-0.5 rounded-full bg-amber-500/20 text-amber-400 border border-amber-500/30';
                statusBadge.textContent = `${response.status} ${response.statusText || 'Client Error'}`;
            } else {
                statusBadge.className = 'text-xs font-mono font-bold px-2.5 py-0.5 rounded-full bg-rose-500/20 text-rose-400 border border-rose-500/30';
                statusBadge.textContent = `${response.status} ${response.statusText || 'Server Error'}`;
            }

            durationInfo.textContent = `${duration} ms`;
            jsonOutput.textContent = JSON.stringify(data, null, 2);

            return { ok: response.ok, status: response.status, data };

        } catch (error) {
            statusBadge.className = 'text-xs font-mono font-bold px-2.5 py-0.5 rounded-full bg-rose-500/20 text-rose-400 border border-rose-500/30';
            statusBadge.textContent = 'Network Error';
            jsonOutput.textContent = `// Error: ${error.message}`;
            durationInfo.textContent = '-';
            return { ok: false, status: 0, data: null };
        }
    }

    // Dynamic Helpers for Detail Views
    function testDetailKdo() {
        const id = document.getElementById('detailKdoId').value || 1;
        testApi('GET', `/api/kendaraan-dinas/${id}`);
    }

    function testDetailPegawai() {
        const id = document.getElementById('detailPegawaiId').value || 1;
        testApi('GET', `/api/pegawai/${id}`);
    }

    function testDetailOpd() {
        const id = document.getElementById('detailOpdId').value || 1;
        testApi('GET', `/api/perangkat-daerah/${id}`);
    }

    // KDO POST
    async function testPostKdo() {
        const randomNum = Math.floor(1000 + Math.random() * 9000);
        const newVehicle = {
            perangkat_daerah_id: SAMPLE_OPD_ID,
            penanggung_jawab_id: SAMPLE_PEGAWAI_ID,
            no_polisi: `B ${randomNum} TST`,
            merek: "Toyota",
            tipe: "Yaris Cross 1.5 S Hybrid",
            jenis_kendaraan: "Roda 4",
            tahun_produksi: 2024,
            warna: "Merah Metalik",
            kondisi: "Baik",
            nomor_rangka: `MHFTST${randomNum}VIN`,
            nomor_mesin: `2NR-TST-${randomNum}`,
            tgl_pajak: "2028-10-10",
            keterangan: "Pengujian tambah data unit KDO baru via Automated REST API Tester."
        };

        const res = await testApi('POST', '/api/kendaraan-dinas', newVehicle);
        if (res.ok && res.data?.data?.id) {
            const newId = res.data.data.id;
            document.getElementById('putKdoId').value = newId;
            document.getElementById('deleteKdoId').value = newId;
            document.getElementById('detailKdoId').value = newId;
        }
    }

    // KDO PUT (Toggle Condition + Trigger Audit Trail)
    async function testPutKdo() {
        const id = document.getElementById('putKdoId').value || 1;
        
        const getRes = await testApi('GET', `/api/kendaraan-dinas/${id}`);
        if (!getRes.ok || !getRes.data?.data) {
            return; // 404 or error already cleanly shown in console
        }

        const current = getRes.data.data;
        const newKondisi = current.kondisi === 'Baik' ? 'Rusak Ringan' : 'Baik';

        const updatePayload = {
            perangkat_daerah_id: current.perangkat_daerah?.id || SAMPLE_OPD_ID,
            penanggung_jawab_id: current.penanggung_jawab?.id || null,
            no_polisi: current.no_polisi,
            merek: current.merek,
            tipe: current.tipe,
            jenis_kendaraan: current.jenis_kendaraan,
            tahun_produksi: current.tahun_produksi,
            warna: current.warna,
            kondisi: newKondisi,
            nomor_rangka: current.nomor_rangka,
            nomor_mesin: current.nomor_mesin,
            tgl_pajak: current.tgl_pajak,
            keterangan: `Inspeksi berkala via API Tester: perubahan kondisi fisik dari [${current.kondisi}] menjadi [${newKondisi}]. Tercatat otomatis di Audit Trail BMD.`
        };

        await testApi('PUT', `/api/kendaraan-dinas/${id}`, updatePayload);
    }

    // Pegawai POST
    async function testPostPegawai() {
        const randomNum = Math.floor(1000 + Math.random() * 9000);
        const newPegawai = {
            perangkat_daerah_id: SAMPLE_OPD_ID,
            nama: `Ir. Hendra Gunawan, M.T.`,
            nip: `19890101201501${randomNum}`,
            jabatan: "Kepala Seksi Pemeliharaan Aset KDO",
            golongan: "III/d (Penata Tingkat I)",
            no_hp: "081299887766",
            email: `hendra.${randomNum}@pemda.go.id`,
            status_aktif: true
        };

        const res = await testApi('POST', '/api/pegawai', newPegawai);
        if (res.ok && res.data?.data?.id) {
            const newId = res.data.data.id;
            document.getElementById('detailPegawaiId').value = newId;
            document.getElementById('putPegawaiId').value = newId;
            document.getElementById('deletePegawaiId').value = newId;
        }
    }

    // Pegawai PUT
    async function testPutPegawai() {
        const id = document.getElementById('putPegawaiId').value || 1;
        const getRes = await testApi('GET', `/api/pegawai/${id}`);
        if (!getRes.ok || !getRes.data?.data) {
            return;
        }

        const current = getRes.data.data;
        const updatePayload = {
            perangkat_daerah_id: current.perangkat_daerah_id || SAMPLE_OPD_ID,
            nip: current.nip,
            nama: current.nama,
            jabatan: current.jabatan,
            golongan: current.golongan,
            no_hp: "08110099" + Math.floor(1000 + Math.random() * 9000),
            email: current.email,
            status_aktif: current.status_aktif
        };

        await testApi('PUT', `/api/pegawai/${id}`, updatePayload);
    }

    // Perangkat Daerah POST
    async function testPostOpd() {
        const randomNum = Math.floor(10 + Math.random() * 89);
        const randomSub = Math.floor(10 + Math.random() * 89);
        const newOpd = {
            kode_opd: `9.${randomNum}.${randomSub}`,
            nama_instansi: `Dinas Lingkungan Hidup & Kebersihan`,
            singkatan: `DLHK`,
            alamat: `Jl. Adipura Raya No. ${randomNum}, Kompleks Perkantoran Pemda`,
            telepon: `(021) 555-88${randomNum}`,
            nama_kepala: `Dr. H. Bambang Soeprapto, M.Si.`,
            nip_kepala: `197205121998031002`
        };

        const res = await testApi('POST', '/api/perangkat-daerah', newOpd);
        if (res.ok && res.data?.data?.id) {
            const newId = res.data.data.id;
            document.getElementById('detailOpdId').value = newId;
            document.getElementById('putOpdId').value = newId;
            document.getElementById('deleteOpdId').value = newId;
        }
    }

    // Perangkat Daerah PUT
    async function testPutOpd() {
        const id = document.getElementById('putOpdId').value || 1;
        const getRes = await testApi('GET', `/api/perangkat-daerah/${id}`);
        if (!getRes.ok || !getRes.data?.data) {
            return;
        }

        const current = getRes.data.data;
        const updatePayload = {
            kode_opd: current.kode_opd,
            nama_instansi: current.nama_instansi,
            singkatan: current.singkatan,
            alamat: current.alamat,
            telepon: `(021) 555-${Math.floor(1000 + Math.random() * 9000)}`,
            nama_kepala: current.nama_kepala,
            nip_kepala: current.nip_kepala
        };

        await testApi('PUT', `/api/perangkat-daerah/${id}`, updatePayload);
    }

    // Custom Modal Confirmation for DELETE
    function openApiDeleteConfirm(type, inputId, baseUrl, entityLabel) {
        const targetId = document.getElementById(inputId).value || 1;
        pendingApiDeletePath = baseUrl + targetId;

        const desc = document.getElementById('apiDeleteModalDesc');
        desc.innerHTML = `Anda akan mengeksekusi request <code class="font-mono font-bold text-rose-700 bg-rose-50 px-1.5 py-0.5 rounded">DELETE ${pendingApiDeletePath}</code> untuk menghapus data <strong>${entityLabel} ID #${targetId}</strong>.`;

        const modal = document.getElementById('apiDeleteModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeApiDeleteModal() {
        pendingApiDeletePath = null;
        const modal = document.getElementById('apiDeleteModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    document.getElementById('confirmApiDeleteBtn').addEventListener('click', async function () {
        if (pendingApiDeletePath) {
            const pathToExecute = pendingApiDeletePath;
            closeApiDeleteModal();
            await testApi('DELETE', pathToExecute);
        }
    });

    // Copy Utilities
    function copyToClipboard(text, btn) {
        navigator.clipboard.writeText(text).then(() => {
            const originalHtml = btn.innerHTML;
            btn.innerHTML = `<svg class="w-3.5 h-3.5 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>`;
            setTimeout(() => { btn.innerHTML = originalHtml; }, 1800);
        });
    }

    function copyJsonOutput() {
        const jsonText = document.getElementById('jsonOutput').textContent;
        const btnText = document.getElementById('copyJsonBtnText');
        navigator.clipboard.writeText(jsonText).then(() => {
            btnText.textContent = 'Tersalin!';
            setTimeout(() => { btnText.textContent = 'Salin JSON'; }, 1800);
        });
    }

    function copyCurlOutput() {
        const curlText = document.getElementById('curlOutput').textContent.trim();
        const btnText = document.getElementById('copyCurlBtnText');
        navigator.clipboard.writeText(curlText).then(() => {
            btnText.textContent = 'Tersalin!';
            setTimeout(() => { btnText.textContent = 'Salin cURL'; }, 1800);
        });
    }
</script>
@endpush
