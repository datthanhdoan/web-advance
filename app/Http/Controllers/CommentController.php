<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Store a newly created comment.
     */
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:comments,id',
        ]);

        $comment = $post->comments()->create([
            'user_id' => Auth::id(),
            'parent_id' => $request->parent_id,
            'content' => $request->content,
            'is_approved' => true,
        ]);

        $comment->load('user', 'replies');

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'comment' => $comment,
                'message' => 'Bình luận đã được thêm thành công!',
            ]);
        }

        return redirect()->back()->with('success', 'Bình luận đã được thêm thành công!');
    }

    /**
     * Update the specified comment.
     */
    public function update(Request $request, Comment $comment)
    {
        if (! $comment->canEdit(Auth::user())) {
            if ($request->ajax()) {
                return response()->json(['error' => 'Bạn không có quyền chỉnh sửa bình luận này.'], 403);
            }

            return redirect()->back()->with('error', 'Bạn không có quyền chỉnh sửa bình luận này.');
        }

        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment->update([
            'content' => $request->content,
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'comment' => $comment,
                'message' => 'Bình luận đã được cập nhật!',
            ]);
        }

        return redirect()->back()->with('success', 'Bình luận đã được cập nhật!');
    }

    /**
     * Remove the specified comment.
     */
    public function destroy(Request $request, Comment $comment)
    {
        if (! $comment->canDelete(Auth::user())) {
            if ($request->ajax()) {
                return response()->json(['error' => 'Bạn không có quyền xóa bình luận này.'], 403);
            }

            return redirect()->back()->with('error', 'Bạn không có quyền xóa bình luận này.');
        }

        $comment->delete();

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Bình luận đã được xóa!',
            ]);
        }

        return redirect()->back()->with('success', 'Bình luận đã được xóa!');
    }

    /**
     * Get comments for a post (AJAX).
     */
    public function getComments(Post $post)
    {
        $comments = $post->approvedComments()
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'comments' => $comments,
            'count' => $comments->count(),
        ]);
    }
}
