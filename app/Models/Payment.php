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
        'type',
        'refund_for_payment_id',
        'refund_reason',
        'created_by',
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

    // Polymorphic relationship - can belong to Order, SewingOrder or InventoryTracking
    public function payable()
    {
        return $this->morphTo();
    }

    // Relationship to the original payment if this is a refund
    public function refundForPayment()
    {
        return $this->belongsTo(Payment::class, 'refund_for_payment_id');
    }

    // Relationship to refunds for this payment
    public function refunds()
    {
        return $this->hasMany(Payment::class, 'refund_for_payment_id');
    }

    // User who created this payment/refund
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
