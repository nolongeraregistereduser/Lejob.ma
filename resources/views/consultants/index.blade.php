<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Consultants - LeJob.ma</title>
    
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

    <main>
        <!-- Hero Section -->
        <section class="px-6 py-16 bg-white">
            <div class="max-w-6xl mx-auto text-center">
                <h1 class="crafty-font text-4xl mb-4">Nos Consultants en Carrière</h1>
                <p class="text-gray-600 max-w-3xl mx-auto mb-12">
                    Réservez une session avec l'un de nos consultants experts pour obtenir des conseils personnalisés sur votre carrière, votre CV, ou votre recherche d'emploi.
                </p>
            </div>
        </section>

        <!-- Consultants Listing -->
        <section class="px-6 py-12">
            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse ($consultants as $consultant)
                        <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                            <div class="p-6">
                                <div class="flex items-center mb-4">
                                    <img 
                                        src="{{ $consultant->profile_picture ? asset('storage/' . $consultant->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode($consultant->name) . '&background=random' }}" 
                                        alt="{{ $consultant->name }}" 
                                        class="w-16 h-16 rounded-full mr-4 object-cover"
                                    >
                                    <div>
                                        <h3 class="font-bold text-lg">{{ $consultant->name }}</h3>
                                        <p class="text-gray-600">{{ $consultant->title }}</p>
                                    </div>
                                </div>
                                
                                <p class="text-gray-700 mb-4 line-clamp-3">{{ $consultant->bio }}</p>
                                
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                        <span class="ml-1 text-gray-600">
                                            {{ number_format($consultant->feedback->avg('rating') ?: 0, 1) }} 
                                            ({{ $consultant->feedback->count() }})
                                        </span>
                                    </div>
                                    <a href="{{ route('consultants.show', $consultant->id) }}" class="inline-block bg-black text-white px-4 py-2 rounded-full text-sm hover:bg-gray-800 transition-colors">
                                        Voir profil
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <p class="text-gray-500">Aucun consultant disponible pour le moment.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </main>

    @include('components.footer')
</body>
</html>