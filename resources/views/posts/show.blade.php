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

.post-author {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
}

.author-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #1a8917;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 14px;
}

.author-name {
    font-weight: 600;
    color: #1a1a1a;
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
    line-height: 1.3;
}

.post-content h1 { font-size: 2rem; }
.post-content h2 { 
    font-size: 1.75rem; 
    border-bottom: 2px solid #e6e6e6;
    padding-bottom: 10px;
}
.post-content h3 { 
    font-size: 1.5rem; 
    color: #2d5016;
}
.post-content h4 { 
    font-size: 1.25rem; 
    color: #4a4a4a;
}

.post-content p {
    margin-bottom: 20px;
    text-align: justify;
}

.post-content ul,
.post-content ol {
    margin: 20px 0;
    padding-left: 30px;
}

.post-content ul li,
.post-content ol li {
    margin-bottom: 8px;
    line-height: 1.6;
}

.post-content ul li {
    list-style-type: disc;
}

.post-content ol li {
    list-style-type: decimal;
}

.post-content li ul,
.post-content li ol {
    margin: 8px 0;
    padding-left: 25px;
}

.post-content strong {
    font-weight: 600;
    color: #1a1a1a;
}

.post-content em {
    font-style: italic;
}

.post-content blockquote {
    border-left: 4px solid #1a8917;
    padding-left: 20px;
    margin: 30px 0;
    font-size: 1.2rem;
    font-style: italic;
    color: #4a4a4a;
    background: #f9f9f9;
    padding: 20px;
    border-radius: 8px;
}

.post-content code {
    background: #f7f7f7;
    padding: 2px 6px;
    border-radius: 4px;
    font-family: 'Monaco', 'Menlo', 'Ubuntu Mono', monospace;
    font-size: 0.9rem;
    border: 1px solid #e6e6e6;
}

.post-content pre {
    background: #f7f7f7;
    padding: 20px;
    border-radius: 8px;
    overflow-x: auto;
    margin: 20px 0;
    border: 1px solid #e6e6e6;
}

.post-content pre code {
    background: none;
    padding: 0;
    border: none;
    font-size: 0.95rem;
}

.post-content a {
    color: #1a8917;
    text-decoration: underline;
}

.post-content a:hover {
    color: #156d12;
}

.post-content img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 20px 0;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.post-content table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    border: 1px solid #e6e6e6;
    border-radius: 8px;
    overflow: hidden;
}

.post-content th,
.post-content td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #e6e6e6;
}

.post-content th {
    background: #f7f7f7;
    font-weight: 600;
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

/* Comments Section */
.comments-section {
    margin-top: 60px;
    padding-top: 40px;
    border-top: 1px solid #e6e6e6;
}

.comments-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #1a1a1a;
    margin-bottom: 30px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.comments-count {
    color: #6b6b6b;
    font-weight: 400;
    font-size: 1rem;
}

.comment-form {
    background: #fafafa;
    border: 1px solid #e6e6e6;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 30px;
}

.comment-form-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 15px;
}

.comment-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: #1a8917;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 16px;
}

.comment-form-info strong {
    display: block;
    color: #1a1a1a;
    font-size: 0.875rem;
}

.comment-form-subtitle {
    color: #6b6b6b;
    font-size: 0.75rem;
}

.comment-textarea {
    width: 100%;
    min-height: 100px;
    padding: 12px 16px;
    border: 1px solid #e6e6e6;
    border-radius: 8px;
    font-size: 0.875rem;
    line-height: 1.5;
    resize: vertical;
    outline: none;
    transition: all 0.2s ease;
    background: white;
}

.comment-textarea:focus {
    border-color: #1a8917;
    box-shadow: 0 0 0 3px rgba(26, 137, 23, 0.1);
}

.comment-form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    margin-top: 15px;
}

.comment-btn-cancel,
.comment-btn-submit {
    padding: 8px 20px;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
    border: none;
}

.comment-btn-cancel {
    background: transparent;
    color: #6b6b6b;
}

.comment-btn-cancel:hover {
    background: #f0f0f0;
    color: #1a1a1a;
}

.comment-btn-submit {
    background: #1a8917;
    color: white;
}

