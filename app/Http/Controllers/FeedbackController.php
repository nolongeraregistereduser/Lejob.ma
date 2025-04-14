<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Afficher le formulaire pour laisser un feedback
     */
    public function create(Reservation $reservation)
    {
        // Vérifier que l'utilisateur est autorisé à laisser un feedback pour cette réservation
        if ($reservation->user_id !== Auth::id() || $reservation->status !== 'completed') {
            return redirect()->route('user.reservations.index')
                ->with('error', 'Vous ne pouvez pas laisser un avis pour cette réservation.');
        }

        // Vérifier qu'un feedback n'existe pas déjà
        if ($reservation->feedback()->exists()) {
            return redirect()->route('user.reservations.index')
                ->with('error', 'Vous avez déjà laissé un avis pour cette séance.');
        }

        return view('user.feedback.create', compact('reservation'));
    }

    /**
     * Enregistrer un nouveau feedback
     */
    public function store(Request $request, Reservation $reservation)
    {
        // Vérifier que l'utilisateur est autorisé
        if ($reservation->user_id !== Auth::id() || $reservation->status !== 'completed') {
            return redirect()->route('user.reservations.index')
                ->with('error', 'Vous ne pouvez pas laisser un avis pour cette réservation.');
        }

        // Valider les données
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        // Créer le feedback
        $feedback = new Feedback([
            'user_id' => Auth::id(),
            'consultant_id' => $reservation->consultant_id,
            'reservation_id' => $reservation->id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        $feedback->save();

        return redirect()->route('user.reservations.index')
            ->with('success', 'Votre avis a été enregistré avec succès. Merci pour votre feedback!');
    }
}