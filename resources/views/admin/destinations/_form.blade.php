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
  @if(!empty($destination->cover_image))
    <div style="margin-bottom:6px;">
      <img src="{{ $destination->cover_image }}" style="height:120px;object-fit:cover;">
    </div>
  @endif
  <input type="url" name="cover_image" 
         value="{{ old('cover_image', $destination->cover_image ?? '') }}" 
         placeholder="Dán link ảnh bìa..."
         style="width:100%;padding:8px">
</div>

<div style="margin-bottom:10px;">
  <label>Thư viện ảnh (gallery - link, cách nhau bởi dấu phẩy)</label><br>
  @if(!empty($destination->gallery))
    @php
      // CHUYỂN gallery thành array nếu nó là string
      $galleryArray = is_array($destination->gallery) ? $destination->gallery : json_decode($destination->gallery, true);
    @endphp
    @if(!empty($galleryArray) && is_array($galleryArray))
      <div style="display:flex;gap:8px;flex-wrap:wrap;margin:8px 0;">
        @foreach($galleryArray as $img)
          <img src="{{ $img }}" style="height:80px;width:auto;border-radius:4px;">
        @endforeach
      </div>
    @endif
  @endif

  <textarea name="gallery" rows="3" placeholder="Dán link ảnh, cách nhau bằng dấu phẩy" 
            style="width:100%;padding:8px">
    {{ old('gallery', !empty($destination->gallery) ? (is_array($destination->gallery) ? implode(',', $destination->gallery) : $destination->gallery) : '') }}
  </textarea>
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

<div style="margin-bottom:10px;">
  <label>
    <input type="checkbox" name="featured" {{ old('featured', $destination->featured ?? false) ? 'checked' : '' }}>
    Featured
  </label>
</div>

<div>
  <button type="submit"
    style="padding:10px 18px;background:#0b74de;color:#fff;border:none;border-radius:6px;">Lưu</button>
</div>
