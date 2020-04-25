<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ServiceDetailController;
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
        ->orderBy("service_id","desc")
        ->whereRaw('service_date = CURDATE()')
        ->get();

        return response()->json($data, 200);
    }

    public function add(Request $request){
        $this->validate($request, [
            'teller' => 'required',
            'customer' => 'required',
            'technician' => 'required',
        ]);

        //Check selected technician
        $technicianStatus = Technician::where('technician_id',$request->input('technician'))->first();
            if ($technicianStatus->status == "On") {
                $service = new Service([
                    'teller' => $request->input('teller'),
                    'customer' => $request->input('customer'),
                    'technician' => $request->input('technician'),
                    'status' => 'Pending'
                ]);

                if ($service->save()) {
                    return $service->service_id;
                } else {
                    return response()->json(['msg' => 'Error during creating service'], 404);
                }
            }   
            else {
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
                } else {
                    return response()->json(['msg' => 'Error during creating service'], 404);
                }
            }
    }

    public function finish($serviceId){
        $serviceDetail = new ServiceDetailController();
        $upStatus = Service::where('service_id', $serviceId)->first();
        $upStatus->status = 'Done';
        $tId = $upStatus->technician;
        $upStatus->update();

        //check remaining service with the same technician
        $remainService = Service::where('technician',$tId)->where('service_id','!=',$serviceId)->where('status','Pending')->first();
        if ($remainService != '') {
            $remainService->status = 'Working';
            if ($remainService->update()) {
                return $serviceDetail->conService($remainService->service_id);
            }
        } else {
            $upTechStatus = Technician::where('technician_id', $tId)->first();
            $upTechStatus->status = 'Off';
            $upTechStatus->update();
    
            return response()->json(['msg' => 'Service has been done'], 200);
        }
    }
}
