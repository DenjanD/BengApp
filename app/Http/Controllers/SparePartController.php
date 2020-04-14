<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Spare_parts;
use App\Supplier;
use App\Spare_parts_category;

class SparePartController extends Controller
{

    public function read(){
        //Eloquent with category name
        $data = Spare_parts::join('spare_parts_categories','category','=','sp_category_id')
                            ->select('spart_id','spare_parts.name','brand','price','quantity','spare_parts_categories.name AS category_name')
                            ->get();
        $supplierData = Supplier::all();
        $spartCategoryData = Spare_parts_category::all();

        return response()->json(['data' => $data, 'suppliers' => $supplierData, 'spartcategories' => $spartCategoryData], 200);
    }

    public function add($request){
        $this->validate($request, [
            'name' => 'required',
            'brand' => 'required',
            'price' => 'required|digits_between:1,11',
            'quantity' => 'required|digits_between:1,11',
            'category' => 'required',
        ]);

        $sparepart = new Spare_parts([
            'name' => $request->input('name'),
            'brand' => $request->input('brand'),
            'price' => $request->input('price'),
            'quantity' => $request->input('quantity'),
            'category' => $request->input('category')
        ]);

        if ($sparepart->save()) {
            return $sparepart->spart_id;
            // return response()->json(['msg' => 'Spare Part Added', 'spare part' => $sparepart],200);
        }
        return $msg = 'Error in sparepart adding';
    }

    public function update(Request $request){
        $sparepart = Spare_parts::where('spart_id', $request->input('spart_id'))->first();
        
        if ($request->input('name') != '') {
            $sparepart->name = $request->input('name');
        }
        if ($request->input('brand') != '') {
            $sparepart->brand = $request->input('brand');
        }
        if ($request->input('price') != '') {
            $sparepart->price = $request->input('price');
        }
        if ($request->input('quantity') != '') {
            $sparepart->quantity = $request->input('quantity');
        }
        if ($request->input('category') != '') {
            $sparepart->category = $request->input('category');
        }
        
        if ($sparepart->update()) {
            return response()->json(['msg' => 'Spare part updated'], 200);
        }
        return response()->json(['msg' => 'Error during update'], 404);
    }

    public function delete($id){
        $sparepart = Spare_parts::findOrFail($id);

        if ($sparepart->delete()) {
            return response()->json(['Spare part deleted'], 200);
        }
        return response()->json(['Error during deletion'], 404);
    }
}
