<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;

class SupplierController extends Controller
{
    //
    public function read(){
        $data = Supplier::all();

        return response()->json($data, 200);
    }

    public function add(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required'
        ]);

        $name = $request->input('name');
        $address = $request->input('address');
        $phone = $request->input('phone');

        $supplier = new Supplier([
            'name' => $name,
            'address' => $address,
            'phone' => $phone
        ]);

        if ($supplier->save()) {
            return response()->json(['msg' => 'Supplier added', 'supplier' => $supplier], 200);
        }
        return response()->json(['msg' => 'Error during creation']);
    }
    
    public function update(Request $request){
        $new_name = $request->input('name');
        $new_address = $request->input('address');
        $new_phone = $request->input('phone');
        $id_update = $request->input('supplier_id');
        $supplier = Supplier::where('supplier_id', $id_update)->first();
        if ($new_name != '') {
            $supplier->name = $new_name;
        }
        if ($new_address != '') {
            $supplier->address = $new_address;
        }
        if ($new_phone != '') {
            $supplier->phone = $new_phone;
        }
        
        if (!$supplier->update()) {
            return response()->json(['msg' => 'Error during update'], 404);
        }

        return response()->json(['msg' => 'Supplier data updated'], 200);
    }

    public function delete($id){
        $supplier = Supplier::findOrFail($id);
        if ($supplier->delete()) {
            return response()->json(['msg' => 'Supplier has been deleted'], 200);
        }
        return response()->json(['msg' => 'Error during deletion']);
    }
}
