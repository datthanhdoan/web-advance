@extends('layouts.app')

@section('content')
<style>
.my-posts-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 20px;
}

.my-posts-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 40px;
    padding-bottom: 20px;
    border-bottom: 2px solid #e6e6e6;
}

.my-posts-title {
    font-size: 2rem;
    font-weight: 700;
    color: #1a1a1a;
    display: flex;
    align-items: center;
    gap: 12px;
}

.create-post-btn {
    background: #1a8917;
    color: white;
    padding: 12px 24px;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s ease;
}

.create-post-btn:hover {
    background: #156d12;
    color: white;
    transform: translateY(-1px);
}

.posts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 30px;
    margin-bottom: 40px;
}

.post-card {
    background: white;
    border: 1px solid #e6e6e6;
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.2s ease;
    position: relative;
}

.post-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.post-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
    background: linear-gradient(135deg, #f0f0f0 0%, #e6e6e6 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #999;
    font-size: 3rem;
}

.post-content {
    padding: 20px;
}

.post-status {
    position: absolute;
    top: 12px;
    right: 12px;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}

.status-published {
    background: #e6f7e6;
    color: #1a8917;
}

.status-draft {
    background: #fff3cd;
    color: #856404;
}

.post-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 8px;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.post-excerpt {
    color: #6b6b6b;
    font-size: 0.875rem;
    line-height: 1.5;
    margin-bottom: 16px;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.post-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
    font-size: 0.75rem;
    color: #999;
}

.post-stats {
    display: flex;
    gap: 16px;
}

.post-stat {
    display: flex;
    align-items: center;
    gap: 4px;
}

.post-actions {
    display: flex;
    gap: 8px;
}

.action-btn {
    padding: 8px 16px;
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    gap: 4px;
}

.btn-view {
    background: #f0f0f0;
    color: #6b6b6b;
}

.btn-view:hover {
    background: #e6e6e6;
    color: #1a1a1a;
}

.btn-edit {
    background: #e6f3ff;
    color: #0066cc;
}

.btn-edit:hover {
    background: #cce6ff;
    color: #0052a3;
}

.btn-delete {
    background: #fef2f2;
    color: #dc2626;
}

.btn-delete:hover {
    background: #fee2e2;
    color: #b91c1c;
}

.empty-state {
    text-align: center;
    padding: 80px 20px;
    color: #6b6b6b;
}

.empty-state-icon {
    font-size: 4rem;
    margin-bottom: 20px;
    opacity: 0.5;
}

.empty-state-title {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 12px;
    color: #1a1a1a;
}

.empty-state-text {
    font-size: 1rem;
    margin-bottom: 30px;
    max-width: 400px;
    margin-left: auto;
    margin-right: auto;
}

.pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 40px;
}

@media (max-width: 768px) {
    .my-posts-container {
        padding: 20px 15px;
    }
    
    .my-posts-header {
        flex-direction: column;
        gap: 20px;
        align-items: stretch;
    }
    
    .posts-grid {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .post-actions {
        flex-wrap: wrap;
    }
}
</style>

<div class="my-posts-container">
    <!-- Header -->
    <div class="my-posts-header">
        <h1 class="my-posts-title">
            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            Bài viết của tôi
            <span style="font-size: 1rem; font-weight: 400; color: #6b6b6b;">({{ $posts->total() }} bài)</span>
        </h1>
        
        <a href="{{ route('posts.create') }}" class="create-post-btn">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Viết bài mới
        </a>
    </div>

    @if($posts->count() > 0)
        <!-- Posts Grid -->
        <div class="posts-grid">
            @foreach($posts as $post)
                <div class="post-card">
                    <!-- Status Badge -->
                    <div class="post-status {{ $post->status === 'published' ? 'status-published' : 'status-draft' }}">
                        {{ $post->status === 'published' ? 'Đã xuất bản' : 'Bản nháp' }}
                    </div>

                    <!-- Featured Image -->
                    @if($post->featured_image)
                        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="post-image">
                    @else
                        <div class="post-image">
                            📝
                        </div>
                    @endif

                    <!-- Content -->
                    <div class="post-content">
                        <h3 class="post-title">{{ $post->title }}</h3>
                        
                        @if($post->excerpt)
                            <p class="post-excerpt">{{ $post->excerpt }}</p>
                        @endif

                        <!-- Meta -->
                        <div class="post-meta">
                            <div>
                                @if($post->category)
                                    <span>{{ $post->category->name }}</span>
                                @endif
                            </div>
                            <div>{{ $post->created_at->format('d/m/Y') }}</div>
                        </div>

                        <!-- Stats -->
                        <div class="post-stats">
                            <div class="post-stat">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                {{ $post->views }}
                            </div>
                            <div class="post-stat">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                {{ $post->comments()->count() }}
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="post-actions">
                            <a href="{{ route('posts.show', $post) }}" class="action-btn btn-view">
                                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Xem
                            </a>
                            
                            <a href="{{ route('posts.edit', $post) }}" class="action-btn btn-edit">
                                <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Sửa
                            </a>
                            
                            <form method="POST" action="{{ route('posts.destroy', $post) }}" style="display: inline;" 
                                  onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn btn-delete">
                                    <svg width="12" height="12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Xóa
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($posts->hasPages())
            <div class="pagination-wrapper">
                {{ $posts->links() }}
            </div>
        @endif
    @else
        <!-- Empty State -->
        <div class="empty-state">
            <div class="empty-state-icon">📝</div>
            <h2 class="empty-state-title">Chưa có bài viết nào</h2>
            <p class="empty-state-text">
                Bạn chưa viết bài viết nào. Hãy bắt đầu chia sẻ những suy nghĩ và kiến thức của bạn!
            </p>
            <a href="{{ route('posts.create') }}" class="create-post-btn">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Viết bài đầu tiên
            </a>
        </div>
    @endif
</div>
@endsection 