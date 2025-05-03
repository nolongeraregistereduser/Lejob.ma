<?php

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ConsultantDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $consultantId = $user->id;
        $now = Carbon::now();
        
        // Get statistics
        $stats = [
            // Client statistics
            'clients' => $this->getClientCount($consultantId),
            'clientGrowth' => $this->calculateGrowth('clients', $consultantId),
            'newClients' => $this->getNewClientsThisMonth($consultantId),
            
            // Session statistics
            'sessions' => $this->getSessionCount($consultantId),
            'sessionGrowth' => $this->calculateGrowth('sessions', $consultantId),
            'upcomingSessions' => $this->getUpcomingSessions($consultantId),
            
            // Earnings statistics
            'earnings' => $this->getTotalEarnings($consultantId),
            'earningGrowth' => $this->calculateGrowth('earnings', $consultantId),
            'monthlyEarnings' => $this->getMonthlyEarnings($consultantId),
            
            // Rating statistics
            'rating' => $this->getAverageRating($consultantId),
            'ratingGrowth' => $this->calculateGrowth('rating', $consultantId),
            'reviewCount' => $this->getReviewCount($consultantId),
        ];
        
        // Get recent activities
        $recentActivities = $this->getRecentActivities($consultantId);
        
        return view('consultant.dashboard', compact('user', 'stats', 'recentActivities'));
    }
    
    /**
     * Get unique client count
     */
    private function getClientCount($consultantId)
    {
        return Reservation::where('consultant_id', $consultantId)
            ->distinct('user_id')
            ->count('user_id');
    }
    
    /**
     * Get new clients this month
     */
    private function getNewClientsThisMonth($consultantId)
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        
        return Reservation::where('consultant_id', $consultantId)
            ->where('created_at', '>=', $startOfMonth)
            ->distinct('user_id')
            ->count('user_id');
    }
    
    /**
     * Get total session count
     */
    private function getSessionCount($consultantId)
    {
        return Reservation::where('consultant_id', $consultantId)->count();
    }
    
    /**
     * Get upcoming sessions count
     */
    private function getUpcomingSessions($consultantId)
    {
        $now = Carbon::now();
        $endOfWeek = Carbon::now()->endOfWeek();
        
        return Reservation::where('consultant_id', $consultantId)
            ->where('date', '>=', $now->format('Y-m-d'))
            ->where('date', '<=', $endOfWeek->format('Y-m-d'))
            ->count();
    }
    
    /**
     * Get total earnings
     */
    private function getTotalEarnings($consultantId)
    {
        $user = User::find($consultantId);
        $hourlyRate = $user->hourly_rate ?? 300;
        
        $completedSessions = Reservation::where('consultant_id', $consultantId)
            ->where('status', 'completed')
            ->count();
            
        return $hourlyRate * $completedSessions;
    }
    
    /**
     * Get monthly earnings
     */
    private function getMonthlyEarnings($consultantId)
    {
        $startOfMonth = Carbon::now()->startOfMonth();
        $user = User::find($consultantId);
        $hourlyRate = $user->hourly_rate ?? 300;
        
        $completedSessions = Reservation::where('consultant_id', $consultantId)
            ->where('status', 'completed')
            ->where('date', '>=', $startOfMonth->format('Y-m-d'))
            ->count();
            
        return $hourlyRate * $completedSessions;
    }
    
    /**
     * Get average rating
     */
    private function getAverageRating($consultantId)
    {
        // Replace this with actual rating logic if you have a ratings table
        return number_format(rand(40, 50) / 10, 1); // Mock rating between 4.0-5.0
    }
    
    /**
     * Get review count
     */
    private function getReviewCount($consultantId)
    {
        // Replace this with actual review count logic if you have a reviews table
        return rand(5, 30); // Mock review count
    }
    
    /**
     * Calculate growth percentage
     */
    private function calculateGrowth($metric, $consultantId)
    {
        // This would normally compare current period to previous period
        // For now, returning mock growth percentages
        $growthRates = [
            'clients' => rand(5, 20),
            'sessions' => rand(8, 25),
            'earnings' => rand(10, 30),
            'rating' => rand(1, 5)
        ];
        
        return $growthRates[$metric] ?? 0;
    }
    
    /**
     * Get recent activities
     */
    private function getRecentActivities($consultantId)
    {
        $activities = [];
        
        // Get latest reservations
        $reservations = Reservation::where('consultant_id', $consultantId)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
            
        foreach ($reservations as $reservation) {
            $status = $reservation->status ?? 'pending';
            
            $activityType = match($status) {
                'confirmed' => [
                    'color' => 'bg-green-100',
                    'iconColor' => 'text-green-600',
                    'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                    'title' => 'Réservation confirmée',
                ],
                'completed' => [
                    'color' => 'bg-blue-100',
                    'iconColor' => 'text-blue-600',
                    'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                    'title' => 'Session complétée',
                ],
                'rejected' => [
                    'color' => 'bg-red-100',
                    'iconColor' => 'text-red-600',
                    'icon' => 'M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z',
                    'title' => 'Réservation annulée',
                ],
                default => [
                    'color' => 'bg-yellow-100',
                    'iconColor' => 'text-yellow-600',
                    'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                    'title' => 'Nouvelle réservation',
                ]
            };
            
            $time = Carbon::parse($reservation->created_at)->diffForHumans();
            $date = Carbon::parse($reservation->date)->format('d/m/Y');
            $timeSlot = Carbon::parse($reservation->time_slot)->format('H:i');
            
            $activities[] = array_merge($activityType, [
                'description' => "Pour le {$date} à {$timeSlot}",
                'time' => $time,
                'clientName' => $reservation->user->name ?? 'Client',
            ]);
        }
        
        return $activities;
    }
    
    /**
     * Display the availability management page.
     */
    public function availability()
    {
        $user = auth()->user();
        $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
        $dayNames = [
            'monday' => 'Lundi',
            'tuesday' => 'Mardi',
            'wednesday' => 'Mercredi',
            'thursday' => 'Jeudi',
            'friday' => 'Vendredi',
            'saturday' => 'Samedi',
            'sunday' => 'Dimanche'
        ];
        
        return view('consultant.availability', compact('user', 'days', 'dayNames'));
    }
    
    /**
     * Display the bookings page.
     */
    public function bookings()
    {
        $user = auth()->user();
        return view('consultant.bookings', compact('user'));
    }
}
