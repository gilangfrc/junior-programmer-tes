<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIM-KDO') - Sistem Informasi Kendaraan Dinas Operasional BMD</title>
    
    <!-- Vite CSS & JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Heroicons / SVG support -->
    <style>
        @media print {
            .no-print { display: none !important; }
            .print-only { display: block !important; }
            body { background: white !important; color: black !important; }
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 font-sans min-h-screen flex flex-col antialiased">

    <!-- Top Navigation Bar -->
    <header class="bg-slate-900 text-white shadow-md border-b border-slate-800 sticky top-0 z-40 no-print">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Brand Logo & Title -->
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-500 flex items-center justify-center shadow-lg shadow-blue-500/30">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0" />
                        </svg>
                    </div>
                    <div>
                        <div class="flex items-center space-x-2">
                            <span class="font-extrabold text-lg tracking-tight text-white">SIM-KDO</span>
                            <span class="text-[10px] uppercase font-bold tracking-wider px-2 py-0.5 rounded-full bg-blue-500/20 text-blue-300 border border-blue-500/30">BMD Pemda</span>
                        </div>
                        <p class="text-xs text-slate-400">Pengelolaan Kendaraan Dinas Operasional</p>
                    </div>
                </div>

                <!-- Navigation Links -->
                <nav class="hidden md:flex items-center space-x-1">
                    <a href="{{ route('dashboard') }}" class="px-3.5 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('kendaraan-dinas.index') }}" class="px-3.5 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('kendaraan-dinas.*') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">
                        Kendaraan Dinas (KDO)
                    </a>
                    <a href="{{ route('pegawai.index') }}" class="px-3.5 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('pegawai.*') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">
                        Pegawai (PNS)
                    </a>
                    <a href="{{ route('perangkat-daerah.index') }}" class="px-3.5 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('perangkat-daerah.*') ? 'bg-blue-600 text-white' : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">
                        Perangkat Daerah (PD)
                    </a>
                    <a href="{{ route('api-docs') }}" class="ml-2 px-3 py-1.5 rounded-lg text-xs font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/30 hover:bg-emerald-500/20 transition-all flex items-center space-x-1.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span>REST API Tester</span>
                    </a>
                </nav>

                <!-- Action Button -->
                <div class="flex items-center space-x-3">
                    <a href="{{ route('kendaraan-dinas.create') }}" class="hidden sm:inline-flex items-center space-x-1.5 text-xs font-semibold px-3 py-2 rounded-lg bg-blue-600 hover:bg-blue-500 text-white transition-all shadow-md shadow-blue-600/30">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        <span>Tambah KDO</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu Bar -->
        <div class="md:hidden border-t border-slate-800 px-4 py-2 flex space-x-2 overflow-x-auto text-xs">
            <a href="{{ route('dashboard') }}" class="whitespace-nowrap px-3 py-1.5 rounded {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'text-slate-300' }}">Dashboard</a>
            <a href="{{ route('kendaraan-dinas.index') }}" class="whitespace-nowrap px-3 py-1.5 rounded {{ request()->routeIs('kendaraan-dinas.*') ? 'bg-blue-600 text-white' : 'text-slate-300' }}">Kendaraan (KDO)</a>
            <a href="{{ route('pegawai.index') }}" class="whitespace-nowrap px-3 py-1.5 rounded {{ request()->routeIs('pegawai.*') ? 'bg-blue-600 text-white' : 'text-slate-300' }}">Pegawai (PNS)</a>
            <a href="{{ route('perangkat-daerah.index') }}" class="whitespace-nowrap px-3 py-1.5 rounded {{ request()->routeIs('perangkat-daerah.*') ? 'bg-blue-600 text-white' : 'text-slate-300' }}">Perangkat Daerah</a>
            <a href="{{ route('api-docs') }}" class="whitespace-nowrap px-3 py-1.5 rounded bg-emerald-950 text-emerald-300 border border-emerald-800">REST API</a>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
        <!-- Toast / Flash Notifications -->
        @if(session('success'))
            <div class="mb-6 flex items-center p-4 bg-emerald-50 border border-emerald-200 text-emerald-900 rounded-xl shadow-sm no-print">
                <div class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center mr-3 flex-shrink-0">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
                <div class="text-sm font-medium">{{ session('success') }}</div>
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 flex items-center p-4 bg-rose-50 border border-rose-200 text-rose-900 rounded-xl shadow-sm no-print">
                <div class="w-8 h-8 rounded-full bg-rose-100 flex items-center justify-center mr-3 flex-shrink-0">
                    <svg class="w-5 h-5 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </div>
                <div class="text-sm font-medium">{{ session('error') }}</div>
            </div>
        @endif

        @if($errors->any())
            <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-900 rounded-xl shadow-sm no-print">
                <div class="flex items-center mb-2 font-semibold text-rose-800">
                    <svg class="w-5 h-5 mr-2 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    Terdapat kesalahan pengisian form:
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
    <footer class="bg-white border-t border-slate-200 py-6 text-center text-xs text-slate-500 no-print mt-auto">
        <div class="max-w-7xl mx-auto px-4 flex flex-col sm:flex-row items-center justify-between gap-2">
            <div>
                <strong>SIM-KDO</strong> &bull; Sistem Inventarisasi Kendaraan Dinas Operasional (Barang Milik Daerah)
            </div>
            <div class="text-slate-400">
                Ujian Praktik Junior Programmer &bull; Laravel 11 + Tailwind CSS + MySQL
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
