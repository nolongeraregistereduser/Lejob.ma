@extends('layouts.app')

@section('content')
<style>
    .crafty-font {
        font-family: 'Crafty Girls', cursive;
    }
    body {
        background-color: white;
        font-family: 'Quicksand', sans-serif;
    }
</style>

<div class="py-12 bg-white font-[Quicksand]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <h1 class="crafty-font text-4xl mb-2">Consultants en Carrière</h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Trouvez et réservez des sessions avec nos experts pour améliorer votre parcours professionnel
            </p>
        </div>

        <!-- Filtres de recherche -->
        <div class="mb-8 bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <form method="GET" action="{{ route('consultants.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Recherche par nom</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" 
                           class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-lg"
                           placeholder="Nom du consultant...">
                </div>
                
                <div>
                    <label for="specialty" class="block text-sm font-medium text-gray-700 mb-1">Filtrer par spécialité</label>
                    <select id="specialty" name="specialty" 
                            class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-lg">
                        <option value="">Toutes les spécialités</option>
                        <option value="Carrière" {{ request('specialty') == 'Carrière' ? 'selected' : '' }}>Carrière</option>
                        <option value="CV et lettre de motivation" {{ request('specialty') == 'CV et lettre de motivation' ? 'selected' : '' }}>CV et lettre de motivation</option>
                        <option value="Entretien" {{ request('specialty') == 'Entretien' ? 'selected' : '' }}>Préparation à l'entretien</option>
                        <option value="Orientation" {{ request('specialty') == 'Orientation' ? 'selected' : '' }}>Orientation professionnelle</option>
                    </select>
                </div>
                
                <div class="flex items-end">
                    <button type="submit" class="inline-flex items-center px-6 py-2.5 border border-transparent text-sm font-medium rounded-full shadow-sm text-white bg-gray-900 hover:bg-gray-800 transition-colors duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Rechercher
                    </button>
                </div>
            </form>
        </div>

        @if($consultants->isEmpty())
            <div class="text-center py-12 bg-white rounded-xl shadow-sm border border-gray-100">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun consultant trouvé</h3>
                <p class="mt-1 text-sm text-gray-500">Essayez de modifier vos critères de recherche.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($consultants as $consultant)
                <div class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 flex flex-col h-full">
                    <!-- Consultant Header with Image -->
                    <div class="bg-gray-100 h-48 flex items-center justify-center">
                        @if($consultant->profile_picture)
                            @if(str_starts_with($consultant->profile_picture, 'http'))
                                <img class="h-full w-full object-cover" src="{{ $consultant->profile_picture }}" alt="{{ $consultant->name }}">
                            @else
                                <img class="h-full w-full object-cover" src="{{ asset('storage/' . $consultant->profile_picture) }}" alt="{{ $consultant->name }}">
                            @endif
                        @else
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                <div class="h-20 w-20 rounded-full bg-blue-100 flex items-center justify-center">
                                    <span class="text-blue-800 font-medium text-2xl">{{ substr($consultant->name, 0, 1) }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Consultant Info -->
                    <div class="p-5 flex-grow">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="font-semibold text-lg text-gray-800">{{ $consultant->name }}</h3>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="ml-1 text-sm text-gray-600 font-medium">
                                    {{ $consultant->feedbacks()->avg('rating') ? number_format($consultant->feedbacks()->avg('rating'), 1) : 'N/A' }}
                                </span>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                                {{ $consultant->speciality ?? 'Consultant Général' }}
                            </span>
                        </div>
                        
                        <p class="text-sm text-gray-600 line-clamp-3 mb-4">
                            {{ $consultant->bio ?? 'Aucune biographie disponible.' }}
                        </p>
                        
                        <div class="flex items-start mb-4">
                            <svg class="h-5 w-5 text-gray-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-sm text-gray-600">Disponible pour consultation</span>
                        </div>
                    </div>
                    
                    <!-- Action Footer -->
                    <div class="p-5 pt-0 mt-auto">
                        <a href="{{ route('consultants.show', $consultant->id) }}" class="inline-flex items-center px-5 py-2.5 border border-transparent text-sm font-medium rounded-full shadow-sm text-white bg-gray-900 hover:bg-gray-800 hover:-translate-y-0.5 transform transition-all duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1.5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-8.707l-3-3a1 1 0 00-1.414 1.414L10.586 9H7a1 1 0 100 2h3.586l-1.293 1.293a1 1 0 101.414 1.414l3-3a1 1 0 000-1.414z" clip-rule="evenodd" />
                            </svg>
                            Voir détails et réserver
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="mt-8">
                {{ $consultants->links() }}
            </div>
        @endif
    </div>
</div>
@endsection