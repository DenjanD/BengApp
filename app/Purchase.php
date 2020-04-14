<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    //
    protected $fillable  = ['spart', 'supplier', 'purchase_date', 'quantity', 'price'];

    public function supplier(){
        return $this->hasMany(Supplier::class);
    }

    public function spare_parts(){
        return $this->hasOne(Spare_parts::class);
    }
}
