<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostService
{
    /**
     * Create a new post
     */
    public function createPost(array $data, User $user): Post
    {
        // Handle featured image upload
        if (isset($data['featured_image']) && $data['featured_image'] instanceof UploadedFile) {
            $data['featured_image'] = $this->handleImageUpload($data['featured_image']);
        }

        // Set user and prepare data
        $data['user_id'] = $user->id;
        $data = $this->preparePostData($data);

        // Create post
        $post = Post::create($data);

        // Attach tags if provided
        if (isset($data['tags']) && is_array($data['tags'])) {
            $post->tags()->attach($data['tags']);
        }

        return $post;
    }

    /**
     * Update an existing post
     */
    public function updatePost(Post $post, array $data): Post
    {
        // Handle featured image upload
        if (isset($data['featured_image']) && $data['featured_image'] instanceof UploadedFile) {
            // Delete old image if exists
            if ($post->featured_image && Storage::disk('public')->exists($post->featured_image)) {
                Storage::disk('public')->delete($post->featured_image);
            }
            
            $data['featured_image'] = $this->handleImageUpload($data['featured_image']);
        }

        // Prepare data
        $data = $this->preparePostData($data, $post);

        // Update post
        $post->update($data);

        // Sync tags
        if (isset($data['tags']) && is_array($data['tags'])) {
            $post->tags()->sync($data['tags']);
        } else {
            $post->tags()->detach();
        }

        return $post->fresh();
    }

    /**
     * Delete a post
     */
    public function deletePost(Post $post): bool
    {
        // Delete featured image if exists
        if ($post->featured_image && Storage::disk('public')->exists($post->featured_image)) {
            Storage::disk('public')->delete($post->featured_image);
        }

        return $post->delete();
    }

    /**
     * Increment post views
     */
    public function incrementViews(Post $post): void
    {
        $post->incrementViews();
    }

    /**
     * Get filtered posts
     */
    public function getFilteredPosts(array $filters)
    {
        $query = Post::published()->with(['user', 'category', 'tags']);

        // Search filter
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('content', 'LIKE', "%{$search}%")
                  ->orWhere('excerpt', 'LIKE', "%{$search}%");
            });
        }

        // Category filter
        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        // Tag filter
        if (!empty($filters['tag_id'])) {
            $query->whereHas('tags', function($q) use ($filters) {
                $q->where('tags.id', $filters['tag_id']);
            });
        }

        // Sort
        $sortBy = $filters['sort'] ?? 'recent';
        switch ($sortBy) {
            case 'popular':
                $query->popular();
                break;
            case 'recent':
            default:
                $query->recent();
                break;
        }

        $perPage = $filters['per_page'] ?? 12;
        return $query->paginate($perPage);
    }

    /**
     * Handle image upload
     */
    private function handleImageUpload(UploadedFile $file): string
    {
        // Validate file
        $this->validateImage($file);

        // Generate unique filename
        $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

        // Store file
        return $file->storeAs('posts', $filename, 'public');
    }

    /**
     * Validate uploaded image
     */
    private function validateImage(UploadedFile $file): void
    {
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        $maxSize = 2 * 1024 * 1024; // 2MB

        if (!in_array($file->getMimeType(), $allowedTypes)) {
            throw new \InvalidArgumentException('File type not allowed.');
        }

        if ($file->getSize() > $maxSize) {
            throw new \InvalidArgumentException('File size too large.');
        }
    }

    /**
     * Prepare post data before saving
     */
    private function preparePostData(array $data, ?Post $post = null): array
    {
        // Set published_at if publishing
        if (isset($data['status']) && $data['status'] === 'published') {
            if (!$post || $post->status !== 'published') {
                $data['published_at'] = now();
            }
        }

        return $data;
    }
}
 