.comment-btn-submit:hover {
    background: #156d12;
}

.comment-login-prompt {
    text-align: center;
    padding: 40px 20px;
    background: #f7f7f7;
    border-radius: 12px;
    margin-bottom: 30px;
}

.comment-login-link {
    color: #1a8917;
    text-decoration: none;
    font-weight: 500;
}

.comment-login-link:hover {
    text-decoration: underline;
}

.comments-list {
    space-y: 20px;
}

.comment-item {
    background: white;
    border: 1px solid #e6e6e6;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 15px;
}

.comment-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 12px;
}

.comment-author-info {
    display: flex;
    align-items: center;
    gap: 12px;
}

.comment-author-avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: #1a8917;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 14px;
}

.comment-author-name {
    font-weight: 600;
    color: #1a1a1a;
    font-size: 0.875rem;
}

.comment-date {
    color: #6b6b6b;
    font-size: 0.75rem;
}

.comment-actions {
    display: flex;
    gap: 8px;
}

.comment-action-btn {
    background: none;
    border: none;
    color: #6b6b6b;
    font-size: 0.75rem;
    cursor: pointer;
    padding: 4px 8px;
    border-radius: 4px;
    transition: all 0.2s ease;
}

.comment-action-btn:hover {
    background: #f0f0f0;
    color: #1a1a1a;
}

.comment-content {
    color: #1a1a1a;
    line-height: 1.6;
    font-size: 0.875rem;
    margin-bottom: 12px;
}

.comment-reply-btn {
    background: none;
    border: none;
    color: #1a8917;
    font-size: 0.75rem;
    font-weight: 500;
    cursor: pointer;
    padding: 4px 0;
    transition: color 0.2s ease;
}

.comment-reply-btn:hover {
    color: #156d12;
}

.comment-replies {
    margin-top: 15px;
    padding-left: 20px;
    border-left: 2px solid #f0f0f0;
}

.comment-reply {
    background: #fafafa;
    border: 1px solid #e6e6e6;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 10px;
}

.no-comments {
    text-align: center;
    padding: 60px 20px;
    color: #6b6b6b;
}

.no-comments svg {
    margin: 0 auto 20px;
    color: #d1d5db;
}

