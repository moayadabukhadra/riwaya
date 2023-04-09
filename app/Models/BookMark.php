<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BookMark extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public function books(): HasMany
    {
        return $this->hasMany(Book::class, 'book_id');
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'user_id');
    }

    public function BookmarkTypes(): HasMany
    {
        return $this->hasMany(BookMarkType::class, 'bookmark_type_id');
    }
}
