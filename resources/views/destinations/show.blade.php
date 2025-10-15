@extends('layouts.myApp')

@section('title', $destination->title)

@section('content')
<article class="destination-article">

    {{-- TIÊU ĐỀ --}}
    <h1>{{ $destination->title }}</h1>

    {{-- SLUG và THÔNG TIN --}}
    <p class="destination-slug">
        🔗 Slug: <code>{{ $destination->slug }}</code>
    </p>

    <p class="destination-location">
        📍 {{ $destination->location ?? 'Không rõ vị trí' }} — {{ $destination->province ?? 'Không rõ tỉnh' }}
    </p>

    {{-- ẢNH CHÍNH --}}
    @if($destination->cover_image)
    <img src="{{ $destination->cover_image }}" alt="{{ $destination->title }}" class="destination-cover-image">
    @endif

    {{-- TRÍCH ĐOẠN --}}
    @if($destination->excerpt)
    <blockquote class="destination-excerpt">
        {{ $destination->excerpt }}
    </blockquote>
    @endif

    {{-- BỘ SƯU TẬP ẢNH --}}
    {{-- Trong show.blade.php --}}
    {{-- BỘ SƯU TẬP ẢNH --}}
    @if($destination->gallery)
    @php
    // XỬ LÝ CẢ 2 TRƯỜNG HỢP: array và string
    if (is_array($destination->gallery)) {
    $galleryArray = $destination->gallery;
    } else {
    $galleryArray = json_decode($destination->gallery, true) ?? [];
    }
    @endphp

    @if(count($galleryArray) > 0)
    <h3 class="destination-gallery-title">Thư viện hình ảnh</h3>
    <div class="destination-gallery-grid">
        @foreach($galleryArray as $img)
        <img src="{{ $img }}" class="destination-gallery-img">
        @endforeach
    </div>
    @endif
    @endif

    {{-- NỘI DUNG --}}
    <div class="destination-content">
        {!! nl2br(e($destination->content)) !!}
    </div>

    {{-- THÔNG TIN KHÁC --}}
    <div class="destination-info">
        <p>⭐ Nổi bật: {{ $destination->featured ? 'Có' : 'Không' }}</p>
        @if($destination->published_at)
        <p>🕒 Đăng ngày: {{ \Carbon\Carbon::parse($destination->published_at)->format('d/m/Y') }}</p>
        @endif
    </div>
    @include('components.comments', ['model' => $destination])

    <style>
    .destination-article {
        max-width: 900px;
        margin: auto;
    }

    .destination-slug {
        color: #888;
        font-size: 14px;
    }

    .destination-location {
        color: #777;
    }

    .destination-cover-image {
        width: 100%;
        max-height: 450px;
        object-fit: cover;
        border-radius: 6px;
        margin: 12px 0;
    }

    .destination-excerpt {
        font-style: italic;
        color: #555;
        background: #f8f8f8;
        padding: 12px;
        border-left: 4px solid #007bff;
    }

    .destination-gallery-title {
        margin-top: 25px;
    }

    .destination-gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 10px;
    }

    .destination-gallery-img {
        width: 100%;
        height: 150px;
        object-fit: cover;
        border-radius: 4px;
    }

    .destination-content {
        line-height: 1.8;
        margin-top: 15px;
    }

    .destination-info {
        margin-top: 20px;
        font-size: 14px;
        color: #666;
    }
    </style>
</article>
@endsection