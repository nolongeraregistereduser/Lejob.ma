<nav class="px-[5%] py-4 flex justify-between items-center bg-white shadow-sm">
    <div class="text-2xl font-bold">
        <a href="/">LeJob</a>
    </div>
    <div class="flex gap-8 items-center">
        <a href="/" class="text-gray-800 hover:text-gray-600">Accueil</a>
        <a href="/cv-builder" class="text-gray-800 hover:text-gray-600">CV Builder</a>
        <a href="/jobs" class="text-gray-800 hover:text-gray-600">Offres</a>
        <a href="/booking" class="text-gray-800 hover:text-gray-600">Booking</a>
        
        @guest
            <a href="/login" class="text-gray-800 hover:text-gray-600">Connexion</a>
            <a href="/register" class="bg-gray-800 text-white px-6 py-2 rounded-full hover:bg-gray-700">Je m'inscris</a>
        @else
            <!-- User Profile Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" type="button" class="flex items-center space-x-2 focus:outline-none">
                    <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center overflow-hidden">
                        @if(auth()->user()->profile_picture)
                            <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="{{ auth()->user()->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="text-gray-500 text-lg font-semibold">{{ substr(auth()->user()->name ?? 'U', 0, 1) }}</div>
                        @endif
                    </div>
                    <div class="hidden md:flex md:flex-col">
                        <span class="text-sm font-medium">{{ auth()->user()->name }}</span>
                        <span class="text-xs text-gray-500">{{ auth()->user()->title ?? 'Membre' }}</span>
                    </div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
                
                <!-- Dropdown Menu -->
                <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" 
                     x-transition:enter-start="transform opacity-0 scale-95" 
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75" 
                     x-transition:leave-start="transform opacity-100 scale-100" 
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                    
                    @if(auth()->user()->role === 'consultant')
                        <a href="/consultant/dashboard" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Dashboard
                        </a>
                        <a href="/consultant/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Modifier le profil
                        </a>
                        <a href="/consultant/bookings" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Mes Réservations
                        </a>
                        <a href="/consultant/availability" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Disponibilités
                        </a>
                    @elseif(auth()->user()->role === 'client')
                        <a href="/client/dashboard" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Dashboard
                        </a>
                        <a href="/client/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Modifier le profil
                        </a>
                    @else
                        <a href="/dashboard" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Dashboard
                        </a>
                        <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Modifier le profil
                        </a>
                    @endif
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        @endguest
    </div>
</nav>

<!-- Make sure Alpine.js is loaded in your layout -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof Alpine === 'undefined') {
            // If Alpine.js is not loaded, load it
            const script = document.createElement('script');
            script.src = 'https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js';
            script.defer = true;
            document.head.appendChild(script);
        }
    });
</script>
