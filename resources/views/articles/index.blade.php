@extends('layouts.myApp')
@section('title', 'Bài viết')
@push('styles')
@vite(['resources/css/articles/index.css', 'resources/js/app.js'])
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
                {{-- Kiểm tra nếu là URL đầy đủ (http/https) --}}
                @if(Str::startsWith($a->cover_image, ['http://', 'https://']))
                    <img src="{{ $a->cover_image }}" class="articles-list-img">
                @else
                    {{-- Ảnh upload trong storage --}}
                    <img src="{{ asset('storage/' . $a->cover_image) }}" class="articles-list-img">
                @endif
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

@endsection