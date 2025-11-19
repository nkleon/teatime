<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Farm extends Model
{
    /** @use HasFactory<\Database\Factories\FarmFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'owner_id',
        'rate'
    ];

    public function owner() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function collections() : HasMany
    {
        return $this->hasMany(Collection::class);
    }
}
