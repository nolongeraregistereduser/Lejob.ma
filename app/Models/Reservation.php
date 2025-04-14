<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'consultant_id', 
        'date', 
        'time_slot', 
        'status'
    ];

    // Relationship with user (Job seeker)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relationship with consultant
    public function consultant()
    {
        return $this->belongsTo(User::class, 'consultant_id');
    }

    /**
     * Feedback associé à cette réservation
     */
    public function feedback()
    {
        return $this->hasOne(Feedback::class);
    }

    /**
     * Vérifier si cette réservation peut recevoir un feedback
     */
    public function canLeaveFeedback()
    {
        return $this->status === 'completed' && !$this->feedback()->exists();
    }
}
