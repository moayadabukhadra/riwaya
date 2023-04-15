<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BookMarkType extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    const TYPES = [
        'favorite' => 1,
        'to_read_later' => 2,
        'done_reading' => 3
    ];

    public function bookmarks(): HasMany
    {
        return $this->hasMany(BookMark::class, 'bookmark_type_id', 'id')->withPivot('bookmark_type_id');
    }

}
