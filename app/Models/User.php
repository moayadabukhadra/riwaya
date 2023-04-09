<?php

namespace App\Models;

use App\Traits\HasImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasImage, HasRoles;

    protected string $guard_name = 'api';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'fb_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

//    protected $appends = [
//        'profile_photo_url',
//    ];

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

    public function bookmarkedBooks(): HasManyThrough
    {
        return $this->hasManyThrough(Book::class,BookMark::class,'id','book_id','user_id');
    }

    public function favoriteBooks(): HasMany
    {
        return $this->hasMany(BookMark::class, 'user_id')->where('bookmark_type_id', BookMarkType::TYPES['favorite']);
    }

    public function toReadLater(): HasMany
    {
        return $this->hasMany(BookMark::class, 'user_id')->where('bookmark_type_id', BookMarkType::TYPES['to_read_later']);
    }

    public function doneReading(): HasMany
    {
        return $this->hasMany(BookMark::class, 'user_id')->where('bookmark_type_id', BookMarkType::TYPES['done_reading']);
    }


}
