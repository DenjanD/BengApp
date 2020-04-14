<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service_category extends Model
{
    //
    protected $fillable = ['name','price'];
    public $primaryKey = 'scategory_id';

    public function service_detail(){
        return $this->hasMany(Service_detail::class);
    }
}
