<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Books extends Model
{
    use HasFactory;

    protected $hidden = [
        'created_at',
        'updated_at',
        'category_id',
        'author_id',
        'editor_id'
    ];

    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function editor(): HasOne
    {
        return $this->hasOne(Editor::class, 'id', 'editor_id');
    }

    public function author(): HasOne
    {
        return $this->hasOne(Author::class, 'id', 'author_id');
    }
}
