<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NaapHistory extends Model
{
    public function naap()
    {
        return $this->belongsTo(Naap::class);
    }
}