.no-comments p {
    font-size: 1rem;
    margin: 0;
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
                @if($post->user)
                <div class="post-author">
                    <span class="author-avatar">{{ strtoupper(substr($post->user->name, 0, 1)) }}</span>
                    <span class="author-name">{{ $post->user->name }}</span>
                </div>
                @endif
                <div class="post-date">{{ $post->published_date }}</div>
                <div class="post-stats">
                    <span>{{ $post->read_time_text }}</span>
                    <span>•</span>
                    <span>{{ $post->views }} lượt xem</span>
                    @if($post->comments()->count() > 0)
                    <span>•</span>
                    <span>{{ $post->comments()->count() }} bình luận</span>
                    @endif
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
        {!! $post->formatted_content !!}
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
        
        @auth
            @if(Auth::user()->id === $post->user_id)
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
            @endif
        @endauth
    </div>
</article>

<!-- Comments Section -->
<section class="post-container">
    <div class="comments-section">
        <h2 class="comments-title">
            Bình luận 
            <span class="comments-count" id="commentsCount">({{ $post->approvedComments->count() }})</span>
        </h2>
        
        @auth
            <!-- Comment Form -->
            <form class="comment-form" id="commentForm" action="{{ route('comments.store', $post) }}" method="POST">
                @csrf
                <div class="comment-form-header">
                    <div class="comment-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    <div class="comment-form-info">
                        <strong>{{ Auth::user()->name }}</strong>
                        <div class="comment-form-subtitle">Chia sẻ suy nghĩ của bạn về bài viết này</div>
                    </div>
                </div>
                
                <textarea 
                    name="content" 
                    class="comment-textarea" 
                    placeholder="Viết bình luận của bạn..."
                    rows="4"
                    required
                ></textarea>
                
                <div class="comment-form-actions">
                    <button type="button" class="comment-btn-cancel" onclick="cancelComment()">Hủy</button>
                    <button type="submit" class="comment-btn-submit">Đăng bình luận</button>
                </div>
            </form>
        @else
            <div class="comment-login-prompt">
                <p>
                    <a href="{{ route('login') }}" class="comment-login-link">Đăng nhập</a> 
                    để tham gia thảo luận
                </p>
            </div>
        @endauth
        
        <!-- Comments List -->
        <div class="comments-list" id="commentsList">
            @foreach($post->approvedComments as $comment)
                @include('partials.comment', ['comment' => $comment])
            @endforeach
        </div>
        
        @if($post->approvedComments->count() === 0)
            <div class="no-comments" id="noComments">
                <svg width="48" height="48" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                </svg>
                <p>Chưa có bình luận nào. Hãy là người đầu tiên chia sẻ suy nghĩ!</p>
            </div>
        @endif
    </div>
</section>

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

// Comment System JavaScript
function cancelComment() {
    document.querySelector('#commentForm textarea').value = '';
}

function toggleReplyForm(commentId) {
    const replyForm = document.getElementById(`reply-form-${commentId}`);
    if (replyForm.style.display === 'none' || replyForm.style.display === '') {
        replyForm.style.display = 'block';
        replyForm.querySelector('textarea').focus();
    } else {
        replyForm.style.display = 'none';
    }
}

function cancelReply(commentId) {
    const replyForm = document.getElementById(`reply-form-${commentId}`);
    replyForm.style.display = 'none';
    replyForm.querySelector('textarea').value = '';
}

function editComment(commentId) {
    const contentDiv = document.getElementById(`comment-content-${commentId}`);
    const editForm = document.getElementById(`edit-form-${commentId}`);
    
    contentDiv.style.display = 'none';
    editForm.style.display = 'block';
    editForm.querySelector('textarea').focus();
}

function cancelEdit(commentId) {
    const contentDiv = document.getElementById(`comment-content-${commentId}`);
    const editForm = document.getElementById(`edit-form-${commentId}`);
    
    contentDiv.style.display = 'block';
    editForm.style.display = 'none';
}

async function updateComment(event, commentId) {
    event.preventDefault();
    
    const form = event.target;
    const formData = new FormData(form);
    
    try {
        const response = await fetch(`/comments/${commentId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-HTTP-Method-Override': 'PUT',
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
            // Update content
            document.getElementById(`comment-content-${commentId}`).textContent = formData.get('content');
            cancelEdit(commentId);
            
            // Show success message
            showNotification('Bình luận đã được cập nhật!', 'success');
        } else {
            showNotification(data.error || 'Có lỗi xảy ra!', 'error');
        }
    } catch (error) {
        showNotification('Có lỗi xảy ra khi cập nhật bình luận!', 'error');
    }
}

async function deleteComment(commentId) {
    if (!confirm('Bạn có chắc chắn muốn xóa bình luận này?')) {
        return;
    }
    
    try {
        const response = await fetch(`/comments/${commentId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        });
        
        const data = await response.json();
        
        if (data.success) {
            // Remove comment from DOM
            document.getElementById(`comment-${commentId}`).remove();
            
            // Update comment count
            updateCommentCount(-1);
            
            showNotification('Bình luận đã được xóa!', 'success');
        } else {
            showNotification(data.error || 'Có lỗi xảy ra!', 'error');
        }
    } catch (error) {
        showNotification('Có lỗi xảy ra khi xóa bình luận!', 'error');
    }
}

async function replyToComment(event, parentId) {
    event.preventDefault();
    
    const form = event.target;
    const formData = new FormData(form);
    
    try {
        const response = await fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
            // Add reply to DOM
            const repliesContainer = document.getElementById(`replies-${parentId}`);
            if (repliesContainer) {
                const replyHtml = createReplyHtml(data.comment);
                repliesContainer.insertAdjacentHTML('beforeend', replyHtml);
            } else {
                // Create replies container if it doesn't exist
                const commentItem = document.getElementById(`comment-${parentId}`);
                const repliesHtml = `<div class="comment-replies" id="replies-${parentId}">${createReplyHtml(data.comment)}</div>`;
                commentItem.insertAdjacentHTML('beforeend', repliesHtml);
            }
            
            // Clear and hide form
            cancelReply(parentId);
            
            // Update comment count
            updateCommentCount(1);
            
            showNotification('Phản hồi đã được thêm!', 'success');
        } else {
            showNotification(data.error || 'Có lỗi xảy ra!', 'error');
        }
    } catch (error) {
        showNotification('Có lỗi xảy ra khi thêm phản hồi!', 'error');
    }
}

