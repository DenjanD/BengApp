<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service_job;

class ServiceJobController extends Controller
{
    //
    public function read(){
        $data = Service_job::all();

        return response()->json($data);
    }

    public function add(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|digits_between:1,11'
        ]);

        $sjob = new Service_job([
            'name' => $request->input('name'),
            'price' => $request->input('price')
        ]);

        if ($sjob->save()) {
            return response()->json(['msg' => 'Service Job created'], 200);
        }
        return response()->json(['msg' => 'Error during creation']);
    }

    public function update(Request $request){
        $sjob = Service_job::where('sjob_id',$request->input('sjob_id'))->first();
        if ($request->input('name') != '') {
            $sjob->name = $request->input('name');
        }
        if ($request->input('price') != '') {
            $sjob->price = $request->input('price');
        }
        
        if ($sjob->update()) {
            return response()->json(['msg' => 'Service Job updated'], 200);
        }
        return response()->json(['msg' => 'Error during update'], 404);
    }  

    public function delete($id){
        $sjob = Service_job::findOrFail($id);
       
        if ( $sjob->delete()) {
            return response()->json(['msg' => 'Service Job deleted'], 200);
        }
        return response()->json(['msg' => 'Error during deletion'], 404);
    }
}
