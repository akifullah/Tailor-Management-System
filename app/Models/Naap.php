<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Naap extends Model
{
    use SoftDeletes;

    protected $guarded = [];



    protected static function booted()
    {
        static::updating(function ($naap) {
            NaapHistory::create([
                'naap_id' => $naap->id,
                'data' => $naap->getOriginal(), // snapshot before change
                'version' => $naap->version,
                'updated_by' => Auth::user()?->name ?? "",
            ]);

            $naap->version = $naap->version + 1;
        });
    }



    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function histories()
    {
        return $this->hasMany(NaapHistory::class);
    }
}
