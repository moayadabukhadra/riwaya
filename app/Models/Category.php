<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use Translatable;



    public $translatedAttributes = ['name', 'description'];
    protected $guarded=[
        'id'
    ];

    public function books(){
        return $this->hasMany(Book::class);
    }
}
