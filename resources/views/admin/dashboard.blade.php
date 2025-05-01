@extends('layouts.admin')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-800">Tableau de Bord</h1>
    <p class="text-gray-600 mt-2">Bienvenue sur le panneau d'administration LeJob.ma</p>
</div>

<!-- Quick Navigation Links -->
<div class="bg-white rounded-xl shadow-md mb-8 p-6 border border-gray-100">
    <h2 class="text-xl font-semibold text-gray-800 mb-5 pb-2 border-b border-gray-100">Navigation rapide</h2>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
        <a href="{{ route('admin.users') }}" class="flex flex-col items-center p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors border border-blue-100">
            <div class="bg-blue-100 p-3 rounded-full mb-3">
                <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
            <span class="text-sm font-medium text-gray-700">Utilisateurs</span>
        </a>
        
        <a href="{{ route('admin.jobs') }}" class="flex flex-col items-center p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors border border-green-100">
            <div class="bg-green-100 p-3 rounded-full mb-3">
                <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
            </div>
            <span class="text-sm font-medium text-gray-700">Offres</span>
        </a>
        
        <a href="{{ route('admin.interviews.index') }}" class="flex flex-col items-center p-4 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition-colors border border-indigo-100">
            <div class="bg-indigo-100 p-3 rounded-full mb-3">
                <svg class="w-7 h-7 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <span class="text-sm font-medium text-gray-700">Consultations</span>
        </a>
        
        <a href="{{ route('admin.feedback.index') }}" class="flex flex-col items-center p-4 bg-amber-50 rounded-lg hover:bg-amber-100 transition-colors border border-amber-100">
            <div class="bg-amber-100 p-3 rounded-full mb-3">
                <svg class="w-7 h-7 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                </svg>
            </div>
            <span class="text-sm font-medium text-gray-700">Avis</span>
        </a>
        
        <a href="{{ route('admin.statistics') }}" class="flex flex-col items-center p-4 bg-rose-50 rounded-lg hover:bg-rose-100 transition-colors border border-rose-100">
            <div class="bg-rose-100 p-3 rounded-full mb-3">
                <svg class="w-7 h-7 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                </svg>
            </div>
            <span class="text-sm font-medium text-gray-700">Statistiques</span>
        </a>
    </div>
</div>

