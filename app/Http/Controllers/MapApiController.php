<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Article;

class MapApiController extends Controller
{
    public function destinations()
    {
        $data = cache()->remember('map.destinations', now()->addMinutes(5), function () {
            return Destination::select('title', 'slug', 'cover_image', 'province', 'latitude', 'longitude')
                ->hasCoords()->latest('id')->get();
        });
        return response()->json($data)->header('Cache-Control', 'public, max-age=60');
    }

    public function articles()
    {
        $data = cache()->remember('map.articles', now()->addMinutes(5), function () {
            return Article::select('title', 'slug', 'cover_image', 'latitude', 'longitude', 'published_at')
                ->hasCoords()->latest('published_at')->get();
        });
        return response()->json($data)->header('Cache-Control', 'public, max-age=60');
    }
}