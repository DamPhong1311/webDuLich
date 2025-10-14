@extends('layouts.myApp')
@section('title', 'Bài viết')
@section('content')
<h1>Bài viết mới nhất</h1>

<div class="articles-add-wrapper">
    <a href="{{ route('articles.create') }}" class="articles-add-btn">
        + Thêm bài viết
    </a>
</div>

<div class="articles-list-grid">
    @foreach($articles as $a)
    <article class="articles-list-item">
        <a href="{{ route('articles.show', $a) }}" class="articles-list-link">
            @if($a->cover_image)
            <img src="{{ $a->cover_image }}" class="articles-list-img">
            @endif
            <h2 class="articles-list-title">{{ $a->title }}</h2>
        </a>
        <p class="articles-list-excerpt">{{ Str::limit($a->excerpt ?? $a->content, 120) }}</p>

        {{-- Nếu là tác giả thì hiện Edit / Delete --}}
        @if($a->user_id === auth()->id())
        <div class="articles-list-actions">
            <a href="{{ route('articles.edit', $a) }}" class="articles-list-edit">✏️ Sửa</a>
            <form action="{{ route('articles.destroy', $a) }}" method="POST" class="articles-list-delete-form">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Bạn chắc chắn muốn xóa?')"
                    class="articles-list-delete-btn">
                    🗑️ Xóa
                </button>
            </form>
        </div>
        @endif
    </article>
    @endforeach
</div>

<div class="articles-pagination">{{ $articles->links() }}</div>

<style>
    .articles-add-wrapper {
        margin-bottom: 20px;
    }

    .articles-add-btn {
        padding: 8px 12px;
        background: #007bff;
        color: #fff;
        border-radius: 4px;
        text-decoration: none;
    }

    .articles-list-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 18px;
    }

    .articles-list-item {
        border: 1px solid #eee;
        padding: 12px;
        border-radius: 6px;
    }

    .articles-list-link {
        text-decoration: none;
        color: inherit;
    }

    .articles-list-img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 4px;
    }

    .articles-list-title {
        margin-top: 10px;
    }

    .articles-list-excerpt {
        color: #666;
    }

    .articles-list-actions {
        margin-top: 10px;
    }

    .articles-list-edit {
        margin-right: 10px;
        color: #007bff;
    }

    .articles-list-delete-form {
        display: inline;
    }

    .articles-list-delete-btn {
        color: red;
        border: none;
        background: none;
        cursor: pointer;
    }

    .articles-pagination {
        margin-top: 20px;
    }
</style>
@endsection