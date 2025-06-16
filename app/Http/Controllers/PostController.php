<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Services\PostService;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
        $this->middleware('auth')->except(['index', 'show', 'byCategory', 'byTag', 'search']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::published()
            ->recent()
            ->with(['category', 'tags'])
            ->paginate(12);

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        
        return view('posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $this->validatePostRequest($request);

        try {
            $post = $this->postService->createPost($validated, auth()->user());
            
            return redirect()->route('posts.show', $post)
                ->with('success', 'Bài viết đã được tạo thành công!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Có lỗi xảy ra khi tạo bài viết: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // Load relationships
        $post->load(['user', 'category', 'tags', 'approvedComments.user', 'approvedComments.replies.user']);
        
        // Increment view count
        $this->postService->incrementViews($post);

        // Get related posts
        $relatedPosts = $this->getRelatedPosts($post);

        return view('posts.show', compact('post', 'relatedPosts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        
        $categories = Category::all();
        $tags = Tag::all();
        
        return view('posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);
        
        $validated = $this->validatePostRequest($request);

        try {
            $post = $this->postService->updatePost($post, $validated);
            
            return redirect()->route('posts.show', $post)
                ->with('success', 'Bài viết đã được cập nhật thành công!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Có lỗi xảy ra khi cập nhật bài viết: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        try {
            $this->postService->deletePost($post);
            
            return redirect()->route('posts.index')
                ->with('success', 'Bài viết đã được xóa thành công!');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Có lỗi xảy ra khi xóa bài viết: ' . $e->getMessage());
        }
    }

    /**
     * Posts by category
     */
    public function byCategory(Category $category)
    {
        $posts = $category->publishedPosts()
            ->recent()
            ->with(['category', 'tags'])
            ->paginate(12);

        return view('posts.by-category', compact('posts', 'category'));
    }

    /**
     * Posts by tag
     */
    public function byTag(Tag $tag)
    {
        $posts = $tag->publishedPosts()
            ->recent()
            ->with(['category', 'tags'])
            ->paginate(12);

        return view('posts.by-tag', compact('posts', 'tag'));
    }

    /**
     * Search posts
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        
        if (empty($query)) {
            return redirect()->route('posts.index');
        }

        $filters = [
            'search' => $query,
            'per_page' => 12
        ];

        $posts = $this->postService->getFilteredPosts($filters);

        return view('posts.search', compact('posts', 'query'));
    }

    /**
     * User's posts
     */
    public function myPosts()
    {
        $posts = auth()->user()->posts()
            ->with(['category', 'tags'])
            ->latest()
            ->paginate(12);

        return view('posts.my-posts', compact('posts'));
    }

    /**
     * Validate post request
     */
    private function validatePostRequest(Request $request): array
    {
        return $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'status' => 'required|in:draft,published',
        ]);
    }

    /**
     * Get related posts
     */
    private function getRelatedPosts(Post $post): \Illuminate\Database\Eloquent\Collection
    {
        return Post::published()
            ->where('id', '!=', $post->id)
            ->where(function($query) use ($post) {
                if ($post->category_id) {
                    $query->where('category_id', $post->category_id);
                }
                if ($post->tags->count() > 0) {
                    $query->orWhereHas('tags', function($q) use ($post) {
                        $q->whereIn('tags.id', $post->tags->pluck('id'));
                    });
                }
            })
            ->with(['user', 'category'])
            ->take(4)
            ->get();
    }
}
