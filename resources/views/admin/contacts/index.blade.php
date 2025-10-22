@extends('layouts.myApp')
@push('styles')
@vite(['resources/css/admin/destination_index.css'])
@endpush
@section('content')
    <div class="admin-shell">
        <div class="admin-header">
            <h1>Danh sách liên hệ</h1>
        </div>

        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Nội dung</th>
                    <th>Ngày tạo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->id }}</td>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->message }}</td>
                        <td>{{ $contact->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper">
            {{  $contacts->links() }}
        </div>

@endsection