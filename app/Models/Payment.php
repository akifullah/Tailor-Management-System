<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'payable_type',
        'payable_id',
        'amount',
        'payment_method',
        'person_reference',
        'payment_date',
        'notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'datetime',
    ];

    // Polymorphic relationship - can belong to Order or InventoryTracking
    public function payable()
    {
        return $this->morphTo();
    }
}
