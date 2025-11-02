<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'brand_id',
        'category_id',
        'supplier_id',
        'purchase_price',
        'sell_price',
        'available_meters',
        'barcode',
    ];

    public function brand() { return $this->belongsTo(Brand::class); }
    public function category() { return $this->belongsTo(Category::class); }
    public function supplier() { return $this->belongsTo(Supplier::class); }
    public function orderItems() { return $this->hasMany(OrderItem::class); }
    public function inventoryTrackings() { return $this->hasMany(InventoryTracking::class); }
}
