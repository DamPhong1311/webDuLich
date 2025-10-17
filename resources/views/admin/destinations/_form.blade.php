{{-- resources/views/admin/destinations/_form.blade.php --}}
@csrf

<div style="margin-bottom:10px;">
    <label>Tiêu đề</label><br>
    <input type="text" name="title" value="{{ old('title', $destination->title ?? '') }}" required
        style="width:100%;padding:8px">
</div>

<div style="margin-bottom:10px;">
    <label>Excerpt</label><br>
    <textarea name="excerpt" style="width:100%;padding:8px">{{ old('excerpt', $destination->excerpt ?? '') }}</textarea>
</div>

<div style="margin-bottom:10px;">
    <label>Nội dung</label><br>
    <textarea name="content" rows="8"
        style="width:100%;padding:8px">{{ old('content', $destination->content ?? '') }}</textarea>
</div>

<div style="margin-bottom:10px;">
    <label>Ảnh bìa (link)</label><br>
    @php
    $cover = old('cover_image', $destination->cover_image ?? '');
    @endphp
    @if(!empty($cover))
    <div style="margin-bottom:6px;">
        <img src="{{ $cover }}" style="height:120px;object-fit:cover;border-radius:6px;border:1px solid #e5e7eb;">
    </div>
    @endif
    <input type="url" name="cover_image" value="{{ $cover }}" placeholder="Dán link ảnh bìa..."
        style="width:100%;padding:8px">
</div>

<div style="margin-bottom:10px;">
    <label>Thư viện ảnh (gallery - link, cách nhau bởi dấu phẩy)</label><br>
    @php
    $galleryRaw = old('gallery', $destination->gallery ?? '');
    $galleryArray = is_array($galleryRaw) ? $galleryRaw : (json_decode($galleryRaw, true) ?: (is_string($galleryRaw) ?
    array_map('trim', array_filter(explode(',', $galleryRaw))) : []));
    @endphp

    @if(!empty($galleryArray))
    <div style="display:flex;gap:8px;flex-wrap:wrap;margin:8px 0;">
        @foreach($galleryArray as $img)
        <img src="{{ $img }}"
            style="height:80px;width:auto;border-radius:4px;border:1px solid #e5e7eb;object-fit:cover;">
        @endforeach
    </div>
    @endif

    <textarea name="gallery" rows="3" placeholder="Dán link ảnh, cách nhau bằng dấu phẩy"
        style="width:100%;padding:8px">{{ is_array($galleryArray) ? implode(',', $galleryArray) : $galleryRaw }}</textarea>
</div>

<div style="margin-bottom:10px;">
    <label>Location</label><br>
    <input type="text" name="location" value="{{ old('location', $destination->location ?? '') }}"
        style="width:100%;padding:8px">
</div>

<div style="margin-bottom:10px;">
    <label>Province</label><br>
    <input type="text" name="province" value="{{ old('province', $destination->province ?? '') }}"
        style="width:100%;padding:8px">
</div>

{{-- ====== TỌA ĐỘ + BẢN ĐỒ CHỌN ĐIỂM ====== --}}
<div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:10px;">
    <div>
        <label>Vĩ độ (Latitude)</label><br>
        <input id="dest-latitude" name="latitude" type="text" inputmode="decimal"
            value="{{ old('latitude', $destination->latitude ?? '') }}" placeholder="VD: 15.880100"
            style="width:100%;padding:8px">
    </div>
    <div>
        <label>Kinh độ (Longitude)</label><br>
        <input id="dest-longitude" name="longitude" type="text" inputmode="decimal"
            value="{{ old('longitude', $destination->longitude ?? '') }}" placeholder="VD: 108.338000"
            style="width:100%;padding:8px">
    </div>
</div>

<div style="margin-bottom:10px;">
    <label>Chọn trên bản đồ (tuỳ chọn)</label><br>
    <div id="pickerMapDest" style="height: 320px; border-radius:12px; border:1px solid #e5e7eb; overflow:hidden;"></div>
    <small style="color:#64748b;">Click để đặt marker, kéo để điều chỉnh; toạ độ sẽ tự điền vào hai ô ở trên.</small>
</div>

<div style="margin-bottom:10px;">
    <label>
        <input type="checkbox" name="featured" {{ old('featured', $destination->featured ?? false) ? 'checked' : '' }}>
        Featured
    </label>
</div>

<div>
    <button type="submit"
        style="padding:10px 18px;background:#4f8cff;color:#fff;border:none;border-radius:8px;font-weight:700;box-shadow:0 8px 20px rgba(79,140,255,.20);">
        Lưu
    </button>
</div>

@push('scripts')
<script type="module">
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

const latInput = document.getElementById('dest-latitude');
const lngInput = document.getElementById('dest-longitude');

const initLat = parseFloat(latInput.value) || 16.0471; // VN center-ish
const initLng = parseFloat(lngInput.value) || 108.2062;

const map = L.map('pickerMapDest').setView([initLat, initLng], (latInput.value && lngInput.value) ? 12 : 6);
L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
    maxZoom: 19
}).addTo(map);

let marker;

function setMarker(lat, lng) {
    if (marker) {
        marker.setLatLng([lat, lng]);
    } else {
        marker = L.marker([lat, lng], {
            draggable: true
        }).addTo(map);
        marker.on('dragend', (e) => {
            const p = e.target.getLatLng();
            latInput.value = p.lat.toFixed(6);
            lngInput.value = p.lng.toFixed(6);
        });
    }
    latInput.value = (+lat).toFixed(6);
    lngInput.value = (+lng).toFixed(6);
}

if (latInput.value && lngInput.value) setMarker(initLat, initLng);

map.on('click', (e) => setMarker(e.latlng.lat, e.latlng.lng));
</script>
@endpush