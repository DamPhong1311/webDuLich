@extends('layouts.myApp')

@section('title', $destination->title)

@section('content')
<article style="max-width:900px;margin:auto;">

    {{-- TIÊU ĐỀ --}}
    <h1>{{ $destination->title }}</h1>

    {{-- SLUG và THÔNG TIN --}}
    <p style="color:#888;font-size:14px;">
        🔗 Slug: <code>{{ $destination->slug }}</code>
    </p>

    <p style="color:#777">
        📍 {{ $destination->location ?? 'Không rõ vị trí' }} — {{ $destination->province ?? 'Không rõ tỉnh' }}
    </p>

    {{-- ẢNH CHÍNH --}}
    @if($destination->cover_image)
        <img src="{{ $destination->cover_image }}" 
             alt="{{ $destination->title }}" 
             style="width:100%;max-height:450px;object-fit:cover;border-radius:6px;margin:12px 0;">
    @endif

    {{-- TRÍCH ĐOẠN --}}
    @if($destination->excerpt)
        <blockquote style="font-style:italic;color:#555;background:#f8f8f8;padding:12px;border-left:4px solid #007bff;">
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
        <h3 style="margin-top:25px;">Thư viện hình ảnh</h3>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:10px;">
            @foreach($galleryArray as $img)
                <img src="{{ $img }}" style="width:100%;height:150px;object-fit:cover;border-radius:4px;">
            @endforeach
        </div>
    @endif
@endif

    {{-- NỘI DUNG --}}
    <div style="line-height:1.8;margin-top:15px;">
        {!! nl2br(e($destination->content)) !!}
    </div>

    {{-- THÔNG TIN KHÁC --}}
    <div style="margin-top:20px;font-size:14px;color:#666;">
        <p>⭐ Nổi bật: {{ $destination->featured ? 'Có' : 'Không' }}</p>
        @if($destination->published_at)
            <p>🕒 Đăng ngày: {{ \Carbon\Carbon::parse($destination->published_at)->format('d/m/Y') }}</p>
        @endif
    </div>

</article>
@endsection
