@extends('layouts.app')

@section('content')
<style>
.create-post-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 40px 20px;
}

.create-post-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 40px;
    text-align: center;
    color: #1a1a1a;
}

.form-group {
    margin-bottom: 30px;
}

.form-label {
    display: block;
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 8px;
    color: #1a1a1a;
}

.form-input {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #e6e6e6;
    border-radius: 8px;
    font-size: 1rem;
    font-family: inherit;
    transition: all 0.2s ease;
    outline: none;
}

.form-input:focus {
    border-color: #1a8917;
    box-shadow: 0 0 0 3px rgba(26, 137, 23, 0.1);
}

.form-textarea {
    min-height: 400px;
    resize: vertical;
    font-family: inherit;
    line-height: 1.6;
}

.form-select {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid #e6e6e6;
    border-radius: 8px;
    font-size: 1rem;
    background: white;
    cursor: pointer;
    transition: all 0.2s ease;
    outline: none;
}

.form-select:focus {
    border-color: #1a8917;
    box-shadow: 0 0 0 3px rgba(26, 137, 23, 0.1);
}

.file-input-wrapper {
    position: relative;
    display: inline-block;
    overflow: hidden;
    background: #f7f7f7;
    color: #1a1a1a;
    border: 2px dashed #e6e6e6;
    border-radius: 8px;
    padding: 40px;
    text-align: center;
    cursor: pointer;
    transition: all 0.2s ease;
    width: 100%;
}

.file-input-wrapper:hover {
    background: #f0f0f0;
    border-color: #1a8917;
}

.file-input {
    position: absolute;
    left: -9999px;
}

.file-input-text {
    font-size: 1rem;
    color: #6b6b6b;
}

.tags-container {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    padding: 12px 16px;
    border: 2px solid #e6e6e6;
    border-radius: 8px;
    min-height: 48px;
    background: white;
    cursor: text;
}

.tags-container:focus-within {
    border-color: #1a8917;
    box-shadow: 0 0 0 3px rgba(26, 137, 23, 0.1);
}

.tag-item {
    background: #1a8917;
    color: white;
    padding: 4px 12px;
    border-radius: 16px;
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    gap: 8px;
}

.tag-remove {
    background: none;
    border: none;
    color: white;
    cursor: pointer;
    font-size: 0.875rem;
    padding: 0;
    width: 16px;
    height: 16px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.tag-remove:hover {
    background: rgba(255, 255, 255, 0.2);
}

.available-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 10px;
}

.available-tag {
    background: #f0f0f0;
    color: #1a1a1a;
    padding: 6px 12px;
    border-radius: 16px;
    font-size: 0.875rem;
    cursor: pointer;
    border: none;
    transition: all 0.2s ease;
}

.available-tag:hover {
    background: #1a8917;
    color: white;
}

.form-actions {
    display: flex;
    gap: 15px;
    justify-content: flex-end;
    margin-top: 40px;
    padding-top: 30px;
    border-top: 1px solid #e6e6e6;
}

.btn {
    padding: 12px 24px;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    border: none;
    font-family: inherit;
    transition: all 0.2s ease;
}

.btn-primary {
    background: #1a8917;
    color: white;
}

.btn-primary:hover {
    background: #156d12;
}

.btn-secondary {
    background: #f0f0f0;
    color: #1a1a1a;
}

.btn-secondary:hover {
    background: #e0e0e0;
}

.btn-outline {
    background: transparent;
    color: #1a8917;
    border: 2px solid #1a8917;
}

.btn-outline:hover {
    background: #1a8917;
    color: white;
}

