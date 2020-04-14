<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service_detail extends Model
{
    //
    protected $fillable = [
        'id',
        'spart',
        'kilometer',
        'service_start_time',
        'service_date',
        'vehicle_license',
        'sjob',
        'service_cost',
        'spart_cost',
        'total_cost',
        'vehicle_name',
        'complaint_desc',
        'scategory',
        'service_end_time',
        'service_desc',
    ];

    public function service_sjob(){
        return $this->hasMany(Service_job::class);
    }

    public function service_spart(){
        return $this->hasMany(Spare_parts::class);
    }
}
