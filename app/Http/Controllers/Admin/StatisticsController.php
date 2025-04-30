<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Cv;
use App\Models\Reservation;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function index()
    {
        // User statistics
        $userStats = [
            'total' => User::count(),
            'jobSeekers' => User::where('role', 'user')->count(),
            'consultants' => User::where('role', 'consultant')->count(),
            'pendingConsultants' => User::where('role', 'consultant')->where('status', 'inactive')->count(),
            'newThisMonth' => User::whereMonth('created_at', now()->month)->count(),
        ];
        
        // CV statistics
        $cvStats = [
            'total' => Cv::count(),
            'byMonth' => $this->getMonthlyCvData(),
        ];
        
        // Reservation statistics
        $reservationStats = [
            'total' => Reservation::count(),
            'pending' => Reservation::where('status', 'pending')->count(),
            'confirmed' => Reservation::where('status', 'confirmed')->count(),
            'completed' => Reservation::where('status', 'completed')->count(),
            'cancelled' => Reservation::where('status', 'cancelled')->count(),
            'revenue' => $this->calculateTotalRevenue(),
            'monthlyData' => $this->getMonthlyReservationData(),
        ];
        
        // Top consultants by rating - PostgreSQL compatible version
        $topConsultants = DB::table('users')
            ->select(
                'users.*',
                DB::raw('(SELECT COUNT(*) FROM feedback WHERE users.id = feedback.consultant_id) as feedbacks_count'), // Changed from feedback_count to feedbacks_count
                DB::raw('(SELECT AVG(rating) FROM feedback WHERE users.id = feedback.consultant_id) as average_rating')
            )
            ->where('role', 'consultant')
            ->where('status', 'active')
            ->whereRaw('(SELECT COUNT(*) FROM feedback WHERE users.id = feedback.consultant_id) > 0')
            ->orderByDesc('average_rating')
            ->limit(5)
            ->get();
            
        // Most active users (by CV creation)
        $activeUsers = User::withCount('cvs')
            ->orderByDesc('cvs_count')
            ->limit(5)
            ->get();
            
        return view('admin.statistics.index', compact(
            'userStats', 
            'cvStats', 
            'reservationStats', 
            'topConsultants',
            'activeUsers'
        ));
    }
    
    private function calculateTotalRevenue()
    {
        // Calculate revenue based on completed sessions and hourly rates
        return Reservation::where('reservations.status', 'completed')  // Specify the table name
            ->join('users', 'users.id', '=', 'reservations.consultant_id')
            ->sum(DB::raw('hourly_rate'));
    }
    
    private function getMonthlyCvData()
    {
        $months = collect([]);
        
        // Get data for the last 6 months
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthName = $date->format('M');
            
            $count = Cv::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();
                
            $months->push([
                'month' => $monthName,
                'count' => $count
            ]);
        }
        
        return $months;
    }
    
    private function getMonthlyReservationData()
    {
        $months = collect([]);
        
        // Get data for the last 6 months
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthName = $date->format('M');
            
            $count = Reservation::whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->count();
                
            // Calculate revenue based on completed sessions and hourly rates for this month
            $revenue = Reservation::whereMonth('reservations.created_at', $date->month)
                ->whereYear('reservations.created_at', $date->year)
                ->where('reservations.status', 'completed')  // Specify the table name
                ->join('users', 'users.id', '=', 'reservations.consultant_id')
                ->sum(DB::raw('hourly_rate'));
                
            $months->push([
                'month' => $monthName,
                'count' => $count,
                'revenue' => $revenue
            ]);
        }
        
        return $months;
    }
}
