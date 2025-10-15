@extends('layouts.myApp')
@section('title','Điểm đến')
@section('content')
<h1 class="page-title">Tất cả điểm đến</h1>
<div class="card-grid">
  @forelse($destinations as $d)
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
  @empty
    <p>Không tìm thấy điểm đến nào.</p>
  @endforelse
</div>
<div class="pagination-wrapper">{{ $destinations->links() }}</div>

<style>
  .page-title { margin-bottom: 24px; font-size: 2rem; font-weight: 700; }
  .card-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px; }
  .pagination-wrapper { margin-top: 30px; display: flex; justify-content: center; }

  /* Reusing styles from home for consistency */
  .home-destination-card { position: relative; display: grid; text-decoration: none; color: inherit; background: #fff; border: 1px solid #e2e8f0; border-radius: 14px; overflow: hidden; box-shadow: 0 10px 28px rgba(2, 6, 23, .06); transition: all 240ms cubic-bezier(.2, .65, .2, 1); }
  .home-destination-card:hover { transform: translateY(-4px); box-shadow: 0 16px 40px rgba(59, 130, 246, .18); border-color: rgba(147, 197, 253, .55); }
  .home-destination-img { width: 100%; height: 190px; object-fit: cover; }
  .home-destination-content { padding: 14px; }
  .home-destination-content h3 { margin: 0 0 6px; font-size: 1.06rem; font-weight: 800; color: #102743; }
  .home-destination-excerpt { margin: 0 0 10px; color: #475569; }
  .home-destination-province { margin: 0; font-size: .92rem; font-weight: 700; color: #285ea8; background: #e6f1ff; display: inline-flex; padding: 6px 10px; border-radius: 999px; border: 1px solid rgba(147, 197, 253, .55); }
  .card-content-link { text-decoration: none; color: inherit; display: block; }
  .card-actions { position: absolute; top: 12px; right: 12px; z-index: 2; display: flex; gap: 8px; background-color: rgba(255, 255, 255, 0.8); padding: 6px; border-radius: 999px; backdrop-filter: blur(4px); box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
  .card-actions button { background: none; border: none; cursor: pointer; padding: 0; display: flex; align-items: center; justify-content: center; transition: transform 0.2s; }
  .card-actions button:hover { transform: scale(1.15); }
</style>
@endsection

