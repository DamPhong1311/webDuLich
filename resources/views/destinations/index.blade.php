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

@endsection

