<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredPosts = Post::published()
            ->recent()
            ->take(5)
            ->with(['category', 'tags'])
            ->get();

        $recentPosts = Post::published()
            ->recent()
            ->skip(5)
            ->take(10)
            ->with(['category', 'tags'])
            ->get();

        $popularPosts = Post::published()
            ->popular()
            ->take(5)
            ->with(['category', 'tags'])
            ->get();

        $categories = Category::withCount('publishedPosts')
            ->having('published_posts_count', '>', 0)
            ->take(8)
            ->get();

        $popularTags = Tag::withCount('publishedPosts')
            ->having('published_posts_count', '>', 0)
            ->orderBy('published_posts_count', 'desc')
            ->take(20)
            ->get();

        return view('home', compact(
            'featuredPosts', 
            'recentPosts', 
            'popularPosts', 
            'categories', 
            'popularTags'
        ));
    }
} 