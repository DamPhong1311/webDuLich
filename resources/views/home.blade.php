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
                    /* .home-container {
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
                    } */
                    /* ======= Home Page – Pastel Sky (lighter/softer blue, redesigned) ======= */
                    /* Palette */
                    :root {
                        --sky-50: #f0f7ff;
                        --sky-100: #e6f1ff;
                        --sky-200: #d8eaff;
                        --sky-300: #cfe5ff;
                        --sky-400: #bfdbfe;
                        /* light */
                        --sky-500: #93c5fd;
                        /* primary (soft) */
                        --sky-600: #60a5fa;
                        /* hover */
                        --sky-700: #3b82f6;
                        /* accent text */
                        --text-900: #0f172a;
                        --text-600: #475569;
                        --muted: #64748b;
                        --border: rgba(15, 23, 42, .08);
                        --shadow: 0 10px 28px rgba(2, 6, 23, .06);
                        --shadow-2: 0 16px 40px rgba(59, 130, 246, .18);
                        --radius: 18px;
                        --radius-sm: 14px;
                        --transition: 240ms cubic-bezier(.2, .65, .2, 1);
                    }

                    /* Container */
                    .home-container {
                        max-width: 1160px;
                        margin: 0 auto;
                        padding: clamp(16px, 3vw, 28px);
                        color: var(--text-900);
                    }

                    /* ======= Banner (glass + pastel gradient waves) ======= */
                    .home-banner {
                        position: relative;
                        overflow: hidden;
                        border-radius: var(--radius);
                        padding: clamp(28px, 6vw, 64px) clamp(20px, 6vw, 56px);
                        text-align: center;
                        color: #0b1b36;
                        background:
                            linear-gradient(180deg, rgba(147, 197, 253, .35), rgba(191, 219, 254, .45)),
                            linear-gradient(120deg, #eef6ff, #ffffff 40%, #eef6ff);
                        border: 1px solid rgba(147, 197, 253, .55);
                        box-shadow: var(--shadow);
                        isolation: isolate;
                    }

                    .home-banner::before,
                    .home-banner::after {
                        content: "";
                        position: absolute;
                        inset: auto;
                        filter: blur(28px);
                        opacity: .55;
                        z-index: -1;
                    }

                    .home-banner::before {
                        width: 56vw;
                        height: 56vw;
                        max-width: 560px;
                        max-height: 560px;
                        left: -18%;
                        top: -22%;
                        border-radius: 50%;
                        background: radial-gradient(closest-side, #93c5fd 35%, transparent 70%);
                    }

                    .home-banner::after {
                        width: 46vw;
                        height: 46vw;
                        max-width: 460px;
                        max-height: 460px;
                        right: -15%;
                        bottom: -25%;
                        border-radius: 50%;
                        background: radial-gradient(closest-side, #bfdbfe 30%, transparent 70%);
                    }

                    .home-banner h1 {
                        margin: 0 0 8px;
                        font-weight: 800;
                        letter-spacing: .2px;
                        font-size: clamp(1.5rem, 3.4vw, 2.2rem);
                        color: #0b1b36;
                    }

                    .home-banner-desc {
                        margin: 0;
                        color: #1f3b66;
                        opacity: .85;
                        font-size: clamp(.98rem, 1.6vw, 1.1rem);
                    }

                    /* ======= Section ======= */
                    .home-section {
                        margin-top: clamp(22px, 4vw, 44px);
                    }

                    .home-section-title {
                        margin: 0 0 16px;
                        font-weight: 800;
                        font-size: clamp(1.15rem, 2vw, 1.5rem);
                        color: #1a2f55;
                        letter-spacing: .2px;
                        position: relative;
                    }

                    .home-section-title::after {
                        content: "";
                        display: block;
                        width: 72px;
                        height: 4px;
                        margin-top: 10px;
                        background: linear-gradient(90deg, var(--sky-500), var(--sky-400));
                        border-radius: 4px;
                        opacity: .9;
                    }

                    .home-destinations-grid,
                    .home-articles-grid {
                        display: grid;
                        gap: clamp(14px, 2.2vw, 22px);
                    }

                    .home-destinations-grid {
                        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
                    }

                    .home-articles-grid {
                        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
                    }

                    .home-destination-card,
                    .home-article-card {
                        position: relative;
                        display: grid;
                        grid-template-rows: 190px auto;
                        text-decoration: none;
                        color: inherit;
                        background: linear-gradient(180deg, rgba(255, 255, 255, .9), rgba(255, 255, 255, .86));
                        border: 1px solid var(--border);
                        border-radius: var(--radius-sm);
                        overflow: hidden;
                        box-shadow: var(--shadow);
                        transition: transform var(--transition), box-shadow var(--transition), border-color var(--transition), background var(--transition);
                    }

                    .home-destination-card::after,
                    .home-article-card::after {
                        content: "";
                        position: absolute;
                        inset: 0 0 auto 0;
                        height: 48px;
                        background: linear-gradient(180deg, rgba(147, 197, 253, 0), rgba(147, 197, 253, .12));
                        opacity: 0;
                        transition: opacity var(--transition);
                    }

                    .home-destination-card:hover,
                    .home-article-card:hover {
                        transform: translateY(-4px);
                        box-shadow: var(--shadow-2);
                        border-color: rgba(147, 197, 253, .55);
                        background: linear-gradient(180deg, rgba(255, 255, 255, .96), rgba(255, 255, 255, .9));
                    }

                    .home-destination-card:hover::after,
                    .home-article-card:hover::after {
                        opacity: 1;
                    }

                    /* Images (soft rounded top) */
                    .home-destination-img,
                    .home-article-img {
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                        background: linear-gradient(180deg, var(--sky-100), var(--sky-50));
                    }

                    /* Content block */
                    .home-destination-content,
                    .home-article-content {
                        padding: 14px 14px 16px;
                    }

                    .home-destination-content h3,
                    .home-article-content h3 {
                        margin: 0 0 6px;
                        font-size: 1.06rem;
                        font-weight: 800;
                        letter-spacing: .2px;
                        color: #102743;
                    }

                    .home-destination-excerpt,
                    .home-article-excerpt {
                        margin: 0 0 10px;
                        color: var(--text-600);
                    }

                    /* Tiny label rows */
                    .home-destination-province,
                    .home-article-date {
                        margin: 0;
                        font-size: .92rem;
                        font-weight: 700;
                        color: #285ea8;
                        background: linear-gradient(180deg, var(--sky-100), var(--sky-50));
                        display: inline-flex;
                        align-items: center;
                        padding: 6px 10px;
                        border-radius: 999px;
                        border: 1px solid rgba(147, 197, 253, .55);
                    }

                    /* ======= Empty state ======= */
                    .home-destinations-grid+p,
                    .home-articles-grid+p {
                        padding: 16px;
                        border-radius: 14px;
                        border: 1px dashed rgba(147, 197, 253, .7);
                        color: var(--muted);
                        background: linear-gradient(180deg, #ffffff, var(--sky-50));
                    }

                    /* ======= Subtle interactive ripple on hover ======= */
                    .home-destination-card:hover .home-destination-img,
                    .home-article-card:hover .home-article-img {
                        filter: saturate(1.02) contrast(1.01);
                    }

                    /* ======= Responsive ======= */
                    @media (max-width:640px) {
                        .home-banner {
                            text-align: left;
                        }
                    }

                    /* ======= Dark mode (soft, still pastel) ======= */
                    @media (prefers-color-scheme:dark) {
                        .home-banner {
                            color: #eaf2ff;
                            background:
                                linear-gradient(180deg, rgba(147, 197, 253, .22), rgba(191, 219, 254, .28)),
                                linear-gradient(120deg, #0f1a2b, #0c1526 40%, #0f1a2b);
                            border-color: rgba(147, 197, 253, .35);
                        }

                        .home-destination-card,
                        .home-article-card {
                            background: linear-gradient(180deg, rgba(15, 23, 42, .65), rgba(15, 23, 42, .58));
                            border-color: rgba(147, 197, 253, .25);
                        }

                        .home-destination-excerpt,
                        .home-article-excerpt {
                            color: #c9d7ee;
                        }

                        .home-destination-province,
                        .home-article-date {
                            color: #cfe4ff;
                            background: linear-gradient(180deg, rgba(59, 130, 246, .15), rgba(59, 130, 246, .08));
                            border-color: rgba(147, 197, 253, .45);
                        }
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