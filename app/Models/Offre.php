<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    protected $fillable = [
        'title',
        'description',
        'price',
        'category_id',
        'user_id',
        'status',
        'start_date',
        'end_date',
        'location',
        'image_path'
    ];


    // no methods for now, i'll implement the functionality
    // of controlling apis to get job offers.. 


    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // public function category()
    // {
    //     return $this->belongsTo(Category::class);
    // }
}
