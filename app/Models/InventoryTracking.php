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
    
    protected $appends = ['total_amount', 'total_paid', 'remaining_amount'];

    public function product() { return $this->belongsTo(Product::class); }
    public function order() { return $this->belongsTo(Order::class); }
    public function supplier() { return $this->belongsTo(Supplier::class); }
    public function payments() { return $this->morphMany(Payment::class, 'payable'); }
    
    // Calculate total amount for purchases
    public function getTotalAmountAttribute()
    {
        if ($this->type === 'purchase' && $this->price_per_meter && $this->quantity_meters) {
            return $this->price_per_meter * $this->quantity_meters;
        }
        return 0;
    }
    
    // Calculate total paid amount
    public function getTotalPaidAttribute()
    {
        return $this->payments()->sum('amount');
    }
    
    // Calculate remaining amount for purchases
    public function getRemainingAmountAttribute()
    {
        if ($this->type === 'purchase') {
            $totalAmount = $this->total_amount;
            $totalPaid = $this->payments()->sum('amount');
            return max(0, $totalAmount - $totalPaid);
        }
        return 0;
    }
}

