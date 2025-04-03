@extends('layouts.admin')

@section('content')
<!-- Cartes de statistiques -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <div class="bg-indigo-600 rounded-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold mb-1">Planning des Entretiens</h3>
                <p class="text-4xl font-bold">86</p>
            </div>
            <div class="bg-indigo-500 p-3 rounded-lg">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-blue-500 rounded-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold mb-1">Candidatures Envoyées</h3>
                <p class="text-4xl font-bold">75</p>
            </div>
            <div class="bg-blue-400 p-3 rounded-lg">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-green-500 rounded-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold mb-1">Profil Consulté</h3>
                <p class="text-4xl font-bold">45,673</p>
            </div>
            <div class="bg-green-400 p-3 rounded-lg">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-purple-500 rounded-lg p-6 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold mb-1">Messages Non Lus</h3>
                <p class="text-4xl font-bold">93</p>
            </div>
            <div class="bg-purple-400 p-3 rounded-lg">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Section des Graphiques -->
<div class="bg-white rounded-lg p-6 mb-6 shadow-sm">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold">Statistiques des Offres</h2>
        <div class="flex items-center space-x-4">
            <div class="flex items-center">
                <div class="w-3 h-3 bg-indigo-500 rounded-full mr-2"></div>
                <span>Candidatures Envoyées</span>
            </div>
            <div class="flex items-center">
                <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                <span>Entretiens</span>
            </div>
            <div class="flex items-center">
                <div class="w-3 h-3 bg-gray-300 rounded-full mr-2"></div>
                <span>Refusées</span>
            </div>
        </div>
    </div>
    <div class="h-64 w-full">
        <canvas id="vacancyChart"></canvas>
    </div>
</div>

<!-- Activités Récentes & Emplois Recommandés -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Activités Récentes -->
    <div class="bg-white rounded-lg p-6 shadow-sm">
        <h2 class="text-xl font-semibold mb-4">Activités Récentes</h2>
        <div class="space-y-4">
            <div class="flex items-start">
                <div class="bg-indigo-100 p-2 rounded-lg mr-3">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium">Votre candidature a été acceptée pour 3 offres</p>
                    <p class="text-xs text-gray-500">Il y a 12h</p>
                </div>
            </div>
            <div class="flex items-start">
                <div class="bg-indigo-100 p-2 rounded-lg mr-3">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium">Votre candidature a été acceptée pour 3 offres</p>
                    <p class="text-xs text-gray-500">Il y a 12h</p>
                </div>
            </div>
            <div class="flex items-start">
                <div class="bg-indigo-100 p-2 rounded-lg mr-3">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium">Votre candidature a été acceptée pour 3 offres</p>
                    <p class="text-xs text-gray-500">Il y a 12h</p>
                </div>
            </div>
            <div class="flex items-start">
                <div class="bg-indigo-100 p-2 rounded-lg mr-3">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <div>
                    <p class="text-sm font-medium">Votre candidature a été acceptée pour 3 offres</p>
                    <p class="text-xs text-gray-500">Il y a 12h</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Emplois Recommandés -->
    <div class="lg:col-span-2 bg-white rounded-lg p-6 shadow-sm">
        <h2 class="text-xl font-semibold mb-4">Emplois Recommandés</h2>
        <div class="space-y-4">
            <div class="border rounded-lg p-4">
                <div class="flex items-center justify-between mb-2">
                    <div>
                        <h3 class="font-semibold">Programmeur de Base de Données</h3>
                        <p class="text-sm text-gray-600">Maximuz Team</p>
                    </div>
                    <span class="px-3 py-1 bg-indigo-100 text-indigo-600 rounded-full text-sm">TÉLÉTRAVAIL</span>
                </div>
                <p class="text-sm text-gray-600 mb-2">14 000 € - 25 000 €</p>
                <p class="text-sm text-gray-500">Londres, Angleterre</p>
            </div>
            <div class="border rounded-lg p-4">
                <div class="flex items-center justify-between mb-2">
                    <div>
                        <h3 class="font-semibold">Programmeur Senior</h3>
                        <p class="text-sm text-gray-600">Klean n Clin Studios</p>
                    </div>
                    <span class="px-3 py-1 bg-indigo-100 text-indigo-600 rounded-full text-sm">TEMPS PARTIEL</span>
                </div>
                <p class="text-sm text-gray-600 mb-2">14 000 € - 25 000 €</p>
                <p class="text-sm text-gray-500">Manchester, Angleterre</p>
            </div>
            <div class="border rounded-lg p-4">
                <div class="flex items-center justify-between mb-2">
                    <div>
                        <h3 class="font-semibold">Stagiaire Designer UX</h3>
                        <p class="text-sm text-gray-600">Maximuz Team</p>
                    </div>
                    <span class="px-3 py-1 bg-indigo-100 text-indigo-600 rounded-full text-sm">TEMPS PLEIN</span>
                </div>
                <p class="text-sm text-gray-600 mb-2">14 000 € - 25 000 €</p>
                <p class="text-sm text-gray-500">Londres, Angleterre</p>
            </div>
        </div>
    </div>
