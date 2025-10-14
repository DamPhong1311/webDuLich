<nav class="nav-main">
  <div class="nav-inner">
    <a href="{{ url('/') }}" class="nav-brand">HeritageTravel</a>
    <div>
      <a href="{{ route('destinations.index') }}" class="nav-link nav-link-mr">Điểm đến</a>
      <a href="/articles" class="nav-link nav-link-mr">Bài viết</a>
      <a href="/contact" class="nav-link nav-link-mr">Liên hệ</a>

      @auth
      <a href="{{ route('admin.destinations.index') }}" class="nav-link nav-link-ml">Admin</a>
      <form class="nav-logout-form" method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="nav-logout-btn">Đăng xuất</button>
      </form>
      @else
      <a href="{{ route('login') }}" class="nav-link nav-link-ml">Đăng nhập</a>
    </div>
    <style>
      .nav-main {
        background: #111;
        color: #fff;
        padding: 12px 0;
      }

      .nav-inner {
        max-width: 1100px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
      }

      .nav-brand {
        color: #fff;
        text-decoration: none;
        font-weight: 700;
      }

      .nav-link {
        color: #fff;
        text-decoration: none;
      }

      .nav-link-mr {
        margin-right: 12px;
      }

      .nav-link-ml {
        margin-left: 12px;
      }

      .nav-logout-form {
        display: inline;
      }

      .nav-logout-btn {
        background: none;
        border: none;
        color: #fff;
        cursor: pointer;
      }
    </style>
    @endauth
  </div>
  </div>
</nav>