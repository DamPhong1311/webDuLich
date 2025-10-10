    @extends('layouts.myApp')
    @section('title','Trang chủ')
    @section('content')

    <div style="max-width:1200px;margin:auto;padding:20px;">

    {{-- Banner --}}
    <div style="text-align:center;margin-bottom:40px;">
        <h1>Khám phá di sản Việt Nam</h1>
        <p style="color:#555;">Những điểm đến hấp dẫn, bài viết hay và kinh nghiệm du lịch thú vị</p>
    </div>
    
    {{-- DESTINATIONS --}}
    <section style="margin-bottom:50px;">
        <h2 style="margin-bottom:20px;">Điểm đến nổi bật</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:20px;">
        @forelse($featuredDestinations as $d)
            @php
            $img = $d->cover_image;
            $isUrl = Str::startsWith($img, ['http://', 'https://']);
            $imgSrc = $isUrl ? $img : asset('storage/'.$img);
            @endphp
            <a href="{{ route('destinations.show',$d) }}" style="text-decoration:none;color:inherit;border:1px solid #eee;border-radius:8px;overflow:hidden;">
            @if($d->cover_image)
                <img src="{{ $imgSrc }}" style="width:100%;height:200px;object-fit:cover;">
            @endif
            <div style="padding:12px;">
                <h3>{{ $d->title }}</h3>
                <p style="color:#666;">{{ Str::limit($d->excerpt ?? $d->content, 100) }}</p>
                @if($d->province)
                <p style="font-size:14px;color:#999;">📍 {{ $d->province }}</p>
                @endif
            </div>
            </a>
        @empty
            <p>Chưa có điểm đến nổi bật nào.</p>
        @endforelse
        </div>
    </section>

    {{-- ARTICLES --}}
    <section>
        <h2 style="margin-bottom:20px;">Bài viết mới nhất</h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:20px;">
        @forelse($latestArticles as $a)
            @php
            $img = $a->cover_image;
            $isUrl = Str::startsWith($img, ['http://', 'https://']);
            $imgSrc = $isUrl ? $img : asset('storage/'.$img);
            @endphp
            <a href="{{ route('articles.show',$a) }}" style="text-decoration:none;color:inherit;border:1px solid #eee;border-radius:8px;overflow:hidden;">
            @if($a->cover_image)
                <img src="{{ $imgSrc }}" style="width:100%;height:180px;object-fit:cover;">
            @endif
            <div style="padding:12px;">
                <h3>{{ $a->title }}</h3>
                <p style="color:#666;">{{ Str::limit($a->excerpt ?? $a->content, 100) }}</p>
                <p style="font-size:13px;color:#999;">🕒 {{ optional($a->published_at)->format('d/m/Y') }}</p>
            </div>
            </a>
        @empty
            <p>Chưa có bài viết nào.</p>
        @endforelse
        </div>
    </section>

    </div>
    @endsection
