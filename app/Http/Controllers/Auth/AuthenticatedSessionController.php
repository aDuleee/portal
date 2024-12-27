<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Memproses autentikasi pengguna.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Melakukan autentikasi
        $request->authenticate();

        // Regenerasi sesi untuk keamanan
        $request->session()->regenerate();

        // Mendapatkan pengguna yang telah login
        $user = Auth::user();

        // Redirect berdasarkan role pengguna
        if ($user && $user->isAdmin()) { // Periksa apakah admin
            return redirect()->route('admin.dashboard'); // Sesuaikan dengan route admin
        } elseif ($user && $user->isUser()) { // Periksa apakah user
            return redirect()->route('user.dashboard'); // Sesuaikan dengan route user
        }

        // Jika tidak ada role yang cocok, redirect ke halaman default
        return redirect()->intended(route('dashboard'));
    }

    /**
     * Logout pengguna dari sesi aktif.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Logout pengguna
        Auth::guard('web')->logout();

        // Invalidasi sesi
        $request->session()->invalidate();

        // Regenerasi token CSRF
        $request->session()->regenerateToken();

        // Redirect ke halaman utama
        return redirect('/');
    }
}
