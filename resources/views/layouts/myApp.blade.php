<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>@yield('title','Du lịch Việt Nam')</title>

    {{-- CSRF cho AJAX --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/home.css', 'resources/js/app.js'])
    @vite(['resources/css/myApp.css', 'resources/js/app.js'])
    @vite(['resources/css/map.css', 'resources/js/app.js'])
    @vite(['resources/css/contact.css', 'resources/js/app.js'])
    @vite(['resources/css/destination/index.css', 'resources/js/app.js'])
    @vite(['resources/css/destination/show.css', 'resources/js/app.js'])
    @vite(['resources/css/destination/save.css', 'resources/js/app.js'])


    @stack('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

            <a href="{{ route('map.explore') }}"
                class="myapp-nav-link {{ request()->routeIs('map.explore') ? 'active' : '' }}">Bản đồ</a>

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

   
    @stack('scripts')

</body>

</html>