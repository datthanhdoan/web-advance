@extends('layouts.app')

@section('content')
<style>
.dashboard-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 60px 20px;
}

.dashboard-header {
    margin-bottom: 48px;
}

.dashboard-title {
    font-size: 42px;
    font-weight: 400;
    color: #1a1a1a;
    margin: 0 0 8px 0;
    line-height: 1.2;
}

.dashboard-subtitle {
    font-size: 16px;
    color: #6b6b6b;
    margin: 0;
    line-height: 1.4;
}

.dashboard-stats {
    display: flex;
    gap: 64px;
    margin-bottom: 64px;
    padding-bottom: 32px;
    border-bottom: 1px solid #f0f0f0;
}

.stat-item {
    text-align: left;
}

.stat-number {
    font-size: 24px;
    font-weight: 600;
    color: #1a1a1a;
    margin: 0 0 4px 0;
    line-height: 1.2;
}

.stat-label {
    font-size: 14px;
    color: #6b6b6b;
    margin: 0;
    line-height: 1.4;
    border-bottom: 1px solid #1a1a1a;
    padding-bottom: 2px;
    display: inline-block;
}

.dashboard-actions {
    display: flex;
    gap: 16px;
    margin-bottom: 64px;
    flex-wrap: wrap;
}

.dashboard-btn {
    padding: 8px 16px;
    border: 1px solid #1a1a1a;
    border-radius: 20px;
    background: transparent;
    color: #1a1a1a;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s ease;
}

.dashboard-btn:hover {
    background: #1a1a1a;
    color: white;
}

.dashboard-btn-primary {
    background: #1a8917;
    border-color: #1a8917;
    color: white;
}

.dashboard-btn-primary:hover {
    background: #156d12;
    border-color: #156d12;
    color: white;
}

.dashboard-content {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 80px;
}

.dashboard-main {
    background: transparent;
    border: none;
    padding: 0;
}

.dashboard-sidebar {
    background: transparent;
    border: none;
    padding: 0;
}

.section-title {
    font-size: 20px;
    font-weight: 500;
    color: #1a1a1a;
    margin: 0 0 32px 0;
    line-height: 1.3;
}

.post-list {
    display: flex;
    flex-direction: column;
    gap: 32px;
}

.post-item {
    padding: 0 0 32px 0;
    border: none;
    border-bottom: 1px solid #f0f0f0;
    background: transparent;
}

.post-item:last-child {
    border-bottom: none;
}

.post-item-title {
    font-size: 20px;
    font-weight: 600;
    color: #1a1a1a;
    margin: 0 0 8px 0;
    text-decoration: none;
    line-height: 1.3;
}

.post-item-title:hover {
    color: #6b6b6b;
}

.post-item-meta {
    display: flex;
    align-items: center;
    gap: 16px;
    font-size: 14px;
    color: #6b6b6b;
    margin-bottom: 12px;
}

