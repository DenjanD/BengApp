<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
{
    //
    public function read(){
        $data = Customer::all();

        return response()->json($data, 200);
    }

    public function add(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required|digits_between:1,12'
        ]);

        $customer = new Customer([
            'name' => $request->input('name'),
            'phone' => $request->input('phone')
        ]);

        if ($customer->save()) {
            return response()->json(['msg' => 'Customer added'], 200);
        }
        return response()->json(['msg' => 'Error during creation'], 404);
    }

    public function update(Request $request){
        $customer = Customer::where('customer_id', $request->input('customer_id'))->first();

        if ($request->input('name') != '') {
            $customer->name = $request->input('name');
        }
        if ($request->input('phone') != '') {
            $customer->phone = $request->input('phone');
        }

        if ($customer->update()) {
            return response()->json(['msg' => 'Customer updated'], 200);
        }
        return response()->json(['msg' => 'Error during update'], 404);
    }

    public function delete($id){
        $customer = Customer::findOrFail($id);

        if ($customer->delete()) {
            return response()->json(['msg' => 'Customer deleted'], 200);
        }
        return response()->json(['msg' => 'Error during deletion']);
    }
}
