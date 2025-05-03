<!-- filepath: c:\Users\LENOVO\Desktop\Desktop FIL ROUGE\Lejob.ma\resources\views\layouts\consultant.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'LeJob.ma') }} - Espace Consultant</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="flex flex-col min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex-shrink-0 flex items-center">
                            <a href="{{ route('consultant.dashboard') }}">
                                <span class="text-lg font-bold">LeJob.ma</span>
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <a href="{{ route('consultant.dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('consultant.dashboard') ? 'border-black text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }}">
                                Dashboard
                            </a>
                            <a href="{{ route('consultant.bookings') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('consultant.bookings*') ? 'border-black text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }}">
                                Réservations
                            </a>
                            <a href="{{ route('consultant.availability') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('consultant.availability') ? 'border-black text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }}">
                                Disponibilités
                            </a>
                            <a href="{{ route('consultant.profile') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('consultant.profile*') ? 'border-black text-gray-900' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' }}">
                                Profil
                            </a>
                        </div>
                    </div>

                    <!-- User dropdown -->
                    <div class="hidden sm:flex sm:items-center sm:ml-6">
                        <div class="ml-3 relative">
                            <div>
                                <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    <span class="text-gray-700">{{ Auth::user()->name }}</span>
                                </button>
                            </div>
                            
                            <div class="ml-3">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="text-gray-500 hover:text-gray-700">
                                        Déconnexion
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile menu button -->
                    <div class="-mr-2 flex items-center sm:hidden">
                        <button type="button" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition" aria-controls="mobile-menu" aria-expanded="false">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Mobile menu -->
            <div class="sm:hidden" id="mobile-menu">
                <div class="pt-2 pb-3 space-y-1">
                    <a href="{{ route('consultant.dashboard') }}" class="block pl-3 pr-4 py-2 {{ request()->routeIs('consultant.dashboard') ? 'border-l-4 border-black text-black bg-black/5' : 'border-l-4 border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('consultant.bookings') }}" class="block pl-3 pr-4 py-2 {{ request()->routeIs('consultant.bookings*') ? 'border-l-4 border-black text-black bg-black/5' : 'border-l-4 border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }}">
                        Réservations
                    </a>
                    <a href="{{ route('consultant.availability') }}" class="block pl-3 pr-4 py-2 {{ request()->routeIs('consultant.availability') ? 'border-l-4 border-black text-black bg-black/5' : 'border-l-4 border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }}">
                        Disponibilités
                    </a>
                    <a href="{{ route('consultant.profile') }}" class="block pl-3 pr-4 py-2 {{ request()->routeIs('consultant.profile*') ? 'border-l-4 border-black text-black bg-black/5' : 'border-l-4 border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }}">
                        Profil
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}" class="block pl-3 pr-4 py-2">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-gray-800">
                            Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <main class="flex-grow">
            @if (session('success'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                    <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-green-700">
                                    {{ session('success') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
                    <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-700">
                                    {{ session('error') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-white border-t border-gray-200 mt-auto">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="text-center text-sm text-gray-500">
                    &copy; {{ date('Y') }} LeJob.ma - Tous droits réservés
                </div>
            </div>
        </footer>
    </div>

    @stack('scripts')
</body>
</html>