@extends('layouts.myApp')

@section('title', 'Quản lý Bài viết')

@push('styles')
{{-- Dùng lại CSS của trang Destination để bảo đảm giống 100% --}}
@vite(['resources/css/admin/destination_index.css'])
@endpush

@section('content')
<div class="admin-shell">
    <div class="admin-header">
        <h2>Quản lý Bài viết</h2>
        <a href="{{ route('admin.articles.create') }}" class="btn-create">Tạo mới</a>
    </div>

    <table class="admin-table">
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
                <td>
                    <a href="{{ route('articles.show', $it) }}" class="link-action">Xem</a>
                    <a href="{{ route('admin.articles.edit', $it) }}" class="link-action">Sửa</a>
                    <form action="{{ route('admin.articles.destroy', $it) }}" method="POST" class="form-inline"
                        onsubmit="return confirm('Xác nhận xóa?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn-delete">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination-wrapper">
        {{ $items->links() }}
    </div>
</div>
@endsection