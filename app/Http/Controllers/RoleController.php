<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class RoleController extends Controller
{
    public function read(){
        $data = Role::all();

        $response = [
            'data' => $data
        ];

        return response()->json($data, 200);
    }

    public function add(Request $request){
        
        //Validasi input
        $this->validate($request, [
            'name' => 'required'
        ]);

        //Deklarasi variabel dan value
        $role_name = $request->input('name');

        //Deklarasi Objek Role
        $role = new Role([
            'name' => $role_name
        ]);

        //Save new role
        if($role->save()){
            $message = [
                'msg' => 'Role Created',
                'role' => $role
            ];
            return response()->json($message, 201);
        }

        return response()->json(['msg' => 'Something Wrong with the role'], 404);
    }

    public function update(Request $request){
        $this->validate($request, [
            'name' => 'required'
        ]);

        $new_name = $request->input('name');
        $id_update = $request->input('role_id');
        $role = Role::where('role_id',$id_update)->first();
        $role->name = $new_name;
        if (!$role->update()) {
            return response()->json([
                'msg' => 'Error during update'
            ],404);
        }
        return response()->json(['msg' => 'Role Updated'], 200);
    }

    public function delete($id){
        $role = Role::findOrFail($id);
        if ($role->delete()) {
            return response()->json(['msg' => 'Role has been deleted'], 200);
        }
        return response()->json(['msg' => 'Error during deletion'], 404);
    }
}
