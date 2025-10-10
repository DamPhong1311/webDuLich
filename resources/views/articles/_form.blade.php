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
  @if(!empty($article->cover_image))
    <div style="margin-bottom:6px;">
      <img src="{{ $article->cover_image }}" style="height:120px;object-fit:cover;">
    </div>
  @endif
  <input type="url" name="cover_image" 
         value="{{ old('cover_image', $article->cover_image ?? '') }}" 
         placeholder="Nhập link ảnh..." 
         style="width:100%;padding:8px">
</div>



<div>
  <button type="submit"
    style="padding:10px 18px;background:#0b74de;color:#fff;border:none;border-radius:6px;">Lưu</button>
</div>
