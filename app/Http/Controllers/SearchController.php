<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\Page;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    /**
     * Search across posts, pages, and documents.
     */
    public function index(Request $request): View
    {
        $query = $request->get('q', $request->get('search'));

        if (!empty($query)) {
            $posts = Post::where('is_published', true)
                ->where(function ($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                      ->orWhere('content', 'like', "%{$query}%");
                })
                ->latest('published_at')
                ->get();

            $pages = Page::where('is_active', true)
                ->where(function ($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                      ->orWhere('content', 'like', "%{$query}%");
                })
                ->get();

            $documents = Document::where('is_active', true)
                ->where(function ($q) use ($query) {
                    $q->where('title', 'like', "%{$query}%")
                      ->orWhere('description', 'like', "%{$query}%");
                })
                ->latest()
                ->get();
        } else {
            $posts = collect();
            $pages = collect();
            $documents = collect();
        }

        return view('search', compact('query', 'posts', 'pages', 'documents'));
    }
}