.post-item-status {
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.post-item-status.published {
    background: #e6f7e6;
    color: #1a8917;
}

.post-item-status.draft {
    background: #f0f0f0;
    color: #6b6b6b;
}

.post-item-excerpt {
    font-size: 16px;
    color: #6b6b6b;
    line-height: 1.5;
    margin: 0;
}

.post-item-actions {
    display: flex;
    gap: 16px;
    margin-top: 16px;
}

.post-action {
    font-size: 14px;
    color: #6b6b6b;
    text-decoration: none;
    transition: color 0.2s ease;
}

.post-action:hover {
    color: #1a1a1a;
}

.activity-item {
    padding: 0 0 24px 0;
    border-bottom: 1px solid #f0f0f0;
    margin-bottom: 24px;
}

.activity-item:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.activity-content {
    font-size: 14px;
    color: #6b6b6b;
    line-height: 1.5;
    margin: 0 0 8px 0;
}

.activity-content a {
    color: #1a1a1a;
    text-decoration: none;
    font-weight: 500;
}

.activity-content a:hover {
    color: #1a8917;
}

.activity-time {
    font-size: 12px;
    color: #a3a3a3;
}

@media (max-width: 768px) {
    .dashboard-container {
        padding: 40px 20px;
    }
    
    .dashboard-title {
        font-size: 32px;
    }
    
    .dashboard-content {
        grid-template-columns: 1fr;
        gap: 48px;
    }
    
    .dashboard-stats {
        flex-direction: column;
        gap: 24px;
    }
}
</style>

<div class="dashboard-container">
    <!-- Header -->
    <div class="dashboard-header">
        <h1 class="dashboard-title">Dashboard</h1>
        <p class="dashboard-subtitle">Chào mừng trở lại, {{ Auth::user()->name }}!</p>
    </div>

    <!-- Stats -->
    <div class="dashboard-stats">
        <div class="stat-item">
            <div class="stat-number">{{ Auth::user()->posts()->count() }}</div>
            <div class="stat-label">Bài viết</div>
        </div>
        
        <div class="stat-item">
            <div class="stat-number">{{ Auth::user()->comments()->count() }}</div>
            <div class="stat-label">Bình luận</div>
        </div>
        
        <div class="stat-item">
            <div class="stat-number">{{ Auth::user()->posts()->sum('views') }}</div>
            <div class="stat-label">Lượt xem</div>
        </div>
    </div>

    <!-- Actions -->
    <div class="dashboard-actions">
        <a href="{{ route('posts.create') }}" class="dashboard-btn dashboard-btn-primary">
            Viết bài mới
        </a>
        <a href="{{ route('profile.edit') }}" class="dashboard-btn">
            Chỉnh sửa hồ sơ
        </a>
    </div>

    <!-- Content -->
    <div class="dashboard-content">
        <!-- Main Content -->
        <div class="dashboard-main">
            <h2 class="section-title">Bài viết của bạn</h2>
            
            <div class="post-list">
                @forelse(Auth::user()->posts()->latest()->take(5)->get() as $post)
                    <article class="post-item">
                        <a href="{{ route('posts.show', $post) }}" class="post-item-title">
                            {{ $post->title }}
                        </a>
                        
                        <div class="post-item-meta">
                            <span class="post-item-status {{ $post->status }}">
                                {{ $post->status === 'published' ? 'Đã xuất bản' : 'Bản nháp' }}
                            </span>
                            <span>{{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}</span>
                            <span>{{ $post->views }} lượt xem</span>
                            <span>{{ $post->comments()->count() }} bình luận</span>
                        </div>
                        
                        @if($post->excerpt)
                            <p class="post-item-excerpt">{{ Str::limit($post->excerpt, 120) }}</p>
                        @endif
                        
                        <div class="post-item-actions">
                            <a href="{{ route('posts.edit', $post) }}" class="post-action">Chỉnh sửa</a>
                            <a href="{{ route('posts.show', $post) }}" class="post-action">Xem</a>
                        </div>
                    </article>
                @empty
                    <div style="text-align: center; padding: 48px 0; color: #6b6b6b;">
                        <p style="font-size: 18px; margin-bottom: 16px;">Bạn chưa có bài viết nào</p>
                        <a href="{{ route('posts.create') }}" class="dashboard-btn dashboard-btn-primary">
                            Viết bài đầu tiên
                        </a>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Sidebar -->
        <div class="dashboard-sidebar">
            <h3 class="section-title">Hoạt động gần đây</h3>
            
            <div class="activity-list">
                @php
                    $recentComments = Auth::user()->comments()->with('post')->latest()->take(3)->get();
                    $recentPosts = Auth::user()->posts()->latest()->take(2)->get();
                    $activities = collect();
                    
                    foreach($recentComments as $comment) {
                        $activities->push([
                            'type' => 'comment',
                            'content' => 'Bạn đã bình luận trong "' . $comment->post->title . '"',
                            'time' => $comment->created_at,
                            'link' => route('posts.show', $comment->post)
                        ]);
                    }
                    
                    foreach($recentPosts as $post) {
                        $activities->push([
                            'type' => 'post',
                            'content' => 'Bài viết "' . $post->title . '" có ' . $post->views . ' lượt xem',
                            'time' => $post->created_at,
                            'link' => route('posts.show', $post)
                        ]);
                    }
                    
                    $activities = $activities->sortByDesc('time')->take(5);
                @endphp
                
                @forelse($activities as $activity)
                    <div class="activity-item">
                        <p class="activity-content">
                            <a href="{{ $activity['link'] }}">{{ $activity['content'] }}</a>
                        </p>
                        <div class="activity-time">{{ $activity['time']->diffForHumans() }}</div>
                    </div>
                @empty
                    <div style="color: #6b6b6b; font-size: 14px; text-align: center; padding: 24px 0;">
                        Chưa có hoạt động nào
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
