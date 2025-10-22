<?php
namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Article;

class HomeController extends Controller
{
    public function index()
    {
        $featuredDestinations = Destination::where('featured', true)
            ->orderBy('published_at', 'desc')
            ->take(6)
            ->get();

        $latestArticles = Article::whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        return view('home', compact('featuredDestinations', 'latestArticles'));
    }
}
