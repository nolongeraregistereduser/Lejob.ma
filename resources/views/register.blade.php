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
                
                <form class="space-y-4 sm:space-y-6">
                    <div>
                        <input type="text" 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-black focus:border-transparent"
                            placeholder="Nom complet *"
                            required>
                    </div>

                    <div>
                        <input type="email" 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-black focus:border-transparent"
                            placeholder="Adresse e-mail *"
                            required>
                    </div>

                    <div>
                        <input type="password" 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-black focus:border-transparent"
                            placeholder="Mot de passe *"
                            required
                            minlength="8">
                    </div>

                    <div>
                        <input type="password" 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-black focus:border-transparent"
                            placeholder="Confirmez le mot de passe *"
                            required>
                    </div>

                    <div>
                        <input type="tel" 
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-black focus:border-transparent"
                            placeholder="Numéro de téléphone (facultatif)"
                            pattern="[0-9]{10}">
                    </div>

                    <div>
                        <select class="w-full px-4 py-3 rounded-lg border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-black focus:border-transparent"
                            required>
                            <option value="" disabled selected>Choisissez votre rôle *</option>
                            <option value="job_seeker">Chercheur d'emploi</option>
                            <option value="consultant">Consultant</option>
                        </select>
                    </div>

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