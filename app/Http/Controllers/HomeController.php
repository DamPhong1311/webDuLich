<?php
namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Article;

class HomeController extends Controller
{
    public function index()
    {
        // Lấy 6 điểm đến nổi bật
        $featuredDestinations = Destination::where('featured', true)
            ->orderBy('published_at', 'desc')
            ->take(6)
            ->get();

        // Lấy 3 bài viết mới nhất
        $latestArticles = Article::whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        return view('home', compact('featuredDestinations', 'latestArticles'));
    }
}
