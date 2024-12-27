<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function dashboard()
    {
        $posts = Post::latest()->paginate(10);
        return view('admin.dashboard', compact('posts'));
    }

    public function createPost()
    {
        $categories = Category::all();
        return view('admin.create', compact('categories'));
    }

    public function storePost(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'published_at' => 'nullable|date',
        ]);

        $post = new Post();
        $post->fill($request->all());
        $post->save();

        return redirect()->route('admin.dashboard')->with('success', 'Post created successfully');
    }
}
