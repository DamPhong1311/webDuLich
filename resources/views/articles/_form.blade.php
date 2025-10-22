
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

<div class="form-group" style="margin-bottom:16px;">
    <label>Ảnh bìa</label><br>
    @php
    $cover = old('cover_image', $article->cover_image ?? '');
    @endphp
    <div id="cover-preview" style="margin-bottom:8px;">
        @if(!empty($cover))
        <img src="{{ asset('storage/' . $cover) }}" alt="cover"
            style="max-width:200px;border-radius:8px;margin-bottom:8px;">
        @endif

    </div>

    <input type="file" name="cover_image" accept="image/*" id="cover-input" class="form-input" style="width:100%;">
    <small style="color:#64748b;">Chọn ảnh bìa từ máy tính của bạn (ảnh sẽ hiển thị bên trên).</small>
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
    const coverInput = document.getElementById('cover-input');
    const coverPreview = document.getElementById('cover-preview');

    if (coverInput) {
        coverInput.addEventListener('change', function(e) {
            console.log('File selected:', e.target.files[0]); 

            coverPreview.innerHTML = ''; 

            if (e.target.files && e.target.files[0]) {
                const file = e.target.files[0];

                if (!file.type.match('image.*')) {
                    alert('Vui lòng chọn file ảnh!');
                    return;
                }

                const reader = new FileReader();

                reader.onload = function(ev) {
                    console.log('File read successfully'); 
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
   
    
});
</script>
@endpush