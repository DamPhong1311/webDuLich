{{-- resources/views/admin/destinations/_form.blade.php --}}

@csrf

@push('styles')
@vite(['resources/css/admin/destination_form.css'])
@endpush
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
    <label>Ảnh bìa (link)</label>
    @php
        $cover = old('cover_image', $destination->cover_image ?? '');
    @endphp
    @if(!empty($cover))
        <div class="cover-preview">
            <img src="{{ $cover }}" alt="cover">
        </div>
    @endif
    <input type="url" name="cover_image" value="{{ $cover }}" placeholder="Dán link ảnh bìa..." class="form-input">
</div>

<div class="form-group">
    <label>Thư viện ảnh (gallery - link, cách nhau bởi dấu phẩy)</label>
    @php
        $galleryRaw = old('gallery', $destination->gallery ?? '');
        $galleryArray = is_array($galleryRaw) ? $galleryRaw : (json_decode($galleryRaw, true) ?: (is_string($galleryRaw)
            ? array_map('trim', array_filter(explode(',', $galleryRaw))) : []));
    @endphp
    @if(!empty($galleryArray))
        <div class="gallery-preview">
            @foreach($galleryArray as $img)
                <img src="{{ $img }}" alt="gallery">
            @endforeach
        </div>
    @endif
    <textarea name="gallery" rows="3" placeholder="Dán link ảnh, cách nhau bằng dấu phẩy" class="form-textarea">
        {{ is_array($galleryArray) ? implode(',', $galleryArray) : $galleryRaw }}
    </textarea>
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
            value="{{ old('longitude', $destination->longitude ?? '') }}" placeholder="VD: 108.338000" class="form-input">
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
