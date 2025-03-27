<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion - LeJob.ma</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&family=Crafty+Girls&display=swap" rel="stylesheet">
    
    @vite('resources/css/app.css')
    <style>
        .crafty-font {
            font-family: 'Crafty Girls', cursive;
        }
    </style>
</head>
<body class="font-[Quicksand] bg-white">
    @include('components.navbar')

    <main class="min-h-screen flex items-center justify-center px-4 sm:px-6 py-12 sm:py-20 relative overflow-hidden">
        <!-- Left Decorative Leaf -->
        <div class="absolute left-0 top-0 hidden sm:block">
            <img src="{{ asset('images/sing-up-left-removebg-preview.png') }}" alt="" class="w-72 mix-blend-multiply">
        </div>

        <!-- Right Decorative Leaf -->
        <div class="absolute right-0 bottom-0 hidden sm:block">
            <img src="{{ asset('images/sing-up-right.png') }}" alt="" class="w-72">
        </div>

        <!-- Central Content -->
        <div class="max-w-md w-full mx-auto z-10">
            <h1 class="text-2xl sm:text-4xl font-bold mb-6 sm:mb-8 text-center px-4">
                Bienvenue sur LeJob.ma
            </h1>
            
            <div class="bg-white p-6 sm:p-8 rounded-xl">
                <h2 class="text-xl sm:text-2xl font-bold mb-4 sm:mb-6">Connexion</h2>
                
                @if ($errors->any())
                    <div class="mb-4 p-4 rounded-lg bg-red-50 border border-red-500">
                        <ul class="list-disc list-inside text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="mb-4 p-4 rounded-lg bg-green-50 border border-green-500">
                        <p class="text-green-600">{{ session('success') }}</p>
                    </div>
                @endif
                
                <form class="space-y-4 sm:space-y-6" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div>
                        <input type="email" 
                            name="email"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-black focus:border-transparent @error('email') border-red-500 @enderror"
                            placeholder="Adresse e-mail"
                            value="{{ old('email') }}"
                            required>
                    </div>

                    <div>
                        <input type="password" 
                            name="password"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-black focus:border-transparent"
                            placeholder="Mot de passe"
                            required>
                    </div>

                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="rounded border-gray-300 text-black focus:ring-black">
                            <span class="ml-2 text-sm">Se souvenir de moi</span>
                        </label>
                        <a href="/forgot-password" class="text-sm text-black hover:underline">
                            Mot de passe oublié ?
                        </a>
                    </div>

                    <button type="submit" 
                        class="w-full bg-black text-white py-3 rounded-lg hover:bg-gray-800 transition-colors">
                        Se connecter
                    </button>

                    <p class="text-sm text-center">
                        Pas encore de compte ? 
                        <a href="{{ route('register') }}" class="text-black hover:underline">Inscrivez-vous</a>
                    </p>
                </form>
            </div>
        </div>
    </main>

    @include('components.footer')

    <!-- Decorative elements for mobile -->
    <div class="fixed top-0 left-0 w-24 h-24 md:hidden">
        <div class="w-full h-full border-l-2 border-t-2 border-black rounded-tl-3xl"></div>
    </div>
    <div class="fixed bottom-0 right-0 w-24 h-24 md:hidden">
        <div class="w-full h-full border-r-2 border-b-2 border-black rounded-br-3xl"></div>
    </div>
</body>
</html>