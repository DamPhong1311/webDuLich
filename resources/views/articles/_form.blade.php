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

<div style="margin-bottom:10px;">
    <label>Ảnh bìa (link)</label><br>
    @php
    $aCover = old('cover_image', $article->cover_image ?? '');
    @endphp
    @if(!empty($aCover))
    <div style="margin-bottom:6px;">
        <img src="{{ $aCover }}" style="height:120px;object-fit:cover;border-radius:6px;border:1px solid #e5e7eb;">
    </div>
    @endif
    <input type="url" name="cover_image" value="{{ $aCover }}" placeholder="Nhập link ảnh..."
        style="width:100%;padding:8px">
</div>

{{-- (Tuỳ chọn) Ngày xuất bản --}}
{{--
<div style="margin-bottom:10px;">
  <label>Ngày xuất bản</label><br>
  <input type="datetime-local" name="published_at"
         value="{{ old('published_at', optional($article->published_at ?? null)->format('Y-m-d\TH:i')) }}"
style="width:100%;padding:8px">
</div>
--}}

{{-- ====== TỌA ĐỘ + BẢN ĐỒ CHỌN ĐIỂM ====== --}}
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
<script type="module">
import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

const latInputA = document.getElementById('art-latitude');
const lngInputA = document.getElementById('art-longitude');

const initLatA = parseFloat(latInputA.value) || 16.0471; // VN center-ish
const initLngA = parseFloat(lngInputA.value) || 108.2062;

const mapA = L.map('pickerMapArticle').setView([initLatA, initLngA], (latInputA.value && lngInputA.value) ? 12 : 6);
L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
    maxZoom: 19
}).addTo(mapA);

let markerA;

function setMarkerA(lat, lng) {
    if (markerA) {
        markerA.setLatLng([lat, lng]);
    } else {
        markerA = L.marker([lat, lng], {
            draggable: true
        }).addTo(mapA);
        markerA.on('dragend', (e) => {
            const p = e.target.getLatLng();
            latInputA.value = p.lat.toFixed(6);
            lngInputA.value = p.lng.toFixed(6);
        });
    }
    latInputA.value = (+lat).toFixed(6);
    lngInputA.value = (+lng).toFixed(6);
}

if (latInputA.value && lngInputA.value) setMarkerA(initLatA, initLngA);
mapA.on('click', (e) => setMarkerA(e.latlng.lat, e.latlng.lng));
</script>
@endpush