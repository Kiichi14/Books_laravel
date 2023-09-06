<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BookEditions extends Model
{
    use HasFactory;

    public function book()
    {
        return $this->belongsTo(Books::class, 'book_id', 'id');
    }

    public function editions()
    {
        return $this->belongsTo(Editions::class, 'edition_id', 'id');
    }

    public function librairy(): HasMany
    {
        return $this->hasMany(Librairy::class, 'edition_id', 'id');
    }

    public function wishlist(): HasMany
    {
        return $this->hasMany(Wishlist::class, 'edition_id', 'id');
    }
}
