<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Bắt đầu câu truy vấn
        $query = Destination::query()->whereNotNull('published_at');

        // Xử lý tìm kiếm theo từ khóa
        if ($request->has('search') && $request->input('search') != '') {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('excerpt', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('content', 'LIKE', "%{$searchTerm}%");
            });
        }

        // Xử lý lọc theo tỉnh/thành phố
        if ($request->has('province') && $request->input('province') != '') {
            $query->where('province', $request->input('province'));
        }

        // Lấy danh sách các tỉnh/thành phố duy nhất để hiển thị trong dropdown
        $provinces = Destination::select('province')->whereNotNull('province')->distinct()->orderBy('province', 'asc')->pluck('province');

        // Lấy kết quả đã phân trang
        $destinations = $query->orderBy('published_at', 'desc')->paginate(9)->withQueryString();

        return view('destinations.index', [
            'destinations' => $destinations,
            'provinces' => $provinces,
            'selectedProvince' => $request->input('province', ''), // Tỉnh đang được chọn
            'searchTerm' => $request->input('search', ''), // Từ khóa đang tìm kiếm
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Destination $destination)
    {
        $destination->load(['comments.user:id,name']);

        $isFavorited = false;
        $isSaved = false;

        if (Auth::check()) {
            $user = Auth::user();
            $isFavorited = $user->favoriteDestinations()->where('destination_slug', $destination->slug)->exists();
            $isSaved = $user->savedDestinations()->where('destination_slug', $destination->slug)->exists();
        }

        return view('destinations.show', compact('destination', 'isFavorited', 'isSaved'));
    }
}

