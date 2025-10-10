@extends('layouts.myApp')

@section('content')
<h2>Sửa bài viết</h2>

<form method="POST" action="{{ route('articles.update', $article) }}" enctype="multipart/form-data">
  @method('PUT')
  @include('articles._form')
</form>
@endsection
