@extends('layouts.myApp')

@section('title','Trang quản trị')

@section('content')
<div style="max-width:900px;margin:auto;padding:20px;">
    <h1 style="margin-bottom:20px;">Trang quản trị</h1>
    <p>Chào mừng {{ Auth::user()->name }}! Đây là khu vực quản lý.</p>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:20px;margin-top:30px;">
        <a href="{{ route('admin.destinations.index') }}" 
           style="display:block;padding:20px;text-align:center;background:#007bff;color:white;border-radius:8px;text-decoration:none;">
           📍 Quản lý Điểm đến
        </a>

        <a href="{{ route('admin.articles.index') }}" 
           style="display:block;padding:20px;text-align:center;background:#28a745;color:white;border-radius:8px;text-decoration:none;">
           📝 Quản lý Bài viết
        </a>

        <a href="{{ route('admin.contacts.index') }}" 
           style="display:block;padding:20px;text-align:center;background:#ffc107;color:black;border-radius:8px;text-decoration:none;">
           ✉️ Quản lý Liên hệ
        </a>
    </div>
</div>
@endsection
