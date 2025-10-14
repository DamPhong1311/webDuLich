@extends('layouts.myApp')
@section('title','Điểm đến')
@section('content')
<h1 class="destinations-title">Điểm đến</h1>

<div class="destinations-list-grid">
  @foreach($destinations as $d)
  @php
  $img = $d->cover_image;
  $isUrl = Str::startsWith($img, ['http://', 'https://']);
  $imgSrc = $isUrl ? $img : asset('storage/'.$img);
  @endphp
  <article class="destinations-list-item">
    <a href="{{ route('destinations.show', $d) }}" class="destinations-list-link">
      @if($d->cover_image)
      <img src="{{ $imgSrc }}" alt="{{ $d->title }}" class="destinations-list-img">
      @else
      <div class="destinations-list-noimg">No image</div>
      @endif

      <h2 class="destinations-list-title">{{ $d->title }}</h2>
    </a>
    <p class="destinations-list-excerpt">{{ Str::limit($d->excerpt ?? $d->content, 120) }}</p>
  </article>

  @endforeach
</div>

<div class="destinations-pagination">
  {{ $destinations->links() }}
</div>

<style>
  .destinations-title {
    margin-bottom: 16px;
  }

  .destinations-list-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 18px;
  }

  .destinations-list-item {
    border: 1px solid #eee;
    padding: 12px;
    border-radius: 6px;
  }

  .destinations-list-link {
    text-decoration: none;
    color: inherit;
  }

  .destinations-list-img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-radius: 4px;
  }

  .destinations-list-noimg {
    width: 100%;
    height: 180px;
    background: #f0f0f0;
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .destinations-list-title {
    margin-top: 10px;
  }

  .destinations-list-excerpt {
    color: #666;
  }

  .destinations-pagination {
    margin-top: 18px;
  }
</style>
@endsection