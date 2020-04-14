<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $fillable = ['name','phone'];
    public $primaryKey = 'customer_id';

    public function service(){
        return $this->hasMany(Service::class);
    }
}
