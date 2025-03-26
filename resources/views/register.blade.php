<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inscription - LeJob.ma</title>
    
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
                Révolutionnez Votre Recherche d'Emploi avec LeJob.ma
            </h1>
            
            <div class="bg-white p-6 sm:p-8 rounded-xl">
                <h2 class="text-xl sm:text-2xl font-bold mb-4 sm:mb-6">Inscription</h2>
                
                <form class="space-y-4 sm:space-y-6" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div>
                        <input type="text" 
                            name="name"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-black focus:border-transparent @error('name') border-red-500 @enderror"
                            placeholder="Nom complet *"
                            value="{{ old('name') }}"
                            required>
                    </div>

                    <div>
                        <input type="email" 
                            name="email"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-black focus:border-transparent @error('email') border-red-500 @enderror"
                            placeholder="Adresse e-mail *"
                            value="{{ old('email') }}"
                            required>
                    </div>

                    <div>
                        <input type="password" 
                            name="password"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-black focus:border-transparent @error('password') border-red-500 @enderror"
                            placeholder="Mot de passe *"
                            required
                            minlength="8">
                    </div>

                    <div>
                        <input type="password" 
                            name="password_confirmation"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-black focus:border-transparent"
                            placeholder="Confirmez le mot de passe *"
                            required>
                    </div>

                    <div>
                        <input type="tel" 
                            name="phone"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-black focus:border-transparent @error('phone') border-red-500 @enderror"
                            placeholder="Numéro de téléphone (facultatif)"
                            value="{{ old('phone') }}"
                            pattern="[0-9]{10}">
                    </div>

                    <div>
                        <select name="role" 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-black focus:border-transparent @error('role') border-red-500 @enderror"
                            required>
                            <option value="" disabled selected>Choisissez votre rôle *</option>
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>Chercheur d'emploi</option>
                            <option value="consultant" {{ old('role') == 'consultant' ? 'selected' : '' }}>Consultant</option>
                        </select>
                    </div>

                    @if ($errors->any())
                        <div class="bg-red-50 text-red-500 p-4 rounded-lg">
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <button type="submit" 
                        class="w-full bg-black text-white py-3 rounded-lg hover:bg-gray-800 transition-colors">
                        S'inscrire
                    </button>

                    <p class="text-sm text-gray-500 text-center">
                        * Champs obligatoires
                    </p>

                    <p class="text-sm text-center">
                        Vous avez déjà un compte ? 
                        <a href="/login" class="text-black hover:underline">Connectez-vous</a>
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