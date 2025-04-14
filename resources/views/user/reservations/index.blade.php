<!-- filepath: resources/views/user/reservations/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Mes Réservations</h2>
                    <a href="{{ route('user.reservations.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition">
                        <i class="fas fa-plus mr-2"></i>Réserver une nouvelle séance
                    </a>
                </div>

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

                @if($reservations->isEmpty())
                <div class="text-center py-8">
                    <p class="text-gray-500 mb-4">Vous n'avez pas encore de réservations.</p>
                    <a href="{{ route('user.reservations.create') }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md transition">
                        Réserver votre première séance
                    </a>
                </div>
                @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Consultant
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Date
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Heure
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Statut
                                </th>
                                <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs leading-4 font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($reservations as $reservation)
                            <tr>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://ui-avatars.com/api/?name={{ urlencode($reservation->consultant->name) }}&color=7F9CF5&background=EBF4FF" alt="{{ $reservation->consultant->name }}">
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm leading-5 font-medium text-gray-900">
                                                {{ $reservation->consultant->name }}
                                            </div>
                                            <div class="text-sm leading-5 text-gray-500">
                                                {{ $reservation->consultant->speciality ?? 'Consultant Général' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <div class="text-sm leading-5 text-gray-900">
                                        {{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <div class="text-sm leading-5 text-gray-900">
                                        {{ \Carbon\Carbon::parse($reservation->time_slot)->format('H:i') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($reservation->status == 'confirmed') bg-green-100 text-green-800
                                        @elseif($reservation->status == 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($reservation->status == 'completed') bg-blue-100 text-blue-800
                                        @elseif($reservation->status == 'cancelled') bg-red-100 text-red-800
                                        @endif">
                                        @if($reservation->status == 'pending') En attente
                                        @elseif($reservation->status == 'confirmed') Confirmée
                                        @elseif($reservation->status == 'completed') Terminée
                                        @elseif($reservation->status == 'cancelled') Annulée
                                        @endif
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap">
                                    @if($reservation->status === 'completed')
                                        @if(!$reservation->feedback)
                                        <a href="{{ route('user.feedback.create', $reservation) }}" 
                                           class="px-3 py-1 bg-green-600 text-white rounded-md hover:bg-green-700">
                                            Laisser un avis
                                        </a>
                                        @else
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs">
                                            Avis laissé ({{ $reservation->feedback->rating }}/5)
                                        </span>
                                        @endif
                                    @elseif($reservation->status === 'pending')
                                        <span class="text-xs text-gray-500">En attente de confirmation</span>
                                    @elseif($reservation->status === 'confirmed')
                                        <span class="text-xs text-gray-500">Prêt pour la séance</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection