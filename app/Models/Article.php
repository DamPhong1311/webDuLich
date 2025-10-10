<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'cover_image',
        'user_id',
        'published_at',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    protected $casts = [
        'published_at' => 'datetime',
    ];
}
