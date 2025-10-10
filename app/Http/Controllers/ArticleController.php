<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

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
        if (!auth()->check()) {
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
            'cover_image' => 'nullable|url',
        ]);

        $article = Article::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'excerpt' => $validated['excerpt'] ?? '',
            'content' => $validated['content'] ?? '',
            'cover_image' => $validated['cover_image'] ?? null,
            'user_id' => auth()->id(),
            'published_at' => Carbon::now(),
        ]);

        return redirect()->route('articles.index')->with('success', 'Tạo bài viết thành công!');
    }

    public function show(Article $article)
    {
        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        if ($article->user_id !== auth()->id()) {
            abort(403, 'Bạn không có quyền sửa bài này');
        }

        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        if ($article->user_id !== auth()->id()) {
            abort(403, 'Bạn không có quyền cập nhật bài này');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'cover_image' => 'nullable|url',
        ]);

        $article->update($validated); 

        return redirect()->route('articles.index')->with('success', 'Cập nhật bài viết thành công!');
    }

    public function destroy(Article $article) 
    {
        if ($article->user_id !== auth()->id()) {
            abort(403, 'Bạn không có quyền xóa bài này');
        }

        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Xóa bài viết thành công!');
    }
}