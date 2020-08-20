<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServiceSpart;
use App\Spare_parts;
use Illuminate\Support\Facades\DB;

class ServiceSpartController extends Controller
{
    //
    public function read(){
        $data = ServiceSpart::all();

        return response()->json(['sspart' => $data]);
    }

    public function readservicespart($id){
        $data = DB::table('spare_parts')
        ->select('spart_id','name AS spart','price')
        ->join('service_sparts','spart','=','spart_id')
        ->where('service_id',$id)
        ->orderBy('id')
        ->get();

        return response()->json($data,200);
    }

    public function add(Request $request, $serviceId){
        $this->validate($request, [
            'spart' => 'required'
        ]);
        
        $newSpart = $request->input('spart');

        $spart = new ServiceSpart([
            'service_id' => $serviceId,
            'spart' => $newSpart
        ]);
        $upSpart = Spare_parts::where('spart_id', $newSpart)->first();
        
        if ($upSpart->quantity < 1) {
            return response()->json(['msg' => 'Spare Part out of stock'], 200);
        }
        
        if ($spart->save()) {
            $upSpart->quantity = $upSpart->quantity - 1;
            $upSpart->update();
            $spartCost = $upSpart->price;

            return $spartCost;
        }
    }

    public function delete($servId, $spartId){
        $spart = Spare_parts::where('spart_id', $spartId)->first();
        $spartCost = $spart->price;

        $spartDel = DB::table('service_sparts')
        ->where('service_id',$servId)
        ->where('spart',$spartId);

        $spartDel->delete();

        return $spartCost;
        
    }
}
