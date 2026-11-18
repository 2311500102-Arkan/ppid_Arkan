<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\View\View;

class GalleryController extends Controller
{
    /**
     * Display a listing of active galleries with pagination.
     */
    public function index(): View
    {
        $galleries = Gallery::where('is_active', true)
            ->orderBy('order')
            ->latest()
            ->paginate(12);

        return view('gallery.index', compact('galleries'));
    }
}
