@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6">
        <h1 class="text-2xl font-bold">Gestion des Réservations</h1>
        <a href="{{ route('admin.interviews.dashboard') }}" class="mt-4 md:mt-0 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Dashboard des Réservations
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow p-4">
            <h3 class="text-gray-500 text-sm font-medium">Total</h3>
            <p class="text-2xl font-bold">{{ $stats['total'] }}</p>
        </div>
        
        <div class="bg-white rounded-lg shadow p-4">
            <h3 class="text-gray-500 text-sm font-medium">En attente</h3>
            <p class="text-2xl font-bold text-yellow-500">{{ $stats['pending'] }}</p>
        </div>
        
        <div class="bg-white rounded-lg shadow p-4">
            <h3 class="text-gray-500 text-sm font-medium">Confirmées</h3>
            <p class="text-2xl font-bold text-blue-500">{{ $stats['confirmed'] }}</p>
        </div>
        
        <div class="bg-white rounded-lg shadow p-4">
            <h3 class="text-gray-500 text-sm font-medium">Terminées</h3>
            <p class="text-2xl font-bold text-green-500">{{ $stats['completed'] }}</p>
        </div>
        
        <div class="bg-white rounded-lg shadow p-4">
            <h3 class="text-gray-500 text-sm font-medium">Annulées</h3>
            <p class="text-2xl font-bold text-red-500">{{ $stats['cancelled'] }}</p>
        </div>
    </div>
    
    <!-- Filters -->
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <form action="{{ route('admin.interviews.index') }}" method="GET" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                    <select id="status" name="status" class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="">Tous les statuts</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>En attente</option>
                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmée</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Terminée</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Annulée</option>
                    </select>
                </div>
                
                <div>
                    <label for="consultant" class="block text-sm font-medium text-gray-700 mb-1">Consultant</label>
                    <select id="consultant" name="consultant" class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        <option value="">Tous les consultants</option>
                        @foreach($consultants as $consultant)
                            <option value="{{ $consultant->id }}" {{ request('consultant') == $consultant->id ? 'selected' : '' }}>
                                {{ $consultant->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Date de début</label>
                    <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}" class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                
                <div>
                    <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">Date de fin</label>
                    <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}" class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
            </div>
            
            <div class="flex items-center space-x-4">
                <div class="flex-grow">
                    <input type="text" name="search" id="search" placeholder="Rechercher par nom du client ou consultant" value="{{ request('search') }}" class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                <div>
                    <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                        Filtrer
                    </button>
                    <a href="{{ route('admin.interviews.index') }}" class="ml-2 px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Réinitialiser
                    </a>
                </div>
            </div>
        </form>
    </div>
    
    <!-- Reservations Table -->
    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Consultant</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Heure</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($reservations as $reservation)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $reservation->id }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $reservation->user->name }}</div>
                        <div class="text-sm text-gray-500">{{ $reservation->user->email }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">{{ $reservation->consultant->name }}</div>
                        <div class="text-sm text-gray-500">{{ $reservation->consultant->email }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}</div>
                        <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($reservation->time_slot)->format('H:i') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                            @if($reservation->status == 'pending') bg-yellow-100 text-yellow-800 @endif
                            @if($reservation->status == 'confirmed') bg-blue-100 text-blue-800 @endif
                            @if($reservation->status == 'completed') bg-green-100 text-green-800 @endif
                            @if($reservation->status == 'cancelled') bg-red-100 text-red-800 @endif
                        ">
                            @if($reservation->status == 'pending') En attente @endif
                            @if($reservation->status == 'confirmed') Confirmée @endif
                            @if($reservation->status == 'completed') Terminée @endif
                            @if($reservation->status == 'cancelled') Annulée @endif
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('admin.interviews.show', $reservation->id) }}" class="text-blue-600 hover:text-blue-900">Détails</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                        Aucune réservation trouvée.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="mt-4">
        {{ $reservations->withQueryString()->links() }}
    </div>
</div>
@endsection