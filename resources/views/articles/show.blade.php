@extends('layouts.myApp')

@section('title', $article->title)

@section('content')
<article style="max-width:900px;margin:auto;">

    {{-- TIÊU ĐỀ --}}
    <h1>{{ $article->title }}</h1>

    {{-- SLUG và TÁC GIẢ --}}
    <p style="color:#888;font-size:14px;">
        🔗 Slug: <code>{{ $article->slug }}</code>
        <br>
        ✍️ Tác giả: {{ optional($article->author)->name ?? 'Ẩn danh' }}
    </p>

    {{-- NGÀY ĐĂNG --}}
    @if($article->published_at)
        <p style="color:#777">
            🕒 {{ \Carbon\Carbon::parse($article->published_at)->format('d/m/Y') }}
        </p>
    @endif

    {{-- ẢNH CHÍNH --}}
    @if($article->cover_image)
        <img src="{{ $article->cover_image }}" 
             alt="{{ $article->title }}" 
             style="width:100%;max-height:450px;object-fit:cover;margin:12px 0;border-radius:6px;">
    @endif

    {{-- TRÍCH ĐOẠN --}}
    @if($article->excerpt)
        <blockquote style="font-style:italic;color:#555;background:#f8f8f8;padding:12px;border-left:4px solid #007bff;">
            {{ $article->excerpt }}
        </blockquote>
    @endif

    {{-- NỘI DUNG --}}
    <div style="line-height:1.8;">
        {!! nl2br(e($article->content)) !!}
    </div>

</article>
@endsection
