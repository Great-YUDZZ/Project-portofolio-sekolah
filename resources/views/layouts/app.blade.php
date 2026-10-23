<!DOCTYPE html>
<html lang="id" class="h-full scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Portal Resmi' }} | SMK Negeri 1 Denpasar</title>

    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="min-h-full flex flex-col bg-paper text-ink selection:bg-yellow-skensa selection:text-navy">
    {{-- Toast Notifikasi Global --}}
    @if(session('success'))
        <div class="fixed top-5 right-5 z-50 bg-navy text-white px-5 py-3 rounded-lg shadow-md border-l-4 border-yellow-skensa flex items-center space-x-3 transition-all" role="alert">
            <span class="font-medium text-sm">{{ session('success') }}</span>
        </div>
    @endif
    @if(session('warning'))
        <div class="fixed top-5 right-5 z-50 bg-yellow-skensa text-navy px-5 py-3 rounded-lg shadow-md border-l-4 border-navy flex items-center space-x-3 transition-all" role="alert">
            <span class="font-medium text-sm">{{ session('warning') }}</span>
        </div>
    @endif
    @if(session('info'))
        <div class="fixed top-5 right-5 z-50 bg-paper-2 text-ink px-5 py-3 rounded-lg shadow-md border border-line flex items-center space-x-3 transition-all" role="alert">
            <span class="font-medium text-sm">{{ session('info') }}</span>
        </div>
    @endif

    <div class="flex-1 flex flex-col">
        {{ $slot ?? '' }}
        @yield('content')
    </div>

    @livewireScripts
    @stack('scripts')
</body>
</html>
