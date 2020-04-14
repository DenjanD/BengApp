<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service_job extends Model
{
    //
    protected $fillable = ['name','price'];
    public $primaryKey = 'sjob_id';

    public function service_detail(){
        return $this->hasMany(Service_detail::class);
    }
}
