@extends('layouts.myApp')

@section('title', $article->title)

@section('content')
<article class="article-article">

    {{-- TIÊU ĐỀ --}}
    <h1>{{ $article->title }}</h1>

    {{-- SLUG và TÁC GIẢ --}}
    <p class="article-slug">
        🔗 Slug: <code>{{ $article->slug }}</code>
        <br>
        ✍️ Tác giả: {{ optional($article->author)->name ?? 'Ẩn danh' }}
    </p>

    {{-- NGÀY ĐĂNG --}}
    @if($article->published_at)
    <p class="article-date">
        🕒 {{ \Carbon\Carbon::parse($article->published_at)->format('d/m/Y') }}
    </p>
    @endif

    {{-- ẢNH CHÍNH --}}
    @if($article->cover_image)
    <img src="{{ $article->cover_image }}" alt="{{ $article->title }}" class="article-cover-image">
    @endif

    {{-- TRÍCH ĐOẠN --}}
    @if($article->excerpt)
    <blockquote class="article-excerpt">
        {{ $article->excerpt }}
    </blockquote>
    @endif

    {{-- NỘI DUNG --}}
    <div class="article-content">
        {!! nl2br(e($article->content)) !!}
    </div>
    @include('components.comments', ['model' => $article])

    <style>
    .article-article {
        max-width: 900px;
        margin: auto;
    }

    .article-slug {
        color: #888;
        font-size: 14px;
    }

    .article-date {
        color: #777;
    }

    .article-cover-image {
        width: 100%;
        max-height: 450px;
        object-fit: cover;
        margin: 12px 0;
        border-radius: 6px;
    }

    .article-excerpt {
        font-style: italic;
        color: #555;
        background: #f8f8f8;
        padding: 12px;
        border-left: 4px solid #007bff;
    }

    .article-content {
        line-height: 1.8;
    }
    </style>
</article>
@endsection