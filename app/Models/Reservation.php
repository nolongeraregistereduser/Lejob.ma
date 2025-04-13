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
        'time',
        'duration',
        'status', // PENDING, CONFIRMED, CANCELLED
        'amount',
        'payment_status',
        'notes'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function consultant()
    {
        return $this->belongsTo(User::class, 'consultant_id');
    }

    public function feedback()
    {
        return $this->hasOne(Feedback::class);
    }

    // Methods
    public function cancel()
    {
        $this->status = 'CANCELLED';
        return $this->save();
    }

    public function updateStatus($status)
    {
        $this->status = $status;
        return $this->save();
    }
}