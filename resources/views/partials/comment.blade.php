<div class="comment-item" id="comment-{{ $comment->id }}">
    <div class="comment-header">
        <div class="comment-author-info">
            <div class="comment-author-avatar">
                {{ strtoupper(substr($comment->user->name, 0, 1)) }}
            </div>
            <div>
                <div class="comment-author-name">{{ $comment->user->name }}</div>
                <div class="comment-date">{{ $comment->time_ago }}</div>
            </div>
        </div>
        
        @auth
            @if($comment->canEdit(Auth::user()) || $comment->canDelete(Auth::user()))
                <div class="comment-actions">
                    @if($comment->canEdit(Auth::user()))
                        <button class="comment-action-btn" onclick="editComment({{ $comment->id }})">
                            Chỉnh sửa
                        </button>
                    @endif
                    
                    @if($comment->canDelete(Auth::user()))
                        <button class="comment-action-btn" onclick="deleteComment({{ $comment->id }})">
                            Xóa
                        </button>
                    @endif
                </div>
            @endif
        @endauth
    </div>
    
    <div class="comment-content" id="comment-content-{{ $comment->id }}">
        {{ $comment->content }}
    </div>
    
    <!-- Edit Form (Hidden by default) -->
    <form class="comment-edit-form" id="edit-form-{{ $comment->id }}" style="display: none;" onsubmit="updateComment(event, {{ $comment->id }})">
        @csrf
        @method('PUT')
        <textarea 
            class="comment-textarea" 
            name="content" 
            rows="3" 
            required
        >{{ $comment->content }}</textarea>
        <div class="comment-form-actions">
            <button type="button" class="comment-btn-cancel" onclick="cancelEdit({{ $comment->id }})">Hủy</button>
            <button type="submit" class="comment-btn-submit">Cập nhật</button>
        </div>
    </form>
    
    @auth
        <button class="comment-reply-btn" onclick="toggleReplyForm({{ $comment->id }})">
            Trả lời
        </button>
        
        <!-- Reply Form (Hidden by default) -->
        <form class="comment-form reply-form" id="reply-form-{{ $comment->id }}" style="display: none; margin-top: 15px;" onsubmit="replyToComment(event, {{ $comment->id }})">
            @csrf
            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
            <div class="comment-form-header">
                <div class="comment-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div class="comment-form-info">
                    <strong>{{ Auth::user()->name }}</strong>
                    <div class="comment-form-subtitle">Trả lời {{ $comment->user->name }}</div>
                </div>
            </div>
            <textarea 
                name="content" 
                class="comment-textarea" 
                placeholder="Viết phản hồi của bạn..."
                rows="3"
                required
            ></textarea>
            <div class="comment-form-actions">
                <button type="button" class="comment-btn-cancel" onclick="cancelReply({{ $comment->id }})">Hủy</button>
                <button type="submit" class="comment-btn-submit">Trả lời</button>
            </div>
        </form>
    @endauth
    
    <!-- Replies -->
    @if($comment->replies->count() > 0)
        <div class="comment-replies" id="replies-{{ $comment->id }}">
            @foreach($comment->replies as $reply)
                <div class="comment-reply">
                    <div class="comment-header">
                        <div class="comment-author-info">
                            <div class="comment-author-avatar">
                                {{ strtoupper(substr($reply->user->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="comment-author-name">{{ $reply->user->name }}</div>
                                <div class="comment-date">{{ $reply->time_ago }}</div>
                            </div>
                        </div>
                        
                        @auth
                            @if($reply->canEdit(Auth::user()) || $reply->canDelete(Auth::user()))
                                <div class="comment-actions">
                                    @if($reply->canEdit(Auth::user()))
                                        <button class="comment-action-btn" onclick="editComment({{ $reply->id }})">
                                            Chỉnh sửa
                                        </button>
                                    @endif
                                    
                                    @if($reply->canDelete(Auth::user()))
                                        <button class="comment-action-btn" onclick="deleteComment({{ $reply->id }})">
                                            Xóa
                                        </button>
                                    @endif
                                </div>
                            @endif
                        @endauth
                    </div>
                    
                    <div class="comment-content" id="comment-content-{{ $reply->id }}">
                        {{ $reply->content }}
                    </div>
                    
                    <!-- Edit Form for Reply -->
                    <form class="comment-edit-form" id="edit-form-{{ $reply->id }}" style="display: none;" onsubmit="updateComment(event, {{ $reply->id }})">
                        @csrf
                        @method('PUT')
                        <textarea 
                            class="comment-textarea" 
                            name="content" 
                            rows="3" 
                            required
                        >{{ $reply->content }}</textarea>
                        <div class="comment-form-actions">
                            <button type="button" class="comment-btn-cancel" onclick="cancelEdit({{ $reply->id }})">Hủy</button>
                            <button type="submit" class="comment-btn-submit">Cập nhật</button>
                        </div>
                    </form>
                </div>
            @endforeach
        </div>
    @endif
</div> 