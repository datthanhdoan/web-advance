/**
 * Post Form Management Module
 * Handles all interactions for create/edit post forms
 */

class PostFormManager {
    constructor() {
        this.selectedTags = new Set();
        this.init();
    }

    init() {
        this.initTagManager();
        this.initFileUpload();
        this.initTextareaAutoResize();
    }

    initTagManager() {
        const tagsContainer = document.getElementById('tags-container');
        const availableTags = document.querySelectorAll('.available-tag');
        
        if (!tagsContainer || !availableTags.length) return;

        availableTags.forEach(tag => {
            tag.addEventListener('click', (e) => {
                e.preventDefault();
                this.addTag(tag);
            });
        });

        window.removeTag = (tagId, button) => this.removeTag(tagId, button);
    }

    addTag(tagElement) {
        const tagId = tagElement.getAttribute('data-tag-id');
        const tagName = tagElement.getAttribute('data-tag-name');
        
        if (!this.selectedTags.has(tagId)) {
            this.selectedTags.add(tagId);
            this.addTagToContainer(tagId, tagName);
            tagElement.style.display = 'none';
        }
    }

    addTagToContainer(tagId, tagName) {
        const tagsContainer = document.getElementById('tags-container');
        const tagElement = document.createElement('div');
        
        tagElement.className = 'tag-item';
        tagElement.innerHTML = `
            #${tagName}
            <button type="button" class="tag-remove" onclick="removeTag('${tagId}', this)">×</button>
            <input type="hidden" name="tags[]" value="${tagId}">
        `;
        
        tagsContainer.appendChild(tagElement);
    }

    removeTag(tagId, button) {
        this.selectedTags.delete(tagId);
        button.parentElement.remove();
        
        const availableTag = document.querySelector(`[data-tag-id="${tagId}"]`);
        if (availableTag) {
            availableTag.style.display = 'inline-block';
        }
    }

    initFileUpload() {
        const fileInput = document.getElementById('featured_image');
        const imagePreview = document.getElementById('image-preview');
        const fileInputWrapper = document.querySelector('.file-input-wrapper');
        
        if (!fileInput || !fileInputWrapper) return;

        fileInput.addEventListener('change', (e) => {
            this.handleFileUpload(e, imagePreview, fileInputWrapper);
        });
    }

    handleFileUpload(event, imagePreview, fileInputWrapper) {
        const file = event.target.files[0];
        
        if (file) {
            if (!this.isValidImageType(file)) {
                alert('Vui lòng chọn file ảnh hợp lệ (PNG, JPG, GIF)');
                event.target.value = '';
                return;
            }

            if (file.size > 2 * 1024 * 1024) {
                alert('File ảnh quá lớn. Vui lòng chọn file nhỏ hơn 2MB');
                event.target.value = '';
                return;
            }

            this.showImagePreview(file, imagePreview, fileInputWrapper);
        }
    }

    isValidImageType(file) {
        const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        return validTypes.includes(file.type);
    }

    showImagePreview(file, imagePreview, fileInputWrapper) {
        const reader = new FileReader();
        
        reader.onload = (e) => {
            if (imagePreview) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            }
        };
        
        reader.readAsDataURL(file);
        
        const fileInputText = fileInputWrapper.querySelector('.file-input-text');
        if (fileInputText) {
            fileInputText.innerHTML = `
                <div style="color: #242424; font-weight: 600;">✓ Đã chọn: ${file.name}</div>
                <small style="color: #757575;">Nhấp để thay đổi</small>
            `;
        }
    }

    initTextareaAutoResize() {
        const textarea = document.getElementById('content');
        
        if (!textarea) return;

        const autoResize = () => {
            textarea.style.height = 'auto';
            textarea.style.height = textarea.scrollHeight + 'px';
        };

        textarea.addEventListener('input', autoResize);
        
        if (textarea.value.trim()) {
            autoResize();
        }
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    new PostFormManager();
});
 