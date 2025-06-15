<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'color',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($tag) {
            if (empty($tag->slug)) {
                $tag->slug = Str::slug($tag->name);
            }
        });
    }

    // Relationships
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tag');
    }

    public function publishedPosts()
    {
        return $this->belongsToMany(Post::class, 'post_tag')
                    ->where('status', 'published');
    }

    // Accessors
    public function getPostsCountAttribute()
    {
        return $this->posts()->count();
    }

    public function getPublishedPostsCountAttribute()
    {
        return $this->publishedPosts()->count();
    }

    // Route key binding
    public function getRouteKeyName()
    {
        return 'slug';
    }
} 