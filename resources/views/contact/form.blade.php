@extends('layouts.myApp')
@section('title', 'Liên hệ')
@section('content')
<div class="contact-form-container">
  <h1>Liên hệ với chúng tôi</h1>

  @if(session('success'))
  <div class="contact-form-success">
    {{ session('success') }}
  </div>
  @endif

  <form action="{{ route('contact.submit') }}" method="POST" class="contact-form-main">
    @csrf

    <div>
      <label for="name">Họ và tên:</label><br>
      <input type="text" id="name" name="name" value="{{ old('name') }}" required class="contact-form-input">
      @error('name') <div class="contact-form-error">{{ $message }}</div> @enderror
    </div>

    <div>
      <label for="email">Email:</label><br>
      <input type="email" id="email" name="email" value="{{ old('email') }}" required class="contact-form-input">
      @error('email') <div class="contact-form-error">{{ $message }}</div> @enderror
    </div>

    <div>
      <label for="subject">Chủ đề:</label><br>
      <input type="text" id="subject" name="subject" value="{{ old('subject') }}" class="contact-form-input">
      @error('subject') <div class="contact-form-error">{{ $message }}</div> @enderror
    </div>

    <div>
      <label for="message">Nội dung:</label><br>
      <textarea id="message" name="message" rows="6" required class="contact-form-input">{{ old('message') }}</textarea>
      @error('message') <div class="contact-form-error">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="contact-form-submit">
      Gửi liên hệ
    </button>
  </form>
  <style>
    .contact-form-container {
      max-width: 600px;
      margin: auto;
      padding: 20px;
    }

    .contact-form-success {
      background: #e6ffed;
      padding: 10px;
      border: 1px solid #b4f2c0;
      color: #2a5d3c;
      margin: 10px 0;
      border-radius: 6px;
    }

    .contact-form-main {
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    .contact-form-input {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .contact-form-error {
      color: red;
    }

    .contact-form-submit {
      padding: 10px 16px;
      border: none;
      background: #007bff;
      color: white;
      border-radius: 4px;
      cursor: pointer;
    }
  </style>
</div>
@endsection