<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_admin' => 'boolean',
        ];
    }

    public function isAdmin()
    {
        return $this->is_admin;
    }


    public function favoriteDestinations()
    {
        return $this->belongsToMany(Destination::class, 'user_favorite_destination', 'user_id', 'destination_slug', 'id', 'slug');
    }


    public function savedDestinations()
    {
        return $this->belongsToMany(Destination::class, 'user_saved_destination', 'user_id', 'destination_slug', 'id', 'slug');
    }
}