.image-preview {
    margin-top: 15px;
    max-width: 100%;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

@media (max-width: 768px) {
    .create-post-container {
        padding: 20px 15px;
    }
    
    .create-post-title {
        font-size: 2rem;
    }
    
    .form-actions {
        flex-direction: column;
    }
}
</style>

<div class="create-post-container">
    <h1 class="create-post-title">Tạo bài viết mới</h1>
    
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <!-- Title -->
        <div class="form-group">
            <label for="title" class="form-label">Tiêu đề bài viết *</label>
            <input 
                type="text" 
                id="title" 
                name="title" 
                class="form-input" 
                placeholder="Nhập tiêu đề hấp dẫn cho bài viết của bạn..."
                value="{{ old('title') }}"
                required
            >
            @error('title')
                <div style="color: red; font-size: 0.875rem; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Excerpt -->
        <div class="form-group">
            <label for="excerpt" class="form-label">Tóm tắt</label>
            <textarea 
                id="excerpt" 
                name="excerpt" 
                class="form-input" 
                rows="3"
                placeholder="Viết tóm tắt ngắn gọn về bài viết (không bắt buộc, sẽ tự động tạo nếu để trống)..."
            >{{ old('excerpt') }}</textarea>
            @error('excerpt')
                <div style="color: red; font-size: 0.875rem; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Category -->
        <div class="form-group">
            <label for="category_id" class="form-label">Danh mục</label>
            <select id="category_id" name="category_id" class="form-select">
                <option value="">Chọn danh mục (không bắt buộc)</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>
            @error('category_id')
                <div style="color: red; font-size: 0.875rem; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tags -->
        <div class="form-group">
            <label class="form-label">Thẻ</label>
            <div id="tags-container" class="tags-container">
                <!-- Selected tags will appear here -->
            </div>
            <div class="available-tags">
                @foreach($tags as $tag)
                <button type="button" class="available-tag" data-tag-id="{{ $tag->id }}" data-tag-name="{{ $tag->name }}">
                    #{{ $tag->name }}
                </button>
                @endforeach
            </div>
            @error('tags')
                <div style="color: red; font-size: 0.875rem; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Featured Image -->
        <div class="form-group">
            <label for="featured_image" class="form-label">Ảnh đại diện</label>
            <div class="file-input-wrapper">
                <input type="file" id="featured_image" name="featured_image" class="file-input" accept="image/*">
                <div class="file-input-text">
                    <svg width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin: 0 auto 10px; display: block; color: #6b6b6b;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <div>Nhấp để chọn ảnh đại diện</div>
                    <small style="color: #6b6b6b;">PNG, JPG, GIF tối đa 2MB</small>
                </div>
            </div>
            <img id="image-preview" class="image-preview" style="display: none;">
            @error('featured_image')
                <div style="color: red; font-size: 0.875rem; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Content -->
        <div class="form-group">
            <label for="content" class="form-label">Nội dung *</label>
            <textarea 
                id="content" 
                name="content" 
                class="form-input form-textarea" 
                placeholder="Viết nội dung bài viết của bạn..."
                required
            >{{ old('content') }}</textarea>
            @error('content')
                <div style="color: red; font-size: 0.875rem; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Status -->
        <div class="form-group">
            <label for="status" class="form-label">Trạng thái *</label>
            <select id="status" name="status" class="form-select" required>
                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Bản nháp</option>
                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Xuất bản ngay</option>
            </select>
            @error('status')
                <div style="color: red; font-size: 0.875rem; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <!-- Actions -->
        <div class="form-actions">
            <a href="{{ route('home') }}" class="btn btn-secondary">Hủy</a>
            <button type="submit" class="btn btn-primary">Tạo bài viết</button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle tags
    const tagsContainer = document.getElementById('tags-container');
    const availableTags = document.querySelectorAll('.available-tag');
    const selectedTags = new Set();

    availableTags.forEach(tag => {
        tag.addEventListener('click', function() {
            const tagId = this.getAttribute('data-tag-id');
            const tagName = this.getAttribute('data-tag-name');
            
            if (!selectedTags.has(tagId)) {
                selectedTags.add(tagId);
                addTagToContainer(tagId, tagName);
                this.style.display = 'none';
            }
        });
    });

    function addTagToContainer(tagId, tagName) {
        const tagElement = document.createElement('div');
        tagElement.className = 'tag-item';
        tagElement.innerHTML = `
            #${tagName}
            <button type="button" class="tag-remove" onclick="removeTag('${tagId}', this)">×</button>
            <input type="hidden" name="tags[]" value="${tagId}">
        `;
        tagsContainer.appendChild(tagElement);
    }

    window.removeTag = function(tagId, button) {
        selectedTags.delete(tagId);
        button.parentElement.remove();
        
        // Show the tag in available tags again
        const availableTag = document.querySelector(`[data-tag-id="${tagId}"]`);
        if (availableTag) {
            availableTag.style.display = 'inline-block';
        }
    };

    // Handle file upload preview
    const fileInput = document.getElementById('featured_image');
    const imagePreview = document.getElementById('image-preview');
    const fileInputWrapper = document.querySelector('.file-input-wrapper');

    fileInput.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            };
            reader.readAsDataURL(file);
            
            fileInputWrapper.querySelector('.file-input-text').innerHTML = `
                <div>Đã chọn: ${file.name}</div>
                <small style="color: #6b6b6b;">Nhấp để thay đổi</small>
            `;
        }
    });

    // Auto resize textarea
    const textarea = document.getElementById('content');
    textarea.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });
});
</script>
@endsection 