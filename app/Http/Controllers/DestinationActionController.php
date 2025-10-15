<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DestinationActionController extends Controller
{
    /**
     * Chuyển đổi trạng thái yêu thích của một địa điểm.
     */
    public function toggleFavorite(Request $request, $slug)
    {
        $user = Auth::user();
        // The toggle method adds or removes the relationship entry
        $user->favoriteDestinations()->toggle($slug);

        // Check if the relationship now exists to return the current state
        $favorited = $user->favoriteDestinations()->where('slug', $slug)->exists();

        return response()->json(['favorited' => $favorited]);
    }

    /**
     * Chuyển đổi trạng thái lưu của một địa điểm.
     */
    public function toggleSave(Request $request, $slug)
    {
        $user = Auth::user();
        $user->savedDestinations()->toggle($slug);

        $saved = $user->savedDestinations()->where('slug', $slug)->exists();

        return response()->json(['saved' => $saved]);
    }

    /**
     * Hiển thị trang các địa điểm đã lưu của người dùng.
     */
    public function savedDestinations()
    {
        $savedDestinations = Auth::user()->savedDestinations()->paginate(9);
        return view('destinations.saved', compact('savedDestinations'));
    }
}

