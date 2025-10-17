<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'cover_image',
        'gallery',
        'location',
        'province',
        'featured',
        'published_at',
        'latitude',
        'longitude'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'featured' => 'boolean',
        'gallery' => 'array',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function comments()
    {
        return $this->morphMany(\App\Models\Comment::class, 'commentable')->latest();
    }


    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'user_favorite_destination', 'destination_slug', 'user_id', 'slug', 'id');
    }

    public function scopeHasCoords($q)
    {
        return $q->whereNotNull('latitude')->whereNotNull('longitude');
    }
}