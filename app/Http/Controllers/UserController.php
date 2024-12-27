<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:user']);
    }

    public function index()
    {
        $posts = Post::whereNotNull('published_at')->latest()->paginate(10);
        return view('user.dashboard', compact('posts'));
    }

    public function show($id)
    {
        try {
            $post = Post::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return redirect()->route('user.dashboard')->with('error', 'Post not found');
        }
        return view('user.post', compact('post'));
    }

    public function respond(Request $request, $id)
    {
        $request->validate(['response' => 'required|in:like,dislike']);
        try {
            $post = Post::findOrFail($id);
            if ($request->response === 'like') {
                $post->increment('likes');
            } else {
                $post->increment('dislikes');
            }
            return back()->with('success', 'Thank you for your feedback!');
        } catch (ModelNotFoundException $e) {
            return back()->with('error', 'Post not found');
        }
    }
}
