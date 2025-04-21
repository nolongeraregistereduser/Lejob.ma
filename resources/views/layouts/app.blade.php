<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LeJob.ma') }} - @yield('title', 'Dashboard')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    @viteReactRefresh
    @vite('resources/css/app.css')
    
    <!-- Additional Styles -->
    @stack('styles')
</head>
<body class="font-[Quicksand] bg-gray-50 min-h-screen flex flex-col">
    <!-- Navbar -->
    @include('components.navbar')
    
    <!-- Main Content -->
    <div class="flex flex-1">
        <!-- Sidebar (only on dashboard pages) -->
        @if(request()->segment(1) == 'dashboard' || request()->segment(1) == 'profile')
            @includeIf('layouts.sidebar')
        @endif
        
        <!-- Page Content -->
        <main class="flex-1 p-6">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif
            
            @yield('content')
        </main>
    </div>
    
    <!-- Footer -->
    @include('components.footer')
    
    <!-- Scripts -->
    @viteReactRefresh
    @vite('resources/js/app.js')
    @stack('scripts')
    @yield('scripts')
</body>
</html>

