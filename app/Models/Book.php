<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'description',
        'image',
        'price',
        'rating',
        'category_id',
        'language',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function cart()
    {
        return $this->belongsToMany(Cart::class);
    }
}
