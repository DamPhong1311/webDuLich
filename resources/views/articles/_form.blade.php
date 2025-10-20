{{-- resources/views/admin/articles/_form.blade.php --}}
@csrf

<div style="margin-bottom:10px;">
    <label>Tiêu đề</label><br>
    <input type="text" name="title" value="{{ old('title', $article->title ?? '') }}" required
        style="width:100%;padding:8px">
</div>

<div style="margin-bottom:10px;">
    <label>Excerpt</label><br>
    <textarea name="excerpt" style="width:100%;padding:8px">{{ old('excerpt', $article->excerpt ?? '') }}</textarea>
</div>

<div style="margin-bottom:10px;">
    <label>Nội dung</label><br>
    <textarea name="content" rows="8"
        style="width:100%;padding:8px">{{ old('content', $article->content ?? '') }}</textarea>
</div>

{{-- ==== ẢNH BÌA (có preview khi chọn file) ==== --}}
<div class="form-group" style="margin-bottom:16px;">
    <label>Ảnh bìa</label><br>
    @php
        $cover = old('cover_image', $article->cover_image ?? '');
    @endphp

    {{-- Preview nếu có ảnh cũ --}}
    <div id="cover-preview" style="margin-bottom:8px;">
        @if(!empty($cover))
            <img src="{{ asset('storage/' . $cover) }}" alt="cover" style="max-width:200px;border-radius:8px;margin-bottom:8px;">
        @endif

    </div>

    {{-- Input upload file --}}
    <input type="file" name="cover_image" accept="image/*" id="cover-input" class="form-input" style="width:100%;">
    <small style="color:#64748b;">Chọn ảnh bìa từ máy tính của bạn (ảnh sẽ hiển thị bên trên).</small>
</div>
{{-- ==== HẾT PHẦN ẢNH BÌA ==== --}}

<div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:10px;">
    <div>
        <label>Vĩ độ (Latitude)</label><br>
        <input id="art-latitude" name="latitude" type="text" inputmode="decimal"
            value="{{ old('latitude', $article->latitude ?? '') }}" placeholder="VD: 21.027763"
            style="width:100%;padding:8px">
    </div>
    <div>
        <label>Kinh độ (Longitude)</label><br>
        <input id="art-longitude" name="longitude" type="text" inputmode="decimal"
            value="{{ old('longitude', $article->longitude ?? '') }}" placeholder="VD: 105.834160"
            style="width:100%;padding:8px">
    </div>
</div>

<div style="margin-bottom:10px;">
    <label>Chọn trên bản đồ (tuỳ chọn)</label><br>
    <div id="pickerMapArticle" style="height: 320px; border-radius:12px; border:1px solid #e5e7eb; overflow:hidden;">
    </div>
    <small style="color:#64748b;">Click để đặt marker, kéo để điều chỉnh; toạ độ sẽ tự điền vào hai ô ở trên.</small>
</div>

<div>
    <button type="submit"
        style="padding:10px 18px;background:#4f8cff;color:#fff;border:none;border-radius:8px;font-weight:700;box-shadow:0 8px 20px rgba(79,140,255,.20);">
        Lưu
    </button>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ==== Preview ảnh bìa ====
    const coverInput = document.getElementById('cover-input');
    const coverPreview = document.getElementById('cover-preview');
    
    if (coverInput) {
        coverInput.addEventListener('change', function(e) {
            console.log('File selected:', e.target.files[0]); // Debug log
            
            coverPreview.innerHTML = ''; // xóa ảnh cũ
            
            if (e.target.files && e.target.files[0]) {
                const file = e.target.files[0];
                
                // Kiểm tra định dạng file
                if (!file.type.match('image.*')) {
                    alert('Vui lòng chọn file ảnh!');
                    return;
                }
                
                const reader = new FileReader();
                
                reader.onload = function(ev) {
                    console.log('File read successfully'); // Debug log
                    const img = document.createElement('img');
                    img.src = ev.target.result;
                    img.alt = 'Preview';
                    img.style.maxWidth = '200px';
                    img.style.borderRadius = '8px';
                    img.style.marginBottom = '8px';
                    img.style.display = 'block';
                    coverPreview.appendChild(img);
                };
                
                reader.onerror = function() {
                    console.error('Error reading file');
                    alert('Có lỗi khi đọc file!');
                };
                
                reader.readAsDataURL(file);
            }
        });
    }
    
    // ==== Bản đồ ====
    // Code bản đồ giữ nguyên...
    const latInputA = document.getElementById('art-latitude');
    const lngInputA = document.getElementById('art-longitude');
    
    // Chỉ khởi tạo bản đồ nếu tồn tại element
    if (document.getElementById('pickerMapArticle')) {
        const initLatA = parseFloat(latInputA?.value) || 16.0471;
        const initLngA = parseFloat(lngInputA?.value) || 108.2062;
        
        // Sử dụng dynamic import để tránh lỗi
        import('https://unpkg.com/leaflet@1.7.1/dist/leaflet-src.js')
            .then(L => {
                const mapA = L.map('pickerMapArticle').setView([initLatA, initLngA], (latInputA?.value && lngInputA?.value) ? 12 : 6);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { 
                    maxZoom: 19,
                    attribution: '© OpenStreetMap'
                }).addTo(mapA);

                let markerA;
                function setMarkerA(lat, lng) {
                    if (markerA) {
                        markerA.setLatLng([lat, lng]);
                    } else {
                        markerA = L.marker([lat, lng], { draggable: true }).addTo(mapA);
                        markerA.on('dragend', (e) => {
                            const p = e.target.getLatLng();
                            if (latInputA) latInputA.value = p.lat.toFixed(6);
                            if (lngInputA) lngInputA.value = p.lng.toFixed(6);
                        });
                    }
                    if (latInputA) latInputA.value = (+lat).toFixed(6);
                    if (lngInputA) lngInputA.value = (+lng).toFixed(6);
                }
                
                if (latInputA?.value && lngInputA?.value) {
                    setMarkerA(initLatA, initLngA);
                }
                
                mapA.on('click', (e) => setMarkerA(e.latlng.lat, e.latlng.lng));
            })
            .catch(err => {
                console.error('Lỗi load Leaflet:', err);
            });
    }
});
</script>
@endpush