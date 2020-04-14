<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    //
    protected $fillable = ['total_bill','sold_date'];
    public $primaryKey = 'sale_id';

    public function spare_part(){
        return $this->hasMany(Sales::class);
    }
    
}
