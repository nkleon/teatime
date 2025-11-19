<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Collection extends Model
{
    /** @use HasFactory<\Database\Factories\CollectionFactory> */
    use HasFactory;

    protected $fillable = [
        'date',
        'farm_id',
        'picker_id',
        'quantity'
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function payments() : HasOne
    {
        return $this->hasOne(Payment::class);
    }
}
