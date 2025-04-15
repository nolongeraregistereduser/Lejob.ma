@extends('layouts.app')

@section('content')
<div class="py-12 bg-gradient-to-b from-blue-50 to-white">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- French Headline Section -->
        <div class="text-center mb-10">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Opportunités d'Emploi à Distance</h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">Découvrez des opportunités professionnelles internationales permettant de travailler depuis n'importe où.</p>
        </div>
        
        <!-- Filter Bar -->
        <div class="bg-white rounded-lg shadow-sm p-4 mb-8 flex flex-wrap items-center justify-between">
            <div class="text-gray-700 font-medium">
                <span class="text-blue-600 font-bold">{{ $jobsCount }}</span> 
                <span class="ml-1">offres trouvées</span>
            </div>
            <div class="flex space-x-2 mt-2 sm:mt-0">
                <span class="text-gray-500">Trier par:</span>
                <button class="text-blue-600 hover:text-blue-800 font-medium">Date</button>
                <button class="text-gray-500 hover:text-blue-800 font-medium">Pertinence</button>
            </div>
        </div>

        <!-- Error Message -->
        @if(isset($error))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded mb-8 shadow-sm" role="alert">
                <p class="font-medium">Attention!</p>
                <p>{{ $error }}</p>
            </div>
        @endif
        
        <!-- Jobs Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($jobs as $job)
                <div class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 flex flex-col h-full group">
                    <!-- Company Header -->
                    <div class="p-5 border-b border-gray-100 flex items-center">
                        @if(isset($job['company_logo']))
                            <img src="{{ $job['company_logo'] }}" alt="{{ $job['company_name'] }} logo" class="h-12 w-12 object-contain mr-4 rounded-md">
                        @else
                            <div class="h-12 w-12 bg-blue-100 rounded-md flex items-center justify-center mr-4">
                                <span class="text-blue-700 font-bold">{{ substr($job['company_name'] ?? 'CO', 0, 2) }}</span>
                            </div>
                        @endif
                        <div>
                            <h3 class="font-semibold text-lg text-gray-800 group-hover:text-blue-600 transition-colors duration-200">{{ $job['title'] ?? 'Poste Non Spécifié' }}</h3>
                            <p class="text-sm text-gray-500">{{ $job['company_name'] ?? 'Entreprise Inconnue' }}</p>
                        </div>
                    </div>
                    
                    <!-- Job Details -->
                    <div class="p-5 flex-grow">
                        <div class="flex flex-wrap mb-4">
                            <div class="bg-blue-50 text-blue-700 text-xs font-medium px-2.5 py-1 rounded-full mr-2 mb-2">
                                {{ $job['category'] ?? 'Non catégorisé' }}
                            </div>
                            <div class="bg-green-50 text-green-700 text-xs font-medium px-2.5 py-1 rounded-full mr-2 mb-2">
                                100% Télétravail
                            </div>
                        </div>
                        
                        <div class="space-y-3 mb-4">
                            <div class="flex items-start">
                                <svg class="h-5 w-5 text-gray-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="text-sm text-gray-600">{{ $job['candidate_required_location'] ?? 'À Distance' }}</span>
                            </div>
                            
                            @if(isset($job['salary']))
                            <div class="flex items-start">
                                <svg class="h-5 w-5 text-gray-400 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-sm text-gray-600">{{ $job['salary'] }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    
                    <!-- Action Footer -->
                    <div class="p-5 pt-0 mt-auto">
                        <a href="{{ $job['url'] ?? '#' }}" target="_blank" 
                           class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-4 rounded-lg transition-colors duration-300">
                            Voir l'offre
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-3 bg-white rounded-lg shadow-sm p-8 text-center">
                    <svg class="h-16 w-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="text-lg font-medium text-gray-700 mb-2">Aucune offre disponible</h3>
                    <p class="text-gray-500">Veuillez réessayer ultérieurement ou modifier vos critères de recherche.</p>
                </div>
            @endforelse
        </div>
        
        <!-- Laravel Pagination -->
        <div class="mt-10">
            {{ $jobs->links('pagination::tailwind') }}
        </div>
    </div>
</div>
@endsection