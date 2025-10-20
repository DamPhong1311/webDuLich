@extends('layouts.myApp')
@section('title','Địa điểm đã lưu')

@section('content')
<h1 class="page-title">Địa điểm đã lưu</h1>

@if($savedDestinations->isEmpty())
    <p>Bạn chưa lưu địa điểm nào.</p>
@else
    <div class="card-grid">
    @foreach($savedDestinations as $d)
        {{-- We reuse the same card structure --}}
        @php
            $img = $d->cover_image;
            $isUrl = Str::startsWith($img, ['http://', 'https://']);
            $imgSrc = $isUrl ? $img : asset('storage/'.$img);
        @endphp
        <div class="home-destination-card">
            @auth
                <div class="card-actions">
                    <button class="favorite-btn" data-slug="{{ $d->slug }}" title="Yêu thích">
                        <svg width="24" height="24" viewBox="0 0 24 24"
                            fill="{{ Auth::user()->favoriteDestinations->contains('slug', $d->slug) ? 'red' : 'none' }}"
                            stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                        </svg>
                    </button>
                    <button class="save-btn" data-slug="{{ $d->slug }}" title="Lưu">
                        <svg width="24" height="24" viewBox="0 0 24 24"
                            fill="{{ Auth::user()->savedDestinations->contains('slug', $d->slug) ? '#0d6efd' : 'none' }}"
                            stroke="#0d6efd" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21l-7-5-7 5V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2z"></path>
                        </svg>
                    </button>
                </div>
            @endauth
            <a href="{{ route('destinations.show', $d) }}" class="card-content-link">
                @if($d->cover_image)
                <img src="{{ $imgSrc }}" class="home-destination-img" alt="{{ $d->title }}">
                @endif
                <div class="home-destination-content">
                    <h3>{{ $d->title }}</h3>
                    <p class="home-destination-excerpt">{{ Str::limit($d->excerpt ?? $d->content, 100) }}</p>
                     @if($d->province)
                        <p class="home-destination-province">📍 {{ $d->province }}</p>
                    @endif
                </div>
            </a>
        </div>
    @endforeach
    </div>
    <div class="pagination-wrapper">{{ $savedDestinations->links() }}</div>
@endif

@endsection

