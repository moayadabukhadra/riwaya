<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'city', 'address', 'phone', 'email', 'name', 'status', 'coustomer_note','total','items'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
