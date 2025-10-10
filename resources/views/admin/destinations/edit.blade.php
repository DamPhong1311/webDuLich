@extends('layouts.myApp')
@section('content')
<h2>Chỉnh sửa: {{ $destination->title }}</h2>

<form action="{{ route('admin.destinations.update', $destination) }}" method="POST" enctype="multipart/form-data">
  @method('PUT')
  @include('admin.destinations._form')
</form>
@endsection
