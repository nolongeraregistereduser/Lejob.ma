<?php

namespace App\Models;
use App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    protected $fillable = ['name' ,'titre', 'email', 'phone', 'education', 'experience','skills', 'certifications', 'languages', 'projects'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

  