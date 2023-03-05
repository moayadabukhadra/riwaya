<?php

namespace App\Models;

use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    use HasImage;


    protected $guarded = ['id'];

    public function books(): HasMany
    {
        return $this->hasMany(Book::class, 'category_id', 'id');
    }
}
