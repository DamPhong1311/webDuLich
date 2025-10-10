@extends('layouts.myApp')
@section('content')
  <h2>Tạo điểm đến mới</h2>

  <form action="{{ route('admin.destinations.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('admin.destinations._form')
  </form>
@endsection 