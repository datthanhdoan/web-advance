@extends('layouts.app')

@section('content')
<style>
/* Medium-style layout */
.medium-layout {
    max-width: 1192px;
    margin: 0 auto;
    padding: 0 20px;
}

.medium-main {
    display: grid;
    grid-template-columns: 1fr 352px;
    gap: 64px;
    padding: 48px 0;
}

.medium-content {
    min-width: 0;
}

.medium-sidebar {
    position: sticky;
    top: 100px;
    height: fit-content;
}

/* Navigation tabs */
.medium-tabs {
    border-bottom: 1px solid #f2f2f2;
    margin-bottom: 32px;
    display: flex;
    gap: 32px;
    position: sticky;
    top: 75px;
    background: white;
    z-index: 10;
    padding: 16px 0;
}

.medium-tab {
    color: #6b6b6b;
    text-decoration: none;
    font-size: 16px;
    padding: 12px 0;
    border-bottom: 1px solid transparent;
    transition: all 0.2s ease;
    position: relative;
}

.medium-tab.active {
    color: #1a1a1a;
    border-bottom-color: #1a1a1a;
}

.medium-tab:hover {
    color: #1a1a1a;
}

/* Article cards */
.article-list {
    display: flex;
    flex-direction: column;
    gap: 0;
}

.article-item {
    display: grid;
    grid-template-columns: 1fr 112px;
    gap: 24px;
    padding: 24px 0;
    border-bottom: 1px solid #f2f2f2;
    cursor: pointer;
    text-decoration: none;
    color: inherit;
}

.article-item:hover {
    color: inherit;
    text-decoration: none;
}

.article-item:hover .article-title {
    color: #1a1a1a;
}

.article-content {
    min-width: 0;
}

.article-meta {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 8px;
}

.article-author {
    display: flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
    color: inherit;
}

.author-avatar {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #1a8917;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    font-weight: 600;
}

.author-name {
    font-size: 13px;
    color: #1a1a1a;
    font-weight: 400;
}

.article-category {
    font-size: 13px;
    color: #6b6b6b;
    text-decoration: none;
    padding: 0 8px;
    position: relative;
}

.article-category:before {
    content: "in";
    margin-right: 4px;
    color: #6b6b6b;
}

.article-category:hover {
    color: #1a1a1a;
    text-decoration: underline;
}

.article-title {
    font-size: 20px;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 4px;
    color: #1a1a1a;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.article-subtitle {
    font-size: 16px;
    line-height: 1.4;
    color: #6b6b6b;
    margin-bottom: 8px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.article-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 8px;
}

.article-footer-left {
    display: flex;
    align-items: center;
    gap: 16px;
    font-size: 13px;
    color: #6b6b6b;
}

.article-date {
    color: #6b6b6b;
}

.article-read-time:before {
    content: "·";
    margin-right: 6px;
}

.article-stats {
    display: flex;
    align-items: center;
    gap: 16px;
    font-size: 13px;
    color: #6b6b6b;
}

.article-image {
    width: 112px;
    height: 112px;
    object-fit: cover;
    border-radius: 4px;
}

/* Sidebar */
.sidebar-section {
    margin-bottom: 40px;
}

.sidebar-title {
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 16px;
    color: #1a1a1a;
}

.sidebar-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar-list li {
    margin-bottom: 8px;
}

.sidebar-list a {
    color: #6b6b6b;
    text-decoration: none;
    font-size: 14px;
    line-height: 1.4;
}

.sidebar-list a:hover {
    color: #1a1a1a;
    text-decoration: underline;
}

.staff-pick-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 16px;
    padding-bottom: 16px;
    border-bottom: 1px solid #f2f2f2;
}

.staff-pick-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.staff-pick-avatar {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background: #1a8917;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    font-weight: 600;
    flex-shrink: 0;
}

.staff-pick-content {
    min-width: 0;
}

.staff-pick-author {
    font-size: 13px;
    color: #1a1a1a;
    font-weight: 400;
    margin-bottom: 4px;
}

