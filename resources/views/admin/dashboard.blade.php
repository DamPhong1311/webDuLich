@extends('layouts.myApp')

@section('title','Trang quản trị')

@section('content')
<div class="admin-dashboard-container">
   <h1 class="admin-dashboard-title">Trang quản trị</h1>
   <p>Chào mừng {{ Auth::user()->name }}! Đây là khu vực quản lý.</p>

   <div class="admin-dashboard-grid">
      <a href="{{ route('admin.destinations.index') }}" class="admin-dashboard-link admin-dashboard-link-destination">
         📍 Quản lý Điểm đến
      </a>

      <a href="{{ route('admin.articles.index') }}" class="admin-dashboard-link admin-dashboard-link-article">
         📝 Quản lý Bài viết
      </a>

      <a href="{{ route('admin.contacts.index') }}" class="admin-dashboard-link admin-dashboard-link-contact">
         ✉️ Quản lý Liên hệ
      </a>
   </div>
</div>

<style>
   .admin-dashboard-container {
      max-width: 900px;
      margin: auto;
      padding: 20px;
   }

   .admin-dashboard-title {
      margin-bottom: 20px;
   }

   .admin-dashboard-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
      margin-top: 30px;
   }

   .admin-dashboard-link {
      display: block;
      padding: 20px;
      text-align: center;
      border-radius: 8px;
      text-decoration: none;
   }

   .admin-dashboard-link-destination {
      background: #007bff;
      color: white;
   }

   .admin-dashboard-link-article {
      background: #28a745;
      color: white;
   }

   .admin-dashboard-link-contact {
      background: #ffc107;
      color: black;
   }
</style>
@endsection