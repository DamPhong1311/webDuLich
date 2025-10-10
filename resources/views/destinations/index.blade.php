@extends('layouts.myApp')
@section('title','Điểm đến')
@section('content')
<h1 style="margin-bottom:16px">Điểm đến</h1>

<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:18px;">
  @foreach($destinations as $d)
    @php
      $img = $d->cover_image;
      $isUrl = Str::startsWith($img, ['http://', 'https://']);
      $imgSrc = $isUrl ? $img : asset('storage/'.$img);
    @endphp
    <article style="border:1px solid #eee;padding:12px;border-radius:6px;">
      <a href="{{ route('destinations.show', $d) }}" style="text-decoration:none;color:inherit">
        @if($d->cover_image)
          <img src="{{ $imgSrc }}" alt="{{ $d->title }}" style="width:100%;height:180px;object-fit:cover;border-radius:4px;">
        @else
          <div style="width:100%;height:180px;background:#f0f0f0;border-radius:4px;display:flex;align-items:center;justify-content:center">No image</div>
        @endif

        <h2 style="margin-top:10px">{{ $d->title }}</h2>
      </a>
      <p style="color:#666">{{ Str::limit($d->excerpt ?? $d->content, 120) }}</p>
    </article>
   
  @endforeach
</div>

<div style="margin-top:18px;">
  {{ $destinations->links() }}
</div>
@endsection
