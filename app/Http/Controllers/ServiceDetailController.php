<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service_detail;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceSjobController;
use App\Http\Controllers\ServiceSpartController;
use App\Service_category;
use Illuminate\Support\Facades\DB;

class ServiceDetailController extends Controller
{
    //
    protected $service;
    protected $serviceSjob;
    protected $serviceSpart;

    public function __construct(){
        $this->service = new ServiceController();
        $this->serviceSjob = new ServiceSjobController();
        $this->serviceSpart = new ServiceSpartController();
    }

    public function read($id){
        // $data = Service_detail::where('id', $id)->first();
        $data = DB::table('services')
        ->select('service_id','customers.name AS cust_name','vehicle_name','vehicle_license','kilometer','technicians.name AS tech_name','service_start_time','complaint_desc','service_desc','service_categories.name AS scat_name','total_cost')
        ->join('customers','customer','=','customer_id')
        ->join('service_details','service_id','=','id')
        ->join('technicians','technician','=','technician_id')
        ->join('service_categories','scategory','=','scategory_id')
        ->where('service_id',$id)
        ->first();

        return response()->json(['data' => $data], 200);
    }

    public function add(Request $request){
        $serviceId = $this->service->add($request);

        $this->validate($request, [
            'kilometer' => 'required',
            'vehicle_license' => 'required',
            'vehicle_name' => 'required',
            'complaint_desc' => 'required',
            'scategory' => 'required',
            'service_desc' => 'required',
        ]);

        //get service start time & date
        $startTime = date("h:i:s");
        $startDate = date("Y-m-d");

        //get spart cost
        $spartCost = $this->serviceSpart->add($request, $serviceId);
     
        //get sjobCost from sjob
        $sjobCost = $this->serviceSjob->add($request, $serviceId);
  
        //get service category price
        $cat = Service_category::where('scategory_id', $request->input('scategory'))->first();
        $catCost = $cat->price;

        //count total cost
        $totalCost = $spartCost + $sjobCost + $catCost;

        $newSDetail = new Service_detail([
            'id' => $serviceId,
            'kilometer' => $request->input('kilometer'),
            'service_start_time' => $startTime,
            'service_date' => $startDate,
            'vehicle_license' => $request->input('vehicle_license'),
            'service_cost' => $catCost + $sjobCost,
            'spart_cost' => $spartCost,
            'total_cost' => $totalCost,
            'vehicle_name' => $request->input('vehicle_name'),
            'complaint_desc' => $request->input('complaint_desc'),
            'scategory' => $request->input('scategory'),
            'service_end_time' => null,
            'service_desc' => $request->input('service_desc'),
        ]);

        if ($newSDetail->save()) {
            
            return response()->json(['New Service has been added'], 200);
        }
    }

    public function upSpart(Request $request){
        //add new spart to the service_spart
        $serviceId = $request->input('service_id');
        $newSpartCost = $this->serviceSpart->add($request, $serviceId);
        
        //update service's spart price
        $upServiceDetail = Service_detail::where('id', $serviceId)->first();
        $upServiceDetail->spart_cost = $upServiceDetail->spart_cost + $newSpartCost;     
        
        //update service's total price
        $upServiceDetail->total_cost += $newSpartCost;
        $upServiceDetail->update();

        return response()->json([
            'New part cost' => $newSpartCost,
            'Total Spart Cost' => $upServiceDetail->spart_cost,
            'Total Cost' => $upServiceDetail->total_cost
        ], 200);
    }

    public function upSjob(Request $request){
        //add new sjob to the service_sjob
        $serviceId = $request->input('service_id');
        $newSjobCost = $this->serviceSjob->add($request, $serviceId);

        //update service's service_cost
        $upServiceDetail = Service_detail::where('id', $serviceId)->first();
        $upServiceDetail->service_cost += $newSjobCost;

        //update service's total price
        $upServiceDetail->total_cost += $newSjobCost;
        $upServiceDetail->update();
    }

    public function finish(Request $request){
        //set service_end_time
        $endTime = date('h:i:s');
        $upSDetail = Service_detail::where('id', $request->input('service_id'))->first();
        $upSDetail->service_end_time = $endTime;
        $upSDetail->update();

        //update service's status
        $this->service->finish($request->input('service_id'));
    }
}
