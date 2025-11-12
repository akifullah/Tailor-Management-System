<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    protected $casts = [
        "combine" => "array"
    ];

    public function fields()
    {
        return $this->hasMany(Field::class);
    }

    
}
