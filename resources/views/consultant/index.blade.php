<!-- filepath: resources/views/consultants/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                Nos Consultants de Carrière
            </h1>
            <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-500 sm:mt-4">
                Réservez une séance avec l'un de nos consultants expérimentés pour obtenir des conseils personnalisés pour votre parcours professionnel.
            </p>
        </div>

        <div class="mt-10">
            <!-- Section de Recherche & Filtrage -->
            <div class="mb-8 bg-white rounded-lg shadow-sm p-6">
                <form action="{{ route('consultants.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Recherche</label>
                        <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Rechercher par nom ou spécialité" 
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div class="w-full md:w-48">
                        <label for="specialty" class="block text-sm font-medium text-gray-700 mb-1">Spécialité</label>
                        <select name="specialty" id="specialty" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Toutes les spécialités</option>
                            <option value="cv" {{ request('specialty') == 'cv' ? 'selected' : '' }}>Rédaction de CV</option>
                            <option value="entretien" {{ request('specialty') == 'entretien' ? 'selected' : '' }}>Préparation aux Entretiens</option>
                            <option value="carriere" {{ request('specialty') == 'carriere' ? 'selected' : '' }}>Transition de Carrière</option>
                            <option value="leadership" {{ request('specialty') == 'leadership' ? 'selected' : '' }}>Développement du Leadership</option>
                        </select>
                    </div>
                    <div class="w-full md:w-48">
                        <label for="rating" class="block text-sm font-medium text-gray-700 mb-1">Note Minimale</label>
                        <select name="rating" id="rating" class="w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Toutes les notes</option>
                            <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>5 Étoiles</option>
                            <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>4+ Étoiles</option>
                            <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>3+ Étoiles</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="h-10 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Filtrer
                        </button>
                    </div>
                </form>
            </div>

            <!-- Grille de Consultants -->
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @forelse($consultants ?? [] as $consultant)
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <!-- En-tête du Consultant -->
                    <div class="relative">
                        <div class="h-32 w-full bg-gradient-to-r from-blue-500 to-indigo-600"></div>
                        <div class="absolute bottom-0 left-0 w-full transform translate-y-1/2 flex justify-center">
                            <img class="h-24 w-24 rounded-full border-4 border-white object-cover" 
                                 src="{{ $consultant->profile_photo ?? 'https://ui-avatars.com/api/?name='.urlencode($consultant->name).'&size=200&background=0D8ABC&color=fff' }}" 
                                 alt="{{ $consultant->name }}">
                        </div>
                    </div>
                    
                    <!-- Détails du Consultant -->
                    <div class="pt-16 p-6">
                        <div class="text-center">
                            <h3 class="text-xl font-bold text-gray-900">{{ $consultant->name }}</h3>
                            <p class="text-sm text-gray-500 mt-1">{{ $consultant->speciality ?? 'Consultant de Carrière' }}</p>
                            
                            <!-- Note -->
                            <div class="flex items-center justify-center mt-2">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= ($consultant->average_rating ?? 0))
                                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @else
                                        <svg class="w-5 h-5 text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @endif
                                @endfor
                                <span class="ml-2 text-sm text-gray-600">
                                    {{ number_format($consultant->average_rating ?? 0, 1) }} ({{ $consultant->ratings_count ?? 0 }})
                                </span>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <h4 class="text-sm font-semibold text-gray-700">À propos:</h4>
                            <p class="mt-1 text-sm text-gray-600 line-clamp-3">
                                {{ $consultant->bio ?? 'Consultant de carrière expérimenté prêt à vous aider à réussir dans votre parcours professionnel.' }}
                            </p>
                        </div>
                        
                        <!-- Prix & Expérience -->
                        <div class="mt-4 flex justify-between items-center text-sm">
                            <div>
                                <span class="font-medium text-gray-900">{{ $consultant->hourly_rate ?? '500' }} MAD</span>
                                <span class="text-gray-500">/heure</span>
                            </div>
                            <div class="text-gray-600">
                                <span>{{ $consultant->experience ?? '5' }}+ ans d'expérience</span>
                            </div>
                        </div>
                        
                        <!-- Feedbacks Récents -->
                        @if(isset($consultant->feedbacks) && count($consultant->feedbacks) > 0)
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <h4 class="text-sm font-semibold text-gray-700">Feedbacks Récents:</h4>
                            <div class="mt-2 space-y-3">
                                @foreach($consultant->feedbacks as $feedback)
                                <div class="bg-gray-50 p-3 rounded-md">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <img class="h-8 w-8 rounded-full" src="https://ui-avatars.com/api/?name=User&size=32&background=4F46E5&color=fff" alt="User">
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-xs font-medium text-gray-900">Utilisateur Anonyme</p>
                                            <div class="flex items-center mt-1">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= ($feedback->rating ?? 0))
                                                        <svg class="w-3 h-3 text-yellow-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                        </svg>
                                                    @else
                                                        <svg class="w-3 h-3 text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                        </svg>
                                                    @endif
                                                @endfor
                                            </div>
                                            <p class="text-xs text-gray-600 mt-1">{{ $feedback->comment ?? 'Très bon consultant, je recommande vivement!' }}</p>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        
                        <!-- Bouton de Réservation -->
                        <div class="mt-6">
                            <a href="{{ route('user.reservations.create', ['consultant_id' => $consultant->id]) }}" 
                               class="w-full inline-flex justify-center items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Réserver une Séance
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full bg-white rounded-lg p-8 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun consultant trouvé</h3>
                    <p class="mt-1 text-sm text-gray-500">Veuillez modifier vos critères de recherche ou réessayer plus tard.</p>
                </div>
                @endforelse
            </div>
            
            <!-- Pagination -->
            @if(isset($consultants) && method_exists($consultants, 'links'))
            <div class="mt-8">
                {{ $consultants->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection