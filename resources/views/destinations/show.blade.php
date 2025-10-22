@extends('layouts.myApp')

@section('title', $destination->title)

@section('content')
<article class="destination-article">

    <h1>{{ $destination->title }}</h1>

    <x-destination-actions :destination="$destination" :isFavorited="$isFavorited" :isSaved="$isSaved" />

    <p class="destination-slug">
        🔗 Slug: <code>{{ $destination->slug }}</code>
    </p>

    <p class="destination-location">
        📍 {{ $destination->location ?? 'Không rõ vị trí' }} — {{ $destination->province ?? 'Không rõ tỉnh' }}
    </p>

    @if($destination->cover_image)
        @php
            $cover = $destination->cover_image;
            $coverSrc = Str::startsWith($cover, ['http://', 'https://'])
                ? $cover
                : asset('storage/' . ltrim($cover, '/'));
        @endphp
        <img src="{{ $coverSrc }}" class="destination-cover-image" alt="Cover image">
    @endif

    @if($destination->excerpt)
        <blockquote class="destination-excerpt">
            {{ $destination->excerpt }}
        </blockquote>
    @endif
    @php
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
    <div class="destination-content">
        {!! nl2br(e($destination->content)) !!}
    </div>

    <div class="destination-info">
        <p>⭐ Nổi bật: {{ $destination->featured ? 'Có' : 'Không' }}</p>
        @if($destination->published_at)
            <p>🕒 Đăng ngày: {{ \Carbon\Carbon::parse($destination->published_at)->format('d/m/Y') }}</p>
        @endif
    </div>

    @include('components.comments', ['model' => $destination])

</article>
@endsection
