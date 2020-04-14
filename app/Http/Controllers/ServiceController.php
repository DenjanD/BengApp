<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Service;
use App\Technician;

class ServiceController extends Controller
{
    //
    public function read(){
        $data = DB::table("services")
        ->select("service_id","customers.name AS customer","vehicle_name","vehicle_license","technicians.name AS technician","services.status")
        ->join("customers",'customer_id','=','customer')
        ->join("technicians",'technician_id','=','technician')
        ->join("service_details",'service_id','=','id')
        ->get();

        return response()->json($data, 200);
    }

    public function add(Request $request){
        $this->validate($request, [
            'teller' => 'required',
            'customer' => 'required',
            'technician' => 'required',
        ]);

        $service = new Service([
            'teller' => $request->input('teller'),
            'customer' => $request->input('customer'),
            'technician' => $request->input('technician'),
            'status' => 'Working'
        ]);
            
        if ($service->save()) {
            //change technician status
            $updateTechnicianStatus = Technician::where('technician_id', $request->input('technician'))->first();
            $updateTechnicianStatus->status = 'On';
            $updateTechnicianStatus->update();
        
            return $service->service_id;
        }
        return response()->json(['msg' => 'Error during creating service'], 404);
    }

    public function finish($serviceId){
        $upStatus = Service::where('service_id', $serviceId)->first();
        $upStatus->status = 'Done';
        $tId = $upStatus->technician;
        $upStatus->update();

        $upTechStatus = Technician::where('technician_id', $tId)->first();
        $upTechStatus->status = 'Off';
        $upTechStatus->update();

        return response()->json(['msg' => 'Service has been done'], 200);
    }
}
