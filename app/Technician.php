<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Technician extends Model
{
    //
    protected $fillable = ['name','status'];
    public $primaryKey  = 'technician_id';

    public function service(){
        return $this->hasMany(Service::class);
    }
}
