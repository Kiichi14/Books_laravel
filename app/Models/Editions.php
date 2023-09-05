<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Editions extends Model
{
    use HasFactory;

    public function editions(): HasMany
    {
        return $this->hasMany(BookEditions::class, 'edition_id', 'id');
    }
}