.staff-pick-title {
    font-size: 14px;
    font-weight: 400;
    line-height: 1.4;
    color: #1a1a1a;
    margin-bottom: 4px;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.staff-pick-title a {
    color: inherit;
    text-decoration: none;
}

.staff-pick-title a:hover {
    color: #1a1a1a;
    text-decoration: underline;
}

.staff-pick-date {
    font-size: 12px;
    color: #6b6b6b;
}

.recommended-topics {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}

.topic-tag {
    background: #f2f2f2;
    color: #6b6b6b;
    padding: 8px 16px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 400;
    text-decoration: none;
    transition: all 0.2s ease;
}

.topic-tag:hover {
    background: #e6e6e6;
    color: #1a1a1a;
    text-decoration: none;
}

.see-more {
    color: #1a8917;
    font-size: 14px;
    text-decoration: none;
    margin-top: 16px;
    display: inline-block;
}

.see-more:hover {
    color: #156d12;
    text-decoration: underline;
}

/* Responsive */
@media (max-width: 1080px) {
    .medium-main {
        grid-template-columns: 1fr;
        gap: 0;
    }
    
    .medium-sidebar {
        position: static;
        order: -1;
        background: #f9f9f9;
        padding: 24px;
        margin: 0 -20px 32px;
    }
    
    .recommended-topics {
        display: none;
    }
}

@media (max-width: 768px) {
    .medium-layout {
        padding: 0 16px;
    }
    
    .article-item {
        grid-template-columns: 1fr;
        gap: 16px;
    }
    
    .article-image {
        width: 100%;
        height: 200px;
        order: -1;
    }
}


</style>

<!-- Medium-style Layout -->
<div class="medium-layout">
    <div class="medium-main">
        <main class="medium-content">
            <!-- Navigation Tabs -->
            <nav class="medium-tabs">
                <a href="#" class="medium-tab active">For you</a>
                <a href="#" class="medium-tab">Following</a>
                <a href="#" class="medium-tab">Featured</a>
            </nav>

            <!-- Article List -->
            <div class="article-list">
                @forelse($featuredPosts->concat($recentPosts) as $post)
                <article class="article-item" onclick="window.location='{{ route('posts.show', $post) }}'">
                    <div class="article-content">
                        <div class="article-meta">
                            <a href="#" class="article-author">
                                <div class="author-avatar">
                                    {{ strtoupper(substr($post->user->name ?? 'A', 0, 1)) }}
                                </div>
                                <span class="author-name">{{ $post->user->name ?? 'Anonymous' }}</span>
                            </a>
                            @if($post->category)
                            <a href="{{ route('posts.by-category', $post->category) }}" class="article-category">
                                {{ $post->category->name }}
                            </a>
                            @endif
                        </div>
                        
                        <h2 class="article-title">{{ $post->title }}</h2>
                        
                        @if($post->excerpt)
                        <p class="article-subtitle">{{ $post->excerpt }}</p>
                        @else
                        <p class="article-subtitle">{{ Str::limit(strip_tags($post->content), 120) }}</p>
                        @endif

                        <div class="article-footer">
                            <div class="article-footer-left">
                                <span class="article-date">{{ $post->created_at->format('M j') }}</span>
                                <span class="article-read-time">{{ ceil(str_word_count(strip_tags($post->content)) / 200) }} min read</span>
                            </div>
                            <div class="article-stats">
                                <span>{{ $post->views ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                    @if($post->featured_image)
                    <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="article-image">
                    @else
                    <div class="article-image" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 14px;">
                        {{ strtoupper(substr($post->title, 0, 2)) }}
                    </div>
                    @endif
                </article>
                @empty
                <div style="text-align: center; padding: 60px 20px; color: #6b6b6b;">
                    <h3>Chưa có bài viết nào</h3>
                    <p>Hãy bắt đầu viết bài viết đầu tiên của bạn!</p>
                    <a href="{{ route('posts.create') }}" style="color: #1a8917; text-decoration: none; font-weight: 600;">Viết bài →</a>
                </div>
                @endforelse
            </div>
        </main>

        <!-- Sidebar -->
        <aside class="medium-sidebar">
            <!-- Staff Picks -->
            <div class="sidebar-section">
                <h3 class="sidebar-title">Staff Picks</h3>
                @if($popularPosts && $popularPosts->count() > 0)
                    @foreach($popularPosts->take(3) as $post)
                    <div class="staff-pick-item">
                        <div class="staff-pick-avatar">
                            {{ strtoupper(substr($post->user->name ?? 'A', 0, 1)) }}
                        </div>
                        <div class="staff-pick-content">
                            <div class="staff-pick-author">{{ $post->user->name ?? 'Anonymous' }}</div>
                            <h4 class="staff-pick-title">
                                <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                            </h4>
                            <div class="staff-pick-date">{{ $post->created_at->format('M j') }}</div>
                        </div>
                    </div>
                    @endforeach
                @endif
                <a href="{{ route('posts.index') }}" class="see-more">See the full list</a>
            </div>

            <!-- Recommended Topics -->
            <div class="sidebar-section">
                <h3 class="sidebar-title">Recommended topics</h3>
                <div class="recommended-topics">
                    @if($categories && $categories->count() > 0)
                        @foreach($categories->take(6) as $category)
                        <a href="{{ route('posts.by-category', $category) }}" class="topic-tag">
                            {{ $category->name }}
                        </a>
                        @endforeach
                    @endif
                </div>
                <a href="#" class="see-more">See more topics</a>
            </div>
        </aside>
    </div>
</div>

@endsection 