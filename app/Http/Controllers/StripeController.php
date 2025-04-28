<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class StripeController extends Controller
{
    public function checkout(Request $request)
    {
        $validated = $request->validate([
            'consultant_id' => 'required|exists:users,id',
            'date' => 'required|date|after_or_equal:today',
            'time_slot' => 'required',
            'notes' => 'nullable|string|max:500',
        ]);
        
        $consultant = User::findOrFail($validated['consultant_id']);
        
        if (!$consultant->hourly_rate) {
            // Default rate if not set
            $hourly_rate = 300;
        } else {
            $hourly_rate = $consultant->hourly_rate;
        }
        
        // Format date for display
        $formattedDate = date('d/m/Y', strtotime($validated['date']));
        $formattedTime = $validated['time_slot'];
        
        Stripe::setApiKey(env('STRIPE_SECRET'));
        
        $checkout_session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'mad',
                    'product_data' => [
                        'name' => "Consultation avec {$consultant->name}",
                        'description' => "Rendez-vous le {$formattedDate} à {$formattedTime}"
                    ],
                    'unit_amount' => $hourly_rate * 100, // Stripe requires amount in cents
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('stripe.success') . "?session_id={CHECKOUT_SESSION_ID}&consultant_id={$validated['consultant_id']}&date={$validated['date']}&time_slot={$validated['time_slot']}&notes=" . ($validated['notes'] ?? ''),
            'cancel_url' => route('consultants.show', $validated['consultant_id']) . '?cancelled=true',
        ]);
        
        return redirect($checkout_session->url);
    }
    
    public function success(Request $request)
    {
        // Simple validation of query parameters
        $request->validate([
            'consultant_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'time_slot' => 'required',
        ]);
        
        // Create the reservation record
        $reservation = new Reservation([
            'user_id' => Auth::id(),
            'consultant_id' => $request->consultant_id,
            'date' => $request->date,
            'time_slot' => $request->time_slot,
            'status' => 'pending', // Manually confirm wakha payment is made but consultant should confirm the reservation
            'payment_status' => 'paid',
            'notes' => $request->notes,
        ]);
        
        $reservation->save();
        // dd($reservation);
        return redirect()->route('user.reservations.index')
            ->with('success', 'Votre rendez-vous a été réservé avec succès !');
    }
}