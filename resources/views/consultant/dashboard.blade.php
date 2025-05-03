@extends('layouts.consultant')

@section('title', 'Tableau de bord Consultant')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Bienvenue, {{ $user->name }}</h1>
        <p class="text-gray-600 mt-2">Voici un aperçu de votre activité en tant que consultant.</p>
    </div>
    
    <!-- Stats Overview -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Clients Card -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-medium text-gray-500">Clients totaux</h3>
                    <span class="p-2 rounded-full bg-blue-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                        </svg>
                    </span>
                </div>
                <div class="flex items-baseline">
                    <span class="text-3xl font-bold text-gray-900">{{ $stats['clients'] }}</span>
                    <span class="ml-2 text-sm text-green-500 font-medium flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                        </svg>
                        {{ $stats['clientGrowth'] }}%
                    </span>
                </div>
                <p class="text-sm text-gray-600 mt-1">Depuis le début</p>
            </div>
            <div class="bg-blue-50 px-6 py-3">
                <div class="text-xs text-blue-500 font-medium">
                    {{ $stats['newClients'] }} nouveaux ce mois
                </div>
            </div>
        </div>
        
        <!-- Sessions Card -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-medium text-gray-500">Consultations</h3>
                    <span class="p-2 rounded-full bg-green-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </div>
                <div class="flex items-baseline">
                    <span class="text-3xl font-bold text-gray-900">{{ $stats['sessions'] }}</span>
                    <span class="ml-2 text-sm text-green-500 font-medium flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                        </svg>
                        {{ $stats['sessionGrowth'] }}%
                    </span>
                </div>
                <p class="text-sm text-gray-600 mt-1">Total des consultations</p>
            </div>
            <div class="bg-green-50 px-6 py-3">
                <div class="text-xs text-green-500 font-medium">
                    {{ $stats['upcomingSessions'] }} à venir cette semaine
                </div>
            </div>
        </div>
        
        <!-- Earnings Card -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-medium text-gray-500">Revenus</h3>
                    <span class="p-2 rounded-full bg-yellow-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </div>
                <div class="flex items-baseline">
                    <span class="text-3xl font-bold text-gray-900">{{ $stats['earnings'] }} MAD</span>
                    <span class="ml-2 text-sm text-green-500 font-medium flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                        </svg>
                        {{ $stats['earningGrowth'] }}%
                    </span>
                </div>
                <p class="text-sm text-gray-600 mt-1">Revenus totaux</p>
            </div>
            <div class="bg-yellow-50 px-6 py-3">
                <div class="text-xs text-yellow-500 font-medium">
                    {{ $stats['monthlyEarnings'] }} MAD ce mois-ci
                </div>
            </div>
        </div>
        
        <!-- Review Card -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow overflow-hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-medium text-gray-500">Satisfaction</h3>
                    <span class="p-2 rounded-full bg-purple-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-500" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    </span>
                </div>
                <div class="flex items-baseline">
                    <span class="text-3xl font-bold text-gray-900">{{ $stats['rating'] }}/5</span>
                    <span class="ml-2 text-sm text-green-500 font-medium flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd" />
                        </svg>
                        {{ $stats['ratingGrowth'] }}%
                    </span>
                </div>
                <div class="flex items-center mt-1">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= round($stats['rating']))
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                        @endif
                    @endfor
                </div>
            </div>
            <div class="bg-purple-50 px-6 py-3">
                <div class="text-xs text-purple-500 font-medium">
                    {{ $stats['reviewCount'] }} avis reçus
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
        <h2 class="text-xl font-semibold text-gray-800 mb-5">Actions rapides</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="{{ route('consultant.bookings') }}" class="group flex items-center p-5 border rounded-lg hover:bg-indigo-50 hover:border-indigo-200 transition-colors">
                <div class="p-3 rounded-lg bg-indigo-100 group-hover:bg-indigo-200 transition-colors mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <p class="font-medium text-gray-800">Gérer mes réservations</p>
                    <p class="text-sm text-gray-500 mt-1">Consultez et acceptez les rendez-vous</p>
                </div>
            </a>
            
            <a href="{{ route('consultant.profile') }}" class="group flex items-center p-5 border rounded-lg hover:bg-green-50 hover:border-green-200 transition-colors">
                <div class="p-3 rounded-lg bg-green-100 group-hover:bg-green-200 transition-colors mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <div>
                    <p class="font-medium text-gray-800">Mettre à jour mon profil</p>
                    <p class="text-sm text-gray-500 mt-1">Modifiez votre profil professionnel</p>
                </div>
            </a>
            
            <a href="" class="group flex items-center p-5 border rounded-lg hover:bg-purple-50 hover:border-purple-200 transition-colors">
                <div class="p-3 rounded-lg bg-purple-100 group-hover:bg-purple-200 transition-colors mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
                <div>
                    <p class="font-medium text-gray-800">Voir mes statistiques</p>
                    <p class="text-sm text-gray-500 mt-1">Analyser votre performance</p>
                </div>
            </a>
        </div>
    </div>
    
    <!-- Recent Activity -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-semibold text-gray-800">Activités récentes</h2>
            <a href="{{ route('consultant.bookings') }}" class="text-sm text-indigo-600 hover:text-indigo-800 hover:underline font-medium">
                Voir toutes les activités
            </a>
        </div>
        
        @if(count($recentActivities) > 0)
            <div class="space-y-5">
                @foreach($recentActivities as $activity)
                    <div class="flex items-start p-4 rounded-lg border border-gray-100 hover:bg-gray-50">
                        <div class="{{ $activity['color'] }} p-3 rounded-full mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ $activity['iconColor'] }}" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $activity['icon'] }}" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between">
                                <p class="font-medium text-gray-900">{{ $activity['title'] }}</p>
                                <span class="text-xs text-gray-500">{{ $activity['time'] }}</span>
                            </div>
                            <p class="text-sm text-gray-600 mt-1">{{ $activity['description'] }}</p>
                            @if(isset($activity['clientName']))
                                <p class="text-xs text-gray-500 mt-2">Client: {{ $activity['clientName'] }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12 border-2 border-dashed border-gray-200 rounded-lg">
                <div class="mx-auto bg-gray-100 rounded-full p-3 w-16 h-16 flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-1">Aucune activité récente</h3>
                <p class="text-gray-500 max-w-sm mx-auto">
                    Les activités apparaîtront ici une fois que vous commencerez à recevoir des réservations
                </p>
            </div>
        @endif
    </div>
</div>
@endsection
