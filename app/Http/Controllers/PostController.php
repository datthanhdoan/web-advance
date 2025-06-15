<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function __construct()
    {
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
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'status' => 'required|in:draft,published',
        ]);

        // Upload featured image
        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('posts', 'public');
            $validated['featured_image'] = $imagePath;
        }

        // Set published_at if publishing
        if ($validated['status'] === 'published') {
            $validated['published_at'] = now();
        }

        // Add user_id
        $validated['user_id'] = auth()->id();

        $post = Post::create($validated);

        // Attach tags
        if (isset($validated['tags'])) {
            $post->tags()->attach($validated['tags']);
        }

        return redirect()->route('posts.show', $post)
            ->with('success', 'Bài viết đã được tạo thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // Load relationships
        $post->load(['user', 'category', 'tags', 'approvedComments.user', 'approvedComments.replies.user']);
        
        // Tăng view count
        $post->incrementViews();

        // Related posts
        $relatedPosts = Post::published()
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

        return view('posts.show', compact('post', 'relatedPosts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        
        return view('posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'nullable|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'status' => 'required|in:draft,published',
        ]);

        // Upload new featured image
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($post->featured_image) {
                \Storage::disk('public')->delete($post->featured_image);
            }
            
            $imagePath = $request->file('featured_image')->store('posts', 'public');
            $validated['featured_image'] = $imagePath;
        }

        // Set published_at if publishing for first time
        if ($validated['status'] === 'published' && $post->status !== 'published') {
            $validated['published_at'] = now();
        }

        $post->update($validated);

        // Sync tags
        if (isset($validated['tags'])) {
            $post->tags()->sync($validated['tags']);
        } else {
            $post->tags()->detach();
        }

        return redirect()->route('posts.show', $post)
            ->with('success', 'Bài viết đã được cập nhật thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Delete featured image if exists
        if ($post->featured_image) {
            \Storage::disk('public')->delete($post->featured_image);
        }

        // Delete post (tags will be detached automatically due to cascade)
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Bài viết đã được xóa thành công!');
    }

    public function byCategory(Category $category)
    {
        $posts = $category->publishedPosts()
            ->recent()
            ->with(['category', 'tags'])
            ->paginate(12);

        return view('posts.by-category', compact('posts', 'category'));
    }

    public function byTag(Tag $tag)
    {
        $posts = $tag->publishedPosts()
            ->recent()
            ->with(['category', 'tags'])
            ->paginate(12);

        return view('posts.by-tag', compact('posts', 'tag'));
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        
        if (empty($query)) {
            return redirect()->route('posts.index');
        }

        $posts = Post::published()
            ->where(function($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                  ->orWhere('content', 'LIKE', "%{$query}%")
                  ->orWhere('excerpt', 'LIKE', "%{$query}%");
            })
            ->orWhereHas('category', function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
            ->orWhereHas('tags', function($q) use ($query) {
                $q->where('name', 'LIKE', "%{$query}%");
            })
            ->with(['category', 'tags'])
            ->recent()
            ->paginate(12);

        return view('posts.search', compact('posts', 'query'));
    }

    /**
     * Display user's posts
     */
    public function myPosts()
    {
        $posts = Post::where('user_id', auth()->id())
            ->with(['category', 'tags'])
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('posts.my-posts', compact('posts'));
    }
}
