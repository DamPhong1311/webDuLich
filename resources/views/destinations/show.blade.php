@extends('layouts.myApp')

@section('title', $destination->title)

@section('content')
<article class="destination-article">

    {{-- TIÊU ĐỀ --}}
    <h1>{{ $destination->title }}</h1>

    {{-- Nút hành động --}}
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
        @php
            $cover = $destination->cover_image;
            // Nếu là link đầy đủ thì giữ nguyên, nếu không thì thêm storage/
            $coverSrc = Str::startsWith($cover, ['http://', 'https://'])
                ? $cover
                : asset('storage/' . ltrim($cover, '/'));
        @endphp
        <img src="{{ $coverSrc }}" class="destination-cover-image" alt="Cover image">
    @endif

    {{-- TRÍCH ĐOẠN --}}
    @if($destination->excerpt)
        <blockquote class="destination-excerpt">
            {{ $destination->excerpt }}
        </blockquote>
    @endif

    {{-- BỘ SƯU TẬP ẢNH --}}
    @php
        // Xử lý cả 2 trường hợp: mảng hoặc JSON
        if (is_array($destination->gallery)) {
            $galleryArray = $destination->gallery;
        } else {
            $galleryArray = json_decode($destination->gallery, true) ?? [];
        }
    @endphp

    @if(!empty($galleryArray))
        <h3 class="destination-gallery-title">Thư viện hình ảnh</h3>
        <div class="destination-gallery-grid">
            @foreach($galleryArray as $img)
                @php
                    // Nếu là URL ngoài thì dùng trực tiếp, nếu không thì thêm storage/
                    $imgSrc = Str::startsWith($img, ['http://', 'https://'])
                        ? $img
                        : asset('storage/' . ltrim($img, '/'));
                @endphp
                <a href="{{ $imgSrc }}" target="_blank" style="display:block;">
                    <img src="{{ $imgSrc }}" class="destination-gallery-img" alt="Gallery image">
                </a>
            @endforeach
        </div>
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
