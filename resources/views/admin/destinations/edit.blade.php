@extends('layouts.myApp')
@section('content')
<h2>Chỉnh sửa: {{ $destination->title }}</h2>

<form method="POST" action="{{ route('admin.destinations.update', $destination) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('admin.destinations._form')
</form>
@endsection