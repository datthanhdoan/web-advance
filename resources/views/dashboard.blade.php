@extends('layouts.app')

@section('content')
<style>
.dashboard-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 40px 20px;
}

.dashboard-header {
    margin-bottom: 40px;
}

.dashboard-title {
    font-size: 2rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 8px;
}

.dashboard-subtitle {
    color: #6b6b6b;
    font-size: 1rem;
}

.dashboard-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 40px;
}

.stat-card {
    background: white;
    border: 1px solid #e6e6e6;
    border-radius: 12px;
    padding: 24px;
    transition: all 0.2s ease;
}

.stat-card:hover {
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
}

.stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 16px;
}

.stat-icon.posts {
    background: #e6f7e6;
    color: #1a8917;
}

.stat-icon.comments {
    background: #e6f3ff;
    color: #0066cc;
}

.stat-icon.views {
    background: #fff3e6;
    color: #cc6600;
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: #1a1a1a;
    margin-bottom: 4px;
}

.stat-label {
    color: #6b6b6b;
    font-size: 0.875rem;
    font-weight: 500;
}

.dashboard-actions {
    display: flex;
    gap: 16px;
    margin-bottom: 40px;
    flex-wrap: wrap;
}

.dashboard-btn {
    padding: 12px 24px;
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.dashboard-btn-primary {
    background: #1a8917;
    color: white;
    border: 1px solid #1a8917;
}

.dashboard-btn-primary:hover {
    background: #156d12;
    color: white;
}

.dashboard-btn-outline {
    background: white;
    color: #1a8917;
    border: 1px solid #1a8917;
}

.dashboard-btn-outline:hover {
    background: #1a8917;
    color: white;
}

.dashboard-content {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 40px;
}

.dashboard-main {
    background: white;
    border: 1px solid #e6e6e6;
    border-radius: 12px;
    padding: 24px;
}

.dashboard-sidebar {
    background: white;
    border: 1px solid #e6e6e6;
    border-radius: 12px;
    padding: 24px;
}

.section-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 20px;
}

.post-list {
    space-y: 16px;
}

.post-item {
    padding: 16px;
    border: 1px solid #f0f0f0;
    border-radius: 8px;
    transition: all 0.2s ease;
}

.post-item:hover {
    background: #fafafa;
    border-color: #e6e6e6;
}

.post-item-title {
    font-size: 1rem;
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 8px;
    text-decoration: none;
}

.post-item-title:hover {
    color: #1a8917;
}

.post-item-meta {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 0.75rem;
    color: #6b6b6b;
    margin-bottom: 8px;
}

.post-item-status {
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 500;
}

.post-item-status.published {
    background: #e6f7e6;
    color: #1a8917;
}

.post-item-status.draft {
    background: #f0f0f0;
    color: #6b6b6b;
}

.post-item-actions {
    display: flex;
    gap: 8px;
    margin-top: 12px;
}

.post-action-btn {
    padding: 4px 12px;
    border-radius: 4px;
    font-size: 0.75rem;
    text-decoration: none;
    transition: all 0.2s ease;
}

.post-action-btn.edit {
    background: #e6f3ff;
    color: #0066cc;
}

.post-action-btn.edit:hover {
    background: #0066cc;
    color: white;
}

.post-action-btn.delete {
    background: #fef2f2;
    color: #dc2626;
}

.post-action-btn.delete:hover {
    background: #dc2626;
    color: white;
}

.activity-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 0;
    border-bottom: 1px solid #f0f0f0;
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-icon {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
}

.activity-icon.comment {
    background: #e6f3ff;
    color: #0066cc;
}

.activity-icon.view {
    background: #fff3e6;
    color: #cc6600;
}

.activity-content {
    flex: 1;
}

.activity-text {
    font-size: 0.875rem;
    color: #1a1a1a;
    margin-bottom: 2px;
}

.activity-time {
    font-size: 0.75rem;
    color: #6b6b6b;
}

