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

<style>
/* --- General Layout (No change) --- */
.map-shell {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 320px 1fr;
    gap: 18px;
    position: relative;
    /* Thêm để định vị cho overlay */
}

@media (max-width: 980px) {
    .map-shell {
        grid-template-columns: 1fr;
    }
}

.map-panel {
    background: #fff;
    border: 1px solid var(--vt-border, #e5e7eb);
    border-radius: 14px;
    box-shadow: var(--vt-shadow, 0 10px 30px rgba(2, 6, 23, .08));
    padding: 16px;
}

.map-panel h2 {
    margin: 0 0 12px;
    font-weight: 800;
    color: #0f1a2b;
    font-size: 1.3rem;
}

/* --- Control Panel Filters & Actions --- */
.map-filter {
    display: grid;
    gap: 14px;
}

/* --- NEW: Smart Search Bar --- */
.search-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

#smartSearch {
    height: 42px;
    border-radius: 10px;
    border: 1px solid #a5b4fc;
    padding: 0 45px 0 15px;
    /* Thêm padding phải cho nút search */
    background: #fbfdff;
    outline: none;
    width: 100%;
    font-size: 1rem;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
}

#btnSearch {
    position: absolute;
    right: 5px;
    top: 5px;
    bottom: 5px;
    border: none;
    background: #4f46e5;
    color: white;
    border-radius: 8px;
    width: 32px;
    cursor: pointer;
    display: grid;
    place-items: center;
    font-size: 1.2rem;
}

#btnSearch:hover {
    background: #4338ca;
}


.map-filter .checkrow {
    display: flex;
    gap: 16px;
    align-items: center;
    flex-wrap: wrap;
}

.map-filter label {
    font-weight: 600;
    color: #0f1a2b;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.map-filter input[type="checkbox"] {
    width: 1.1em;
    height: 1.1em;
}

.map-filter hr {
    border: none;
    border-top: 1px solid #e5e7eb;
    margin: 4px 0;
}

/* --- NEW: Button Styles --- */
.map-action-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 0 14px;
    height: 38px;
    border: 1px solid;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    flex-grow: 1;
    /* Để các nút đều nhau */
}

.map-action-btn.btn-primary {
    background-color: #4f46e5;
    border-color: #4f46e5;
    color: #fff;
}

.map-action-btn.btn-primary:hover {
    background-color: #4338ca;
}

.map-action-btn.btn-secondary {
    background-color: #f1f5f9;
    border-color: #e2e8f0;
    color: #334155;
}

.map-action-btn.btn-secondary:hover {
    background-color: #e2e8f0;
    border-color: #cbd5e1;
}

.map-legend {
    font-size: .9rem;
    color: #64748b;
    line-height: 1.5;
}

/* --- Map Container & Popups (No change) --- */
.map-container {
    position: relative;
    width: 100%;
    height: min(70vh, 680px);
    border-radius: 14px;
    overflow: hidden;
    border: 1px solid var(--vt-border, #e5e7eb);
    box-shadow: var(--vt-shadow, 0 10px 30px rgba(2, 6, 23, .08));
}

#map {
    width: 100%;
    height: 100%;
}

.leaflet-popup-content-wrapper {
    border-radius: 12px;
}

.popup-card {
    display: grid;
    grid-template-columns: 88px 1fr;
    gap: 10px;
    align-items: center;
}

.popup-card img {
    width: 88px;
    height: 72px;
    object-fit: cover;
    border-radius: 10px;
    border: 1px solid #e5e7eb;
}

.popup-card h3 {
    margin: 0;
    font-size: 1rem;
    font-weight: 800;
    color: #0f1a2b;
}

.popup-card p {
    margin: .2rem 0 0;
    color: #64748b;
    font-size: .92rem;
}

.popup-card a {
    display: inline-block;
    margin-top: 6px;
    font-weight: 700;
    text-decoration: none;
    color: #2563eb;
}

.popup-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: .85rem;
    font-weight: 700;
    color: #059669;
    background: #d1fae5;
    border: 1px solid #a7f3d0;
    border-radius: 999px;
    padding: 4px 10px;
}

.popup-badge.article {
    color: #3b82f6;
    background: #dbeafe;
    border-color: #bfdbfe;
}

/* --- NEW: Map Overlay for Loading/Error States --- */
#map-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.7);
    backdrop-filter: blur(4px);
    z-index: 1000;
    /* Phải cao hơn z-index của map controls */
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    text-align: center;
    transition: opacity 0.3s;
    pointer-events: none;
    /* Mặc định không bắt sự kiện chuột */
    opacity: 0;
}

#map-overlay.visible {
    opacity: 1;
    pointer-events: auto;
    /* Khi hiện ra thì bắt sự kiện */
}

/* Loader animation */
.loader {
    width: 48px;
    height: 48px;
    border: 5px solid #4f46e5;
    border-bottom-color: transparent;
    border-radius: 50%;
    display: inline-block;
    box-sizing: border-box;
    animation: rotation 1s linear infinite;
}

@keyframes rotation {
    0% {
        transform: rotate(0deg);
    }

    100% {
        transform: rotate(360deg);
    }
}

.overlay-message {
    margin-top: 16px;
    font-size: 1.1rem;
    font-weight: 600;
    color: #1e293b;
}
</style>

<div class="map-shell">
    <aside class="map-panel">
        <h2>Khám phá Việt Nam</h2>
        <div class="map-filter">
            <!-- Gộp thành 1 thanh tìm kiếm thông minh -->
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

    <!-- Map container -->
    <div class="map-container">
        <div id="map"></div>
        <!-- Lớp phủ cho trạng thái loading/error -->
        <div id="map-overlay">
            <div id="loader-element" class="loader"></div>
            <div id="message-element" class="overlay-message">Đang tải dữ liệu bản đồ...</div>
        </div>
    </div>
</div>

{{-- Bạn sẽ cần cập nhật file JS để xử lý logic mới cho search bar và overlay --}}
@vite('resources/js/map-explore.js')
@endsection