<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Editor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function editions(): HasMany
    {
        return $this->hasMany(BookEditions::class, 'book_id', 'id');
    }

    public function rate(): HasMany
    {
        return $this->hasMany(Comments::class, 'book_id', 'id');
    }
}
