<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'LeJob.ma') }} - @yield('title', 'Dashboard')</title>
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    @vite('resources/js/app.js')
    
    @stack('styles')
</head>
<body class="bg-gray-100 font-sans">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-md h-full">
            <div class="px-6 py-4 border-b">
                <h1 class="text-2xl font-bold text-black">LeJob.ma</h1>
            </div>
            
            <div class="p-4">
                <p class="text-gray-600 mb-2">Welcome, {{ Auth::user()->name }}</p>
                <div class="bg-gray-200 rounded-full py-1 px-3 text-sm mb-6">
                    <span class="text-gray-700 capitalize">{{ Auth::user()->role }}</span>
                </div>
            </div>
            
            <nav class="mt-2">
                @include('partials.sidebar')
            </nav>
        </div>
        
        <!-- Main Content -->
        <div class="flex-1 overflow-x-hidden overflow-y-auto">
            <!-- Top Navigation -->
            <div class="bg-white p-4 shadow-sm flex justify-between items-center">
                <h2 class="text-xl font-semibold">@yield('page-title', 'Dashboard')</h2>
                
                <div class="flex items-center">
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center text-gray-700 focus:outline-none">
                            <span class="mr-2">{{ Auth::user()->name }}</span>
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1">
                            <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Page Content -->
            <div class="p-6">
                @if(session('success'))
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                        <p>{{ session('success') }}</p>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
                        <p>{{ session('error') }}</p>
                    </div>
                @endif
                
                @yield('content')
            </div>
        </div>
    </div>
    
    @stack('scripts')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
</body>
</html>