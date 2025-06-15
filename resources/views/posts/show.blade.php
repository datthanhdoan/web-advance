@extends('layouts.app')

@section('content')
<style>
.post-container {
    max-width: 700px;
    margin: 0 auto;
    padding: 40px 20px;
}

.post-header {
    margin-bottom: 40px;
}

.post-title {
    font-size: 2.5rem;
    font-weight: 700;
    line-height: 1.2;
    color: #1a1a1a;
    margin-bottom: 20px;
    letter-spacing: -0.02em;
}

.post-meta {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 1px solid #e6e6e6;
    flex-wrap: wrap;
}

.post-date {
    color: #6b6b6b;
    font-size: 0.875rem;
}

.post-stats {
    display: flex;
    align-items: center;
    gap: 15px;
    color: #6b6b6b;
    font-size: 0.875rem;
}

.post-category {
    background: #f0f0f0;
    color: #1a1a1a;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
}

.post-category:hover {
    background: #1a8917;
    color: white;
}

.post-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 10px;
}

.post-tag {
    background: #e6f7e6;
    color: #1a8917;
    padding: 4px 12px;
    border-radius: 16px;
    font-size: 0.75rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
}

.post-tag:hover {
    background: #1a8917;
    color: white;
}

.post-featured-image {
    width: 100%;
    max-height: 400px;
    object-fit: cover;
    border-radius: 12px;
    margin-bottom: 30px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
}

.post-content {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #1a1a1a;
    margin-bottom: 40px;
}

.post-content h1,
.post-content h2,
.post-content h3,
.post-content h4,
.post-content h5,
.post-content h6 {
    margin: 30px 0 15px 0;
    font-weight: 600;
    color: #1a1a1a;
}

.post-content h1 { font-size: 2rem; }
.post-content h2 { font-size: 1.75rem; }
.post-content h3 { font-size: 1.5rem; }
.post-content h4 { font-size: 1.25rem; }

.post-content p {
    margin-bottom: 20px;
}

.post-content blockquote {
    border-left: 4px solid #1a8917;
    padding-left: 20px;
    margin: 30px 0;
    font-size: 1.2rem;
    font-style: italic;
    color: #4a4a4a;
}

.post-content code {
    background: #f7f7f7;
    padding: 2px 6px;
    border-radius: 4px;
    font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
    font-size: 0.9rem;
}

.post-content pre {
    background: #f7f7f7;
    padding: 20px;
    border-radius: 8px;
    overflow-x: auto;
    margin: 20px 0;
}

.post-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 30px 0;
    border-top: 1px solid #e6e6e6;
    border-bottom: 1px solid #e6e6e6;
    margin-bottom: 40px;
}

.post-actions-left {
    display: flex;
    gap: 15px;
}

.action-btn {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 8px 16px;
    border: 1px solid #e6e6e6;
    border-radius: 20px;
    background: white;
    color: #6b6b6b;
    text-decoration: none;
    font-size: 0.875rem;
    transition: all 0.2s ease;
    cursor: pointer;
}

.action-btn:hover {
    background: #f7f7f7;
    color: #1a1a1a;
}

.action-btn.edit {
    color: #1a8917;
    border-color: #1a8917;
}

.action-btn.edit:hover {
    background: #1a8917;
    color: white;
}

.action-btn.delete {
    color: #dc2626;
    border-color: #dc2626;
}

.action-btn.delete:hover {
    background: #dc2626;
    color: white;
}

.related-posts {
    margin-top: 60px;
}

.related-posts-title {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 30px;
    color: #1a1a1a;
}

.related-posts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
}

.related-post-card {
    border: 1px solid #e6e6e6;
    border-radius: 12px;
    padding: 20px;
    background: white;
    transition: all 0.2s ease;
}

.related-post-card:hover {
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
}

.related-post-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 10px;
    line-height: 1.3;
}

.related-post-title a {
    color: #1a1a1a;
    text-decoration: none;
}

.related-post-title a:hover {
    color: #1a8917;
}

.related-post-excerpt {
    color: #6b6b6b;
    font-size: 0.875rem;
    line-height: 1.5;
    margin-bottom: 10px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.related-post-meta {
    font-size: 0.75rem;
    color: #6b6b6b;
}

@media (max-width: 768px) {
    .post-container {
        padding: 20px 15px;
    }
    
    .post-title {
        font-size: 2rem;
    }
    
    .post-meta {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
    
    .post-actions {
        flex-direction: column;
        gap: 15px;
        align-items: stretch;
    }
    
    .post-actions-left {
        justify-content: center;
    }
    
    .related-posts-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<article class="post-container">
    <!-- Post Header -->
    <header class="post-header">
        <h1 class="post-title">{{ $post->title }}</h1>
        
        <div class="post-meta">
            <div>
                <div class="post-date">{{ $post->published_date }}</div>
                <div class="post-stats">
                    <span>{{ $post->read_time_text }}</span>
                    <span>•</span>
                    <span>{{ $post->views }} lượt xem</span>
                </div>
            </div>
            
            <div>
                @if($post->category)
                <a href="{{ route('posts.by-category', $post->category) }}" class="post-category">
                    {{ $post->category->name }}
                </a>
                @endif
                
                @if($post->tags->count() > 0)
                <div class="post-tags">
                    @foreach($post->tags as $tag)
                    <a href="{{ route('posts.by-tag', $tag) }}" class="post-tag">
                        #{{ $tag->name }}
                    </a>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
        
        @if($post->featured_image)
        <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="post-featured-image">
        @endif
    </header>

    <!-- Post Content -->
    <div class="post-content">
        {!! nl2br(e($post->content)) !!}
    </div>

    <!-- Post Actions -->
    <div class="post-actions">
        <div class="post-actions-left">
            <button class="action-btn" onclick="window.print()">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                </svg>
                In
            </button>
            
            <button class="action-btn" onclick="sharePost()">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                </svg>
                Chia sẻ
            </button>
        </div>
        
        <div class="post-actions-right">
            <a href="{{ route('posts.edit', $post) }}" class="action-btn edit">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                </svg>
                Chỉnh sửa
            </a>
            
            <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display: inline;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="action-btn delete">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                    Xóa
                </button>
            </form>
        </div>
    </div>
</article>

<!-- Related Posts -->
@if($relatedPosts->count() > 0)
<section class="post-container">
    <div class="related-posts">
        <h2 class="related-posts-title">Bài viết liên quan</h2>
        <div class="related-posts-grid">
            @foreach($relatedPosts as $relatedPost)
            <article class="related-post-card">
                <h3 class="related-post-title">
                    <a href="{{ route('posts.show', $relatedPost) }}">{{ $relatedPost->title }}</a>
                </h3>
                <p class="related-post-excerpt">{{ $relatedPost->excerpt }}</p>
                <div class="related-post-meta">
                    {{ $relatedPost->published_date }} • {{ $relatedPost->read_time_text }}
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif

<script>
function sharePost() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $post->title }}',
            text: '{{ $post->excerpt }}',
            url: window.location.href
        });
    } else {
        // Fallback - copy to clipboard
        navigator.clipboard.writeText(window.location.href).then(function() {
            alert('Đã sao chép link bài viết vào clipboard!');
        });
    }
}

// Add smooth scrolling for anchor links
document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('a[href^="#"]');
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
</script>
@endsection 