<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Document;
use App\Models\Post;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the PPID homepage with banners, latest news, and document stats.
     */
    public function index(): View
    {
        $banners = Banner::where('is_active', true)
            ->orderBy('order')
            ->get();

        $latestPosts = Post::where('is_published', true)
            ->latest('published_at')
            ->take(6)
            ->get();

        $berkalaCount = Document::where('category', 'berkala')
            ->where('is_active', true)
            ->count();

        $sertaMertaCount = Document::where('category', 'serta-merta')
            ->where('is_active', true)
            ->count();

        $setiapSaatCount = Document::where('category', 'setiap-saat')
            ->where('is_active', true)
            ->count();

        return view('home', compact(
            'banners',
            'latestPosts',
            'berkalaCount',
            'sertaMertaCount',
            'setiapSaatCount'
        ));
    }
}
