@extends('layouts.myApp')

@section('title','Trang quản trị')

@push('styles')
@vite(['resources/css/admin/dashboard.css'])
@endpush

@section('content')
<div class="admin-dashboard-container">
   <h1 class="admin-dashboard-title">Trang quản trị</h1>
   <p>Chào mừng {{ Auth::user()->name }}! Đây là khu vực quản lý.</p>

   <div class="admin-dashboard-grid">
      <a href="{{ route('admin.destinations.index') }}" class="admin-dashboard-link admin-dashboard-link-destination">
          Quản lý Điểm đến
      </a>

      <a href="{{ route('admin.articles.index') }}" class="admin-dashboard-link admin-dashboard-link-article">
          Quản lý Bài viết
      </a>

      <a href="{{ route('admin.contacts.index') }}" class="admin-dashboard-link admin-dashboard-link-contact">
          Quản lý Liên hệ
      </a>
   </div>
</div>
@endsection
