<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    // Method untuk menampilkan semua postingan (index)
    public function index()
    {
        $posts = Post::with('user', 'category')->get(); // Include user dan category untuk tampilan lengkap
        return view('posts.index', compact('posts'));
    }

    // Method untuk menampilkan form create
    public function create()
    {
        return view('posts.create');
    }

    // Method untuk menyimpan postingan baru (store)
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->user_id = Auth::id(); // Mengambil ID user yang login
        $post->published_at = $request->published_at; // Opsional

        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }

    // Method untuk menampilkan data postingan (show)
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // Method untuk menampilkan form edit (edit)
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    // Method untuk update postingan (update)
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post->title = $request->title;
        $post->content = $request->content;
        $post->category_id = $request->category_id;
        $post->published_at = $request->published_at; // Opsional

        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
    }

    // Method untuk menghapus postingan (destroy)
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
    }

    // Tambahkan method untuk mengelola like dan dislike
    public function like(Post $post)
    {
        $post->increment('likes');
        return redirect()->back()->with('success', 'Post liked.');
    }

    public function dislike(Post $post)
    {
        $post->increment('dislikes');
        return redirect()->back()->with('success', 'Post disliked.');
    }
}
