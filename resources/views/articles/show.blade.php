@extends('layouts.myApp')

@section('title', $article->title)
@push('styles')
@vite(['resources/css/articles/show.css', 'resources/js/app.js'])
@section('content')
<article class="article-article">

    <h1>{{ $article->title }}</h1>

    <p class="article-slug">
        🔗 Slug: <code>{{ $article->slug }}</code>
        <br>
        ✍️ Tác giả: {{ optional($article->author)->name ?? 'Ẩn danh' }}
    </p>
    @if($article->published_at)
    <p class="article-date">
        🕒 {{ \Carbon\Carbon::parse($article->published_at)->format('d/m/Y') }}
    </p>
    @endif

    @if($article->cover_image)
        @if(Str::startsWith($article->cover_image, ['http://', 'https://']))

            <img src="{{ $article->cover_image }}" alt="{{ $article->title }}" class="article-cover-image">
        @else
            <img src="{{ asset('storage/' . $article->cover_image) }}" alt="{{ $article->title }}" class="article-cover-image">
        @endif
    @endif
    @if($article->excerpt)
    <blockquote class="article-excerpt">
        {{ $article->excerpt }}
    </blockquote>
    @endif

    <div class="article-content">
        {!! nl2br(e($article->content)) !!}
    </div>
    @include('components.comments', ['model' => $article])

</article>
@endsection 