@extends('layouts.myApp')
@section('title','Điểm đến')
@section('content')

<div class="search-filter-container">
    <h1 class="page-title">Khám phá các điểm đến</h1>

    {{-- SEARCH & FILTER FORM --}}
    <form action="{{ route('destinations.index') }}" method="GET" class="search-filter-form">
        <div class="form-group search-group">
            <input type="text" name="search" class="form-control" placeholder="Tìm kiếm theo tên, mô tả..." value="{{ $searchTerm ?? '' }}">
        </div>
        <div class="form-group filter-group">
            <select name="province" class="form-control">
                <option value="">Tất cả tỉnh/thành</option>
                @foreach($provinces as $province)
                    <option value="{{ $province }}" {{ $selectedProvince == $province ? 'selected' : '' }}>
                        {{ $province }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
            <a href="{{ route('destinations.index') }}" class="btn btn-secondary">Xóa bộ lọc</a>
        </div>
    </form>
</div>


@if($destinations->isEmpty())
    <div class="no-results">
        <p>Không tìm thấy kết quả nào phù hợp.</p>
    </div>
@else
    <div class="card-grid">
        @foreach($destinations as $d)
            @include('components.destination-card', ['d' => $d])
        @endforeach
    </div>
    <div class="pagination-wrapper">
        {{ $destinations->links() }}
    </div>
@endif

<style>
.page-title { margin-bottom: 24px; font-size: 2.2rem; font-weight: 700; color: #1a202c; text-align: center;}
.search-filter-container { background-color: #f8f9fa; padding: 24px; border-radius: 12px; margin-bottom: 30px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
.search-filter-form { display: flex; flex-wrap: wrap; gap: 16px; align-items: flex-end; }
.form-group { flex: 1; min-width: 200px; }
.search-group { flex-grow: 2; }
.form-control { width: 100%; padding: 10px 14px; border: 1px solid #ced4da; border-radius: 8px; font-size: 1rem; transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out; }
.form-control:focus { border-color: #86b7fe; outline: 0; box-shadow: 0 0 0 0.25rem rgba(13,110,253,.25); }
.form-actions { display: flex; gap: 10px; }
.btn { display: inline-block; font-weight: 400; line-height: 1.5; text-align: center; text-decoration: none; vertical-align: middle; cursor: pointer; user-select: none; background-color: transparent; border: 1px solid transparent; padding: 10px 18px; font-size: 1rem; border-radius: 8px; transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out; }
.btn-primary { color: #fff; background-color: #0d6efd; border-color: #0d6efd; }
.btn-primary:hover { background-color: #0b5ed7; border-color: #0a58ca; }
.btn-secondary { color: #fff; background-color: #6c757d; border-color: #6c757d; }
.btn-secondary:hover { background-color: #5c636a; border-color: #565e64; }
.card-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px; }
.pagination-wrapper { margin-top: 30px; display: flex; justify-content: center; }
.no-results { text-align: center; padding: 40px; background-color: #fff; border-radius: 12px; }
</style>
@endsection

