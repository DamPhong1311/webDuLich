<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DestinationController extends Controller
{
    public function index()
    {
        $destinations = Destination::whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->paginate(9);
        return view('destinations.index', compact('destinations'));
    }

    public function show(Destination $destination)
    {
        $destination->load(['comments.user:id,name']);

        $isFavorited = false;
        $isSaved = false;

        if (Auth::check()) {
            $user = Auth::user();
            $isFavorited = $user->favoriteDestinations()->where('slug', $destination->slug)->exists();
            // SỬA LỖI TẠI ĐÂY: 'a' được thay bằng '$destination->slug'
            $isSaved = $user->savedDestinations()->where('slug', $destination->slug)->exists();
        }

        return view('destinations.show', compact('destination', 'isFavorited', 'isSaved'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function edit(Destination $destination)
    {
        //
    }

    public function update(Request $request, Destination $destination)
    {
        //
    }

    public function destroy(Destination $destination)
    {
        //
    }
}

