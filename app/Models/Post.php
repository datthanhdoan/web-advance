<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'status',
        'published_at',
        'read_time',
        'views',
        'category_id',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
            
            // Auto calculate read time (assuming 200 words per minute)
            if (empty($post->read_time) && !empty($post->content)) {
                $wordCount = str_word_count(strip_tags($post->content));
                $post->read_time = max(1, ceil($wordCount / 200));
            }
            
            // Auto generate excerpt if empty
            if (empty($post->excerpt) && !empty($post->content)) {
                $post->excerpt = Str::limit(strip_tags($post->content), 200);
            }
        });

        static::updating(function ($post) {
            // Auto calculate read time
            if (!empty($post->content)) {
                $wordCount = str_word_count(strip_tags($post->content));
                $post->read_time = max(1, ceil($wordCount / 200));
            }
            
            // Auto generate excerpt if empty
            if (empty($post->excerpt) && !empty($post->content)) {
                $post->excerpt = Str::limit(strip_tags($post->content), 200);
            }
        });
    }

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->where('published_at', '<=', now());
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('published_at', 'desc');
    }

    public function scopePopular($query)
    {
        return $query->orderBy('views', 'desc');
    }

    // Accessors
    public function getIsPublishedAttribute()
    {
        return $this->status === 'published' && $this->published_at <= now();
    }

    public function getPublishedDateAttribute()
    {
        return $this->published_at ? $this->published_at->format('M j, Y') : null;
    }

    public function getReadTimeTextAttribute()
    {
        return $this->read_time . ' min read';
    }

    // Methods
    public function incrementViews()
    {
        $this->increment('views');
    }

    public function publish()
    {
        $this->update([
            'status' => 'published',
            'published_at' => now(),
        ]);
    }

    public function unpublish()
    {
        $this->update([
            'status' => 'draft',
        ]);
    }

    // Route key binding
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
