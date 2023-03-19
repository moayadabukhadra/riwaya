<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

trait HasImage
{
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function saveImage($image): void
    {

        $img_name = Str::random(10) . '.' . $image->getClientOriginalExtension();
        $img = \Intervention\Image\Facades\Image::make($image);
        $img->resize(400, 300, function ($constraint) {
            $constraint->aspectRatio();
        })->insert(public_path('/assets/images/water-mark.png'), 'bottom-right', 10, 10)
            ->save(storage_path('app/public/images/' . $img_name));

        $this->image()->create(
            [
                'name' => $image->getClientOriginalName(),
                'path' => $img_name,
            ]
        );
    }

    public function ImageUrl(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->image?->path,
        );
    }
}
