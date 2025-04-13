<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mes Réservations - LeJob.ma</title>
    
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
        <section class="px-6 py-12">
            <div class="max-w-6xl mx-auto">
                <h1 class="crafty-font text-3xl mb-8">Mes Réservations</h1>
                
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                        {{ session('success') }}
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                        {{ session('error') }}
                    </div>
                @endif
                
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="p-6">
                        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                            <h2 class="text-xl font-bold mb-4 md:mb-0">Vos sessions réservées</h2>
                            <a href="{{ route('consultants.index') }}" class="inline-block bg-black text-white px-4 py-2 rounded-full text-sm hover:bg-gray-800 transition-colors">
                                Réserver une nouvelle session
                            </a>
                        </div>
                        
                        @if($reservations->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Consultant
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Date & Heure
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Sujet
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Statut
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($reservations as $reservation)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="flex-shrink-0 h-10 w-10">
                                                            <img 
                                                                class="h-10 w-10 rounded-full object-cover" 
                                                                src="{{ $reservation->consultant->profile_picture ? asset('storage/' . $reservation->consultant->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode($reservation->consultant->name) . '&background=random' }}" 
                                                                alt="{{ $reservation->consultant->name }}"
                                                            >
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm font-medium text-gray-900">
                                                                {{ $reservation->consultant->name }}
                                                            </div>
                                                            <div class="text-sm text-gray-500">
                                                                {{ $reservation->consultant->title }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ \Carbon\Carbon::parse($reservation->date)->format('d/m/Y') }}</div>
                                                    <div class="text-sm text-gray-500">
                                                        {{ \Carbon\Carbon::parse($reservation->start_time)->format('H:i') }} - 
                                                        {{ \Carbon\Carbon::parse($reservation->end_time)->format('H:i') }}
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-900">{{ $reservation->topic }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    @if($reservation->status == 'pending')
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                            En attente
                                                        </span>
                                                    @elseif($reservation->status == 'confirmed')
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                            Confirmée
                                                        </span>
                                                    @elseif($reservation->status == 'completed')
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                            Terminée
                                                        </span>
                                                    @elseif($reservation->status == 'cancelled')
                                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                            Annulée
                                                        </span>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                    <a href="{{ route('reservations.show', $reservation->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-3">
                                                        Détails
                                                    </a>
                                                    
                                                    @if($reservation->status == 'pending' || $reservation->status == 'confirmed')
                                                        <form action="{{ route('reservations.cancel', $reservation->id) }}" method="POST" class="inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation?')">
                                                                Annuler
                                                            </button>
                                                        </form>
                                                    @endif
                                                    
                                                    @if($reservation->status == 'completed' && !$reservation->feedback)
                                                        <a href="{{ route('reservations.show', $reservation->id) }}#feedback" class="text-green-600 hover:text-green-900">
                                                            Donner un avis
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-8">
                                <p class="text-gray-500 mb-4">Vous n'avez pas encore de réservations.</p>
                                <a href="{{ route('consultants.index') }}" class="inline-block bg-black text-white px-6 py-3 rounded-full hover:bg-gray-800 transition-colors">
                                    Réserver une session
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>

    @include('components.footer')
</body>
</html>