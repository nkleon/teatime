<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentFactory> */
    use HasFactory;

    protected $fillable = [
        'date',
        'collection_id',
        'amount',
        'method_id'
    ];

    public function collection() : BelongsTo
    {
        return $this->belongsTo(Collection::class);
    }

    public function payment_method() : BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class, 'method_id');
    }
}
