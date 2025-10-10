@extends('layouts.myApp')

@section('content')
<div style="display:flex;justify-content:space-between;align-items:center;">
  <h2>Quản lý Bài viết</h2>
  <a href="{{ route('admin.articles.create') }}" 
     style="padding:8px 12px;background:#0b74de;color:#fff;border-radius:6px;text-decoration:none">
     Tạo mới
  </a>
</div>

<table style="width:100%;border-collapse:collapse;margin-top:12px;">
  <thead>
    <tr style="text-align:left;border-bottom:1px solid #eee;">
      <th>Tiêu đề</th>
      <th>Danh mục</th>
      <th>Ngày đăng</th>
      <th>Hành động</th>
    </tr>
  </thead>
  <tbody>
    @foreach($items as $it)
      <tr style="border-bottom:1px solid #f6f6f6;">
        <td>{{ $it->title }}</td>
        <td>{{ $it->category ?? '-' }}</td>
        <td>{{ $it->published_at ? $it->published_at->format('Y-m-d') : '-' }}</td>
        <td>
          <a href="{{ route('articles.show', $it) }}" style="margin-right:8px">Xem</a>
          <a href="{{ route('admin.articles.edit', $it) }}" style="margin-right:8px">Sửa</a>
          <form action="{{ route('admin.articles.destroy', $it) }}" method="POST" style="display:inline" onsubmit="return confirm('Xác nhận xóa?')">
            @csrf 
            @method('DELETE')
            <button style="background:none;border:0;color:#d00;cursor:pointer">Xóa</button>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

<div style="margin-top:12px;">
  {{ $items->links() }}
</div>
@endsection
