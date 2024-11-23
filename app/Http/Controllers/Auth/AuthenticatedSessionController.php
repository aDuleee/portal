<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = Auth::user(); // Mendapatkan user yang baru saja login
        

        // Redirect berdasarkan role pengguna
        if ($user->isAdmin()) { // Ganti hasRole dengan isAdmin
            return redirect()->route('admin.dashboard'); // Sesuaikan dengan route admin
        } elseif ($user->isUser()) { // Ganti hasRole dengan isUser
            return redirect()->route('user.dashboard'); // Sesuaikan dengan route user
        }

        // Jika tidak ada role yang sesuai, redirect ke dashboard default
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
