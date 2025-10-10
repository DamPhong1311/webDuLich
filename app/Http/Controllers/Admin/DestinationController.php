<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
class DestinationController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Destination::orderBy('created_at', 'desc')->paginate(12);
        return view('admin.destinations.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.destinations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'cover_image' => 'nullable|url',
            'location' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
            'featured' => 'nullable|boolean',
        ]);



        if ($request->has('gallery') && !empty($request->gallery)) {
            $data['gallery'] = $request->gallery;
        } else {
            $data['gallery'] = null;
        }   
        // unique slug
        $slug = Str::slug($data['title']);
        $original = $slug;
        $i = 1;
        while (Destination::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $i;
            $i++;
        }
        $data['slug'] = $slug;

        $data['featured'] = $request->has('featured');

        // THÊM: Set published_at nếu không có giá trị
        if (empty($data['published_at'])) {
            $data['published_at'] = Carbon::now();
        }

        $destination = Destination::create($data);

        return redirect()->route('admin.destinations.index')->with('success', 'Tạo điểm đến thành công.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Destination $destination)
    {
        return view('admin.destinations.show', compact('destination'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Destination $destination)
    {
        return view('admin.destinations.edit', compact('destination'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Destination $destination)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'cover_image' => 'nullable|url',
            'location' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'published_at' => 'nullable|date',
            'featured' => 'nullable|boolean',
        ]);

        // Xử lý gallery từ URL

        if ($request->has('gallery') && !empty($request->gallery)) {
            $data['gallery'] = $request->gallery;
        } else {
            $data['gallery'] = null;
        }

        // update slug only if title changed
        if ($data['title'] !== $destination->title) {
            $slug = Str::slug($data['title']);
            $original = $slug;
            $i = 1;
            while (Destination::where('slug', $slug)->where('id', '!=', $destination->id)->exists()) {
                $slug = $original . '-' . $i;
                $i++;
            }
            $data['slug'] = $slug;
        }

        $data['featured'] = $request->has('featured');


        $destination->update($data);

        return redirect()->route('admin.destinations.index')->with('success', 'Cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Destination $destination)
    {

        $destination->delete();

        return redirect()->route('admin.destinations.index')->with('success', 'Xóa điểm đến thành công.');
    }
}
