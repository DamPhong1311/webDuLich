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
            <a href="{{ route('home') }}" class="myapp-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Trang chủ</a>
            <a href="{{ route('destinations.index') }}" class="myapp-nav-link {{ request()->routeIs('destinations.index') ? 'active' : '' }}">Điểm đến</a>
            <a href="{{ route('articles.index') }}" class="myapp-nav-link {{ request()->routeIs('articles.index') ? 'active' : '' }}">Bài viết</a>
            <a href="{{ route('contact.form') }}" class="myapp-nav-link {{ request()->routeIs('contact.form') ? 'active' : '' }}">Liên hệ</a>
            @auth
            <a href="{{ route('destinations.saved') }}" class="myapp-nav-link {{ request()->routeIs('destinations.saved') ? 'active' : '' }}">Đã lưu</a>
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
/* CSS của bạn đã rất tốt, tôi giữ nguyên */
:root { --primary: #0d6efd; --secondary: #6c757d; --light: #f8f9fa; --border: #dee2e6; }
.myapp-body { font-family: 'Inter', sans-serif; margin: 0; background-color: var(--light); color: #212529; }
.myapp-header { background: white; padding: 12px 40px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--border); position: sticky; top: 0; z-index: 100; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }
.myapp-brand { color: var(--primary); text-decoration: none; font-weight: 700; font-size: 24px; }
.myapp-nav { display: flex; gap: 25px; align-items: center; flex-wrap: wrap; }
.myapp-nav-link { color: #495057; text-decoration: none; font-weight: 500; transition: color 0.2s; padding: 5px 0; }
.myapp-nav-link:hover, .myapp-nav-link.active { color: var(--primary); }
.myapp-auth { display: flex; align-items: center; gap: 15px; }
.myapp-admin-link { padding: 8px 14px; background: #ffc107; color: black; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 500; }
.myapp-user { color: var(--secondary); font-weight: 500; }
.myapp-login-btn, .myapp-register-btn, .myapp-logout-btn { border: none; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: 500; cursor: pointer; }
.myapp-login-btn { background: #e9ecef; color: #495057; }
.myapp-register-btn { background: var(--primary); color: white; }
.myapp-logout-btn { background: #dc3545; color: white; }
.myapp-main { padding: 20px; max-width: 1200px; margin: 20px auto; }
.myapp-footer { background: #e9ecef; padding: 20px; text-align: center; color: var(--secondary); margin-top: 40px; border-top: 1px solid var(--border); }
</style>
</body>
</html>

