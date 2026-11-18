<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of galleries.
     */
    public function index(Request $request)
    {
        $query = Gallery::query();

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

        if ($request->filled('status')) {
            $query->where('is_active', $request->input('status') === 'active');
        }

        $galleries = $query->orderBy('order')->latest('created_at')->paginate(15)->withQueryString();

        return view('admin.galleries.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new gallery item.
     */
    public function create()
    {
        return view('admin.galleries.create');
    }

    /**
     * Store a newly created gallery item in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'is_active' => 'nullable|boolean',
            'order' => 'nullable|integer',
            'image' => 'required_without:image_url|nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'image_url' => 'nullable|string|max:255',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('galleries', 'public');
            $imagePath = '/storage/' . $path;
        } elseif ($request->filled('image_url')) {
            $imagePath = $request->input('image_url');
        }

        Gallery::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'image' => $imagePath,
            'category' => $validated['category'] ?? 'kegiatan',
            'is_active' => $request->boolean('is_active', true),
            'order' => $validated['order'] ?? 0,
        ]);

        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    /**
     * Display the specified gallery item.
     */
    public function show($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('admin.galleries.show', compact('gallery'));
    }

    /**
     * Show the form for editing the specified gallery item.
     */
    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        return view('admin.galleries.edit', compact('gallery'));
    }

    /**
     * Update the specified gallery item in storage.
     */
    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'is_active' => 'nullable|boolean',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'image_url' => 'nullable|string|max:255',
        ]);

        $data = [
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'category' => $validated['category'] ?? $gallery->category,
            'is_active' => $request->boolean('is_active'),
            'order' => $validated['order'] ?? $gallery->order,
        ];

        if ($request->hasFile('image')) {
            if (!empty($gallery->image)) {
                $oldPath = ltrim(str_replace('/storage/', '', $gallery->image), '/');
                $oldPath = preg_replace('#^storage/#', '', $oldPath);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
            $path = $request->file('image')->store('galleries', 'public');
            $data['image'] = '/storage/' . $path;
        } elseif ($request->filled('image_url')) {
            $data['image'] = $request->input('image_url');
        }

        $gallery->update($data);

        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    /**
     * Remove the specified gallery item from storage.
     */
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        if (!empty($gallery->image)) {
            $oldPath = ltrim(str_replace('/storage/', '', $gallery->image), '/');
            $oldPath = preg_replace('#^storage/#', '', $oldPath);
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        $gallery->delete();

        return redirect()->route('admin.galleries.index')->with('success', 'Galeri berhasil dihapus.');
    }
}
