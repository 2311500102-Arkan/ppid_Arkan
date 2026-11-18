<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    /**
     * Display a listing of documents.
     */
    public function index(Request $request)
    {
        $query = Document::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        if ($request->filled('year')) {
            $query->where('year', $request->input('year'));
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->input('status') === 'active');
        }

        $documents = $query->latest('created_at')->paginate(15)->withQueryString();

        $categories = [
            'berkala' => 'Informasi Berkala',
            'serta-merta' => 'Informasi Serta Merta',
            'setiap-saat' => 'Informasi Setiap Saat',
        ];

        return view('admin.documents.index', compact('documents', 'categories'));
    }

    /**
     * Show the form for creating a new document.
     */
    public function create()
    {
        $categories = [
            'berkala' => 'Informasi Berkala',
            'serta-merta' => 'Informasi Serta Merta',
            'setiap-saat' => 'Informasi Setiap Saat',
        ];

        return view('admin.documents.create', compact('categories'));
    }

    /**
     * Store a newly created document in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:berkala,serta-merta,setiap-saat',
            'year' => 'nullable|integer|min:1900|max:2100',
            'is_active' => 'nullable|boolean',
            'file_path' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:51200',
        ]);

        $filePath = $request->file('file_path')->store('documents', 'public');

        Document::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'category' => $validated['category'],
            'year' => $validated['year'] ?? date('Y'),
            'file_path' => $filePath,
            'is_active' => $request->boolean('is_active', true),
            'download_count' => 0,
        ]);

        return redirect()->route('admin.documents.index')->with('success', 'Dokumen publik berhasil ditambahkan.');
    }

    /**
     * Display the specified document.
     */
    public function show($id)
    {
        $document = Document::findOrFail($id);
        return view('admin.documents.show', compact('document'));
    }

    /**
     * Show the form for editing the specified document.
     */
    public function edit($id)
    {
        $document = Document::findOrFail($id);
        $categories = [
            'berkala' => 'Informasi Berkala',
            'serta-merta' => 'Informasi Serta Merta',
            'setiap-saat' => 'Informasi Setiap Saat',
        ];

        return view('admin.documents.edit', compact('document', 'categories'));
    }

    /**
     * Update the specified document in storage.
     */
    public function update(Request $request, $id)
    {
        $document = Document::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|in:berkala,serta-merta,setiap-saat',
            'year' => 'nullable|integer|min:1900|max:2100',
            'is_active' => 'nullable|boolean',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,rar|max:51200',
        ]);

        $data = [
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'category' => $validated['category'],
            'year' => $validated['year'] ?? $document->year,
            'is_active' => $request->boolean('is_active'),
        ];

        if ($request->hasFile('file_path')) {
            if (!empty($document->file_path)) {
                $cleanPath = ltrim(str_replace('/storage/', '', $document->file_path), '/');
                $cleanPath = preg_replace('#^storage/#', '', $cleanPath);
                if (Storage::disk('public')->exists($cleanPath)) {
                    Storage::disk('public')->delete($cleanPath);
                }
            }
            $data['file_path'] = $request->file('file_path')->store('documents', 'public');
        }

        $document->update($data);

        return redirect()->route('admin.documents.index')->with('success', 'Dokumen publik berhasil diperbarui.');
    }

    /**
     * Remove the specified document from storage.
     */
    public function destroy($id)
    {
        $document = Document::findOrFail($id);

        if (!empty($document->file_path)) {
            $cleanPath = ltrim(str_replace('/storage/', '', $document->file_path), '/');
            $cleanPath = preg_replace('#^storage/#', '', $cleanPath);
            if (Storage::disk('public')->exists($cleanPath)) {
                Storage::disk('public')->delete($cleanPath);
            }
        }

        $document->delete();

        return redirect()->route('admin.documents.index')->with('success', 'Dokumen berhasil dihapus.');
    }
}
