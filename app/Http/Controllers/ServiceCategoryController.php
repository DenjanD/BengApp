<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service_category;

class ServiceCategoryController extends Controller
{
    //
    public function read(){
        $data = Service_category::all();

        return response()->json($data, 200);
    }

    public function add(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|digits_between:1,11'
        ]);

        $scat = new Service_category([
            'name' => $request->input('name'),
            'price' => $request->input('price')
        ]);

        if ($scat->save()) {
            return response()->json(['msg' => 'Service Category created'], 200);
        }
        return response()->json(['msg' => 'Error during creation']);
    }

    public function update(Request $request){
        $scat = Service_category::where('scategory_id',$request->input('scategory_id'))->first();
        if ($request->input('name') != '') {
            $scat->name = $request->input('name');
        }
        if ($request->input('price') != '') {
            $scat->price = $request->input('price');
        }
        
        if ($scat->update()) {
            return response()->json(['msg' => 'Service Category updated'], 200);
        }
        return response()->json(['msg' => 'Error during update'], 404);
    }

    public function delete($id){
        $scat = Service_category::findOrFail($id);
       
        if ( $scat->delete()) {
            return response()->json(['msg' => 'Service Category deleted'], 200);
        }
        return response()->json(['msg' => 'Error during deletion'], 404);
    }
}
