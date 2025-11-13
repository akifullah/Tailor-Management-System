<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'order_id',
        'product_id',
        // "assign_to",
        'product_name',
        // 'measurement',
        'is_from_inventory',
        'sell_price',
        'quantity_meters',
        // 'status',
        'total_price',
    ];

    protected $casts = [
        'is_from_inventory' => 'boolean',
        'sell_price' => 'decimal:2',
        'quantity_meters' => 'decimal:2',
        'total_price' => 'decimal:2',
        // 'measurement' => 'array',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
  
    // public function worker()
    // {
    //     return $this->belongsTo(User::class, 'assign_to', 'id');
    // }
}
