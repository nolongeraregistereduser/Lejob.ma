<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsultantAvailability extends Model
{
    use HasFactory;

    protected $fillable = [
        'consultant_id',
        'date',
        'start_time',
        'end_time',
        'is_booked'
    ];

    protected $casts = [
        'date' => 'date',
        'is_booked' => 'boolean'
    ];

    // Relationship with consultant (user)
    public function consultant()
    {
        return $this->belongsTo(User::class, 'consultant_id');
    }

    // Method to check if availability can be booked
    public function isAvailable()
    {
        return !$this->is_booked;
    }

    // Format date and time for display
    public function getFormattedSlot()
    {
        $dayName = $this->date->locale('fr')->isoFormat('dddd');
        $date = $this->date->format('d/m/Y');
        $startTime = \Carbon\Carbon::parse($this->start_time)->format('H:i');
        $endTime = \Carbon\Carbon::parse($this->end_time)->format('H:i');
        
        return ucfirst($dayName) . ", {$date} - {$startTime} à {$endTime}";
    }
}