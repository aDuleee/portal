<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Tentukan kolom mana yang dapat diisi secara massal
    protected $fillable = [
        'title', 
        'content', 
        'category_id', 
        'user_id', 
        'published_at', 
        'likes', 
        'dislikes'
    ];

    // Relasi dengan model Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi dengan model User (jika menggunakan sistem user di Laravel)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
