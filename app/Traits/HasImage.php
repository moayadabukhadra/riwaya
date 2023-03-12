<?php

namespace App\Traits;

use App\Models\Image;
use Illuminate\Http\UploadedFile;
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
            $image->storeAs('images', $img_name, 'public');

            $this->image()->create(
                [
                    'name' => $image->getClientOriginalName(),
                    'path' => $img_name
                ]
            );
    }
}
