<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>@yield('title','Du lịch Việt Nam')</title>

    {{-- Thẻ CSRF Token, bắt buộc cho các request AJAX --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="myapp-body">
    <header class="myapp-header">
        <a href="{{ route('home') }}" class="myapp-brand">VietNamTravel</a>
        <nav class="myapp-nav">
            <a href="{{ route('home') }}" class="myapp-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Trang
                chủ</a>
            <a href="{{ route('destinations.index') }}"
                class="myapp-nav-link {{ request()->routeIs('destinations.index') ? 'active' : '' }}">Điểm đến</a>
            <a href="{{ route('articles.index') }}"
                class="myapp-nav-link {{ request()->routeIs('articles.index') ? 'active' : '' }}">Bài viết</a>
            <a href="{{ route('contact.form') }}"
                class="myapp-nav-link {{ request()->routeIs('contact.form') ? 'active' : '' }}">Liên hệ</a>
            @auth
            <a href="{{ route('destinations.saved') }}"
                class="myapp-nav-link {{ request()->routeIs('destinations.saved') ? 'active' : '' }}">Đã lưu</a>
            @endauth
            <div class="myapp-auth">
                @if(Auth::check() && Auth::user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="myapp-admin-link">Quản lý</a>
                @endif
                @auth
                <span class="myapp-user">Chào, {{ Auth::user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}" class="myapp-logout-form">
                    @csrf
                    <button type="submit" class="myapp-logout-btn">Đăng xuất</button>
                </form>
                @else
                <a href="{{ route('login') }}" class="myapp-login-btn">Đăng nhập</a>
                <a href="{{ route('register') }}" class="myapp-register-btn">Đăng ký</a>
                @endauth
            </div>
        </nav>
    </header>

    <main class="myapp-main">
        @yield('content')
    </main>

    <footer class="myapp-footer">© {{ date('Y') }} VietNamTravel</footer>

    <style>
    /* ========= VietNamTravel – Polished Theme (scoped to .myapp-*) ========= */
    /* Color system */
    :root {
        --vt-bg: #0b1535;
        --vt-surface: #0f1b4b;
        --vt-surface-2: #0e1540;
        --vt-text: #0f172a;
        --vt-text-muted: #64748b;
        --vt-white: #ffffff;

        --vt-primary: #2563eb;
        /* Indigo/Blue */
        --vt-primary-2: #3b82f6;
        /* Lighter */
        --vt-accent: #22c55e;
        /* Green */
        --vt-warning: #f59e0b;
        /* Amber */

        --vt-border: rgba(15, 23, 42, 0.12);
        --vt-shadow: 0 10px 30px rgba(2, 6, 23, 0.10);
        --vt-shadow-2: 0 14px 40px rgba(37, 99, 235, 0.22);

        --vt-radius: 14px;
        --vt-radius-sm: 10px;
        --vt-radius-xs: 8px;

        --vt-transition: 220ms cubic-bezier(.2, .6, .2, 1);
    }

    /* Light/Dark auto theming */
    @media (prefers-color-scheme: dark) {
        :root {
            --vt-bg: #070b1f;
            --vt-surface: #0b102b;
            --vt-surface-2: #0e1540;
            --vt-text: #e5e7eb;
            --vt-text-muted: #9aa4b2;
            --vt-border: rgba(148, 163, 184, 0.12);
            --vt-shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
            --vt-shadow-2: 0 14px 40px rgba(59, 130, 246, 0.25);
        }
    }

    /* Base */
    .myapp-body {
        font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, "Helvetica Neue", Inter, Arial, "Noto Sans", "Apple Color Emoji", "Segoe UI Emoji";
        margin: 0;
        color: var(--vt-text);
        background:
            radial-gradient(1200px 600px at 10% -10%, rgba(59, 130, 246, .12), transparent 55%),
            radial-gradient(1000px 600px at 110% -20%, rgba(34, 197, 94, .10), transparent 50%),
            #f8fafc;
        line-height: 1.6;
    }

    /* ======= Header ======= */
    .myapp-header {
        position: sticky;
        top: 0;
        z-index: 50;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 14px;
        padding: 14px 22px;
        border-bottom: 1px solid var(--vt-border);
        background: linear-gradient(180deg, rgba(255, 255, 255, .85), rgba(255, 255, 255, .75));
        backdrop-filter: saturate(130%) blur(8px);
        box-shadow: var(--vt-shadow);
    }

    @media (prefers-color-scheme: dark) {
        .myapp-header {
            background: linear-gradient(180deg, rgba(13, 19, 48, .72), rgba(13, 19, 48, .62));
            border-bottom-color: rgba(255, 255, 255, 0.06);
        }
    }

    .myapp-brand {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        font-weight: 800;
        letter-spacing: .2px;
        color: var(--vt-primary);
        font-size: 1.3rem;
        transform: translateZ(0);
        transition: transform var(--vt-transition), text-shadow var(--vt-transition);
    }

    .myapp-brand::before {
        content: "";
        width: 28px;
        height: 28px;
        border-radius: 9px;
        background: conic-gradient(from 160deg at 50% 50%, var(--vt-primary), var(--vt-primary-2), var(--vt-accent));
        box-shadow: 0 6px 18px rgba(37, 99, 235, .35), inset 0 -2px 6px rgba(255, 255, 255, .35);
    }

    .myapp-brand:hover {
        transform: translateY(-1px);
        text-shadow: 0 6px 18px rgba(37, 99, 235, .25);
    }

    /* ======= Nav ======= */
    .myapp-nav {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }

    .myapp-nav-link,
    .myapp-admin-link,
    .myapp-logout-btn {
        position: relative;
        display: inline-flex;
        align-items: center;
        height: 40px;
        padding: 0 14px;
        border-radius: var(--vt-radius-xs);
        text-decoration: none;
        font-weight: 600;
        letter-spacing: .2px;
        border: 1px solid transparent;
        transition: all var(--vt-transition);
        outline: none;
    }

    /* Primary text links */
    .myapp-nav-link {
        color: var(--vt-text);
        background: transparent;
    }

    .myapp-nav-link::after {
        content: "";
        position: absolute;
        left: 12px;
        right: 12px;
        bottom: 8px;
        height: 2px;
        border-radius: 2px;
        background: linear-gradient(90deg, var(--vt-primary), var(--vt-primary-2));
        opacity: 0;
        transform: scaleX(.4);
        transform-origin: center;
        transition: transform var(--vt-transition), opacity var(--vt-transition);
    }

    .myapp-nav-link:hover {
        background: rgba(37, 99, 235, 0.08);
    }

    .myapp-nav-link:hover::after {
        opacity: 1;
        transform: scaleX(1);
    }

    .myapp-nav-link:focus-visible {
        box-shadow: 0 0 0 3px rgba(37, 99, 235, .25);
    }

    /* Admin CTA */
    .myapp-admin-link {
        color: #1f2937;
        background: linear-gradient(180deg, #ffe08a, #ffc107);
        border-color: rgba(31, 41, 55, .08);
        box-shadow: 0 6px 18px rgba(245, 158, 11, .35);
    }

    .myapp-admin-link:hover {
        filter: brightness(1.03);
        transform: translateY(-1px);
    }

    /* User & Auth */
    .myapp-user {
        color: var(--vt-text-muted);
        font-weight: 600;
        margin-left: 4px;
    }

    .myapp-logout-form {
        display: inline;
    }

    .myapp-logout-btn {
        color: var(--vt-white);
        background: linear-gradient(180deg, #ef4444, #dc2626);
        border-color: rgba(239, 68, 68, .15);
        box-shadow: 0 10px 24px rgba(239, 68, 68, .35);
    }

    .myapp-logout-btn:hover {
        transform: translateY(-1px);
        filter: brightness(1.05);
    }

    .myapp-logout-btn:focus-visible {
        box-shadow: 0 0 0 3px rgba(239, 68, 68, .35);
    }

    /* ===== Buttons: Login / Register (for guest state) ===== */
    .myapp-login-btn,
    .myapp-register-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        height: 40px;
        padding: 0 16px;
        border-radius: var(--vt-radius-xs);
        font-weight: 700;
        letter-spacing: .2px;
        text-decoration: none;
        border: 1px solid transparent;
        cursor: pointer;
        transition: transform var(--vt-transition), box-shadow var(--vt-transition), background var(--vt-transition), color var(--vt-transition), border-color var(--vt-transition);
        -webkit-tap-highlight-color: transparent;
    }

    /* Outline/ghost style for Login */
    .myapp-login-btn {
        color: var(--vt-primary);
        background: transparent;
        border-color: rgba(37, 99, 235, .35);
        box-shadow: 0 2px 10px rgba(2, 6, 23, .04);
    }

    .myapp-login-btn:hover {
        background: rgba(37, 99, 235, .08);
        border-color: rgba(37, 99, 235, .55);
        transform: translateY(-1px);
    }

    .myapp-login-btn:active {
        transform: translateY(0);
    }

    .myapp-login-btn:focus-visible {
        outline: none;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, .30);
    }

    /* Primary gradient style for Register */
    .myapp-register-btn {
        color: #fff;
        background: linear-gradient(180deg, var(--vt-primary-2), var(--vt-primary));
        border-color: rgba(37, 99, 235, .35);
        box-shadow: 0 10px 24px rgba(37, 99, 235, .30);
    }

    .myapp-register-btn:hover {
        filter: brightness(1.03);
        transform: translateY(-1px);
        box-shadow: var(--vt-shadow-2);
    }

    .myapp-register-btn:active {
        transform: translateY(0);
    }

    .myapp-register-btn:focus-visible {
        outline: none;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, .30);
    }

    /* Disabled states (for anchors, use aria-disabled="true") */
    .myapp-login-btn[aria-disabled="true"],
    .myapp-register-btn[aria-disabled="true"] {
        opacity: .6;
        pointer-events: none;
    }

    /* ======= Main ======= */
    .myapp-main {
        padding: clamp(16px, 3vw, 28px);
    }

    .myapp-main>* {
        max-width: 1100px;
        margin-inline: auto;
        background: linear-gradient(180deg, rgba(255, 255, 255, .9), rgba(255, 255, 255, .88));
        border: 1px solid var(--vt-border);
        border-radius: var(--vt-radius);
        box-shadow: var(--vt-shadow);
        padding: clamp(16px, 2.2vw, 28px);
    }

    @media (prefers-color-scheme: dark) {
        .myapp-main>* {
            background: linear-gradient(180deg, rgba(15, 23, 42, .55), rgba(15, 23, 42, .50));
            border-color: rgba(255, 255, 255, .06);
        }
    }

    /* Utility: subtle section header inside content */
    .myapp-main h1,
    .myapp-main h2,
    .myapp-main h3 {
        letter-spacing: .2px;
        line-height: 1.25;
    }

    .myapp-main h1 {
        font-size: clamp(1.6rem, 2.4vw, 2rem);
    }

    .myapp-main h2 {
        font-size: clamp(1.3rem, 2vw, 1.6rem);
        color: var(--vt-primary);
    }

    .myapp-main h3 {
        font-size: clamp(1.1rem, 1.6vw, 1.3rem);
        color: var(--vt-text);
    }

    /* ======= Footer ======= */
    .myapp-footer {
        color: var(--vt-text-muted);
        text-align: center;
        padding: 26px 20px 40px;
        background:
            radial-gradient(700px 120px at 50% 0%, rgba(37, 99, 235, .12), transparent 70%),
            linear-gradient(0deg, rgba(15, 23, 42, .04), rgba(15, 23, 42, .00));
        border-top: 1px solid var(--vt-border);
    }

    /* ======= Small screens ======= */
    @media (max-width: 960px) {
        .myapp-header {
            padding: 12px 16px;
        }

        .myapp-brand {
            font-size: 1.15rem;
        }

        .myapp-nav {
            gap: 6px;
        }

        .myapp-nav-link,
        .myapp-admin-link,
        .myapp-logout-btn,
        .myapp-login-btn,
        .myapp-register-btn {
            height: 38px;
            padding: 0 12px;
        }
    }

    @media (max-width: 640px) {
        .myapp-header {
            flex-wrap: wrap;
            gap: 10px 14px;
        }

        .myapp-nav {
            width: 100%;
            justify-content: space-between;
        }

        .myapp-user {
            width: 100%;
            text-align: right;
        }
    }

    /* ======= Nice extras ======= */
    /* Smooth hover elevate for any card-like content inside .myapp-main */
    .myapp-main .card,
    .myapp-main .panel,
    .myapp-main .box {
        border-radius: var(--vt-radius);
        border: 1px solid var(--vt-border);
        box-shadow: var(--vt-shadow);
        transition: transform var(--vt-transition), box-shadow var(--vt-transition);
    }

    .myapp-main .card:hover,
    .myapp-main .panel:hover,
    .myapp-main .box:hover {
        transform: translateY(-2px);
        box-shadow: var(--vt-shadow-2);
    }

    /* Better focus styles for links/buttons */
    .myapp-nav-link:focus-visible,
    .myapp-admin-link:focus-visible,
    .myapp-logout-btn:focus-visible,
    .myapp-login-btn:focus-visible,
    .myapp-register-btn:focus-visible,
    .myapp-brand:focus-visible {
        outline: none;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, .35);
        border-color: rgba(59, 130, 246, .35);
    }

    /* Reduce motion if user prefers */
    @media (prefers-reduced-motion: reduce) {
        * {
            transition: none !important;
        }
    }
    </style>
</body>

</html>