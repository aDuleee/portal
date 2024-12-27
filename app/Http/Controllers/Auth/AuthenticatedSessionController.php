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
        // Melakukan autentikasi pengguna
        $request->authenticate();

        // Regenerasi sesi untuk keamanan
        $request->session()->regenerate();

        // Mendapatkan pengguna yang telah login
        $user = Auth::user();

        // Periksa apakah pengguna valid
        if (!$user) {
            return redirect()->route('login')->with('error', 'Gagal masuk. Silakan coba lagi.');
        }

        // Redirect berdasarkan role pengguna
        if ($user->isAdmin()) { 
            return redirect()->route('admin.dashboard'); // Redirect ke admin dashboard
        } elseif ($user->isUser()) { 
            return redirect()->route('user.dashboard'); // Redirect ke user dashboard
        }

        // Jika role tidak dikenali, logout dan tampilkan error
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('login')->with('error', 'Role tidak valid. Silakan hubungi administrator.');
    }

    /**
     * Logout pengguna dari sesi aktif.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Logout pengguna
        Auth::guard('web')->logout();

        // Invalidasi sesi untuk keamanan
        $request->session()->invalidate();

        // Regenerasi token CSRF
        $request->session()->regenerateToken();

        // Redirect ke halaman utama
        return redirect('/')->with('status', 'Anda telah keluar.');
    }
}
