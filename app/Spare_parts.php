<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spare_parts extends Model
{
    //
    protected $fillable = ['name','brand','price','quantity','category'];
    public $primaryKey = 'spart_id';

    public function service(){
        return $this->hasOne(Service::class);
    }

    public function sales(){
        return $this->hasMany(Sales::class);
    }

    public function category(){
        return $this->hasOne(Spare_parts_category::class,'category');
    }
}
