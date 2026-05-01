<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Post::published()->latest('published_at');

        if ($request->filled('kategori') && $request->kategori !== 'Semua') {
            $query->where('category', $request->kategori);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $posts = $query->get()->map(fn ($post) => [
            'judul' => $post->title,
            'excerpt' => $post->excerpt ?? strip_tags(substr($post->content, 0, 150)),
            'tanggal' => $post->published_at?->format('Y-m-d'),
            'kategori' => $post->category,
            'gambar' => $post->getFirstMediaUrl('featured_image') ?: 'https://images.unsplash.com/photo-1509062522246-3755977927d7?w=800',
            'slug' => $post->slug,
        ]);

        return view('front.berita.index', compact('posts'));
    }

    public function show($slug)
    {
        $post = Post::published()->where('slug', $slug)->firstOrFail();

        $relatedPosts = Post::published()
            ->where('id', '!=', $post->id)
            ->where(function ($q) use ($post) {
                $q->where('category', $post->category)
                  ->orWhereRaw('1=1');
            })
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('front.berita.show', compact('post', 'relatedPosts'));
    }
}
