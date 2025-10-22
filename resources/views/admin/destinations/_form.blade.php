@extends('layouts.myApp')

@section('title', isset($destination) ? 'Sửa Điểm Đến' : 'Tạo Điểm Đến Mới')

@push('styles')
@vite(['resources/css/admin/destination_form.css'])
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
@endpush

@section('content')
<div class="admin-form-container">
    <h2>{{ isset($destination) ? 'Sửa Điểm Đến' : 'Tạo Điểm Đến Mới' }}</h2>
    
    <form action="{{ isset($destination) ? route('admin.destinations.update', $destination) : route('admin.destinations.store') }}" 
          method="POST" enctype="multipart/form-data" class="admin-form">
        @csrf
        @if(isset($destination))
            @method('PUT')
        @endif

        <div class="form-group">
            <label>Tiêu đề</label>
            <input type="text" name="title" value="{{ old('title', $destination->title ?? '') }}" required class="form-input">
        </div>

        <div class="form-group">
            <label>Excerpt</label>
            <textarea name="excerpt" class="form-textarea">{{ old('excerpt', $destination->excerpt ?? '') }}</textarea>
        </div>

        <div class="form-group">
            <label>Nội dung</label>
            <textarea name="content" rows="8" class="form-textarea">{{ old('content', $destination->content ?? '') }}</textarea>
        </div>

        <div class="form-group">
            <label>Ảnh bìa</label>
            @php
            $cover = old('cover_image', $destination->cover_image ?? '');
            @endphp
            <div id="cover-preview">
                @if(!empty($cover))
                <img src="{{ asset('storage/' . $cover) }}" alt="cover"
                    style="max-width:200px;border-radius:8px;margin-bottom:8px;">
                @endif
            </div>
            <input type="file" name="cover_image" accept="image/*" id="cover-input" class="form-input">
        </div>

        <div class="form-group">
            <label>Thư viện ảnh</label>
            @php
            $galleryRaw = old('gallery', $destination->gallery ?? '[]');
            $galleryArray = is_array($galleryRaw) ? $galleryRaw : (json_decode($galleryRaw, true) ?: []);
            @endphp

            <div id="gallery-preview" style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:12px;">
                @foreach($galleryArray as $index => $img)
                <div class="gallery-item" style="position:relative;">
                    <img src="{{ asset('storage/' . $img) }}" alt="gallery"
                        style="width:80px;height:80px;object-fit:cover;border-radius:4px;">
                    @if(isset($destination))
                    <button type="button" class="remove-gallery-image" data-image-path="{{ $img }}"
                        data-destination-id="{{ $destination->id }}" style="position:absolute;top:-5px;right:-5px;background:red;color:white;border:none;
                                       border-radius:50%;width:20px;height:20px;cursor:pointer;font-size:12px;
                                       display:flex;align-items:center;justify-content:center;">×</button>
                    @endif
                </div>
                @endforeach
            </div>

            <div id="gallery-inputs">
                <input type="file" name="gallery[]" accept="image/*" class="form-input">
            </div>

            <button type="button" id="add-gallery-input" class="btn" style="margin-top:8px;background:#3490dc;color:white;padding:6px 12px;border:none;
                   border-radius:4px;cursor:pointer;">
                + Thêm ảnh
            </button>

            <small class="form-note">Chọn từng ảnh hoặc thêm nhiều ảnh bằng cách nhấn "+ Thêm ảnh".</small>
        </div>

        <div class="form-group">
            <label>Location</label>
            <input type="text" name="location" value="{{ old('location', $destination->location ?? '') }}" class="form-input">
        </div>

        <div class="form-group">
            <label>Province</label>
            <input type="text" name="province" value="{{ old('province', $destination->province ?? '') }}" class="form-input">
        </div>

        <div class="form-grid">
            <div>
                <label>Vĩ độ (Latitude)</label>
                <input id="dest-latitude" name="latitude" type="text" inputmode="decimal"
                    value="{{ old('latitude', $destination->latitude ?? '') }}" placeholder="VD: 15.880100" class="form-input">
            </div>
            <div>
                <label>Kinh độ (Longitude)</label>
                <input id="dest-longitude" name="longitude" type="text" inputmode="decimal"
                    value="{{ old('longitude', $destination->longitude ?? '') }}" placeholder="VD: 108.338000"
                    class="form-input">
            </div>
        </div>

        <div class="form-group">
            <label>Tìm kiếm địa điểm</label>
            <div class="search-wrapper" style="display:flex;gap:8px;margin-bottom:12px;">
                <input type="text" id="location-search" placeholder="Nhập địa chỉ, địa danh..." 
                       style="flex:1;padding:8px 12px;border:1px solid #d1d5db;border-radius:4px;">
                <button type="button" id="btn-search-location" 
                        style="background:#3490dc;color:white;border:none;padding:8px 16px;border-radius:4px;cursor:pointer;">
                    Tìm
                </button>
            </div>
        </div>

        <div class="form-group">
            <label>Chọn trên bản đồ (tuỳ chọn)</label>
            <div id="pickerMapDest" class="map-picker"></div>
            <small class="form-note">Click để đặt marker, kéo để điều chỉnh; toạ độ sẽ tự điền vào hai ô ở trên.</small>
        </div>

        <div class="form-group checkbox">
            <label>
                <input type="checkbox" name="featured" {{ old('featured', $destination->featured ?? false) ? 'checked' : '' }}>
                Featured
            </label>
        </div>

        <div>
            <button type="submit" class="btn-submit">Lưu</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('cover-input')?.addEventListener('change', function(e) {
        const preview = document.getElementById('cover-preview');
        preview.innerHTML = '';

        if (e.target.files[0]) {
            const reader = new FileReader();
            reader.onload = function(ev) {
                const img = document.createElement('img');
                img.src = ev.target.result;
                img.style.maxWidth = '200px';
                img.style.borderRadius = '8px';
                img.style.marginBottom = '8px';
                preview.appendChild(img);
            };
            reader.readAsDataURL(e.target.files[0]);
        }
    });

    const addBtn = document.getElementById('add-gallery-input');
    const galleryInputs = document.getElementById('gallery-inputs');

    addBtn.addEventListener('click', function() {
        const newInput = document.createElement('input');
        newInput.type = 'file';
        newInput.name = 'gallery[]';
        newInput.accept = 'image/*';
        newInput.classList.add('form-input');
        newInput.style.marginTop = '5px';
        galleryInputs.appendChild(newInput);
    });

    galleryInputs.addEventListener('change', function(e) {
        if (e.target.type === 'file' && e.target.files.length > 0) {
            const preview = document.getElementById('gallery-preview');
            [...e.target.files].forEach(file => {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const img = document.createElement('img');
                    img.src = event.target.result;
                    img.style.width = '80px';
                    img.style.height = '80px';
                    img.style.objectFit = 'cover';
                    img.style.borderRadius = '4px';
                    img.style.marginRight = '8px';
                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        }
    });

    initMapPicker();

    document.querySelectorAll('.remove-gallery-image').forEach(button => {
        button.addEventListener('click', function() {
            const imagePath = this.dataset.imagePath;
            const destinationId = this.dataset.destinationId;
            
            if (confirm('Bạn có chắc muốn xóa ảnh này?')) {
                fetch(`/admin/destinations/${destinationId}/remove-gallery-image`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ image_path: imagePath })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        this.parentElement.remove();
                    } else {
                        alert('Lỗi khi xóa ảnh');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Lỗi khi xóa ảnh');
                });
            }
        });
    });
});

