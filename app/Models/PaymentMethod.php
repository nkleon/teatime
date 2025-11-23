<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PaymentMethod extends Model
{
    /** @use HasFactory<\Database\Factories\PaymentMethodFactory> */
    use HasFactory;

    public $timestamps = false; // Disable 'created_at' and 'updated_at' fields

    protected $fillable = [
        'name',
        'description'
    ];

    public function payments() : HasMany
    {
        return $this->hasMany(Payment::class, 'method_id');
    }
}
