<?php

namespace App\Http\Controllers\Consultant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConsultantDashboardController extends Controller
{
    /**
     * Display the consultant dashboard.
     */
    public function index()
    {
        $user = auth()->user();
        
        // Dashboard statistics (placeholders for now)
        $stats = [
            'clients' => 0,
            'sessions' => 0,
            'earnings' => '0 MAD',
            'rating' => '0.0'
        ];
        
        // Recent activities (placeholder)
        $recentActivities = [];
        
        return view('consultant.dashboard', compact('user', 'stats', 'recentActivities'));
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
