<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    protected $fillable = [
        'title', 'author', 'year',
        'publisher', 'city',
        'bookshelf_id',
        'cover',
    ];

    function bookshelf(): BelongsTo{
        return $this->belongsTo(Bookshelf::class);
    }
}
