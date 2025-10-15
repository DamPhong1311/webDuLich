<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DestinationActionController extends Controller
{

    public function toggleFavorite(Request $request, $slug)
    {
        $user = Auth::user();
        $user->favoriteDestinations()->toggle($slug);

        $favorited = $user->favoriteDestinations()->where('slug', $slug)->exists();

        return response()->json(['favorited' => $favorited]);
    }


    public function toggleSave(Request $request, $slug)
    {
        $user = Auth::user();
        $user->savedDestinations()->toggle($slug);

        $saved = $user->savedDestinations()->where('slug', $slug)->exists();

        return response()->json(['saved' => $saved]);
    }


    public function savedDestinations()
    {
        $savedDestinations = Auth::user()->savedDestinations()->paginate(9);
        return view('destinations.saved', compact('savedDestinations'));
    }
}

