@extends('layouts.myApp')
@section('title', 'Liên hệ')
@section('content')
<div style="max-width:600px;margin:auto;padding:20px;">
  <h1>Liên hệ với chúng tôi</h1>

  @if(session('success'))
    <div style="background:#e6ffed;padding:10px;border:1px solid #b4f2c0;color:#2a5d3c;margin:10px 0;border-radius:6px;">
      {{ session('success') }}
    </div>
  @endif

  <form action="{{ route('contact.submit') }}" method="POST" style="display:flex;flex-direction:column;gap:12px;">
    @csrf

    <div>
      <label for="name">Họ và tên:</label><br>
      <input type="text" id="name" name="name" value="{{ old('name') }}" required style="width:100%;padding:8px;border:1px solid #ccc;border-radius:4px;">
      @error('name') <div style="color:red;">{{ $message }}</div> @enderror
    </div>

    <div>
      <label for="email">Email:</label><br>
      <input type="email" id="email" name="email" value="{{ old('email') }}" required style="width:100%;padding:8px;border:1px solid #ccc;border-radius:4px;">
      @error('email') <div style="color:red;">{{ $message }}</div> @enderror
    </div>

    <div>
      <label for="subject">Chủ đề:</label><br>
      <input type="text" id="subject" name="subject" value="{{ old('subject') }}" style="width:100%;padding:8px;border:1px solid #ccc;border-radius:4px;">
      @error('subject') <div style="color:red;">{{ $message }}</div> @enderror
    </div>

    <div>
      <label for="message">Nội dung:</label><br>
      <textarea id="message" name="message" rows="6" required style="width:100%;padding:8px;border:1px solid #ccc;border-radius:4px;">{{ old('message') }}</textarea>
      @error('message') <div style="color:red;">{{ $message }}</div> @enderror
    </div>

    <button type="submit" style="padding:10px 16px;border:none;background:#007bff;color:white;border-radius:4px;cursor:pointer;">
      Gửi liên hệ
    </button>
  </form>
</div>
@endsection
