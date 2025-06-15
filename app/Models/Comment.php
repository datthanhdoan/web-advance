<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
        'post_id',
        'parent_id',
    ];

    /**
     * Lấy người dùng đã bình luận.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Lấy bài viết mà bình luận này thuộc về.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Nếu có bình luận lồng nhau, lấy bình luận cha.
     */
    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    /**
     * Nếu có bình luận lồng nhau, lấy các bình luận con (trả lời).
     */
    public function replies()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
