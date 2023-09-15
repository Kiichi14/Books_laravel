<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
        'user_id',
        'edition_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function editions()
    {
        return $this->belongsTo(BookEditions::class, 'edition_id', 'id');
    }
}
