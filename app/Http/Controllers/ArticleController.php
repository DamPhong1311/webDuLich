<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->paginate(8);

        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        if (!Auth::check()) {
            abort(403, 'Bạn cần đăng nhập để tạo bài viết.');
        }
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Lưu file ảnh nếu có
        $path = null;
        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('articles', 'public');
        }

        $article = Article::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'excerpt' => $validated['excerpt'] ?? '',
            'content' => $validated['content'] ?? '',
            'cover_image' => $path,
            'user_id' => Auth::id(),
            'published_at' => Carbon::now(),
        ]);

        return redirect()->route('articles.index')->with('success', 'Tạo bài viết thành công!');
    }

    public function show(Article $article)
    {
        $article->load([
            'author:id,name',
            'comments.user:id,name'
        ]);
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        if ($article->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền sửa bài này');
        }

        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        if ($article->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền cập nhật bài này');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Nếu có ảnh mới thì upload và thay thế
        if ($request->hasFile('cover_image')) {
            // Xóa ảnh cũ (nếu có)
            if ($article->cover_image && Storage::disk('public')->exists($article->cover_image)) {
                Storage::disk('public')->delete($article->cover_image);
            }
            $path = $request->file('cover_image')->store('articles', 'public');
            $article->cover_image = $path;
        }

        $article->update([
            'title' => $validated['title'],
            'excerpt' => $validated['excerpt'] ?? '',
            'content' => $validated['content'] ?? '',
            'cover_image' => $article->cover_image,
        ]);

        return redirect()->route('articles.index')->with('success', 'Cập nhật bài viết thành công!');
    }

    public function destroy(Article $article)
    {
        if ($article->user_id !== Auth::id()) {
            abort(403, 'Bạn không có quyền xóa bài này');
        }

        // Xóa ảnh khi xóa bài
        if ($article->cover_image && Storage::disk('public')->exists($article->cover_image)) {
            Storage::disk('public')->delete($article->cover_image);
        }

        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Xóa bài viết thành công!');
    }
}
    