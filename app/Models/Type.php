<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $guarded = [];

    protected $casts = [
        "combine" => "array"
    ];

    public function fields()
    {
        return $this->hasMany(Field::class);
    }

    
}
