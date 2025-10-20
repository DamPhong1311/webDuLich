@extends('layouts.admin')
@section('title','Danh sách liên hệ')
@section('content')
<h1>Danh sách liên hệ</h1>

@if(session('success'))
<div class="contact-success-message">{{ session('success') }}</div>
@endif

<table border="1" width="100%" cellspacing="0" cellpadding="8">
  <thead>
    <tr class="contact-table-header-row">
      <th>ID</th>
      <th>Họ tên</th>
      <th>Email</th>
      <th>Chủ đề</th>
      <th>Ngày gửi</th>
      <th>Thao tác</th>
    </tr>
  </thead>
  <tbody>
    @foreach($contacts as $c)
    <tr>
      <td>{{ $c->id }}</td>
      <td>{{ $c->name }}</td>
      <td>{{ $c->email }}</td>
      <td>{{ $c->subject }}</td>
      <td>{{ $c->created_at->format('d/m/Y H:i') }}</td>
      <td>
        <a href="{{ route('admin.contacts.show',$c) }}">Xem</a> |
        <form action="{{ route('admin.contacts.destroy',$c) }}" method="POST" class="contact-inline-form">
          @csrf @method('DELETE')
          <button type="submit" class="contact-delete-btn">Xóa</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

<div class="contact-pagination">{{ $contacts->links() }}</div>

@endsection