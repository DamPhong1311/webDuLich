    @extends('layouts.myApp')
    @section('title','Trang chủ')
    @section('content')

    <div class="home-container">

        {{-- Banner --}}
        <div class="home-banner">
            <h1>Khám phá di sản Việt Nam</h1>
            <p class="home-banner-desc">Những điểm đến hấp dẫn, bài viết hay và kinh nghiệm du lịch thú vị</p>
        </div>

        {{-- DESTINATIONS --}}
        <section class="home-section">
            <h2 class="home-section-title">Điểm đến nổi bật</h2>
            <div class="home-destinations-grid">
                @forelse($featuredDestinations as $d)
                @php
                $img = $d->cover_image;
                $isUrl = Str::startsWith($img, ['http://', 'https://']);
                $imgSrc = $isUrl ? $img : asset('storage/'.$img);
                @endphp
                <a href="{{ route('destinations.show',$d) }}" class="home-destination-card">
                    @if($d->cover_image)
                    <img src="{{ $imgSrc }}" class="home-destination-img">
                    @endif
                    <div class="home-destination-content">
                        <h3>{{ $d->title }}</h3>
                        <p class="home-destination-excerpt">{{ Str::limit($d->excerpt ?? $d->content, 100) }}</p>
                        @if($d->province)
                        <p class="home-destination-province">📍 {{ $d->province }}</p>
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
            <h2 class="home-section-title">Bài viết mới nhất</h2>
            <div class="home-articles-grid">
                @forelse($latestArticles as $a)
                @php
                $img = $a->cover_image;
                $isUrl = Str::startsWith($img, ['http://', 'https://']);
                $imgSrc = $isUrl ? $img : asset('storage/'.$img);
                @endphp
                <a href="{{ route('articles.show',$a) }}" class="home-article-card">
                    @if($a->cover_image)
                    <img src="{{ $imgSrc }}" class="home-article-img">
                    @endif
                    <div class="home-article-content">
                        <h3>{{ $a->title }}</h3>
                        <p class="home-article-excerpt">{{ Str::limit($a->excerpt ?? $a->content, 100) }}</p>
                        <p class="home-article-date">🕒 {{ optional($a->published_at)->format('d/m/Y') }}</p>
                    </div>
                    <style>
                    .home-container {
                        max-width: 1200px;
                        margin: auto;
                        padding: 20px;
                    }

                    .home-banner {
                        text-align: center;
                        margin-bottom: 40px;
                    }

                    .home-banner-desc {
                        color: #555;
                    }

                    .home-section {
                        margin-bottom: 50px;
                    }

                    .home-section-title {
                        margin-bottom: 20px;
                    }

                    .home-destinations-grid {
                        display: grid;
                        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                        gap: 20px;
                    }

                    .home-destination-card {
                        text-decoration: none;
                        color: inherit;
                        border: 1px solid #eee;
                        border-radius: 8px;
                        overflow: hidden;
                    }

                    .home-destination-img {
                        width: 100%;
                        height: 200px;
                        object-fit: cover;
                    }

                    .home-destination-content {
                        padding: 12px;
                    }

                    .home-destination-excerpt {
                        color: #666;
                    }

                    .home-destination-province {
                        font-size: 14px;
                        color: #999;
                    }

                    .home-articles-grid {
                        display: grid;
                        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
                        gap: 20px;
                    }

                    .home-article-card {
                        text-decoration: none;
                        color: inherit;
                        border: 1px solid #eee;
                        border-radius: 8px;
                        overflow: hidden;
                    }

                    .home-article-img {
                        width: 100%;
                        height: 180px;
                        object-fit: cover;
                    }

                    .home-article-content {
                        padding: 12px;
                    }

                    .home-article-excerpt {
                        color: #666;
                    }

                    .home-article-date {
                        font-size: 13px;
                        color: #999;
                    }
                    </style>
                </a>
                @empty
                <p>Chưa có bài viết nào.</p>
                @endforelse
            </div>
        </section>

    </div>
    @endsection