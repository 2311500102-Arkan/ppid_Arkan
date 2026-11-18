<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class DocumentController extends Controller
{
    /**
     * Display a listing of active documents with filters and pagination.
     */
    public function index(Request $request): View
    {
        $category = $request->query('category', $request->query('kategori'));
        $year = $request->query('year', $request->query('tahun'));
        $search = $request->query('search', $request->query('q'));

        $query = Document::where('is_active', true);

        if (!empty($category)) {
            // Support both direct and alias categories
            $catMap = [
                'lkpd' => 'berkala',
                'lppd' => 'berkala',
                'laporan-ppid' => 'setiap-saat',
            ];
            $targetCategory = $catMap[$category] ?? $category;

            $query->where(function($q) use ($targetCategory, $category) {
                $q->where('category', $targetCategory);
                if (in_array($category, ['lkpd', 'lppd', 'laporan-ppid'])) {
                    $q->orWhere('title', 'like', "%{$category}%");
                }
            });
        }

        if (!empty($year)) {
            $query->where('year', $year);
        }

        if (!empty($search)) {
            $query->where('title', 'like', "%{$search}%");
        }

        $documents = $query->latest()->paginate(15)->withQueryString();

        $categories = [
            'berkala' => 'Informasi Berkala',
            'serta-merta' => 'Informasi Serta Merta',
            'setiap-saat' => 'Informasi Setiap Saat',
        ];

        $years = Document::where('is_active', true)
            ->whereNotNull('year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('documents.index', compact('documents', 'categories', 'years'));
    }

    /**
     * Download the specified document file and increment download counter.
     */
    public function download($id)
    {
        $document = Document::where('is_active', true)->findOrFail($id);

        $document->increment('download_count');

        if (!empty($document->file_path)) {
            // Check public storage disk
            if (Storage::disk('public')->exists($document->file_path)) {
                $extension = pathinfo($document->file_path, PATHINFO_EXTENSION);
                $fileName = $extension ? $document->title . '.' . $extension : $document->title;
                return Storage::disk('public')->download($document->file_path, $fileName);
            }

            // Check default storage disk
            if (Storage::exists($document->file_path)) {
                $extension = pathinfo($document->file_path, PATHINFO_EXTENSION);
                $fileName = $extension ? $document->title . '.' . $extension : $document->title;
                return Storage::download($document->file_path, $fileName);
            }

            // Check directly in public folder
            $publicFilePath = public_path($document->file_path);
            if (file_exists($publicFilePath)) {
                return response()->download($publicFilePath);
            }
        }

        abort(404, 'File dokumen tidak ditemukan.');
    }
}
