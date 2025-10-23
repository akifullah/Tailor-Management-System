<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $guarded = [];

    protected $casts = [
        "options" => 'array',
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
