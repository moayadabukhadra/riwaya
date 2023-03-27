<?php

namespace App\Models;

use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class Category extends Model
{
    use HasFactory;
    use HasImage;
//    use Searchable;

//    protected array $mapping = [
//        'properties' => [
//            'name' => [
//                'type' => 'text',
//                'analyzer' => 'arabic',
//                'boost' => 2,
//            ],
//            'description' => [
//                'type' => 'text',
//                'analyzer' => 'arabic',
//                'boost' => 1.5,
//            ],
//        ]
//    ];

    protected $guarded = ['id'];

//    public function toSearchableArray(): array
//    {
//        $with = [
//            'image',
//        ];
//
//        $this->loadMissing($with);
//        return $this->toArray();
//    }

    public function books(): HasMany
    {
        return $this->hasMany(Book::class, 'category_id', 'id');
    }
}
