<?php

namespace App\Http\Controllers;

use App\Technician;
use Illuminate\Http\Request;

class TechnicianController extends Controller
{
    //
    public function read(){
        $data = Technician::all();

        return response()->json($data, 200);
    }

    public function readAuth(){
        $data = Technician::all();

        return response()->json(['Authenticated' => 'Yes','data' => $data],200);
    }

    public function add(Request $request){

        $this->validate($request, [
            'name' => 'required'
        ]);

        $name = $request->input('name');

        $technician = new Technician([
            'name' => $name,
            'status' => 'Off'
        ]);

        if($technician->save()){
            $message = [
                'msg' => 'Technician has been saved!',
                'technician' => $technician
            ];
            return response()->json($message, 201);
        }
        else{
            $message = [
                'msg' => 'Something wrong'
            ];
            return response()->json($message, 404);   
        }
    }

    public function update(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'technician_id' => 'required'
        ]);
        
        $new_name = $request->input('name');
        $id_update = $request->input('technician_id');
        $technician = Technician::where('technician_id',$id_update)->first();
        $technician->name = $new_name;
        if(!$technician->update()){
            return response()->json([
                'msg' => 'Error during update'
            ], 404);
        }
        $response = [
            'msg' => 'Technician Updated'
        ];

        return response()->json($response, 200);
    }

    public function delete($id){
        $technicianId = $id;
        $technician = Technician::findOrFail($technicianId);
        if($technician->delete()){
            $response = [
                'msg' => 'Technician Deleted'
            ];
            return response()->json($response, 200);
        }else{
            $response = [
                'msg' => 'Something wrong'
            ];
            return response()->json($response, 404);
        }
    }
}
