<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of published posts with search and pagination.
     */
    public function index(Request $request): View
    {
        $search = $request->input('search', $request->input('q'));

        $posts = Post::where('is_published', true)
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%");
            })
            ->latest('published_at')
            ->paginate(12)
            ->withQueryString();

        return view('posts.index', compact('posts'));
    }

    /**
     * Display the specified post, increment view count, and get related posts.
     */
    public function show(string $slug): View
    {
        $post = Post::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        $post->increment('view_count');

        $relatedPosts = Post::where('is_published', true)
            ->where('category', $post->category)
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('posts.show', compact('post', 'relatedPosts'));
    }
}