let searchMap;
let searchMarker;

function initMapPicker() {
    const mapElement = document.getElementById('pickerMapDest');
    if (!mapElement) return;

    const latInput = document.getElementById('dest-latitude');
    const lngInput = document.getElementById('dest-longitude');
    
    const defaultLat = latInput.value ? parseFloat(latInput.value) : 15.880100;
    const defaultLng = lngInput.value ? parseFloat(lngInput.value) : 108.338000;

    searchMap = L.map('pickerMapDest').setView([defaultLat, defaultLng], 10);
    
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(searchMap);
    
    searchMarker = L.marker([defaultLat, defaultLng], {
        draggable: true
    }).addTo(searchMap);
    
    searchMap.on('click', function(e) {
        const { lat, lng } = e.latlng;
        
        searchMarker.setLatLng([lat, lng]);
        
        latInput.value = lat.toFixed(6);
        lngInput.value = lng.toFixed(6);
    });
    
    searchMarker.on('dragend', function(e) {
        const { lat, lng } = e.target.getLatLng();
        latInput.value = lat.toFixed(6);
        lngInput.value = lng.toFixed(6);
    });

    const searchInput = document.getElementById('location-search');
    const searchButton = document.getElementById('btn-search-location');

    searchButton.addEventListener('click', searchLocation);
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            searchLocation();
        }
    });
}

function searchLocation() {
    const searchInput = document.getElementById('location-search');
    const query = searchInput.value.trim();
    
    if (!query) return;

    const latInput = document.getElementById('dest-latitude');
    const lngInput = document.getElementById('dest-longitude');

    fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&limit=1&countrycodes=vn`)
        .then(response => response.json())
        .then(data => {
            if (data && data.length > 0) {
                const result = data[0];
                const lat = parseFloat(result.lat);
                const lon = parseFloat(result.lon);
                
                searchMap.setView([lat, lon], 15);
                searchMarker.setLatLng([lat, lon]);
                
                latInput.value = lat.toFixed(6);
                lngInput.value = lon.toFixed(6);
                
            } else {
                alert('Không tìm thấy địa điểm. Vui lòng thử từ khóa khác.');
            }
        })
        .catch(error => {
            console.error('Lỗi tìm kiếm:', error);
            alert('Lỗi khi tìm kiếm địa điểm.');
        });
}
</script>
@endpush