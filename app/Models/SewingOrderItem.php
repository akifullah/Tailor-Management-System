<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SewingOrderItem extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'sewing_order_id',
        'product_name',
        'sewing_price',
        'qty',
        'customer_measurement',
        'assign_to',
        'assign_note',
        'status',
        'total_price',
        'cancelled_at',
        'cancelled_by',
        'cancellation_reason',
    ];

    protected $casts = [
        'sewing_price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'customer_measurement' => 'array',
        'cancelled_at' => 'datetime',
    ];

    public function sewingOrder()
    {
        return $this->belongsTo(SewingOrder::class);
    }

    public function worker()
    {
        return $this->belongsTo(User::class, 'assign_to');
    }

    public function cancelledBy()
    {
        return $this->belongsTo(User::class, 'cancelled_by');
    }
}
