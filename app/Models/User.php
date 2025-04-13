<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'first_name',
        'last_name',
        'username',
        'phone',
        'whatsapp',
        'address',
        'city',
        'country',
        'bio',
        'title', // Make sure this is included
        'profile_picture',
        'available_for_hire',
        'role',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'available_for_hire' => 'boolean',
        ];
    }
    
    /**
     * Check if the user has a specific role
     *
     * @param string $role
     * @return bool
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    // Relationships for booking system
    public function reservationsAsUser()
    {
        return $this->hasMany(Reservation::class, 'user_id');
    }

    public function reservationsAsConsultant()
    {
        return $this->hasMany(Reservation::class, 'consultant_id');
    }

    public function availabilities()
    {
        return $this->hasMany(Availability::class, 'consultant_id');
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class);
    }
}
