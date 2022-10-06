<?php

namespace App\Models;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Darryldecode\Cart\Cart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    protected $fillable = ['image', 'price'];

    public $translatedAttributes = ['title', 'author', 'description'];



    public function cart()
    {
        return $this->belongsToMany(Cart::class);
    }

    public function categories(){
        return $this->belongsToMany(Category::class , 'book_category' ,'category_id' ,'book_id');
    }
}
