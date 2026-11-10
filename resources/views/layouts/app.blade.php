<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIM-KDO') - Sistem Informasi Kendaraan Dinas Operasional BMD</title>
    
    <!-- Vite CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Smooth transitions for all interactive elements */
        input, select, textarea, button, a {
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
        }

        /* Custom soft focus styling */
        .form-control-smooth {
            transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
            border-color: #e2e8f0;
            background-color: #ffffff;
        }
        .form-control-smooth:hover {
            border-color: #cbd5e1;
        }
        .form-control-smooth:focus {
            outline: none;
            border-color: #3b82f6 !important;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.14) !important;
            background-color: #ffffff !important;
        }

        /* Plat Merah preview badge styling */
        .plat-merah-badge {
            background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
            border: 2px solid #991b1b;
            color: #ffffff;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
            font-weight: 800;
            letter-spacing: 0.1em;
            text-shadow: 0 1px 2px rgba(0,0,0,0.5);
            box-shadow: 0 4px 6px -1px rgba(185, 28, 28, 0.3), inset 0 1px 1px rgba(255, 255, 255, 0.3);
        }

        @media print {
            .no-print { display: none !important; }
            .print-only { display: block !important; }
            body { background: white !important; color: black !important; }
        }
    </style>
</head>
<body class="bg-slate-50/70 text-slate-900 font-sans min-h-screen flex antialiased">

    <!-- Mobile Sidebar Backdrop -->
    <div id="sidebarBackdrop" onclick="toggleSidebar()" class="fixed inset-0 bg-slate-950/60 z-40 hidden lg:hidden transition-opacity duration-300 no-print"></div>

    <!-- Sidebar Navigation (Fixed on Desktop, Drawer on Mobile) -->
    <aside id="sidebar" class="fixed inset-y-0 left-0 z-40 w-64 h-screen bg-slate-900 text-slate-300 flex flex-col border-r border-slate-800 transition-transform duration-300 ease-in-out -translate-x-full lg:translate-x-0 no-print flex-shrink-0">
        
        <!-- Sidebar Brand Header -->
        <div class="h-16 px-5 border-b border-slate-800 flex items-center justify-between flex-shrink-0">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-500 flex items-center justify-center shadow-lg shadow-blue-500/25 group-hover:scale-105 transition-transform">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                    </svg>
                </div>
                <div>
                    <div class="flex items-center space-x-1.5">
                        <span class="font-black text-base tracking-tight text-white">SIM-KDO</span>
                        <span class="text-[9px] uppercase font-bold tracking-wider px-1.5 py-0.5 rounded bg-blue-500/20 text-blue-300 border border-blue-500/30">BMD</span>
                    </div>
                    <p class="text-[11px] text-slate-400">Pemerintah Daerah</p>
                </div>
            </a>

            <!-- Mobile Close Button -->
            <button onclick="toggleSidebar()" class="lg:hidden text-slate-400 hover:text-white p-1 rounded-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        <!-- Sidebar Navigation Links -->
        <div class="flex-1 px-3 py-4 space-y-6 overflow-y-auto">
            <!-- Section 1: Menu Utama -->
            <div>
                <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-2">Menu Utama</p>
                <nav class="space-y-1">
                    <!-- Dashboard -->
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/30 font-bold' : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">
                        <svg class="w-4 h-4 {{ request()->routeIs('dashboard') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span>Dashboard Eksekutif</span>
                    </a>

                    <!-- Kendaraan Dinas (KDO) -->
                    <a href="{{ route('kendaraan-dinas.index') }}" class="flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('kendaraan-dinas.*') && !request()->routeIs('kendaraan-dinas.cetak') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/30 font-bold' : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">
                        <div class="flex items-center space-x-3">
                            <svg class="w-4 h-4 {{ request()->routeIs('kendaraan-dinas.*') && !request()->routeIs('kendaraan-dinas.cetak') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1" />
                            </svg>
                            <span>Kendaraan Dinas (KDO)</span>
                        </div>
                        <span class="text-[10px] font-bold px-1.5 py-0.5 rounded-full {{ request()->routeIs('kendaraan-dinas.*') && !request()->routeIs('kendaraan-dinas.cetak') ? 'bg-white/20 text-white' : 'bg-slate-800 text-slate-400' }}">
                            {{ \App\Models\KendaraanDinas::count() }}
                        </span>
                    </a>

                    <!-- Pegawai (PNS) -->
                    <a href="{{ route('pegawai.index') }}" class="flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('pegawai.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/30 font-bold' : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">
                        <div class="flex items-center space-x-3">
                            <svg class="w-4 h-4 {{ request()->routeIs('pegawai.*') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span>Pegawai (PNS)</span>
                        </div>
                        <span class="text-[10px] font-bold px-1.5 py-0.5 rounded-full {{ request()->routeIs('pegawai.*') ? 'bg-white/20 text-white' : 'bg-slate-800 text-slate-400' }}">
                            {{ \App\Models\Pegawai::count() }}
                        </span>
                    </a>

                    <!-- Perangkat Daerah (PD) -->
                    <a href="{{ route('perangkat-daerah.index') }}" class="flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('perangkat-daerah.*') ? 'bg-blue-600 text-white shadow-md shadow-blue-600/30 font-bold' : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">
                        <div class="flex items-center space-x-3">
                            <svg class="w-4 h-4 {{ request()->routeIs('perangkat-daerah.*') ? 'text-white' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <span>Perangkat Daerah (PD)</span>
                        </div>
                        <span class="text-[10px] font-bold px-1.5 py-0.5 rounded-full {{ request()->routeIs('perangkat-daerah.*') ? 'bg-white/20 text-white' : 'bg-slate-800 text-slate-400' }}">
                            {{ \App\Models\PerangkatDaerah::count() }}
                        </span>
                    </a>
                </nav>
            </div>

            <!-- Section 2: Pelaporan & Utilitas -->
            <div>
                <p class="px-3 text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-2">Pelaporan & Pengujian</p>
                <nav class="space-y-1">
                    <!-- Cetak Rekap BMD -->
                    <a href="{{ route('kendaraan-dinas.cetak') }}" target="_blank" class="flex items-center space-x-3 px-3 py-2.5 rounded-xl text-xs font-semibold text-slate-300 hover:text-white hover:bg-slate-800 transition-all">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                        </svg>
                        <span>Cetak Rekap BMD</span>
                    </a>

                    <!-- REST API Tester -->
                    <a href="{{ route('api-docs') }}" class="flex items-center justify-between px-3 py-2.5 rounded-xl text-xs font-semibold transition-all {{ request()->routeIs('api-docs') ? 'bg-emerald-600 text-white font-bold' : 'text-emerald-400 hover:bg-emerald-950/40 bg-emerald-950/20 border border-emerald-800/40' }}">
                        <div class="flex items-center space-x-3">
                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                            </svg>
                            <span>REST API Tester</span>
                        </div>
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    </a>
                </nav>
            </div>
        </div>

        <!-- Sidebar Footer Status -->
        <div class="p-3.5 border-t border-slate-800 bg-slate-950/40 flex-shrink-0">
            <div class="flex items-center space-x-2.5 px-2 py-1.5 rounded-lg bg-slate-800/40 text-[11px]">
                <div class="w-2 h-2 rounded-full bg-emerald-400"></div>
                <div class="text-slate-400 truncate">
                    <span class="font-semibold text-slate-300">MySQL Database</span>: pusadatin_tes
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content Area Wrapper (Offset by Sidebar Width on Desktop) -->
    <div class="lg:pl-64 flex-1 flex flex-col min-w-0 min-h-screen">
        
        <!-- Sticky Top Bar (Info Umum Sistem, Tanggal & Operator BMD) -->
        <header class="h-16 bg-white/95 backdrop-blur-md border-b border-slate-200/80 sticky top-0 z-30 px-4 sm:px-6 lg:px-8 flex items-center justify-between no-print">
            <div class="flex items-center space-x-3">
                <!-- Hamburger Button for Mobile -->
                <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 focus:outline-none transition-colors" aria-label="Toggle Menu">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>

                <!-- General System Info -->
                <div class="flex items-center space-x-2.5">
                    <div class="w-2.5 h-2.5 rounded-full bg-blue-600 ring-4 ring-blue-100"></div>
                    <div>
                        <div class="flex items-center space-x-2">
                            <span class="text-xs font-black tracking-tight text-slate-900">Sistem Pengelolaan KDO</span>
                            <span class="text-[10px] uppercase font-bold px-1.5 py-0.5 rounded bg-blue-50 text-blue-700 border border-blue-200">BMD Pemda</span>
                        </div>
                        <p class="text-[11px] text-slate-400 hidden sm:block">Inventarisasi & Pengawasan Fisik Kendaraan Operasional</p>
                    </div>
                </div>
            </div>

            <!-- Header Right: Info Umum (Tanggal, Status Database, Operator) -->
            <div class="flex items-center space-x-3">
                <!-- Tanggal Hari Ini -->
                <div class="hidden md:flex items-center space-x-2 px-3 py-1.5 rounded-xl bg-slate-50 border border-slate-200/80 text-xs text-slate-600">
                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    <span class="font-medium">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
                </div>

                <!-- Database Status Badge -->
                <div class="hidden sm:flex items-center space-x-2 px-3 py-1.5 rounded-xl bg-emerald-50/80 border border-emerald-200/80 text-xs">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="text-[11px] font-bold text-emerald-800">MySQL Online</span>
                </div>

                <!-- Operator Profile Badge -->
                <div class="flex items-center space-x-2.5 pl-2 sm:border-l sm:border-slate-200">
                    <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-slate-900 to-blue-900 text-white flex items-center justify-center font-black text-xs shadow-sm">
                        AD
                    </div>
                    <div class="hidden sm:block text-left">
                        <div class="text-xs font-bold text-slate-900 leading-tight">Admin BMD</div>
                        <div class="text-[10px] text-slate-400 leading-tight font-medium">Pengurus Barang Pengelola</div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Body Content -->
        <main class="flex-1 p-4 sm:p-6 lg:p-8 max-w-7xl w-full mx-auto">
            <!-- Flash Notifications -->
            @if(session('success'))
                <div class="mb-6 flex items-center p-4 bg-emerald-50 border border-emerald-200 text-emerald-900 rounded-2xl shadow-sm no-print">
                    <div class="w-8 h-8 rounded-xl bg-emerald-100 flex items-center justify-center mr-3 flex-shrink-0 text-emerald-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </div>
                    <div class="text-sm font-semibold">{{ session('success') }}</div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 flex items-center p-4 bg-rose-50 border border-rose-200 text-rose-900 rounded-2xl shadow-sm no-print">
                    <div class="w-8 h-8 rounded-xl bg-rose-100 flex items-center justify-center mr-3 flex-shrink-0 text-rose-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </div>
                    <div class="text-sm font-semibold">{{ session('error') }}</div>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-900 rounded-2xl shadow-sm no-print">
                    <div class="flex items-center mb-2 font-bold text-rose-800 text-sm">
                        <svg class="w-5 h-5 mr-2 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                        Mohon periksa kesalahan input berikut:
                    </div>
                    <ul class="list-disc list-inside text-xs text-rose-700 space-y-1">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-slate-200/80 py-4 px-6 text-center text-xs text-slate-500 no-print mt-auto">
            <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-2">
                <div>
                    <strong>SIM-KDO</strong> &bull; Sistem Inventarisasi Kendaraan Dinas Operasional (Barang Milik Daerah)
                </div>
                <div class="text-slate-400">
                    Ujian Praktik Junior Programmer &bull; Laravel 11 + Tailwind CSS + MySQL
                </div>
            </div>
        </footer>
    </div>

    <!-- Mobile Sidebar Toggle Script -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const backdrop = document.getElementById('sidebarBackdrop');
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                backdrop.classList.remove('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
                backdrop.classList.add('hidden');
            }
        }
    </script>

    <!-- Global Reusable Delete Confirmation Modal -->
    @include('components.delete-modal')

    @stack('scripts')
</body>
</html>
