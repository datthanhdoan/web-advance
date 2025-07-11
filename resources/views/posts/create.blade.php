@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/css/posts.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/js/post-form.js') }}"></script>
@endpush

@section('content')
<div class="create-post-container">
    <h1 class="create-post-title">Tạo bài viết mới</h1>
    
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        {{-- Title Input --}}
        @include('layouts.partials.form-components', [
            'type' => 'text',
            'name' => 'title',
            'label' => 'Tiêu đề bài viết',
            'placeholder' => 'Nhập tiêu đề hấp dẫn cho bài viết của bạn...',
            'required' => true
        ])

        {{-- Excerpt Textarea --}}
        @include('layouts.partials.form-components', [
            'type' => 'textarea',
            'name' => 'excerpt',
            'label' => 'Tóm tắt',
            'placeholder' => 'Viết tóm tắt ngắn gọn về bài viết (không bắt buộc, sẽ tự động tạo nếu để trống)...',
            'rows' => 3
        ])

        {{-- Category Select --}}
        @include('layouts.partials.form-components', [
            'type' => 'select',
            'name' => 'category_id',
            'label' => 'Danh mục',
            'placeholder' => 'Chọn danh mục (không bắt buộc)',
            'options' => $categories->pluck('name', 'id')->toArray()
        ])

        {{-- Tags Selector --}}
        @include('layouts.partials.tags-selector', [
            'tags' => $tags,
            'label' => 'Thẻ'
        ])

        {{-- Featured Image Upload --}}
        @include('layouts.partials.file-upload', [
            'name' => 'featured_image',
            'label' => 'Ảnh bìa bài viết',
            'uploadText' => 'Nhấp để chọn ảnh bìa',
            'description' => 'PNG, JPG, GIF tối đa 2MB'
        ])

        {{-- Content Textarea --}}
        @include('layouts.partials.form-components', [
            'type' => 'textarea',
            'name' => 'content',
            'label' => 'Nội dung',
            'placeholder' => 'Viết nội dung bài viết của bạn...',
            'required' => true,
            'class' => 'form-textarea'
        ])

        {{-- Status Select --}}
        @include('layouts.partials.form-components', [
            'type' => 'select',
            'name' => 'status',
            'label' => 'Trạng thái',
            'required' => true,
            'options' => [
                'draft' => 'Bản nháp',
                'published' => 'Xuất bản ngay'
            ]
        ])

        {{-- Form Actions --}}
        <div class="form-actions">
            <a href="{{ route('home') }}" class="btn btn-secondary">Hủy</a>
            <button type="submit" class="btn btn-primary">Tạo bài viết</button>
        </div>
    </form>
</div>
@endsection 