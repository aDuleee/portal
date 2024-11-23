<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Tentukan kolom mana yang dapat diisi secara massal
    protected $fillable = ['name'];

    // Relasi dengan model Post
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
