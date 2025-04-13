<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use HasFactory;

    protected $fillable = [
        'consultant_id',
        'day_of_week',
        'start_time',
        'end_time',
        'is_available'
    ];

    /**
     * Get the consultant that owns the availability.
     */
    public function consultant()
    {
        return $this->belongsTo(User::class, 'consultant_id');
    }

    /**
     * Get the day name for this availability
     */
    public function getDayNameAttribute()
    {
        $days = [
            0 => 'Dimanche',
            1 => 'Lundi',
            2 => 'Mardi',
            3 => 'Mercredi',
            4 => 'Jeudi',
            5 => 'Vendredi',
            6 => 'Samedi',
        ];

        return $days[$this->day_of_week] ?? 'Unknown';
    }

    /**
     * Format the time range for display
     */
    public function getTimeRangeAttribute()
    {
        return date('H:i', strtotime($this->start_time)) . ' - ' . 
               date('H:i', strtotime($this->end_time));
    }
}