@extends('layouts.app')

@section('content')
<style>
.hero-section {
    background: linear-gradient(135deg, #1a8917 0%, #156d12 100%);
    color: white;
    padding: 80px 0;
    margin-bottom: 60px;
}

.hero-content {
    text-align: center;
    max-width: 800px;
    margin: 0 auto;
}

.hero-title {
    font-size: 4rem;
    font-weight: 700;
    margin-bottom: 20px;
    letter-spacing: -0.02em;
}

.hero-subtitle {
    font-size: 1.2rem;
    opacity: 0.9;
    margin-bottom: 40px;
    line-height: 1.5;
}

.post-grid {
    display: grid;
    gap: 40px;
    margin-bottom: 60px;
}

.featured-section {
    margin-bottom: 60px;
}

.section-title {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 30px;
    color: #1a1a1a;
}

.featured-post {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 40px;
    padding: 40px 0;
    border-bottom: 1px solid #e6e6e6;
}

.featured-post:last-child {
    border-bottom: none;
}

.featured-content h2 {
    font-size: 1.75rem;
    font-weight: 700;
    margin-bottom: 12px;
    line-height: 1.2;
}

.featured-content h2 a {
    color: #1a1a1a;
    text-decoration: none;
}

.featured-content h2 a:hover {
    color: #1a8917;
}

.featured-excerpt {
    color: #6b6b6b;
    font-size: 1rem;
    line-height: 1.6;
    margin-bottom: 15px;
}

.post-meta {
    display: flex;
    align-items: center;
    gap: 15px;
    font-size: 0.875rem;
    color: #6b6b6b;
}

.category-tag {
    background: #f0f0f0;
    color: #1a1a1a;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 0.75rem;
    font-weight: 500;
    text-decoration: none;
}

.category-tag:hover {
    background: #e0e0e0;
}

.featured-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 8px;
}

.posts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    margin-bottom: 60px;
}

.post-card {
    border: 1px solid #e6e6e6;
    border-radius: 12px;
    overflow: hidden;
    transition: all 0.2s ease;
    background: white;
}

.post-card:hover {
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
}

.post-card-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.post-card-content {
    padding: 20px;
}

.post-card-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 10px;
    line-height: 1.3;
}

.post-card-title a {
    color: #1a1a1a;
    text-decoration: none;
}

.post-card-title a:hover {
    color: #1a8917;
}

.post-card-excerpt {
    color: #6b6b6b;
    font-size: 0.875rem;
    line-height: 1.5;
    margin-bottom: 15px;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.sidebar {
    background: #f7f7f7;
    padding: 40px 0;
}

.sidebar-content {
    display: grid;
    grid-template-columns: 1fr 300px;
    gap: 60px;
}

.sidebar-section {
    background: white;
    padding: 30px;
    border-radius: 12px;
    border: 1px solid #e6e6e6;
}

.sidebar-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 20px;
    color: #1a1a1a;
}

