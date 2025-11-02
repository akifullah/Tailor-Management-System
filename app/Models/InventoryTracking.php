<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryTracking extends Model
{
    protected $fillable = [
        'product_id',
        'supplier_id',
        'order_id',
        'type',
        'quantity_meters',
        'price_per_meter',
        'balance_meters',
        'notes',
        'reference_number',
    ];

    protected $casts = [
        'quantity_meters' => 'decimal:2',
        'price_per_meter' => 'decimal:2',
        'balance_meters' => 'decimal:2',
    ];

    public function product() { return $this->belongsTo(Product::class); }
    public function order() { return $this->belongsTo(Order::class); }
    public function supplier() { return $this->belongsTo(Supplier::class); }
}

