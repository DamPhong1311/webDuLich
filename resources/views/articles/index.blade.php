@extends('layouts.myApp')
@section('title', 'Bài viết')
@section('content')
    <h1>Bài viết mới nhất</h1>

    <div style="margin-bottom:20px;">
        <a href="{{ route('articles.create') }}"
            style="padding:8px 12px;background:#007bff;color:#fff;border-radius:4px;text-decoration:none;">
            + Thêm bài viết
        </a>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:18px;">
        @foreach($articles as $a)
            <article style="border:1px solid #eee;padding:12px;border-radius:6px;">
                <a href="{{ route('articles.show', $a) }}" style="text-decoration:none;color:inherit">
                    @if($a->cover_image)
                        <img src="{{ $a->cover_image }}" style="width:100%;height:180px;object-fit:cover;border-radius:4px;">
                    @endif
                    <h2 style="margin-top:10px">{{ $a->title }}</h2>
                </a>
                <p style="color:#666">{{ Str::limit($a->excerpt ?? $a->content, 120) }}</p>

                {{-- Nếu là tác giả thì hiện Edit / Delete --}}
                @if($a->user_id === auth()->id())
                    <div style="margin-top:10px;">
                           <a href="{{ route('articles.edit', $a) }}" style="margin-right:10px;color:#007bff;">✏️ Sửa</a>
                        <form action="{{ route('articles.destroy', $a) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Bạn chắc chắn muốn xóa?')"
                                style="color:red;border:none;background:none;cursor:pointer;">
                                🗑️ Xóa
                            </button>
                        </form>
                    </div>
                @endif
            </article>
        @endforeach
    </div>

    <div style="margin-top:20px;">{{ $articles->links() }}</div>
@endsection