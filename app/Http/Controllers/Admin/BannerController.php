<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of banners.
     */
    public function index(Request $request)
    {
        $query = Banner::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('subtitle', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->input('status') === 'active');
        }

        $banners = $query->orderBy('order')->latest('created_at')->paginate(15)->withQueryString();

        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new banner.
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Store a newly created banner in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'link' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
            'order' => 'nullable|integer',
            'image' => 'required_without:image_url|nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'image_url' => 'nullable|string|max:255',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('banners', 'public');
            $imagePath = '/storage/' . $path;
        } elseif ($request->filled('image_url')) {
            $imagePath = $request->input('image_url');
        }

        Banner::create([
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'] ?? null,
            'image' => $imagePath,
            'link' => $validated['link'] ?? null,
            'is_active' => $request->boolean('is_active', true),
            'order' => $validated['order'] ?? 0,
        ]);

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil ditambahkan.');
    }

    /**
     * Display the specified banner.
     */
    public function show($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banners.show', compact('banner'));
    }

    /**
     * Show the form for editing the specified banner.
     */
    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banners.edit', compact('banner'));
    }

    /**
     * Update the specified banner in storage.
     */
    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'link' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
            'order' => 'nullable|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
            'image_url' => 'nullable|string|max:255',
        ]);

        $data = [
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'] ?? null,
            'link' => $validated['link'] ?? null,
            'is_active' => $request->boolean('is_active'),
            'order' => $validated['order'] ?? $banner->order,
        ];

        if ($request->hasFile('image')) {
            if (!empty($banner->image)) {
                $oldPath = ltrim(str_replace('/storage/', '', $banner->image), '/');
                $oldPath = preg_replace('#^storage/#', '', $oldPath);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
            $path = $request->file('image')->store('banners', 'public');
            $data['image'] = '/storage/' . $path;
        } elseif ($request->filled('image_url')) {
            $data['image'] = $request->input('image_url');
        }

        $banner->update($data);

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil diperbarui.');
    }

    /**
     * Remove the specified banner from storage.
     */
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);

        if (!empty($banner->image)) {
            $oldPath = ltrim(str_replace('/storage/', '', $banner->image), '/');
            $oldPath = preg_replace('#^storage/#', '', $oldPath);
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        $banner->delete();

        return redirect()->route('admin.banners.index')->with('success', 'Banner berhasil dihapus.');
    }
}
