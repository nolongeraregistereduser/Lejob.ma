<!-- filepath: c:\Users\LENOVO\Desktop\Desktop FIL ROUGE\Lejob.ma\resources\views\admin\interviews\dashboard.blade.php -->
@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Dashboard des Réservations</h1>
        <a href="{{ route('admin.interviews.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Liste des Réservations
        </a>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Status Chart -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-medium">Répartition des statuts</h2>
            </div>
            <div class="p-6">
                <canvas id="statusChart" height="250"></canvas>
            </div>
        </div>
        
        <!-- Weekly Reservations -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-medium">Réservations cette semaine</h2>
            </div>
            <div class="p-6">
                <canvas id="weeklyChart" height="250"></canvas>
            </div>
        </div>
    </div>
    
    <!-- Top Consultants -->
    <div class="bg-white rounded-lg shadow overflow-hidden mb-6">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-medium">Top Consultants</h2>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-4">
                @foreach($topConsultants as $consultant)
                <div class="border rounded-lg p-4">
                    <div class="font-medium text-lg">{{ $consultant->name }}</div>
                    <div class="text-gray-500 text-sm">{{ $consultant->email }}</div>
                    <div class="mt-2">
                        <span class="font-bold text-blue-600">{{ $consultant->reservations_as_consultant_count }}</span> 
                        <span class="text-gray-500">sessions terminées</span>
                    </div>
                </div>
                @endforeach
                
                @if($topConsultants->isEmpty())
                <div class="col-span-full text-center text-gray-500 py-4">
                    Aucun consultant avec des sessions terminées
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Status Chart
        const statusCtx = document.getElementById('statusChart').getContext('2d');
        
        const statusData = @json($statusCounts);
        const statusLabels = statusData.map(item => {
            switch(item.status) {
                case 'pending': return 'En attente';
                case 'confirmed': return 'Confirmée';
                case 'completed': return 'Terminée';
                case 'cancelled': return 'Annulée';
                default: return item.status;
            }
        });
        
        const statusCounts = statusData.map(item => item.total);
        const statusColors = statusData.map(item => {
            switch(item.status) {
                case 'pending': return 'rgba(251, 191, 36, 0.7)';
                case 'confirmed': return 'rgba(59, 130, 246, 0.7)';
                case 'completed': return 'rgba(34, 197, 94, 0.7)';
                case 'cancelled': return 'rgba(239, 68, 68, 0.7)';
                default: return 'rgba(107, 114, 128, 0.7)';
            }
        });
        
        new Chart(statusCtx, {
            type: 'pie',
            data: {
                labels: statusLabels,
                datasets: [{
                    data: statusCounts,
                    backgroundColor: statusColors,
                    borderColor: statusColors.map(color => color.replace('0.7', '1')),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.parsed || 0;
                                const total = context.dataset.data.reduce((acc, val) => acc + val, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
        
        // Weekly Chart
        const weeklyCtx = document.getElementById('weeklyChart').getContext('2d');
        
        const weeklyData = @json($weeklyReservations);
        const weeklyLabels = weeklyData.map(item => item.day);
        const weeklyCounts = weeklyData.map(item => item.count);
        
        new Chart(weeklyCtx, {
            type: 'bar',
            data: {
                labels: weeklyLabels,
                datasets: [{
                    label: 'Nombre de réservations',
                    data: weeklyCounts,
                    backgroundColor: 'rgba(59, 130, 246, 0.7)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>
@endpush
@endsection