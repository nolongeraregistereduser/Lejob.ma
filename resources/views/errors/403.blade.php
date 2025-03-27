<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accès Refusé - LeJob.ma</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&family=Crafty+Girls&display=swap" rel="stylesheet">
    
    @vite('resources/css/app.css')
</head>
<body class="font-[Quicksand] bg-gray-50">
    @include('components.navbar')

    <main class="container mx-auto px-4 py-16 text-center">
        <div class="bg-white rounded-xl shadow-sm p-8 max-w-2xl mx-auto">
            <h1 class="text-3xl font-bold mb-4 text-red-600">Accès Refusé</h1>
            
            <div class="mb-8">
                <p class="text-xl mb-4">{{ $exception->getMessage() ?: 'Vous n\'avez pas les permissions nécessaires pour accéder à cette page.' }}</p>
                <p class="text-gray-600">Veuillez contacter l'administrateur si vous pensez qu'il s'agit d'une erreur.</p>
            </div>
            
            <div class="flex justify-center space-x-4">
                <a href="{{ route('dashboard') }}" class="bg-black text-white px-6 py-3 rounded-lg hover:bg-gray-800 transition-colors">
                    Retour au tableau de bord
                </a>
                <a href="/" class="bg-gray-200 text-gray-800 px-6 py-3 rounded-lg hover:bg-gray-300 transition-colors">
                    Accueil
                </a>
            </div>
        </div>
    </main>

    @include('components.footer')
</body>
</html>
