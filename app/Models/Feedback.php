<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'consultant_id', 'reservation_id', 'rating', 'comment'];

    /**
     * Relation avec l'utilisateur qui a laissé le feedback
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relation avec le consultant qui a reçu le feedback
     */
    public function consultant()
    {
        return $this->belongsTo(User::class, 'consultant_id');
    }

    /**
     * Relation avec la réservation associée
     */
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
