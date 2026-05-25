<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SIMRS - Rawat Jalan')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 min-h-screen">

<nav class="bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-6 py-0">
        <div class="flex items-center h-14 gap-8">
            <a href="{{ route('kunjungan.index') }}" class="flex items-center gap-2 font-bold text-teal-700 text-lg shrink-0">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
                SIMRS
            </a>
            <div class="flex items-center gap-1">
                <a href="{{ route('kunjungan.index') }}"
                   class="px-3 py-1.5 rounded-md text-sm font-medium transition-colors
                          {{ request()->routeIs('kunjungan.*') ? 'bg-teal-50 text-teal-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                    Pendaftaran
                </a>
                <a href="{{ route('laporan.index') }}"
                   class="px-3 py-1.5 rounded-md text-sm font-medium transition-colors
                          {{ request()->routeIs('laporan.*') ? 'bg-teal-50 text-teal-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-100' }}">
                    Laporan
                </a>
            </div>
        </div>
    </div>
</nav>

<main class="max-w-7xl mx-auto px-6 py-8">

    @if(session('success'))
        <div class="mb-5 px-4 py-3 bg-teal-50 border border-teal-200 text-teal-800 rounded-lg text-sm flex items-center gap-2">
            <svg class="w-4 h-4 shrink-0 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-5 px-4 py-3 bg-red-50 border border-red-200 text-red-800 rounded-lg text-sm flex items-center gap-2">
            <svg class="w-4 h-4 shrink-0 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
            {{ session('error') }}
        </div>
    @endif

    @yield('content')

</main>

</body>
</html>
