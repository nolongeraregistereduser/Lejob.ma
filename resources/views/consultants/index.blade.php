@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                Consultants en Carrière
            </h1>
            <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-500 sm:mt-4">
                Trouvez et réservez des sessions avec nos experts pour améliorer votre parcours professionnel
            </p>
        </div>

        <!-- Filtres de recherche -->
        <div class="mb-8 bg-white p-6 rounded-lg shadow-sm">
            <form method="GET" action="{{ route('consultants.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Recherche par nom</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" 
                           class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md"
                           placeholder="Nom du consultant...">
                </div>
                
                <div>
                    <label for="specialty" class="block text-sm font-medium text-gray-700 mb-1">Filtrer par spécialité</label>
                    <select id="specialty" name="specialty" 
                            class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        <option value="">Toutes les spécialités</option>
                        <option value="Carrière" {{ request('specialty') == 'Carrière' ? 'selected' : '' }}>Carrière</option>
                        <option value="CV et lettre de motivation" {{ request('specialty') == 'CV et lettre de motivation' ? 'selected' : '' }}>CV et lettre de motivation</option>
                        <option value="Entretien" {{ request('specialty') == 'Entretien' ? 'selected' : '' }}>Préparation à l'entretien</option>
                        <option value="Orientation" {{ request('specialty') == 'Orientation' ? 'selected' : '' }}>Orientation professionnelle</option>
                    </select>
                </div>
                
                <div class="flex items-end">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Rechercher
                    </button>
                </div>
            </form>
        </div>

        @if($consultants->isEmpty())
            <div class="text-center py-12 bg-white rounded-lg shadow">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun consultant trouvé</h3>
                <p class="mt-1 text-sm text-gray-500">Essayez de modifier vos critères de recherche.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($consultants as $consultant)
                <div class="bg-white overflow-hidden shadow rounded-lg divide-y divide-gray-200">
                    <div class="px-4 py-5 sm:px-6 flex items-center">
                        <div class="flex-shrink-0 h-12 w-12">
                            @if($consultant->profile_picture)
                                <img class="h-12 w-12 rounded-full object-cover" src="{{ asset('storage/' . $consultant->profile_picture) }}" alt="{{ $consultant->name }}">
                            @else
                                <div class="h-12 w-12 rounded-full bg-blue-100 flex items-center justify-center">
                                    <span class="text-blue-800 font-medium text-lg">{{ substr($consultant->name, 0, 1) }}</span>
                                </div>
                            @endif
                        </div>
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">{{ $consultant->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $consultant->speciality ?? 'Consultant Général' }}</p>
                        </div>
                    </div>
                    <div class="px-4 py-4 sm:px-6">
                        <p class="text-sm text-gray-500 line-clamp-3">
                            {{ $consultant->bio ?? 'Aucune biographie disponible.' }}
                        </p>
                    </div>
                    <div class="px-4 py-4 sm:px-6 bg-gray-50">
                        <div class="flex justify-between items-center">
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="ml-1 text-sm text-gray-600">
                                    {{ $consultant->feedbacks()->avg('rating') ? number_format($consultant->feedbacks()->avg('rating'), 1) : 'N/A' }}
                                </span>
                            </div>
                            <a href="{{ route('user.reservations.create', ['consultant_id' => $consultant->id]) }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Réserver
                            </a>
                        </div>
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