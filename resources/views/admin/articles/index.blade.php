@extends('layouts.myApp')

@section('title', 'Quản lý Bài viết')

@push('styles')
@vite(['resources/css/admin/articles.css'])
@endpush

@section('content')
<div class="admin-articles-header">
  <h2>Quản lý Bài viết</h2> 
  <a href="{{ route('admin.articles.create') }}" class="admin-articles-create-btn">Tạo mới</a>
</div>

<table class="admin-articles-table">
  <thead>
    <tr>
      <th>Tiêu đề</th>
      <th>Danh mục</th>
      <th>Ngày đăng</th>
      <th>Hành động</th>
    </tr>
  </thead>
  <tbody>
    @foreach($items as $it)
      <tr>
        <td>{{ $it->title }}</td>
        <td>{{ $it->category ?? '-' }}</td>
        <td>{{ $it->published_at ? $it->published_at->format('Y-m-d') : '-' }}</td>
        <td class="admin-articles-actions">
          <a href="{{ route('articles.show', $it) }}">Xem</a>
          <a href="{{ route('admin.articles.edit', $it) }}">Sửa</a>
          <form action="{{ route('admin.articles.destroy', $it) }}" method="POST" style="display:inline"
                onsubmit="return confirm('Xác nhận xóa?')">
            @csrf
            @method('DELETE')
            <button class="admin-articles-delete-btn">Xóa</button>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

<div class="admin-articles-pagination">
  {{ $items->links() }}
</div>
@endsection
