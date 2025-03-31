import Chart from 'chart.js/auto';

document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('vacancyStats');
    if (ctx) {
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Week 01', 'Week 02', 'Week 03', 'Week 04', 'Week 05', 'Week 06', 'Week 07', 'Week 08', 'Week 09', 'Week 10'],
                datasets: [
                    {
                        label: 'Application Sent',
                        data: [30, 45, 25, 35, 40, 50, 30, 35, 25, 20],
                        borderColor: '#6366f1',
                        tension: 0.4
                    },
                    {
                        label: 'Interviews',
                        data: [20, 35, 40, 30, 25, 35, 45, 40, 30, 25],
                        borderColor: '#10b981',
                        tension: 0.4
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
                        beginAtZero: true
                    }
                }
            }
        });
    }
}); 