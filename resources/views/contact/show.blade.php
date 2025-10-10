@extends('layouts.admin')
@section('title','Chi tiết liên hệ')
@section('content')
<h1>Chi tiết liên hệ #{{ $contact->id }}</h1>

<p><strong>Họ tên:</strong> {{ $contact->name }}</p>
<p><strong>Email:</strong> {{ $contact->email }}</p>
<p><strong>Chủ đề:</strong> {{ $contact->subject }}</p>
<p><strong>Nội dung:</strong><br>{!! nl2br(e($contact->message)) !!}</p>
<p><strong>Ngày gửi:</strong> {{ $contact->created_at->format('d/m/Y H:i') }}</p>

<a href="{{ route('admin.contacts.index') }}">← Quay lại danh sách</a>
@endsection
