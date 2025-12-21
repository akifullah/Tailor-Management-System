<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'order_number',
        'customer_id',
        'order_date',
        // 'delivery_date',
        // 'delivery_status',
        'total_amount',
        'payment_method',
        'payment_status',
        'order_status',
        'partial_amount',
        'remaining_amount',
        'notes',
        'is_return',
        'return_date',
        'return_reason',
        'cancelled_at',
        'cancelled_by',
        'cancellation_reason',
    ];

    protected $casts = [
        'order_date' => 'date',
        // 'delivery_date' => 'date',
        'total_amount' => 'decimal:2',
        'partial_amount' => 'decimal:2',
        'remaining_amount' => 'decimal:2',
        'is_return' => 'boolean',
        'return_date' => 'date',
        'return_reason' => 'string',
        'cancelled_at' => 'datetime',
    ];

    protected $appends = ['total_paid'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payments()
    {
        return $this->morphMany(Payment::class, 'payable');
    }

    public function cancelledBy()
    {
        return $this->belongsTo(User::class, 'cancelled_by');
    }

    // Calculate total paid amount from payments (only payments, not refunds)
    public function getTotalPaidAttribute()
    {
        return $this->payments()->where('type', 'payment')->sum('amount') -
               $this->payments()->where('type', 'refund')->sum('amount');
    }

    // Check if all items are cancelled
    public function allItemsCancelled()
    {
        $items = $this->items;
        if ($items->isEmpty()) {
            return false;
        }

        return $items->every(function ($item) {
            return $item->status === 'cancelled';
        });
    }
}
