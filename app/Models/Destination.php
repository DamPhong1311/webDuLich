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
        'published_at'
    ];
    protected $casts = [
        'published_at' => 'datetime',
        'featured' => 'boolean',    
        'gallery' => 'array',   
    ];


}
