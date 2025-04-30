@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">Statistiques de la plateforme</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-lg shadow p-4">
            <h3 class="text-gray-500 text-sm font-medium">Utilisateurs totaux</h3>
            <p class="text-2xl font-bold">{{ $userStats['total'] }}</p>
        </div>
        
        <div class="bg-white rounded-lg shadow p-4">
            <h3 class="text-gray-500 text-sm font-medium">CVs créés</h3>
            <p class="text-2xl font-bold">{{ $cvStats['total'] }}</p>
        </div>
        
        <div class="bg-white rounded-lg shadow p-4">
            <h3 class="text-gray-500 text-sm font-medium">Sessions totales</h3>
            <p class="text-2xl font-bold">{{ $reservationStats['total'] }}</p>
        </div>
        
        <div class="bg-white rounded-lg shadow p-4">
            <h3 class="text-gray-500 text-sm font-medium">Revenus totaux</h3>
            <p class="text-2xl font-bold">{{ number_format($reservationStats['revenue'], 2) }} MAD</p>
        </div>
    </div>
    
    <!-- Monthly statistics chart -->
    <div class="bg-white rounded-lg shadow mb-8">
        <div class="p-4 border-b border-gray-200">
            <h2 class="text-lg font-medium">Évolution des réservations</h2>
        </div>
        <div class="p-4">
            <canvas id="reservationChart" height="100"></canvas>
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- User statistics -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-4 border-b border-gray-200">
                <h2 class="text-lg font-medium">Statistiques des utilisateurs</h2>
            </div>
            <div class="p-4">
                <div class="flex items-center justify-between mb-3">
                    <span class="text-gray-600">Chercheurs d'emploi</span>
                    <span class="font-medium">{{ $userStats['jobSeekers'] }}</span>
                </div>
                <div class="flex items-center justify-between mb-3">
                    <span class="text-gray-600">Consultants</span>
                    <span class="font-medium">{{ $userStats['consultants'] }}</span>
                </div>
                <div class="flex items-center justify-between mb-3">
                    <span class="text-gray-600">Consultants en attente</span>
                    <span class="font-medium">{{ $userStats['pendingConsultants'] }}</span>
                </div>
                <div class="flex items-center justify-between mb-3">
                    <span class="text-gray-600">Nouveaux ce mois</span>
                    <span class="font-medium">{{ $userStats['newThisMonth'] }}</span>
                </div>
            </div>
        </div>
        
        <!-- Top consultants -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-4 border-b border-gray-200">
                <h2 class="text-lg font-medium">Top 5 des consultants</h2>
            </div>
            <div class="p-4">
                @if($topConsultants->count() > 0)
                    @foreach($topConsultants as $consultant)
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center">
                            <div class="ml-3">
                                <span class="text-gray-800 font-medium">{{ $consultant->name }}</span>
                                <div class="flex items-center mt-1">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= round($consultant->average_rating) ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @endfor
                                    <span class="text-gray-600 text-sm ml-1">({{ $consultant->average_rating }})</span>
                                </div>
                            </div>
                        </div>
                        <span class="text-gray-600">{{ $consultant->feedbacks_count }} avis</span>
                    </div>
                    @endforeach
                @else
                    <p class="text-gray-500">Aucun consultant avec des évaluations pour le moment.</p>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('reservationChart').getContext('2d');
    
    // Extract data from PHP
    const months = @json($reservationStats['monthlyData']->pluck('month'));
    const counts = @json($reservationStats['monthlyData']->pluck('count'));
    const revenues = @json($reservationStats['monthlyData']->pluck('revenue'));
    
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [
                {
                    label: 'Réservations',
                    data: counts,
                    borderColor: '#4F46E5',
                    backgroundColor: 'rgba(79, 70, 229, 0.1)',
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'Revenus (MAD)',
                    data: revenues,
                    borderColor: '#10B981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    tension: 0.4,
                    fill: true,
                    yAxisID: 'y1'
                }
            ]
        },
        options: {
            responsive: true,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Nombre de réservations'
                    }
                },
                y1: {
                    beginAtZero: true,
                    position: 'right',
                    grid: {
                        drawOnChartArea: false,
                    },
                    title: {
                        display: true,
                        text: 'Revenus (MAD)'
                    }
                }
            }
        }
    });
});
</script>
@endpush
@endsection