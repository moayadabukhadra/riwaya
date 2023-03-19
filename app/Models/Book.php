<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;

class Book extends Model
{
    use HasFactory;
    use HasImage;
    use Searchable;

    protected $guarded = ['id'];

    protected array $mapping= [
        'properties' => [
            'title' => [
                'type' => 'text',
                'analyzer' => 'arabic',
                'boost' => 2,
            ],
            'description' => [
                'type' => 'text',
                'analyzer' => 'arabic',
                'boost' => 1.5,
            ],
            'author' => [
                'type' => 'text',
                'analyzer' => 'arabic',
            ],
            'category' => [
                'type' => 'text',
                'analyzer' => 'arabic',
            ],
        ]
    ];


    public function toSearchableArray(): array
    {
        $with = [
            'image',
            'author',
            'category',
        ];

        $this->loadMissing($with);
        $array = $this->toArray();

        $array['author'] = $this->author?->name;
        $array['category'] = $this->category?->name;

        return $array;
    }

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
}
