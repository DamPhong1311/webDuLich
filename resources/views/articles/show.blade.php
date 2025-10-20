@extends('layouts.myApp')

@section('title', $article->title)
@push('styles')
@vite(['resources/css/articles/show.css', 'resources/js/app.js'])
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
        @if(Str::startsWith($article->cover_image, ['http://', 'https://']))
            {{-- Ảnh link --}}
            <img src="{{ $article->cover_image }}" alt="{{ $article->title }}" class="article-cover-image">
        @else
            {{-- Ảnh upload --}}
            <img src="{{ asset('storage/' . $article->cover_image) }}" alt="{{ $article->title }}" class="article-cover-image">
        @endif
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

</article>
@endsection 