<!-- Key Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-md overflow-hidden">
        <div class="px-6 py-5">
            <div class="flex items-center justify-between">
                <div class="flex-shrink-0 bg-white/20 p-3 rounded-full">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <div class="text-right">
                    <p class="text-white text-opacity-80 text-sm">Total Utilisateurs</p>
                    <p class="text-white text-3xl font-bold">{{ App\Models\User::count() }}</p>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.users') }}" class="text-xs text-white/90 flex items-center hover:text-white">
                    Voir les détails
                    <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
    
    <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-md overflow-hidden">
        <div class="px-6 py-5">
            <div class="flex items-center justify-between">
                <div class="flex-shrink-0 bg-white/20 p-3 rounded-full">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <div class="text-right">
                    <p class="text-white text-opacity-80 text-sm">Réservations</p>
                    <p class="text-white text-3xl font-bold">{{ App\Models\Reservation::count() }}</p>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.interviews.index') }}" class="text-xs text-white/90 flex items-center hover:text-white">
                    Voir les détails
                    <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
    
    <div class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl shadow-md overflow-hidden">
        <div class="px-6 py-5">
            <div class="flex items-center justify-between">
                <div class="flex-shrink-0 bg-white/20 p-3 rounded-full">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                    </svg>
                </div>
                <div class="text-right">
                    <p class="text-white text-opacity-80 text-sm">Avis Clients</p>
                    <p class="text-white text-3xl font-bold">{{ App\Models\Feedback::count() }}</p>
                </div>
            </div>
            <div class="mt-4">
                <a href="{{ route('admin.feedback.index') }}" class="text-xs text-white/90 flex items-center hover:text-white">
                    Voir les détails
                    <svg class="w-3 h-3 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Reservation Status Cards -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
        <div class="px-6 py-5">
            <div class="flex items-center">
                <div class="p-3 bg-yellow-100 rounded-md">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm">En attente</p>
                    <p class="text-gray-800 text-xl font-bold">{{ App\Models\Reservation::where('status', 'pending')->count() }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
        <div class="px-6 py-5">
            <div class="flex items-center">
                <div class="p-3 bg-blue-100 rounded-md">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm">Confirmées</p>
                    <p class="text-gray-800 text-xl font-bold">{{ App\Models\Reservation::where('status', 'confirmed')->count() }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
        <div class="px-6 py-5">
            <div class="flex items-center">
                <div class="p-3 bg-green-100 rounded-md">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm">Terminées</p>
                    <p class="text-gray-800 text-xl font-bold">{{ App\Models\Reservation::where('status', 'completed')->count() }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
        <div class="px-6 py-5">
            <div class="flex items-center">
                <div class="p-3 bg-red-100 rounded-md">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-gray-500 text-sm">Annulées</p>
                    <p class="text-gray-800 text-xl font-bold">{{ App\Models\Reservation::where('status', 'cancelled')->count() }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart and Actions Required -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    <!-- Chart -->
    <div class="lg:col-span-2 bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
        <div class="px-6 py-5 border-b border-gray-100">
            <h2 class="text-lg font-medium text-gray-800">Activité Récente</h2>
        </div>
        <div class="px-6 py-6">
            <div class="h-64">
                <canvas id="activityChart"></canvas>
            </div>
        </div>
    </div>
    
    <!-- Actions Required -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
        <div class="px-6 py-5 border-b border-gray-100">
            <h2 class="text-lg font-medium text-gray-800">Actions Requises</h2>
        </div>
        <div class="px-6 py-6">
            <div class="space-y-5">
                <div class="flex items-start">
                    <span class="flex-shrink-0 bg-yellow-100 p-2 rounded-full">
                        <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </span>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-900">{{ App\Models\User::where('status', 'pending')->count() }} utilisateurs en attente d'approbation</p>
                        <a href="{{ route('admin.users') }}" class="text-xs text-blue-600 mt-1 inline-block hover:text-blue-800">Voir les utilisateurs</a>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <span class="flex-shrink-0 bg-blue-100 p-2 rounded-full">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </span>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-900">{{ App\Models\Reservation::where('status', 'pending')->count() }} réservations en attente</p>
                        <a href="{{ route('admin.interviews.index') }}" class="text-xs text-blue-600 mt-1 inline-block hover:text-blue-800">Gérer les réservations</a>
                    </div>
                </div>
                
                <div class="flex items-start">
                    <span class="flex-shrink-0 bg-red-100 p-2 rounded-full">
                        <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </span>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-900">{{ App\Models\Feedback::where('rating', '<', 3)->count() }} avis négatifs à traiter</p>
                        <a href="{{ route('admin.feedback.index') }}" class="text-xs text-blue-600 mt-1 inline-block hover:text-blue-800">Voir les avis</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Latest Registrations -->
<div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100">
    <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center">
        <h2 class="text-lg font-medium text-gray-800">Dernières inscriptions</h2>
        <a href="{{ route('admin.users') }}" class="text-sm text-blue-600 hover:text-blue-800 flex items-center">
            Voir tout
            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </a>
    </div>
    <div class="px-6 py-4">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rôle</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach(App\Models\User::orderBy('created_at', 'desc')->take(5)->get() as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="text-sm text-gray-500">{{ $user->email }}</div>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="text-sm text-gray-900 capitalize">{{ $user->role }}</div>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="text-sm text-gray-500">{{ $user->created_at->format('d/m/Y H:i') }}</div>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if($user->status == 'active') bg-green-100 text-green-800 
                                @elseif($user->status == 'pending') bg-yellow-100 text-yellow-800
                                @elseif($user->status == 'inactive') bg-red-100 text-red-800 
                                @endif">
                                {{ ucfirst($user->status) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('activityChart').getContext('2d');
        
        // Get last 7 days
        const dates = [];
        for(let i = 6; i >= 0; i--) {
            const date = new Date();
            date.setDate(date.getDate() - i);
            dates.push(date.toLocaleDateString('fr-FR', { day: 'numeric', month: 'short' }));
        }
        
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: dates,
                datasets: [
                    {
                        label: 'Réservations',
                        backgroundColor: 'rgba(99, 102, 241, 0.8)',
                        borderColor: 'rgba(99, 102, 241, 1)',
                        borderWidth: 1,
                        data: [5, 7, 12, 8, 10, 15, 9],
                    },
                    {
                        label: 'Utilisateurs',
                        backgroundColor: 'rgba(16, 185, 129, 0.8)',
                        borderColor: 'rgba(16, 185, 129, 1)',
                        borderWidth: 1,
                        data: [3, 4, 6, 2, 5, 8, 4],
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        align: 'end'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    });
</script>
@endpush