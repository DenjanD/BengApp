<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Spare_parts_category;

class SparePartCategoryController extends Controller
{
    //
    public function read(){
        $data = Spare_parts_category::all();

        return response()->json($data, 200);
    }

    public function add(Request $request){
        $this->validate($request, [
            'name' => 'required'
        ]);

        $category = new Spare_parts_category([
            'name' => $request->input('name')
        ]);

        if ($category->save()) {
            return response()->json(['msg' => 'Category Saved', 'category' => $category], 200);
        }
        return response()->json(['msg' => 'Error during creating'], 404);
    }

    public function update(Request $request){
        $category = Spare_parts_category::where('sp_category_id',$request->input('sp_category_id'))->first();
        $category->name = $request->input('name');
        
        if ($category->update()) {
            return response()->json(['msg' => 'Category updated'], 200);
        }
        return response()->json(['msg' => 'Error during update']);
    }

    public function delete($id){
        $category = Spare_parts_category::findOrFail($id);
        
        if ($category->delete()) {
            return response()->json(['msg' => 'Categpry deleted'], 200);
        }
        return response()->json(['msg' => 'Error during deletion'], 404);
    }
}
