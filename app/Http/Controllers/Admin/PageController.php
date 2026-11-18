<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of pages.
     */
    public function index(Request $request)
    {
        $query = Page::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%{$search}%");
        }

        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->input('status') === 'active');
        }

        $pages = $query->orderBy('category')->orderBy('order')->paginate(15)->withQueryString();

        $categories = [
            'profil-pemerintah' => 'Profil Pemerintah',
            'profil-ppid' => 'Profil PPID',
            'layanan' => 'Layanan Informasi',
            'laporan-pemda' => 'Laporan Pemda',
            'laporan-ppid' => 'Laporan PPID',
        ];

        return view('admin.pages.index', compact('pages', 'categories'));
    }

    /**
     * Show the form for creating a new page.
     */
    public function create()
    {
        $categories = [
            'profil-pemerintah' => 'Profil Pemerintah',
            'profil-ppid' => 'Profil PPID',
            'layanan' => 'Layanan Informasi',
            'laporan-pemda' => 'Laporan Pemda',
            'laporan-ppid' => 'Laporan PPID',
        ];

        return view('admin.pages.create', compact('categories'));
    }

    /**
     * Store a newly created page in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:profil-pemerintah,profil-ppid,layanan,laporan-pemda,laporan-ppid',
            'is_active' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        $baseSlug = !empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['title']);
        $slug = $baseSlug;
        $counter = 1;
        while (Page::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        Page::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'content' => $validated['content'],
            'category' => $validated['category'],
            'is_active' => $request->boolean('is_active', true),
            'order' => $validated['order'] ?? 0,
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Halaman berhasil dibuat.');
    }

    /**
     * Display the specified page.
     */
    public function show($id)
    {
        $page = Page::findOrFail($id);
        return view('admin.pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified page.
     */
    public function edit($id)
    {
        $page = Page::findOrFail($id);
        $categories = [
            'profil-pemerintah' => 'Profil Pemerintah',
            'profil-ppid' => 'Profil PPID',
            'layanan' => 'Layanan Informasi',
            'laporan-pemda' => 'Laporan Pemda',
            'laporan-ppid' => 'Laporan PPID',
        ];

        return view('admin.pages.edit', compact('page', 'categories'));
    }

    /**
     * Update the specified page in storage.
     */
    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'content' => 'required|string',
            'category' => 'required|in:profil-pemerintah,profil-ppid,layanan,laporan-pemda,laporan-ppid',
            'is_active' => 'nullable|boolean',
            'order' => 'nullable|integer',
        ]);

        $baseSlug = !empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['title']);
        $slug = $baseSlug;
        $counter = 1;
        while (Page::where('slug', $slug)->where('id', '!=', $page->id)->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        $page->update([
            'title' => $validated['title'],
            'slug' => $slug,
            'content' => $validated['content'],
            'category' => $validated['category'],
            'is_active' => $request->boolean('is_active'),
            'order' => $validated['order'] ?? $page->order,
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Halaman berhasil diperbarui.');
    }

    /**
     * Remove the specified page from storage.
     */
    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        $page->delete();

        return redirect()->route('admin.pages.index')->with('success', 'Halaman berhasil dihapus.');
    }
}
