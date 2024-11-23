<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class UserController extends Controller
{
    /**
     * Halaman Dashboard User
     */
    public function index()
    {
        // Menampilkan daftar berita yang dipublikasikan
        $posts = Post::whereNotNull('published_at')
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        return view('user.dashboard', compact('posts'));
    }

    /**
     * Halaman Detail Postingan
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);

        // Menampilkan detail postingan
        return view('user.post', compact('post'));
    }

    /**
     * Memberi Respon Positif atau Negatif pada Berita
     */
    public function respond(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        // Memeriksa apakah pengguna memberikan respons positif atau negatif
        if ($request->response === 'like') {
            $post->likes += 1;
        } elseif ($request->response === 'dislike') {
            $post->dislikes += 1;
        }

        $post->save();

        return redirect()->back()->with('success', 'Terima kasih atas tanggapan Anda!');
    }
}
