<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

// Rute dengan middleware untuk user
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/user/posts/{id}', [UserController::class, 'show'])->name('user.post');
    Route::post('/user/posts/{id}/respond', [UserController::class, 'respond'])->name('user.post.respond');
});

// Rute dengan middleware untuk admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

// Redirect ke login page secara default
Route::get('/', function () {
    return redirect()->route('login');
});

// Redirect berdasarkan role setelah login
Route::get('/dashboard', function () {
    $user = auth()->user();

    if (!$user) {
        return redirect('/login')->with('error', 'Anda belum login.');
    }

    if ($user->isAdmin()) {
        return redirect()->route('admin.dashboard'); // Redirect ke route admin
    } elseif ($user->isUser()) {
        return redirect()->route('user.dashboard'); // Redirect ke route user
    }

    return view('dashboard'); // Default jika tidak ada role yang sesuai
})->middleware(['auth', 'verified'])->name('dashboard');

// Rute untuk profile pengguna
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute autentikasi
require __DIR__ . '/auth.php';
