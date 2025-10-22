<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Article;
use Illuminate\Http\JsonResponse;

class MapApiController extends Controller
{
    public function destinations(): JsonResponse
    {
        $destinations = Destination::whereNotNull('latitude')
                                  ->whereNotNull('longitude')
                                  ->get();

        $features = [];
        foreach ($destinations as $destination) {
            $features[] = [
                'type' => 'Feature',
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [
                        (float) $destination->longitude, // GeoJSON: [lng, lat]
                        (float) $destination->latitude
                    ]
                ],
                'properties' => [
                    'id' => $destination->id,
                    'title' => $destination->title,
                    'slug' => $destination->slug,
                    'excerpt' => $destination->excerpt,
                    'cover_image' => $destination->cover_image,
                    'location' => $destination->location,
                    'province' => $destination->province,
                    'latitude' => $destination->latitude,
                    'longitude' => $destination->longitude,
                    'published_at' => $destination->published_at,
                    'featured' => $destination->featured,
                ]
            ];
        }

        return response()->json([
            'type' => 'FeatureCollection',
            'features' => $features
        ]);
    }

    public function articles(): JsonResponse
    {
        $articles = Article::whereNotNull('latitude')
                          ->whereNotNull('longitude')
                          ->get();

        $features = [];
        foreach ($articles as $article) {
            $features[] = [
                'type' => 'Feature',
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [
                        (float) $article->longitude, // GeoJSON: [lng, lat]
                        (float) $article->latitude
                    ]
                ],
                'properties' => [
                    'id' => $article->id,
                    'title' => $article->title,
                    'slug' => $article->slug,
                    'excerpt' => $article->excerpt,
                    'cover_image' => $article->cover_image,
                    'content' => $article->content,
                    'latitude' => $article->latitude,
                    'longitude' => $article->longitude,
                    'published_at' => $article->published_at,
                    'user_id' => $article->user_id,
                ]
            ];
        }

        return response()->json([
            'type' => 'FeatureCollection',
            'features' => $features
        ]);
    }
}