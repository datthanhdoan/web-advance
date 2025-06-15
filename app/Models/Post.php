<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
    ];

    public function claps()
    {
        return $this->hasMany(Clap::class);
    }

    public function isClappedByUser(?User $user = null)
    {
        if (! $user) {
            $user = auth()->user();
        }
        if (! $user) {
            return false;
        }

        return $this->claps()->where('user_id', $user->id)->exists();
    }
    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id')->with('replies'); // Lấy bình luận gốc và các trả lời
    }
}
