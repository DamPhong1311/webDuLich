<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>@yield('title','Du lịch Việt Nam')</title>
    {{-- CSRF Token for AJAX requests --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Scripts and Styles with Vite --}}

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body class="myapp-body">
    <header class="myapp-header">
        <a href="{{ route('home') }}" class="myapp-brand">VietNamTravel</a>
        <nav class="myapp-nav">
            <a href="{{ route('home') }}" class="myapp-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Trang chủ</a>
            <a href="{{ route('destinations.index') }}" class="myapp-nav-link {{ request()->routeIs('destinations.index') ? 'active' : '' }}">Điểm đến</a>
            <a href="{{ route('articles.index') }}" class="myapp-nav-link {{ request()->routeIs('articles.index') ? 'active' : '' }}">Bài viết</a>
            <a href="{{ route('contact.form') }}" class="myapp-nav-link {{ request()->routeIs('contact.form') ? 'active' : '' }}">Liên hệ</a>

            {{-- Add Saved Destinations link for logged-in users --}}
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

    <footer class="myapp-footer">
        © {{ date('Y') }} VietNamTravel
    </footer>
</body>
<style>
:root {
    --primary: #0d6efd;
    --secondary: #6c757d;
    --light: #f8f9fa;
    --dark: #212529;
    --border: #dee2e6;
    --border-light: #f1f5f9;
    --text-muted: #64748b;
}

.myapp-body {
    font-family: 'Inter', sans-serif;
    margin: 0;
    background-color: var(--light);
    color: var(--dark);
    line-height: 1.6;
}

.myapp-header {
    background: white;
    padding: 12px 40px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid var(--border);
    position: sticky;
    top: 0;
    z-index: 100;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.myapp-brand {
    color: var(--primary);
    text-decoration: none;
    font-weight: 800;
    font-size: 24px;
}

.myapp-nav {
    display: flex;
    gap: 25px;
    align-items: center;
}

.myapp-nav-link {
    color: #495057;
    text-decoration: none;
    font-weight: 600;
    font-size: 15px;
    transition: color 0.2s;
    position: relative;
    padding-bottom: 4px;
}

.myapp-nav-link::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background-color: var(--primary);
    transform: scaleX(0);
    transform-origin: bottom right;
    transition: transform 0.25s ease-out;
}
.myapp-nav-link:hover::after,
.myapp-nav-link.active::after {
    transform: scaleX(1);
    transform-origin: bottom left;
}
.myapp-nav-link:hover,
.myapp-nav-link.active {
    color: var(--primary);
}

.myapp-auth {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-left: 20px;
}

.myapp-admin-link, .myapp-login-btn, .myapp-register-btn, .myapp-logout-btn {
    border: none;
    padding: 8px 16px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.2s ease-in-out;
}

.myapp-admin-link { background: #ffc107; color: black; }
.myapp-admin-link:hover { background: #ffca2c; }

.myapp-user { color: var(--text-muted); font-weight: 500; font-size: 14px; }
.myapp-login-btn { background: #e9ecef; color: #495057; }
.myapp-login-btn:hover { background: #dde2e7; }
.myapp-register-btn { background: var(--primary); color: white; }
.myapp-register-btn:hover { background: #0b5ed7; }
.myapp-logout-btn { background: #dc3545; color: white; }
.myapp-logout-btn:hover { background: #c82333; }

.myapp-main { padding: 20px; }
.myapp-footer { background: #e9ecef; padding: 30px; text-align: center; color: var(--secondary); margin-top: 40px; border-top: 1px solid var(--border); }
</style>

</html>

