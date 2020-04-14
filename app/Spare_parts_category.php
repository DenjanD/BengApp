<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spare_parts_category extends Model
{
    //
    protected $fillable = ['name'];
    public $primaryKey = 'sp_category_id';

    public function spare_parts(){
        return $this->hasMany(Spare_parts::class);
    }
}
