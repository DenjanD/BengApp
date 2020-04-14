<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //
    protected $fillable = ['name','address','phone'];
    public $primaryKey = 'supplier_id';

    public function purchase(){
        return $this->hasMany(Purchase::class);
    }
}
