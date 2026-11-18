<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of posts.
     */
    public function index(Request $request)
    {
        $query = Post::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        if ($request->filled('status')) {
            $query->where('is_published', $request->input('status') === 'published');
        }

        $posts = $query->latest('created_at')->paginate(15)->withQueryString();

        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new post.
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created post in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'category' => 'required|string|max:100',
            'is_published' => 'nullable|boolean',
            'published_at' => 'nullable|date',
            'author' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
        ]);

        $baseSlug = !empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['title']);
        $slug = $baseSlug;
        $counter = 1;
        while (Post::where('slug', $slug)->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        $isPublished = $request->boolean('is_published');
        $publishedAt = $isPublished
            ? ($request->filled('published_at') ? $request->input('published_at') : now())
            : null;

        $imagePath = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            $imagePath = '/storage/' . $path;
        } elseif ($request->filled('image_url')) {
            $imagePath = $request->input('image_url');
        }

        Post::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'excerpt' => $validated['excerpt'] ?? Str::limit(strip_tags($validated['content']), 150),
            'content' => $validated['content'],
            'image' => $imagePath,
            'category' => $validated['category'],
            'is_published' => $isPublished,
            'published_at' => $publishedAt,
            'author' => !empty($validated['author']) ? $validated['author'] : (Auth::user()->name ?? 'Administrator'),
            'view_count' => 0,
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'Berita berhasil dibuat.');
    }

    /**
     * Display the specified post.
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified post.
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified post in storage.
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'category' => 'required|string|max:100',
            'is_published' => 'nullable|boolean',
            'published_at' => 'nullable|date',
            'author' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
        ]);

        $baseSlug = !empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['title']);
        $slug = $baseSlug;
        $counter = 1;
        while (Post::where('slug', $slug)->where('id', '!=', $post->id)->exists()) {
            $slug = "{$baseSlug}-{$counter}";
            $counter++;
        }

        $isPublished = $request->boolean('is_published');
        $publishedAt = $isPublished
            ? ($request->filled('published_at') ? $request->input('published_at') : ($post->published_at ?? now()))
            : null;

        $data = [
            'title' => $validated['title'],
            'slug' => $slug,
            'excerpt' => $validated['excerpt'] ?? Str::limit(strip_tags($validated['content']), 150),
            'content' => $validated['content'],
            'category' => $validated['category'],
            'is_published' => $isPublished,
            'published_at' => $publishedAt,
            'author' => !empty($validated['author']) ? $validated['author'] : ($post->author ?: (Auth::user()->name ?? 'Administrator')),
        ];

        if ($request->hasFile('image')) {
            if (!empty($post->image)) {
                $oldPath = ltrim(str_replace('/storage/', '', $post->image), '/');
                $oldPath = preg_replace('#^storage/#', '', $oldPath);
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
            $path = $request->file('image')->store('posts', 'public');
            $data['image'] = '/storage/' . $path;
        } elseif ($request->filled('image_url')) {
            $data['image'] = $request->input('image_url');
        }

        $post->update($data);

        return redirect()->route('admin.posts.index')->with('success', 'Berita berhasil diperbarui.');
    }

    /**
     * Remove the specified post from storage.
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if (!empty($post->image)) {
            $oldPath = ltrim(str_replace('/storage/', '', $post->image), '/');
            $oldPath = preg_replace('#^storage/#', '', $oldPath);
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'Berita berhasil dihapus.');
    }
}
