<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - LeJob.ma</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&family=Crafty+Girls&display=swap" rel="stylesheet">
    
    @vite('resources/css/app.css')
    <style>
        .crafty-font {
            font-family: 'Crafty Girls', cursive;
        }
    </style>
</head>
<body class="font-[Quicksand] bg-gray-50">
    @include('components.navbar')

    <main class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <h1 class="text-2xl font-bold mb-6">Tableau de bord</h1>
            
            <div class="mb-6">
                <h2 class="text-xl font-semibold mb-3">Bienvenue, {{ Auth::user()->name }}!</h2>
                <p class="text-gray-600">Vous êtes connecté en tant que {{ Auth::user()->role }}.</p>
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