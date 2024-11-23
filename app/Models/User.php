<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Pastikan role ada di fillable jika Anda mengubah role pengguna
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Method untuk memeriksa apakah pengguna adalah admin
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    // Method untuk memeriksa apakah pengguna adalah user
    public function isUser()
    {
        return $this->role === 'user';
    }
}