@media (max-width: 768px) {
    .dashboard-container {
        padding: 20px 15px;
    }
    
    .dashboard-content {
        grid-template-columns: 1fr;
        gap: 20px;
    }
    
    .dashboard-stats {
        grid-template-columns: 1fr;
    }
    
    .dashboard-actions {
        flex-direction: column;
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
        <div class="stat-card">
            <div class="stat-icon posts">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
            </div>
            <div class="stat-number">{{ Auth::user()->posts()->count() }}</div>
            <div class="stat-label">Bài viết</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon comments">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
            </div>
            <div class="stat-number">{{ Auth::user()->comments()->count() }}</div>
            <div class="stat-label">Bình luận</div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon views">
                <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
            </div>
            <div class="stat-number">{{ Auth::user()->posts()->sum('views') }}</div>
            <div class="stat-label">Lượt xem</div>
        </div>
    </div>
    
    <!-- Actions -->
    <div class="dashboard-actions">
        <a href="{{ route('posts.create') }}" class="dashboard-btn dashboard-btn-primary">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Viết bài mới
        </a>
        
        <a href="{{ route('posts.index') }}" class="dashboard-btn dashboard-btn-outline">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            Khám phá bài viết
        </a>
        
        <a href="{{ route('profile.edit') }}" class="dashboard-btn dashboard-btn-outline">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            Chỉnh sửa hồ sơ
        </a>
    </div>
    
    <!-- Content -->
    <div class="dashboard-content">
        <!-- Main Content -->
        <div class="dashboard-main">
            <h2 class="section-title">Bài viết của bạn</h2>
            
            @if(Auth::user()->posts()->count() > 0)
                <div class="post-list">
                    @foreach(Auth::user()->posts()->latest()->take(5)->get() as $post)
                        <div class="post-item">
                            <a href="{{ route('posts.show', $post) }}" class="post-item-title">
                                {{ $post->title }}
                            </a>
                            
                            <div class="post-item-meta">
                                <span class="post-item-status {{ $post->status }}">
                                    {{ $post->status === 'published' ? 'Đã xuất bản' : 'Bản nháp' }}
                                </span>
                                <span>{{ $post->published_date ?? $post->created_at->format('M j, Y') }}</span>
                                <span>{{ $post->views }} lượt xem</span>
                                <span>{{ $post->comments()->count() }} bình luận</span>
                            </div>
                            
                            <div class="post-item-actions">
                                <a href="{{ route('posts.edit', $post) }}" class="post-action-btn edit">
                                    Chỉnh sửa
                                </a>
                                <a href="{{ route('posts.show', $post) }}" class="post-action-btn edit">
                                    Xem
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                @if(Auth::user()->posts()->count() > 5)
                    <div style="text-align: center; margin-top: 20px;">
                        <a href="#" class="dashboard-btn dashboard-btn-outline">
                            Xem tất cả bài viết
                        </a>
                    </div>
                @endif
            @else
                <div style="text-align: center; padding: 40px 20px; color: #6b6b6b;">
                    <svg width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="margin: 0 auto 20px; color: #d1d5db;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <p>Bạn chưa có bài viết nào. Hãy bắt đầu viết bài đầu tiên!</p>
                    <a href="{{ route('posts.create') }}" class="dashboard-btn dashboard-btn-primary" style="margin-top: 16px;">
                        Viết bài ngay
                    </a>
                </div>
            @endif
        </div>
        
        <!-- Sidebar -->
        <div class="dashboard-sidebar">
            <h3 class="section-title">Hoạt động gần đây</h3>
            
            <div class="activity-list">
                @php
                    $recentComments = Auth::user()->comments()->with('post')->latest()->take(3)->get();
                    $recentPosts = Auth::user()->posts()->latest()->take(2)->get();
                @endphp
                
                @foreach($recentComments as $comment)
                    <div class="activity-item">
                        <div class="activity-icon comment">
                            💬
                        </div>
                        <div class="activity-content">
                            <div class="activity-text">
                                Bạn đã bình luận trong "<a href="{{ route('posts.show', $comment->post) }}" style="color: #1a8917;">{{ Str::limit($comment->post->title, 30) }}</a>"
                            </div>
                            <div class="activity-time">{{ $comment->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                @endforeach
                
                @foreach($recentPosts as $post)
                    <div class="activity-item">
                        <div class="activity-icon view">
                            📝
                        </div>
                        <div class="activity-content">
                            <div class="activity-text">
                                Bài viết "<a href="{{ route('posts.show', $post) }}" style="color: #1a8917;">{{ Str::limit($post->title, 30) }}</a>" có {{ $post->views }} lượt xem
                            </div>
                            <div class="activity-time">{{ $post->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                @endforeach
                
                @if($recentComments->count() === 0 && $recentPosts->count() === 0)
                    <div style="text-align: center; padding: 20px; color: #6b6b6b;">
                        <p>Chưa có hoạt động nào gần đây</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
