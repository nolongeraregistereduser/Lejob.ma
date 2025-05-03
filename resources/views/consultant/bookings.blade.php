<!-- filepath: resources/views/consultant/bookings.blade.php -->
@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Gérer Mes Réservations</h2>

                @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
                @endif

                @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
                @endif

                <div class="mb-6">
                    <ul class="flex border-b">
                        <li class="-mb-px mr-1">
                            <a href="#pending" class="bg-white inline-block py-2 px-4 text-blue-600 font-semibold border-l border-t border-r rounded-t tab-active" onclick="switchTab(event, 'pending')">
                                En attente
                                <span class="ml-2 px-2 py-1 text-xs bg-yellow-100 text-yellow-800 rounded-full">{{ $pendingReservations->count() ?? 0 }}</span>
                            </a>
                        </li>
                        <li class="mr-1">
                            <a href="#confirmed" class="bg-white inline-block py-2 px-4 text-gray-600 font-semibold rounded-t hover:text-blue-600" onclick="switchTab(event, 'confirmed')">
                                Confirmées
                                <span class="ml-2 px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">{{ $confirmedReservations->count() ?? 0 }}</span>
                            </a>
                        </li>
                        <li class="mr-1">
                            <a href="#completed" class="bg-white inline-block py-2 px-4 text-gray-600 font-semibold rounded-t hover:text-blue-600" onclick="switchTab(event, 'completed')">
                                Terminées
                                <span class="ml-2 px-2 py-1 text-xs bg-green-100 text-green-800 rounded-full">{{ $completedReservations->count() ?? 0 }}</span>
                            </a>
                        </li>
                        <li class="mr-1">
                            <a href="#cancelled" class="bg-white inline-block py-2 px-4 text-gray-600 font-semibold rounded-t hover:text-blue-600" onclick="switchTab(event, 'cancelled')">
                                Annulées
                                <span class="ml-2 px-2 py-1 text-xs bg-red-100 text-red-800 rounded-full">{{ $cancelledReservations->count() ?? 0 }}</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Onglet En attente -->
                <div id="pending" class="tab-content">
                    @if($pendingReservations->isEmpty())
                    <div class="text-center py-8">
                        <p class="text-gray-500">Aucune demande de réservation en attente.</p>
                    </div>
                    @else
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Utilisateur
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Date & Heure
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($pendingReservations as $reservation)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($reservation->user->name) }}&color=7F9CF5&background=EBF4FF" alt="User">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm leading-5 font-medium text-gray-900">
                                                {{ $reservation->user->name }}
                                            </div>
                                            <div class="text-sm leading-5 text-gray-500">
                                                {{ $reservation->user->email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <div class="text-sm leading-5 text-gray-900">
                                        {{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}
                                    </div>
                                    <div class="text-sm leading-5 text-gray-500">
                                        {{ \Carbon\Carbon::parse($reservation->time_slot)->format('H:i') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('consultant.bookings.accept-form', $reservation->id) }}" class="text-green-600 hover:text-green-800">Confirmer avec instructions</a>
                                        <form action="{{ route('consultant.bookings.reject', $reservation->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                                Refuser
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>

                <!-- Onglet Confirmées -->
                <div id="confirmed" class="tab-content hidden">
                    @if($confirmedReservations->isEmpty())
                    <div class="text-center py-8">
                        <p class="text-gray-500">Aucune réservation confirmée.</p>
                    </div>
                    @else
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Utilisateur
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Date & Heure
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($confirmedReservations as $reservation)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($reservation->user->name) }}&color=7F9CF5&background=EBF4FF" alt="User">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm leading-5 font-medium text-gray-900">
                                                {{ $reservation->user->name }}
                                            </div>
                                            <div class="text-sm leading-5 text-gray-500">
                                                {{ $reservation->user->email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <div class="text-sm leading-5 text-gray-900">
                                        {{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}
                                    </div>
                                    <div class="text-sm leading-5 text-gray-500">
                                        {{ \Carbon\Carbon::parse($reservation->time_slot)->format('H:i') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium">
                                    <form action="{{ route('consultant.bookings.complete', $reservation->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">
                                            Marquer comme terminée
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>

                <!-- Onglet Terminées -->
                <div id="completed" class="tab-content hidden">
                    @if($completedReservations->isEmpty())
                    <div class="text-center py-8">
                        <p class="text-gray-500">Aucune réservation terminée.</p>
                    </div>
                    @else
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Utilisateur
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Date & Heure
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Feedback
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($completedReservations as $reservation)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($reservation->user->name) }}&color=7F9CF5&background=EBF4FF" alt="User">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm leading-5 font-medium text-gray-900">
                                                {{ $reservation->user->name }}
                                            </div>
                                            <div class="text-sm leading-5 text-gray-500">
                                                {{ $reservation->user->email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <div class="text-sm leading-5 text-gray-900">
                                        {{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}
                                    </div>
                                    <div class="text-sm leading-5 text-gray-500">
                                        {{ \Carbon\Carbon::parse($reservation->time_slot)->format('H:i') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    @if($reservation->feedback)
                                        <div class="flex items-center">
                                            <div class="flex">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $reservation->feedback->rating)
                                                        <svg class="h-4 w-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                        </svg>
                                                    @else
                                                        <svg class="h-4 w-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                        </svg>
                                                    @endif
                                                @endfor
                                            </div>
                                            <span class="ml-2 text-sm text-gray-600">{{ $reservation->feedback->rating }}/5</span>
                                        </div>
                                        @if($reservation->feedback->comment)
                                            <p class="mt-1 text-xs text-gray-500">{{ $reservation->feedback->comment }}</p>
                                        @endif
                                    @else
                                        <span class="text-sm text-gray-500">Pas encore de feedback</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>

                <!-- Onglet Annulées -->
                <div id="cancelled" class="tab-content hidden">
                    @if($cancelledReservations->isEmpty())
                    <div class="text-center py-8">
                        <p class="text-gray-500">Aucune réservation annulée.</p>
                    </div>
                    @else
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Utilisateur
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Date & Heure
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Statut
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($cancelledReservations as $reservation)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($reservation->user->name) }}&color=7F9CF5&background=EBF4FF" alt="User">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm leading-5 font-medium text-gray-900">
                                                {{ $reservation->user->name }}
                                            </div>
                                            <div class="text-sm leading-5 text-gray-500">
                                                {{ $reservation->user->email }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <div class="text-sm leading-5 text-gray-900">
                                        {{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}
                                    </div>
                                    <div class="text-sm leading-5 text-gray-500">
                                        {{ \Carbon\Carbon::parse($reservation->time_slot)->format('H:i') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        Annulée
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function switchTab(event, tabId) {
        event.preventDefault();
        
        // Cacher tous les onglets
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.add('hidden');
        });
        
        // Retirer la classe active de tous les liens d'onglets
        document.querySelectorAll('ul.flex a').forEach(link => {
            link.classList.remove('tab-active', 'border-l', 'border-t', 'border-r', 'text-blue-600');
            link.classList.add('text-gray-600');
        });
        
        // Afficher l'onglet sélectionné
        document.getElementById(tabId).classList.remove('hidden');
        
        // Ajouter la classe active au lien d'onglet cliqué
        event.target.classList.add('tab-active', 'border-l', 'border-t', 'border-r', 'text-blue-600');
        event.target.classList.remove('text-gray-600');
    }
</script>
@endsection