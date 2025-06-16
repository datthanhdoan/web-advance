{{-- File Upload Component --}}
<div class="form-group">
    <label for="{{ $name ?? 'file' }}" class="form-label">{{ $label ?? 'File Upload' }}</label>
    
    <div class="file-input-wrapper" onclick="document.getElementById('{{ $name ?? 'file' }}').click();">
        <input 
            type="file" 
            id="{{ $name ?? 'file' }}" 
            name="{{ $name ?? 'file' }}" 
            class="file-input" 
            accept="{{ $accept ?? 'image/*' }}"
        >
        
        <div class="file-input-text">
            <svg width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24" 
                 style="margin: 0 auto 10px; display: block; color: #757575;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                </path>
            </svg>
            <div>{{ $uploadText ?? 'Nhấp để chọn file' }}</div>
            <small style="color: #757575;">{{ $description ?? 'PNG, JPG, GIF tối đa 2MB' }}</small>
        </div>
    </div>
    
    @if(($showPreview ?? true))
        <img id="{{ $name ?? 'file' }}-preview" class="image-preview" style="display: none;" alt="Preview">
    @endif
    
    @error($name ?? 'file')
        <div class="error-message">{{ $message }}</div>
    @enderror
</div> 