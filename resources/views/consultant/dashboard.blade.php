<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tableau de Bord Consultant - LeJob.ma</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&family=Crafty+Girls&display=swap" rel="stylesheet">
    
    @vite('resources/css/app.css')
</head>
<body class="font-[Quicksand] bg-gray-50">
    @include('components.navbar')

    <main class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h1 class="text-2xl font-bold mb-6">Tableau de Bord Consultant</h1>
            
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-3">Bienvenue, {{ Auth::user()->name }}!</h2>
                <p class="text-gray-600">Vous êtes connecté en tant que consultant.</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div class="bg-blue-50 p-4 rounded-lg">
                    <h3 class="font-semibold mb-2">Statistiques</h3>
                    <div class="flex justify-between">
                        <div>
                            <p class="text-sm text-gray-600">Rendez-vous ce mois</p>
                            <p class="text-xl font-bold">0</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Rendez-vous à venir</p>
                            <p class="text-xl font-bold">0</p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-green-50 p-4 rounded-lg">
                    <h3 class="font-semibold mb-2">Prochains rendez-vous</h3>
                    <p class="text-gray-600 text-sm">Aucun rendez-vous à venir</p>
                </div>
            </div>
            
            <div class="mb-6">
                <h3 class="font-semibold mb-3">Actions rapides</h3>
                <div class="flex flex-wrap gap-2">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        Gérer mes disponibilités
                    </button>
                    <button class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700 transition-colors">
                        Mettre à jour mon profil
                    </button>
                </div>
            </div>
            
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-colors">
                    Se déconnecter
                </button>
            </form>
        </div>
    </main>

    @include('components.footer')
</body>
</html>
