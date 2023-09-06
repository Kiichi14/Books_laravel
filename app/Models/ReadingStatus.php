<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ReadingStatus extends Model
{
    use HasFactory;

    protected $table = 'reading_status';

    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function edition(): HasOne
    {
        return $this->hasOne(BookEditions::class, 'id', 'edition_id');
    }
}
