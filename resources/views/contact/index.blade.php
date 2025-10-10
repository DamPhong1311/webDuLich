@extends('layouts.admin')
@section('title','Danh sách liên hệ')
@section('content')
<h1>Danh sách liên hệ</h1>

@if(session('success'))
  <div style="background:#e6ffed;padding:8px;border:1px solid #b4f2c0;margin:10px 0;">{{ session('success') }}</div>
@endif

<table border="1" width="100%" cellspacing="0" cellpadding="8">
  <thead>
    <tr style="background:#f2f2f2">
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
          <form action="{{ route('admin.contacts.destroy',$c) }}" method="POST" style="display:inline;">
            @csrf @method('DELETE')
            <button type="submit" style="color:red;border:none;background:none;">Xóa</button>
          </form>
        </td>
      </tr>
    @endforeach
  </tbody>
</table>

<div style="margin-top:15px;">{{ $contacts->links() }}</div>
@endsection
