@extends('layouts.myApp')

@section('content')
<h2>Thêm bài viết</h2>

<form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">
@csrf  
@include('articles._form')
</form>
@endsection
