@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/posts.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/js/post-form.js') }}"></script>
@endpush

@section('content')
<div class="create-post-container">
    <h1 class="create-post-title">Chỉnh sửa bài viết</h1>
    
    <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        {{-- Title Input --}}
        @include('layouts.partials.form-components', [
            'type' => 'text',
            'name' => 'title',
            'label' => 'Tiêu đề bài viết',
            'placeholder' => 'Nhập tiêu đề hấp dẫn cho bài viết của bạn...',
            'value' => $post->title,
            'required' => true
        ])

        {{-- Excerpt Textarea --}}
        @include('layouts.partials.form-components', [
            'type' => 'textarea',
            'name' => 'excerpt',
            'label' => 'Tóm tắt',
            'placeholder' => 'Viết tóm tắt ngắn gọn về bài viết (không bắt buộc, sẽ tự động tạo nếu để trống)...',
            'value' => $post->excerpt,
            'rows' => 3
        ])

        {{-- Category Select --}}
        @include('layouts.partials.form-components', [
            'type' => 'select',
            'name' => 'category_id',
            'label' => 'Danh mục',
            'placeholder' => 'Chọn danh mục (không bắt buộc)',
            'value' => $post->category_id,
            'options' => $categories->pluck('name', 'id')->toArray()
        ])

        {{-- Tags Selector --}}
        @include('layouts.partials.tags-selector', [
            'tags' => $tags,
            'selectedTags' => $post->tags->pluck('id')->toArray(),
            'label' => 'Thẻ'
        ])

        {{-- Current Featured Image --}}
        @if($post->featured_image)
            <div class="form-group">
                <label class="form-label">Ảnh bìa hiện tại</label>
                <div class="current-image">
                    <img src="{{ Storage::url($post->featured_image) }}" alt="Current featured image" style="max-width: 300px; height: auto; border-radius: 8px;">
                </div>
            </div>
        @endif

        {{-- Featured Image Upload --}}
        @include('layouts.partials.file-upload', [
            'name' => 'featured_image',
            'label' => 'Thay đổi ảnh bìa bài viết',
            'uploadText' => 'Nhấp để chọn ảnh bìa mới',
            'description' => 'PNG, JPG, GIF tối đa 2MB (để trống nếu không muốn thay đổi)'
        ])

        {{-- Content Textarea --}}
        @include('layouts.partials.form-components', [
            'type' => 'textarea',
            'name' => 'content',
            'label' => 'Nội dung',
            'placeholder' => 'Viết nội dung bài viết của bạn...',
            'value' => $post->content,
            'required' => true,
            'class' => 'form-textarea'
        ])

        {{-- Status Select --}}
        @include('layouts.partials.form-components', [
            'type' => 'select',
            'name' => 'status',
            'label' => 'Trạng thái',
            'value' => $post->status,
            'required' => true,
            'options' => [
                'draft' => 'Bản nháp',
                'published' => 'Xuất bản'
            ]
        ])

        {{-- Form Actions --}}
        <div class="form-actions">
            <a href="{{ route('posts.show', $post) }}" class="btn btn-secondary">Hủy</a>
            <button type="submit" class="btn btn-primary">Cập nhật bài viết</button>
        </div>
    </form>
</div>
@endsection 