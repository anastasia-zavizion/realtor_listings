<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Listing extends Model
{
    use HasFactory;
    protected $fillable = ['city','baths','code','area','beds', 'street', 'street_nr', 'price'];

    public function owner() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
