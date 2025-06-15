<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'user_id',
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
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->with('user', 'replies');
    }

    public function approvedComments(): HasMany
    {
        return $this->hasMany(Comment::class)->approved()->parent()->with('user', 'replies');
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

    public function getFormattedContentAttribute()
    {
        $content = $this->content;
        // Decode HTML entities if they exist
        $content = html_entity_decode($content, ENT_QUOTES, 'UTF-8');
        // Fix common escaped characters
        $content = str_replace(['&lt;', '&gt;', '&amp;', '&quot;'], ['<', '>', '&', '"'], $content);
        return $content;
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
