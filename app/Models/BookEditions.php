<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}