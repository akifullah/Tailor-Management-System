<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function measurements (){
        return $this->hasMany(Measurement::class)->latest();
    }

    public function orders() {
        return $this->hasMany(Order::class)->latest();
    }

    public function sewingOrders() {
        return $this->hasMany(SewingOrder::class)->latest();
    }
}