function createReplyHtml(comment) {
    return `
        <div class="comment-reply" id="comment-${comment.id}">
            <div class="comment-header">
                <div class="comment-author-info">
                    <div class="comment-author-avatar">
                        ${comment.user.name.charAt(0).toUpperCase()}
                    </div>
                    <div>
                        <div class="comment-author-name">${comment.user.name}</div>
                        <div class="comment-date">vừa xong</div>
                    </div>
                </div>
            </div>
            <div class="comment-content" id="comment-content-${comment.id}">
                ${comment.content}
            </div>
        </div>
    `;
}

function updateCommentCount(change) {
    const countElement = document.getElementById('commentsCount');
    const currentCount = parseInt(countElement.textContent.match(/\d+/)[0]);
    const newCount = currentCount + change;
    countElement.textContent = `(${newCount})`;
    
    // Hide/show no comments message
    const noComments = document.getElementById('noComments');
    if (noComments) {
        if (newCount > 0) {
            noComments.style.display = 'none';
        } else {
            noComments.style.display = 'block';
        }
    }
}

function showNotification(message, type) {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `notification ${type}`;
    notification.innerHTML = `
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <strong>${type === 'success' ? 'Thành công!' : 'Lỗi!'}</strong><br>
                ${message}
            </div>
            <button onclick="this.parentElement.parentElement.remove()" style="background: none; border: none; font-size: 18px; cursor: pointer; color: #6b6b6b;">&times;</button>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (notification.parentElement) {
            notification.remove();
        }
    }, 5000);
}

// Handle main comment form submission
document.getElementById('commentForm')?.addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    try {
        console.log('Submitting comment to:', this.action);
        const response = await fetch(this.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            body: formData
        });
        
        console.log('Response status:', response.status);
        
        // Log raw response text first
        const responseText = await response.text();
        console.log('Raw response:', responseText);
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status} - ${responseText}`);
        }
        
        // Try to parse JSON
        let data;
        try {
            data = JSON.parse(responseText);
            console.log('Parsed JSON data:', data);
        } catch (parseError) {
            console.error('JSON parse error:', parseError);
            console.error('Response was:', responseText);
            throw new Error('Server trả về không phải JSON: ' + responseText.substring(0, 200));
        }
        
        if (data.success) {
            // Add comment to DOM
            const commentsList = document.getElementById('commentsList');
            const commentHtml = createCommentHtml(data.comment);
            commentsList.insertAdjacentHTML('afterbegin', commentHtml);
            
            // Clear form
            this.reset();
            
            // Update comment count
            updateCommentCount(1);
            
            showNotification('Bình luận đã được thêm thành công!', 'success');
        } else {
            console.error('Server error:', data);
            showNotification(data.error || 'Có lỗi xảy ra!', 'error');
        }
    } catch (error) {
        console.error('Fetch error:', error);
        showNotification('Có lỗi xảy ra khi thêm bình luận! Chi tiết: ' + error.message, 'error');
    }
});

function createCommentHtml(comment) {
    return `
        <div class="comment-item" id="comment-${comment.id}">
            <div class="comment-header">
                <div class="comment-author-info">
                    <div class="comment-author-avatar">
                        ${comment.user.name.charAt(0).toUpperCase()}
                    </div>
                    <div>
                        <div class="comment-author-name">${comment.user.name}</div>
                        <div class="comment-date">vừa xong</div>
                    </div>
                </div>
            </div>
            <div class="comment-content" id="comment-content-${comment.id}">
                ${comment.content}
            </div>
            <button class="comment-reply-btn" onclick="toggleReplyForm(${comment.id})">
                Trả lời
            </button>
        </div>
    `;
}
</script>
@endsection 