<?php

namespace App\Models;

use App\Traits\HasComments;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class Book extends Model
{
    use HasFactory;
    use HasImage;

//    use Searchable;
    use HasComments;

    protected $guarded = ['id'];

//    protected array $mapping= [
//        'properties' => [
//            'title' => [
//                'type' => 'text',
//                'analyzer' => 'arabic',
//                'boost' => 2,
//            ],
//            'description' => [
//                'type' => 'text',
//                'analyzer' => 'arabic',
//                'boost' => 1.5,
//            ],
//            'author' => [
//                'type' => 'text',
//                'analyzer' => 'arabic',
//            ],
//            'category' => [
//                'type' => 'text',
//                'analyzer' => 'arabic',
//            ],
//        ]
//    ];


//    public function toSearchableArray(): array
//    {
//        $with = [
//            'image',
//            'author',
//            'category',
//        ];
//
//        $this->loadMissing($with);
//        $array = $this->toArray();
//
//        $array['author'] = $this->author?->name;
//        $array['category'] = $this->category?->name;
//
//        return $array;
//    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'author_id', 'id');
    }

    public function UsersFavorite(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_book_favorite');
    }

    public function quotes(): HasMany
    {
        return $this->hasMany(Quote::class, 'book_id', 'id');
    }

    public function bookmark(): BelongsToMany
    {
        return $this->belongsToMany(BookMark::class, 'book_marks', 'id', 'book_id');
    }
}
