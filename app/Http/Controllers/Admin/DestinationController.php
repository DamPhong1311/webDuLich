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
    public function index()
    {
        $items = Destination::orderBy('created_at', 'desc')->paginate(12);
        return view('admin.destinations.index', compact('items'));
    }

    public function create()
    {
        return view('admin.destinations.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'location' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'published_at' => 'nullable|date',
            'featured' => 'nullable|boolean',
        ]);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('cover_images', 'public');
        }

        $galleryPaths = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                if ($file->isValid()) {
                    $galleryPaths[] = $file->store('gallery', 'public');
                }
            }
        }
        $data['gallery'] = !empty($galleryPaths) ? json_encode($galleryPaths) : null;


        $slug = Str::slug($data['title']);
        $original = $slug;
        $i = 1;
        while (Destination::where('slug', $slug)->exists()) {
            $slug = $original . '-' . $i;
            $i++;
        }
        $data['slug'] = $slug;

        $data['featured'] = $request->has('featured');

        $data['published_at'] = $data['published_at'] ?? Carbon::now();

        Destination::create($data);

        return redirect()->route('admin.destinations.index')->with('success', 'Tạo điểm đến thành công.');
    }

    public function show(Destination $destination)
    {
        return view('admin.destinations.show', compact('destination'));
    }

    public function edit(Destination $destination)
    {
        return view('admin.destinations.edit', compact('destination'));
    }

    public function update(Request $request, Destination $destination)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'location' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'published_at' => 'nullable|date',
            'featured' => 'nullable|boolean',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($destination->cover_image && Storage::disk('public')->exists($destination->cover_image)) {
                Storage::disk('public')->delete($destination->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('cover_images', 'public');
        }

        $existingGallery = json_decode($destination->gallery ?? '[]', true);
        $newGallery = [];

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                if ($file->isValid()) {
                    $newGallery[] = $file->store('gallery', 'public');
                }
            }
        }


        if (!empty($newGallery)) {
            $mergedGallery = array_merge($existingGallery, $newGallery);
            $data['gallery'] = json_encode($mergedGallery);
        } else {
            $data['gallery'] = json_encode($existingGallery);
        }


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

        return redirect()->route('admin.destinations.index')->with('success', 'Cập nhật điểm đến thành công.');
    }

    public function destroy(Destination $destination)
    {
        if ($destination->cover_image && Storage::disk('public')->exists($destination->cover_image)) {
            Storage::disk('public')->delete($destination->cover_image);
        }

        $gallery = json_decode($destination->gallery ?? '[]', true);
        foreach ($gallery as $img) {
            if (Storage::disk('public')->exists($img)) {
                Storage::disk('public')->delete($img);
            }
        }

        $destination->delete();

        return redirect()->route('admin.destinations.index')->with('success', 'Xóa điểm đến thành công.');
    }

    public function removeGalleryImage(Request $request, Destination $destination)
    {
        $request->validate([
            'image_path' => 'required|string',
        ]);

        $imagePath = $request->image_path;
        $gallery = json_decode($destination->gallery ?? '[]', true);

        if (($key = array_search($imagePath, $gallery)) !== false) {
   
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            unset($gallery[$key]);
            $gallery = array_values($gallery);

            $destination->update([
                'gallery' => !empty($gallery) ? json_encode($gallery) : null,
            ]);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }
}
