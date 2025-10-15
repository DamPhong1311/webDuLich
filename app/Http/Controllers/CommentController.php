<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Destination;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function storeForArticle(Request $request, Article $article)
    {
        $data = $request->validate(['body' => 'required|string|min:3|max:5000']);
        $comment = new Comment($data);
        $comment->user()->associate($request->user());
        $article->comments()->save($comment);

        return back()->with('success', 'Đã đăng bình luận!');
    }

    public function storeForDestination(Request $request, Destination $destination)
    {
        $data = $request->validate(['body' => 'required|string|min:3|max:5000']);
        $comment = new Comment($data);
        $comment->user()->associate($request->user());
        $destination->comments()->save($comment);

        return back()->with('success', 'Đã đăng bình luận!');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return back()->with('success', 'Đã xoá bình luận.');
    }
}