@extends('layouts.app')

@section('title', 'Dokumentasi REST API & Interactive Tester')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <div class="flex items-center space-x-2">
                <span class="text-xs font-bold uppercase tracking-wider text-blue-600 bg-blue-50 px-2.5 py-1 rounded-full border border-blue-200">
                    RESTful API v1
                </span>
                <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Dokumentasi & Interactive API Tester</h1>
            </div>
            <p class="text-sm text-slate-500 mt-1">Uji coba langsung seluruh endpoint REST API Kendaraan Dinas Operasional (KDO - BMD).</p>
        </div>
        <div class="flex items-center space-x-2">
            <span class="text-xs px-3 py-1.5 rounded-lg bg-slate-900 text-slate-200 font-mono">
                Base URL: <strong class="text-emerald-400">{{ url('/api') }}</strong>
            </span>
        </div>
    </div>

    <!-- Instructions / Guide Card -->
    <div class="bg-gradient-to-r from-slate-900 to-indigo-950 text-white rounded-2xl p-5 shadow-md">
        <div class="flex items-start space-x-3">
            <div class="w-8 h-8 rounded-lg bg-blue-500/20 text-blue-400 flex items-center justify-center flex-shrink-0 mt-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <h3 class="font-bold text-sm text-white">Petunjuk Pengujian API untuk Penilai / Penguji</h3>
                <p class="text-xs text-slate-300 mt-1 leading-relaxed">
                    Klik tombol <strong>"Eksekusi / Test Endpoint"</strong> pada kartu di bawah untuk mengirimkan HTTP Request secara real-time. Console di sebelah kanan akan langsung menampilkan status HTTP Code (misal: <code>200 OK</code>, <code>201 Created</code>), waktu respon (latency), dan JSON payload yang terstruktur. Anda juga dapat menggunakan <strong>cURL</strong> atau <strong>Postman</strong> dengan menyalin URL endpoint yang tersedia.
                </p>
            </div>
        </div>
    </div>

    <!-- Main Grid: Endpoint Cards (Left) & Live Console Result (Right) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <!-- Endpoint List (7 Cols) -->
        <div class="lg:col-span-7 space-y-4">
            
            <!-- Group 1: Dashboard Stats -->
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-4 space-y-3">
                <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Statistik Eksekutif</span>
                    <span class="text-[11px] text-slate-400">BMD Overview</span>
                </div>
                
                <div class="p-3 rounded-xl border border-slate-200 bg-slate-50/50 flex items-center justify-between gap-3">
                    <div class="flex items-center space-x-2">
                        <span class="px-2 py-0.5 rounded text-[11px] font-bold font-mono bg-blue-100 text-blue-800">GET</span>
                        <code class="text-xs font-mono font-semibold text-slate-800">/api/dashboard/stats</code>
                    </div>
                    <button onclick="testApi('GET', '/api/dashboard/stats')" class="px-3 py-1.5 rounded-lg bg-blue-600 hover:bg-blue-500 text-white text-xs font-semibold shadow-sm transition-all">
                        Test Endpoint
                    </button>
                </div>
            </div>

            <!-- Group 2: Kendaraan Dinas (KDO) -->
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-4 space-y-3">
                <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Kendaraan Dinas Operasional (KDO)</span>
                </div>

                <!-- GET /api/kendaraan-dinas -->
                <div class="p-3 rounded-xl border border-slate-200 bg-slate-50/50 space-y-2">
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center space-x-2">
                            <span class="px-2 py-0.5 rounded text-[11px] font-bold font-mono bg-blue-100 text-blue-800">GET</span>
                            <code class="text-xs font-mono font-semibold text-slate-800">/api/kendaraan-dinas</code>
                        </div>
                        <button onclick="testApi('GET', '/api/kendaraan-dinas')" class="px-3 py-1.5 rounded-lg bg-blue-600 hover:bg-blue-500 text-white text-xs font-semibold shadow-sm transition-all">
                            Test Endpoint
                        </button>
                    </div>
                    <p class="text-[11px] text-slate-500">Mendapatkan seluruh daftar armada kendaraan dinas beserta relasi OPD dan PNS.</p>
                </div>

                <!-- GET /api/kendaraan-dinas with Filter Rusak -->
                <div class="p-3 rounded-xl border border-slate-200 bg-slate-50/50 space-y-2">
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center space-x-2">
                            <span class="px-2 py-0.5 rounded text-[11px] font-bold font-mono bg-blue-100 text-blue-800">GET</span>
                            <code class="text-xs font-mono font-semibold text-slate-800">/api/kendaraan-dinas?kondisi=Rusak+Ringan</code>
                        </div>
                        <button onclick="testApi('GET', '/api/kendaraan-dinas?kondisi=Rusak+Ringan')" class="px-3 py-1.5 rounded-lg bg-blue-600 hover:bg-blue-500 text-white text-xs font-semibold shadow-sm transition-all">
                            Test Filter
                        </button>
                    </div>
                    <p class="text-[11px] text-slate-500">Filter cepat untuk memantau unit yang membutuhkan perbaikan (Rusak Ringan).</p>
                </div>

                <!-- GET /api/kendaraan-dinas/1 (Detail) -->
                <div class="p-3 rounded-xl border border-slate-200 bg-slate-50/50 space-y-2">
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center space-x-2">
                            <span class="px-2 py-0.5 rounded text-[11px] font-bold font-mono bg-blue-100 text-blue-800">GET</span>
                            <code class="text-xs font-mono font-semibold text-slate-800">/api/kendaraan-dinas/1</code>
                        </div>
                        <button onclick="testApi('GET', '/api/kendaraan-dinas/1')" class="px-3 py-1.5 rounded-lg bg-blue-600 hover:bg-blue-500 text-white text-xs font-semibold shadow-sm transition-all">
                            Test Detail
                        </button>
                    </div>
                    <p class="text-[11px] text-slate-500">Detail 1 unit KDO mencakup spesifikasi, penanggung jawab, dan riwayat kondisi.</p>
                </div>

                <!-- POST /api/kendaraan-dinas -->
                <div class="p-3 rounded-xl border border-slate-200 bg-slate-50/50 space-y-2">
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center space-x-2">
                            <span class="px-2 py-0.5 rounded text-[11px] font-bold font-mono bg-emerald-100 text-emerald-800">POST</span>
                            <code class="text-xs font-mono font-semibold text-slate-800">/api/kendaraan-dinas</code>
                        </div>
                        <button onclick="testPostKdo()" class="px-3 py-1.5 rounded-lg bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-semibold shadow-sm transition-all">
                            Test Create (201)
                        </button>
                    </div>
                    <p class="text-[11px] text-slate-500">Menambahkan kendaraan dinas operasional baru dengan validasi otomatis.</p>
                </div>
            </div>

            <!-- Group 3: Pegawai (PNS) -->
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-4 space-y-3">
                <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Pegawai Negeri Sipil (PNS)</span>
                </div>

                <!-- GET /api/pegawai -->
                <div class="p-3 rounded-xl border border-slate-200 bg-slate-50/50 flex items-center justify-between gap-3">
                    <div class="flex items-center space-x-2">
                        <span class="px-2 py-0.5 rounded text-[11px] font-bold font-mono bg-blue-100 text-blue-800">GET</span>
                        <code class="text-xs font-mono font-semibold text-slate-800">/api/pegawai</code>
                    </div>
                    <button onclick="testApi('GET', '/api/pegawai')" class="px-3 py-1.5 rounded-lg bg-blue-600 hover:bg-blue-500 text-white text-xs font-semibold shadow-sm transition-all">
                        Test Endpoint
                    </button>
                </div>

                <!-- GET /api/pegawai/1 -->
                <div class="p-3 rounded-xl border border-slate-200 bg-slate-50/50 flex items-center justify-between gap-3">
                    <div class="flex items-center space-x-2">
                        <span class="px-2 py-0.5 rounded text-[11px] font-bold font-mono bg-blue-100 text-blue-800">GET</span>
                        <code class="text-xs font-mono font-semibold text-slate-800">/api/pegawai/1</code>
                    </div>
                    <button onclick="testApi('GET', '/api/pegawai/1')" class="px-3 py-1.5 rounded-lg bg-blue-600 hover:bg-blue-500 text-white text-xs font-semibold shadow-sm transition-all">
                        Test Detail
                    </button>
                </div>
            </div>

            <!-- Group 4: Perangkat Daerah (PD) -->
            <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-4 space-y-3">
                <div class="flex items-center justify-between pb-2 border-b border-slate-100">
                    <span class="text-xs font-bold text-slate-500 uppercase tracking-wider">Perangkat Daerah (PD / OPD)</span>
                </div>

                <!-- GET /api/perangkat-daerah -->
                <div class="p-3 rounded-xl border border-slate-200 bg-slate-50/50 flex items-center justify-between gap-3">
                    <div class="flex items-center space-x-2">
                        <span class="px-2 py-0.5 rounded text-[11px] font-bold font-mono bg-blue-100 text-blue-800">GET</span>
                        <code class="text-xs font-mono font-semibold text-slate-800">/api/perangkat-daerah</code>
                    </div>
                    <button onclick="testApi('GET', '/api/perangkat-daerah')" class="px-3 py-1.5 rounded-lg bg-blue-600 hover:bg-blue-500 text-white text-xs font-semibold shadow-sm transition-all">
                        Test Endpoint
                    </button>
                </div>

                <!-- GET /api/perangkat-daerah/1 -->
                <div class="p-3 rounded-xl border border-slate-200 bg-slate-50/50 flex items-center justify-between gap-3">
                    <div class="flex items-center space-x-2">
                        <span class="px-2 py-0.5 rounded text-[11px] font-bold font-mono bg-blue-100 text-blue-800">GET</span>
                        <code class="text-xs font-mono font-semibold text-slate-800">/api/perangkat-daerah/1</code>
                    </div>
                    <button onclick="testApi('GET', '/api/perangkat-daerah/1')" class="px-3 py-1.5 rounded-lg bg-blue-600 hover:bg-blue-500 text-white text-xs font-semibold shadow-sm transition-all">
                        Test Detail
                    </button>
                </div>
            </div>
        </div>

        <!-- Live Response Console (5 Cols) -->
        <div class="lg:col-span-5">
            <div class="bg-slate-900 rounded-2xl border border-slate-800 shadow-xl overflow-hidden sticky top-24">
                <!-- Console Top Header -->
                <div class="p-3.5 bg-slate-950 border-b border-slate-800 flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <span class="w-3 h-3 rounded-full bg-rose-500"></span>
                        <span class="w-3 h-3 rounded-full bg-amber-500"></span>
                        <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
                        <span class="text-xs font-mono font-bold text-slate-400 ml-2">Live Response Console</span>
                    </div>
                    <div id="statusBadge" class="hidden text-xs font-mono font-bold px-2.5 py-0.5 rounded-full">
                        200 OK
                    </div>
                </div>

                <!-- Request Info -->
                <div class="p-3 bg-slate-900/90 border-b border-slate-800 text-[11px] font-mono text-slate-400 flex items-center justify-between">
                    <span id="requestMethodUrl">Menunggu eksekusi endpoint...</span>
                    <span id="responseDuration" class="text-emerald-400"></span>
                </div>

                <!-- JSON Body Output -->
                <div class="p-4 overflow-x-auto max-h-[500px]">
                    <pre id="jsonOutput" class="text-xs font-mono text-emerald-400 leading-relaxed whitespace-pre-wrap">// Klik salah satu tombol "Test Endpoint" di sebelah kiri untuk melihat hasil respon API...</pre>
                </div>

                <!-- cURL Command Box -->
                <div class="p-3 bg-slate-950 border-t border-slate-800">
                    <span class="text-[10px] uppercase font-bold text-slate-500 block mb-1">Equivalent cURL Command:</span>
                    <code id="curlOutput" class="text-[11px] font-mono text-slate-300 block bg-slate-900 p-2 rounded border border-slate-800 break-all select-all">
                        curl -X GET "{{ url('/api/dashboard/stats') }}" -H "Accept: application/json"
                    </code>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
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
                    'X-Requested-With': 'XMLHttpRequest'
                }
            };
            if (body) {
                options.body = JSON.stringify(body);
            }

            const response = await fetch(fullUrl, options);
            const endTime = performance.now();
            const duration = Math.round(endTime - startTime);
            const data = await response.json();

            // Status Badge
            statusBadge.classList.remove('hidden', 'bg-emerald-500/20', 'text-emerald-400', 'bg-rose-500/20', 'text-rose-400');
            if (response.ok) {
                statusBadge.className = 'text-xs font-mono font-bold px-2.5 py-0.5 rounded-full bg-emerald-500/20 text-emerald-400 border border-emerald-500/30';
                statusBadge.textContent = `${response.status} ${response.statusText || 'OK'}`;
            } else {
                statusBadge.className = 'text-xs font-mono font-bold px-2.5 py-0.5 rounded-full bg-rose-500/20 text-rose-400 border border-rose-500/30';
                statusBadge.textContent = `${response.status} ${response.statusText || 'Error'}`;
            }

            durationInfo.textContent = `${duration} ms`;
            jsonOutput.textContent = JSON.stringify(data, null, 2);

        } catch (error) {
            statusBadge.className = 'text-xs font-mono font-bold px-2.5 py-0.5 rounded-full bg-rose-500/20 text-rose-400';
            statusBadge.textContent = 'Network Error';
            jsonOutput.textContent = `// Error: ${error.message}`;
            durationInfo.textContent = '-';
        }
    }

    function testPostKdo() {
        const randomNum = Math.floor(1000 + Math.random() * 9000);
        const newVehicle = {
            perangkat_daerah_id: 1,
            penanggung_jawab_id: 1,
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
            keterangan: "Pengujian tambah data unit kendaraan baru melalui automated API Tester."
        };

        testApi('POST', '/api/kendaraan-dinas', newVehicle);
    }
</script>
@endpush
