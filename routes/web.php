<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::middleware(['role:User'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/user/posts/{id}', [UserController::class, 'show'])->name('user.post');
    Route::post('/user/posts/{id}/respond', [UserController::class, 'respond'])->name('user.post.respond');
});

// Rute untuk dashboard admin dan user
Route::get('/admin', [AdminController::class, 'dashboard'])->middleware('role:admin')->name('admin.dashboard'); 
Route::get('/user', [UserController::class, 'dashboard'])->middleware('role:user')->name('user.dashboard'); 

// Redirect ke login page secara default
Route::get('/', function () {
    return redirect()->route('login'); 
});

// Menambahkan middleware untuk redirect setelah login
Route::get('/dashboard', function () {
   $user = auth()->user();

    if ($user->hasRole('admin')) {
        return redirect()->route('admin.dashboard'); // Redirect ke route admin
    } elseif ($user->hasRole('user')) {
        return redirect()->route('user.dashboard'); // Redirect ke route user
    }

    return view('dashboard'); // Default jika tidak ada role yang sesuai
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
