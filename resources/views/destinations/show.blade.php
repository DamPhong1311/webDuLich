@extends('layouts.myApp')

@section('title', $destination->title)

@section('content')
<article class="destination-article">

    {{-- TIÊU ĐỀ --}}
    <h1>{{ $destination->title }}</h1>

    {{-- DÒNG MỚI: Thêm component nút bấm vào đây --}}
    <x-destination-actions :destination="$destination" :isFavorited="$isFavorited" :isSaved="$isSaved" />

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

</article>
@endsection

