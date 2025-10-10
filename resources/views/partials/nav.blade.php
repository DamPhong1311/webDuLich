<nav style="background:#111;color:#fff;padding:12px 0;">
  <div style="max-width:1100px;margin:0 auto;display:flex;justify-content:space-between;align-items:center;">
    <a href="{{ url('/') }}" style="color:#fff;text-decoration:none;font-weight:700">HeritageTravel</a>
    <div>
      <a href="{{ route('destinations.index') }}" style="color:#fff;margin-right:12px">Điểm đến</a>
      <a href="/articles" style="color:#fff;margin-right:12px">Bài viết</a>
      <a href="/contact" style="color:#fff;margin-right:12px">Liên hệ</a>

      @auth
        <a href="{{ route('admin.destinations.index') }}" style="color:#fff;margin-left:12px">Admin</a>
        <form style="display:inline" method="POST" action="{{ route('logout') }}">
          @csrf
          <button style="background:none;border:none;color:#fff;cursor:pointer">Đăng xuất</button>
        </form>
      @else
        <a href="{{ route('login') }}" style="color:#fff;margin-left:12px">Đăng nhập</a>
      @endauth
    </div>
  </div>
</nav>
