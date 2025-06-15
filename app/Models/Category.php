<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'color',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    // Relationships
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function publishedPosts()
    {
        return $this->hasMany(Post::class)->where('status', 'published');
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