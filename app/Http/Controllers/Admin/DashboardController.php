<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Document;
use App\Models\Gallery;
use App\Models\InformationRequest;
use App\Models\Objection;
use App\Models\Post;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik permohonan informasi
        $totalRequests = InformationRequest::count();

        $pendingRequests = InformationRequest::where(
            'status',
            'pending'
        )->count();

        // Statistik pengajuan keberatan
        $totalObjections = Objection::count();

        $pendingObjections = Objection::where(
            'status',
            'pending'
        )->count();

        // Statistik dokumen
        $totalDocuments = Document::count();

        // Statistik berita
        $totalPosts = Post::count();
        $publishedPosts = Post::published()->count();

        // Statistik galeri
        $totalGalleries = Gallery::count();

        // Kontak belum dibaca
        $unreadContacts = Contact::where(
            'is_read',
            false
        )->count();

        // Aktivitas terbaru
        $recentRequests = InformationRequest::latest()
            ->take(5)
            ->get();

        $recentObjections = Objection::latest()
            ->take(5)
            ->get();

        $recentContacts = Contact::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalRequests',
            'pendingRequests',
            'totalObjections',
            'pendingObjections',
            'totalDocuments',
            'totalPosts',
            'publishedPosts',
            'totalGalleries',
            'unreadContacts',
            'recentRequests',
            'recentObjections',
            'recentContacts'
        ));
    }
}
