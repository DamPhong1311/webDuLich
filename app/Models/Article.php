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
    public function comments()
    {
        return $this->morphMany(\App\Models\Comment::class, 'commentable')->latest();
    }

    public function getRouteKeyName()
    {
        return 'slug'; // cho implicit route model binding
    }
}