@extends('layouts.myApp')

@push('styles')
@vite(['resources/css/admin/destination_index.css'])
@endpush

@section('content')
<div class="admin-shell">
    <div class="admin-header">
        <h2>Quản lý Điểm đến</h2>
        <a href="{{ route('admin.destinations.create') }}" class="btn-create">Tạo mới</a>
    </div>

    <table class="admin-table">
        <thead>
            <tr>
                <th>Tiêu đề</th>
                <th>Location</th>
                <th>Published</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $it)
            <tr>
                <td>{{ $it->title }}</td>
                <td>{{ $it->location }}</td>
                <td>{{ $it->published_at ? $it->published_at->format('Y-m-d') : '-' }}</td>
                <td>
                    <a href="{{ route('destinations.show', $it) }}" class="link-action">Xem</a>
                    <a href="{{ route('admin.destinations.edit', $it) }}" class="link-action">Sửa</a>
                    <form action="{{ route('admin.destinations.destroy', $it) }}" method="POST" class="form-inline"
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