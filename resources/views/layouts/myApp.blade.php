<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>@yield('title','Du lịch Việt Nam')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="myapp-body">


    <header class="myapp-header">
        <a href="{{ route('home') }}" class="myapp-brand">VietNamTravel</a>
        <nav class="myapp-nav">
            <a href="{{ route('home') }}" class="myapp-nav-link">Trang chủ</a>
            <a href="{{ route('destinations.index') }}" class="myapp-nav-link">Điểm đến</a>
            <a href="{{ route('articles.index') }}" class="myapp-nav-link">Bài viết</a>
            <a href="{{ route('contact.form') }}" class="myapp-nav-link">Liên hệ</a>
            @if(Auth::check() && Auth::user()->isAdmin())
            <a href="{{ route('admin.dashboard') }}" class="myapp-admin-link">Quản lý Admin</a>
            @endif
            @auth
            <span class="myapp-user">Xin chào, {{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" class="myapp-logout-form">
                @csrf
                <button type="submit" class="myapp-logout-btn">Đăng xuất</button>
            </form>
            @else
            <a href="{{ route('login') }}" class="myapp-nav-link">Đăng nhập</a>
            <a href="{{ route('register') }}" class="myapp-nav-link">Đăng ký</a>
            @endauth
        </nav>
    </header>


    <main class="myapp-main">
        @yield('content')
    </main>

    <footer class="myapp-footer">
        © {{ date('Y') }} VietNamTravel - Trang web du lịch Việt Nam
    </footer>
</body>
<style>
.myapp-body {
    font-family: sans-serif;
    margin: 0;
}

.myapp-header {
    background: #007bff;
    color: white;
    padding: 12px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.myapp-brand {
    color: white;
    text-decoration: none;
    font-weight: bold;
}

.myapp-nav {
    display: flex;
    gap: 15px;
    align-items: center;
}

.myapp-nav-link {
    color: white;
    text-decoration: none;
}

.myapp-admin-link {
    padding: 6px 12px;
    background: #ffc107;
    color: black;
    border-radius: 5px;
    text-decoration: none;
}

.myapp-user {
    color: white;
}

.myapp-logout-form {
    display: inline;
}

.myapp-logout-btn {
    background: none;
    border: none;
    color: white;
    cursor: pointer;
}

.myapp-main {
    padding: 20px;
}

.myapp-footer {
    background: #f2f2f2;
    padding: 20px;
    text-align: center;
    color: #555;
}
</style>

</body>

</html>