<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
    protected $fillable = ['teller','customer','technician','status'];
    public $primaryKey = 'service_id';

    public function service_detail(){
        return $this->hasOne(Service_detail::class);
    }
}
