@extends('layouts.app')

@section('content')
<style>
.my-posts-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 60px 20px;
}

.my-posts-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 64px;
}

.header-content h1 {
    font-size: 42px;
    font-weight: 400;
    color: #1a1a1a;
    margin: 0 0 8px 0;
    line-height: 1.2;
}

.header-content p {
    font-size: 16px;
    color: #6b6b6b;
    margin: 0;
    line-height: 1.4;
}

.create-post-btn {
    padding: 8px 16px;
    border: 1px solid #1a8917;
    border-radius: 20px;
    background: #1a8917;
    color: white;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    transition: all 0.2s ease;
}

.create-post-btn:hover {
    background: #156d12;
    border-color: #156d12;
    color: white;
}

.posts-list {
    display: flex;
    flex-direction: column;
    gap: 48px;
}

.post-item {
    padding: 0 0 48px 0;
    border-bottom: 1px solid #f0f0f0;
}

.post-item:last-child {
    border-bottom: none;
}

.post-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 16px;
}

.post-status {
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-published {
    background: #e6f7e6;
    color: #1a8917;
}

.status-draft {
    background: #f0f0f0;
    color: #6b6b6b;
}

.post-title {
    font-size: 24px;
    font-weight: 600;
    color: #1a1a1a;
    margin: 0 0 12px 0;
    line-height: 1.3;
    text-decoration: none;
}

.post-title:hover {
    color: #6b6b6b;
}

.post-excerpt {
    font-size: 16px;
    color: #6b6b6b;
    line-height: 1.5;
    margin: 0 0 16px 0;
}

.post-meta {
    display: flex;
    align-items: center;
    gap: 16px;
    font-size: 14px;
    color: #6b6b6b;
    margin-bottom: 16px;
}

.post-actions {
    display: flex;
    gap: 16px;
}

.action-btn {
    font-size: 14px;
    color: #6b6b6b;
    text-decoration: none;
    transition: color 0.2s ease;
}

.action-btn:hover {
    color: #1a1a1a;
}

.action-btn.delete:hover {
    color: #dc2626;
}

.empty-state {
    text-align: center;
    padding: 80px 20px;
    color: #6b6b6b;
}

.empty-state h3 {
    font-size: 24px;
    font-weight: 500;
    color: #1a1a1a;
    margin: 0 0 16px 0;
}

.empty-state p {
    font-size: 16px;
    color: #6b6b6b;
    margin: 0 0 24px 0;
    line-height: 1.5;
}

@media (max-width: 768px) {
    .my-posts-container {
        padding: 40px 20px;
    }
    
    .header-content h1 {
        font-size: 32px;
    }
    
    .my-posts-header {
        flex-direction: column;
        gap: 24px;
        align-items: flex-start;
    }
}
</style>

<div class="my-posts-container">
    <!-- Header -->
    <div class="my-posts-header">
        <div class="header-content">
            <h1>Your stories</h1>
            <p>{{ $posts->total() }} {{ Str::plural('story', $posts->total()) }}</p>
        </div>
        <a href="{{ route('posts.create') }}" class="create-post-btn">
            Write a story
        </a>
    </div>

    <!-- Posts List -->
    @if($posts->count() > 0)
        <div class="posts-list">
            @foreach($posts as $post)
                <article class="post-item">
                    <div class="post-header">
                        <span class="post-status status-{{ $post->status }}">
                            {{ $post->status === 'published' ? 'Published' : 'Draft' }}
                        </span>
                    </div>
                    
                    <a href="{{ route('posts.show', $post) }}" class="post-title">
                        {{ $post->title }}
                    </a>
                    
                    @if($post->excerpt)
                        <p class="post-excerpt">{{ Str::limit($post->excerpt, 200) }}</p>
                    @endif
                    
                    <div class="post-meta">
                        <span>{{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}</span>
                        <span>{{ $post->read_time }} min read</span>
                        <span>{{ $post->views }} views</span>
                        <span>{{ $post->comments()->count() }} responses</span>
                    </div>
                    
                    <div class="post-actions">
                        <a href="{{ route('posts.show', $post) }}" class="action-btn">View story</a>
                        <a href="{{ route('posts.edit', $post) }}" class="action-btn">Edit</a>
                        <form method="POST" action="{{ route('posts.destroy', $post) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this story?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn delete" style="background: none; border: none; cursor: pointer;">Delete</button>
                        </form>
                    </div>
                </article>
            @endforeach
        </div>
        
        <!-- Pagination -->
        @if($posts->hasPages())
            <div style="margin-top: 64px; display: flex; justify-content: center;">
                {{ $posts->links() }}
            </div>
        @endif
    @else
        <div class="empty-state">
            <h3>You haven't published any stories yet</h3>
            <p>Your published stories will appear here. Readers will only see your published stories, not your drafts.</p>
            <a href="{{ route('posts.create') }}" class="create-post-btn">
                Write your first story
            </a>
        </div>
    @endif
</div>
@endsection 