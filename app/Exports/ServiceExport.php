<?php

namespace App\Exports;

use App\Service;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ServiceExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    private $exportFilter;

    public function __construct($dataFilter){
        $this->exportFilter = $dataFilter;
    }

    public function collection()
    { 
        $startDate = $this->exportFilter['startDate'];
        $endDate = $this->exportFilter['endDate'];
        $teller = $this->exportFilter['teller'];
        $technician = $this->exportFilter['technician'];
        $servCat = $this->exportFilter['servCat'];

        if ($teller == '--- Pilih Teller ---') {
            $teller = '';
        }

        if ($technician == '--- Pilih Teknisi ---') {
            $technician = '';
        }

        if ($servCat == '--- Pilih Kategori Servis ---') {
            $servCat = '';
        }
  
        if ($startDate == null && $endDate != null) {
            $exportData = DB::table('services')
            ->select('service_date','customers.name AS cust_name','vehicle_name','vehicle_license','service_categories.name AS servCat','service_cost','spart_cost','total_cost','technicians.name AS technician','users.name AS teller')
            ->join('service_details','service_id','=','id')
            ->join('customers','customer','=','customer_id')
            ->join('service_categories','scategory','=','scategory_id')
            ->join('technicians','technician','=','technician_id')
            ->join('users','teller','=','user_id')
            ->where('service_categories.name','like','%'.$servCat.'%')
            ->where('technicians.name','like','%'.$technician.'%')
            ->where('users.name','like','%'.$teller.'%')
            ->where('service_date','<=',$endDate)
            ->get();
        }

        else if ($endDate == null && $startDate != null) {
            $exportData = DB::table('services')
            ->select('service_date','customers.name AS cust_name','vehicle_name','vehicle_license','service_categories.name AS servCat','service_cost','spart_cost','total_cost','technicians.name AS technician','users.name AS teller')
            ->join('service_details','service_id','=','id')
            ->join('customers','customer','=','customer_id')
            ->join('service_categories','scategory','=','scategory_id')
            ->join('technicians','technician','=','technician_id')
            ->join('users','teller','=','user_id')
            ->where('service_categories.name','like','%'.$servCat.'%')
            ->where('technicians.name','like','%'.$technician.'%')
            ->where('users.name','like','%'.$teller.'%')
            ->where('service_date','>=',$startDate)
            ->get();
        }

        else if ($startDate == null && $endDate == null) {
            $exportData = DB::table('services')
            ->select('service_date','customers.name AS cust_name','vehicle_name','vehicle_license','service_categories.name AS servCat','service_cost','spart_cost','total_cost','technicians.name AS technician','users.name AS teller')
            ->join('service_details','service_id','=','id')
            ->join('customers','customer','=','customer_id')
            ->join('service_categories','scategory','=','scategory_id')
            ->join('technicians','technician','=','technician_id')
            ->join('users','teller','=','user_id')
            ->where('service_categories.name','like','%'.$servCat.'%')
            ->where('technicians.name','like','%'.$technician.'%')
            ->where('users.name','like','%'.$teller.'%')
            ->get();
        }

        else {
            $exportData = DB::table('services')
            ->select('service_date','customers.name AS cust_name','vehicle_name','vehicle_license','service_categories.name AS servCat','service_cost','spart_cost','total_cost','technicians.name AS technician','users.name AS teller')
            ->join('service_details','service_id','=','id')
            ->join('customers','customer','=','customer_id')
            ->join('service_categories','scategory','=','scategory_id')
            ->join('technicians','technician','=','technician_id')
            ->join('users','teller','=','user_id')
            ->where('service_categories.name','like','%'.$servCat.'%')
            ->where('technicians.name','like','%'.$technician.'%')
            ->where('users.name','like','%'.$teller.'%')
            ->whereBetween('service_date',[$startDate,$endDate])
            ->get();
        }

        return $exportData;
    }

    public function headings(): array {
        return [
            'Tanggal Servis',
            'Pelanggan',
            'Kendaraan',
            'Plat Nomor',
            'Kategori Servis',
            'Biaya Servis',
            'Biaya Spare Part',
            'Total Biaya',
            'Teknisi',
            'Teller'
        ];
    }
}
