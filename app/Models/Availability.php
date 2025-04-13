<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    use HasFactory;

    protected $fillable = [
        'consultant_id',
        'day_of_week', // 0-6 (Sunday-Saturday)
        'start_time',
        'end_time',
        'is_available'
    ];

    // Relationships
    public function consultant()
    {
        return $this->belongsTo(User::class, 'consultant_id');
    }
}