</div>

<!-- Section des Entreprises en Vedette -->
<div class="mt-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-semibold">Entreprises en Vedette</h2>
        <a href="#" class="text-indigo-600 hover:underline flex items-center">
            Voir Plus
            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </a>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4">
        <div class="bg-white p-4 rounded-lg shadow-sm flex flex-col items-center">
            <div class="w-16 h-16 bg-gray-200 rounded-lg mb-3"></div>
            <h3 class="font-semibold">Herman-Carter</h3>
            <p class="text-sm text-gray-500">21 Offres</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-sm flex flex-col items-center">
            <div class="w-16 h-16 bg-gray-200 rounded-lg mb-3"></div>
            <h3 class="font-semibold">Funk Inc.</h3>
            <p class="text-sm text-gray-500">21 Offres</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-sm flex flex-col items-center">
            <div class="w-16 h-16 bg-gray-200 rounded-lg mb-3"></div>
            <h3 class="font-semibold">Williamson Inc</h3>
            <p class="text-sm text-gray-500">21 Offres</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-sm flex flex-col items-center">
            <div class="w-16 h-16 bg-gray-200 rounded-lg mb-3"></div>
            <h3 class="font-semibold">Donnelly Ltd.</h3>
            <p class="text-sm text-gray-500">21 Offres</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-sm flex flex-col items-center">
            <div class="w-16 h-16 bg-gray-200 rounded-lg mb-3"></div>
            <h3 class="font-semibold">Herman-Carter</h3>
            <p class="text-sm text-gray-500">21 Offres</p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('vacancyChart').getContext('2d');
        
        // Sample data
        const labels = ['Semaine 01', 'Semaine 02', 'Semaine 03', 'Semaine 04', 'Semaine 05', 'Semaine 06', 'Semaine 07', 'Semaine 08', 'Semaine 09', 'Semaine 10'];
        const applicationData = [20, 40, 30, 70, 50, 60, 30, 20, 40, 50];
        const interviewData = [10, 20, 15, 30, 25, 40, 35, 25, 30, 20];
        const rejectedData = [5, 10, 8, 15, 12, 20, 18, 12, 15, 10];
        
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Candidatures Envoyées',
                        data: applicationData,
                        borderColor: '#6366F1',
                        backgroundColor: 'rgba(99, 102, 241, 0.1)',
                        tension: 0.4,
                        borderWidth: 3,
                        pointBackgroundColor: '#6366F1'
                    },
                    {
                        label: 'Entretiens',
                        data: interviewData,
                        borderColor: '#10B981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        tension: 0.4,
                        borderWidth: 3,
                        pointBackgroundColor: '#10B981'
                    },
                    {
                        label: 'Refusées',
                        data: rejectedData,
                        borderColor: '#D1D5DB',
                        backgroundColor: 'rgba(209, 213, 219, 0.1)',
                        tension: 0.4,
                        borderWidth: 3,
                        pointBackgroundColor: '#D1D5DB'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: true,
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    });
</script>
@endpush
