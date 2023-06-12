<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    static function boot(): void
    {
        parent::boot();

        static::deleting(function ($image) {
            unlink('riwaya/storage/app/public/images/' . $image->path);
        });
    }

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }

    public function imageUrl()
    {
        return $this->image->path;
    }
}