.category-list {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.category-item {
    background: #f0f0f0;
    color: #1a1a1a;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
}

.category-item:hover {
    background: #1a8917;
    color: white;
}

.tag-list {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
}

.tag-item {
    background: #e6f7e6;
    color: #1a8917;
    padding: 4px 12px;
    border-radius: 16px;
    font-size: 0.75rem;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
}

.tag-item:hover {
    background: #1a8917;
    color: white;
}

@media (max-width: 768px) {
    .hero-title {
        font-size: 2.5rem;
    }
    
    .featured-post {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .sidebar-content {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .posts-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<!-- Hero Section -->
<section class="hero-section">
    <div class="medium-container">
        <div class="hero-content">
            <h1 class="hero-title">Chào mừng đến với Medium</h1>
            <p class="hero-subtitle">
                Nơi chia sẻ những câu chuyện thú vị, kiến thức bổ ích và truyền cảm hứng cho cộng đồng
            </p>
            <a href="{{ route('posts.create') }}" class="medium-btn medium-btn-primary" style="padding: 12px 24px; font-size: 16px;">
                Bắt đầu viết
            </a>
        </div>
    </div>
</section>

<div class="medium-container">
    <!-- Featured Posts -->
    @if($featuredPosts->count() > 0)
    <section class="featured-section">
        <h2 class="section-title">Bài viết nổi bật</h2>
        @foreach($featuredPosts as $post)
        <article class="featured-post">
            <div class="featured-content">
                <h2>
                    <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                </h2>
                <p class="featured-excerpt">{{ $post->excerpt }}</p>
                <div class="post-meta">
                    @if($post->category)
                    <a href="{{ route('posts.by-category', $post->category) }}" class="category-tag">
                        {{ $post->category->name }}
                    </a>
                    @endif
                    <span>{{ $post->published_date }}</span>
                    <span>{{ $post->read_time_text }}</span>
                    <span>{{ $post->views }} lượt xem</span>
                </div>
            </div>
            @if($post->featured_image)
            <div>
                <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="featured-image">
            </div>
            @endif
        </article>
        @endforeach
    </section>
    @endif

    <!-- Recent Posts Grid -->
    @if($recentPosts->count() > 0)
    <section>
        <h2 class="section-title">Bài viết mới nhất</h2>
        <div class="posts-grid">
            @foreach($recentPosts as $post)
            <article class="post-card">
                @if($post->featured_image)
                <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="post-card-image">
                @endif
                <div class="post-card-content">
                    <h3 class="post-card-title">
                        <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                    </h3>
                    <p class="post-card-excerpt">{{ $post->excerpt }}</p>
                    <div class="post-meta">
                        @if($post->category)
                        <a href="{{ route('posts.by-category', $post->category) }}" class="category-tag">
                            {{ $post->category->name }}
                        </a>
                        @endif
                        <span>{{ $post->published_date }}</span>
                        <span>{{ $post->read_time_text }}</span>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
    </section>
    @endif
</div>

<!-- Sidebar Section -->
@if($categories->count() > 0 || $popularTags->count() > 0)
<section class="sidebar">
    <div class="medium-container">
        <div class="sidebar-content">
            <div>
                @if($popularPosts->count() > 0)
                <div class="sidebar-section">
                    <h3 class="sidebar-title">Bài viết được xem nhiều</h3>
                    @foreach($popularPosts as $post)
                    <article style="margin-bottom: 20px; padding-bottom: 20px; border-bottom: 1px solid #e6e6e6;">
                        <h4 style="font-size: 1rem; font-weight: 600; margin-bottom: 8px;">
                            <a href="{{ route('posts.show', $post) }}" style="color: #1a1a1a; text-decoration: none;">
                                {{ Str::limit($post->title, 60) }}
                            </a>
                        </h4>
                        <div class="post-meta">
                            <span>{{ $post->views }} lượt xem</span>
                            <span>{{ $post->published_date }}</span>
                        </div>
                    </article>
                    @endforeach
                </div>
                @endif
            </div>
            
            <div>
                @if($categories->count() > 0)
                <div class="sidebar-section" style="margin-bottom: 30px;">
                    <h3 class="sidebar-title">Danh mục</h3>
                    <div class="category-list">
                        @foreach($categories as $category)
                        <a href="{{ route('posts.by-category', $category) }}" class="category-item">
                            {{ $category->name }} ({{ $category->published_posts_count }})
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
                
                @if($popularTags->count() > 0)
                <div class="sidebar-section">
                    <h3 class="sidebar-title">Thẻ phổ biến</h3>
                    <div class="tag-list">
                        @foreach($popularTags as $tag)
                        <a href="{{ route('posts.by-tag', $tag) }}" class="tag-item">
                            #{{ $tag->name }}
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endif

@if($featuredPosts->count() == 0 && $recentPosts->count() == 0)
<div class="medium-container" style="text-align: center; padding: 80px 0;">
    <h2 style="font-size: 2rem; font-weight: 600; margin-bottom: 20px; color: #6b6b6b;">
        Chưa có bài viết nào
    </h2>
    <p style="font-size: 1.1rem; color: #6b6b6b; margin-bottom: 30px;">
        Hãy là người đầu tiên chia sẻ câu chuyện của bạn
    </p>
    <a href="{{ route('posts.create') }}" class="medium-btn medium-btn-primary" style="padding: 12px 24px; font-size: 16px;">
        Viết bài đầu tiên
    </a>
</div>
@endif
@endsection 