<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>@yield('title','Du lịch Việt Nam')</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body style="font-family:sans-serif;margin:0;">

<header style="background:#007bff;color:white;padding:12px 20px;display:flex;justify-content:space-between;align-items:center;">
    <a href="{{ route('home') }}" style="color:white;text-decoration:none;font-weight:bold;">VietNamTravel</a>
    
    <nav style="display:flex;gap:15px;align-items:center;">
      <a href="{{ route('home') }}" style="color:white;text-decoration:none;">Trang chủ</a>
      <a href="{{ route('destinations.index') }}" style="color:white;text-decoration:none;">Điểm đến</a>
      <a href="{{ route('articles.index') }}" style="color:white;text-decoration:none;">Bài viết</a>
      <a href="{{ route('contact.form') }}" style="color:white;text-decoration:none;">Liên hệ</a>
       
      @if(Auth::check() && Auth::user()->isAdmin())
        <a href="{{ route('admin.dashboard') }}" 
           style="padding:6px 12px;background:#ffc107;color:black;border-radius:5px;text-decoration:none;">
           Quản lý Admin
        </a>
      @endif

      @auth
        <span style="color:white;">Xin chào, {{ Auth::user()->name }}</span>
        <form method="POST" action="{{ route('logout') }}" style="display:inline;">
          @csrf
          <button type="submit" style="background:none;border:none;color:white;cursor:pointer;">Đăng xuất</button>
        </form>
      @else
        <a href="{{ route('login') }}" style="color:white;text-decoration:none;">Đăng nhập</a>
        <a href="{{ route('register') }}" style="color:white;text-decoration:none;">Đăng ký</a>
      @endauth
    </nav>
</header>


  <main style="padding:20px;">
    @yield('content')
  </main>

  <footer style="background:#f2f2f2;padding:20px;text-align:center;color:#555;">
    © {{ date('Y') }} VietNamTravel - Trang web du lịch Việt Nam
  </footer>

</body>
</html>
