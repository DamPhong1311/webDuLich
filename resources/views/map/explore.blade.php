@extends('layouts.myApp')
@section('title','Bản đồ khám phá')
@section('content')

{{--
    CHANGELOG:
    - Gộp 2 ô tìm kiếm thành 1 thanh tìm kiếm thông minh.
    - Thêm lớp phủ #map-overlay cho trạng thái Tải (loading) và Lỗi (error).
    - Cải thiện UI/UX của control panel:
        + Thêm icon cho các nút.
        + Phân cấp style nút chính/phụ (primary/secondary).
        + Thêm đường kẻ <hr> để phân tách các nhóm chức năng.
    - Cập nhật CSS tương ứng cho các thay đổi trên.
--}}

<div class="map-shell">
    <aside class="map-panel">
        <h2>Khám phá Việt Nam</h2>
        <div class="map-filter">
    
            <div class="search-wrapper">
                <input id="smartSearch" type="text" placeholder="Tìm điểm đến, bài viết, địa danh...">
                <button id="btnSearch" type="button" aria-label="Tìm kiếm">🔎</button>
            </div>

            <div class="checkrow">
                <label><input type="checkbox" id="fDest" checked> Điểm đến</label>
                <label><input type="checkbox" id="fArt" checked> Bài viết</label>
            </div>

            <hr>

            <div class="checkrow">
                <button id="btnLocate" class="map-action-btn btn-primary" type="button">📍 Vị trí của tôi</button>
                <button id="btnReset" class="map-action-btn btn-secondary" type="button">↺ Xoá lọc</button>
            </div>

            <p class="map-legend">
                Nhập từ khoá để lọc các điểm trên bản đồ, hoặc tìm một địa danh bất kỳ để di chuyển tới.
            </p>
        </div>
    </aside>

    <div class="map-container">
        <div id="map"></div>
        <div id="map-overlay">
            <div id="loader-element" class="loader"></div>
            <div id="message-element" class="overlay-message">Đang tải dữ liệu bản đồ...</div>
        </div>
    </div>
</div>

@vite('resources/js/map-explore.js')
@endsection