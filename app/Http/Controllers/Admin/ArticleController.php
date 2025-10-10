<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    
    public function index()
    {
        $items = Article::orderBy('created_at', 'desc')->paginate(12);
        return view('admin.articles.index', compact('items'));
    }

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'cover_image' => 'nullable|image|max:4096',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('articles', 'public');
        }

        $data['slug'] = Str::slug($data['title']) . '-' . rand(1, 9999);
        $data['user_id'] = auth()->id();
        Article::create($data);
        return redirect()->route('admin.articles.index')->with('success', 'Đã tạo bài viết.');
    }

    public function edit(Article $article)
    {
        if ($article->user_id !== auth()->id()) {
            abort(403, 'Bạn không có quyền sửa bài này.');
        }
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        if ($article->user_id !== auth()->id()) {
            abort(403, 'Bạn không có quyền sửa bài này.');
        }
        $data = $request->validate([
            'title' => 'required|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'nullable|string',
            'cover_image' => 'nullable|image|max:4096',
            'published_at' => 'nullable|date',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($article->cover_image) {
                Storage::disk('public')->delete($article->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('articles', 'public');
        }

        $article->update($data);
        return redirect()->route('articles.index')->with('success', 'Cập nhật thành công.');
    }

    public function destroy(Article $article)
    {
        if ($article->user_id !== auth()->id()) {
            abort(403, 'Bạn không có quyền xóa bài này.');
        }
        if ($article->cover_image) {
            Storage::disk('public')->delete($article->cover_image);
        }
        $article->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Đã xóa bài viết.');
    }
}
