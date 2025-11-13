<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SewingOrder extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'sewing_order_number',
        'customer_id',
        'order_date',
        'delivery_date',
        'total_amount',
        'paid_amount',
        'remaining_amount',
        'payment_method',
        'partial_amount',
        'payment_status',
        'order_status',
        'notes',
    ];

    protected $casts = [
        'order_date' => 'date',
        'delivery_date' => 'date',
        'total_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'remaining_amount' => 'decimal:2',
        'partial_amount' => 'decimal:2',
    ];

    protected $appends = ['total_paid'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(SewingOrderItem::class);
    }

    public function payments()
    {
        return $this->morphMany(Payment::class, 'payable');
    }

    // Calculate total paid amount from payments
    public function getTotalPaidAttribute()
    {
        return $this->payments()->sum('amount');
    }
}
