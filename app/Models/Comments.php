<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Comments extends Model
{
    use HasFactory;

    protected $hidden = [
        'user_id',
        'book_id',
    ];

    public function book(): HasOne
    {
        return $this->hasOne(Books::class, 'id', 'book_id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
