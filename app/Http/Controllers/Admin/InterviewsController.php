<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InterviewsController extends Controller
{
    public function index(Request $request) 
    {
        $query = Reservation::with(['user', 'consultant', 'feedback']);
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter by consultant
        if ($request->filled('consultant')) {
            $query->where('consultant_id', $request->consultant);
        }
        
        // Filter by date range
        if ($request->filled('start_date')) {
            $query->whereDate('date', '>=', $request->start_date);
        }
        
        if ($request->filled('end_date')) {
            $query->whereDate('date', '<=', $request->end_date);
        }
        
        // Search by user or consultant name
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhereHas('consultant', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }
        
        $reservations = $query->orderBy('date', 'desc')
                             ->orderBy('time_slot', 'desc')
                             ->paginate(15);
        
        $consultants = User::where('role', 'consultant')->get();
        
        $stats = [
            'total' => Reservation::count(),
            'pending' => Reservation::where('status', 'pending')->count(),
            'confirmed' => Reservation::where('status', 'confirmed')->count(),
            'completed' => Reservation::where('status', 'completed')->count(),
            'cancelled' => Reservation::where('status', 'cancelled')->count(),
        ];
        
        return view('admin.interviews.index', compact('reservations', 'consultants', 'stats'));
    }
    
    public function show($id)
    {
        $reservation = Reservation::with(['user', 'consultant', 'feedback'])->findOrFail($id);
        
        return view('admin.interviews.show', compact('reservation'));
    }
    
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
            'notes' => 'nullable|string',
        ]);
        
        $reservation = Reservation::findOrFail($id);
        $reservation->status = $request->status;
        
        if ($request->filled('notes')) {
            $reservation->notes = $request->notes;
        }
        
        $reservation->save();
        
        return redirect()->route('admin.interviews.show', $id)
            ->with('success', 'Statut de réservation mis à jour avec succès.');
    }
    
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        
        return redirect()->route('admin.interviews.index')
            ->with('success', 'Réservation supprimée avec succès.');
    }
    
    public function dashboard()
    {
        // Réservations par statut (pour graphique)
        $statusCounts = Reservation::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->get();
        
        // Réservations par jour pour la semaine en cours
        $today = now()->startOfDay();
        $endOfWeek = now()->endOfWeek();
        $weeklyReservations = [];
        
        for ($day = $today->copy(); $day <= $endOfWeek; $day->addDay()) {
            $weeklyReservations[] = [
                'date' => $day->format('Y-m-d'),
                'day' => $day->format('D'),
                'count' => Reservation::whereDate('date', $day->format('Y-m-d'))->count()
            ];
        }
        
        // Top consultants par nombre de réservations
        $topConsultants = User::where('role', 'consultant')
            ->withCount(['reservationsAsConsultant' => function($query) {
                $query->where('status', 'completed');
            }])
            ->orderByDesc('reservations_as_consultant_count')
            ->limit(5)
            ->get();
        
        return view('admin.interviews.dashboard', compact('statusCounts', 'weeklyReservations', 'topConsultants'));
    }
}
