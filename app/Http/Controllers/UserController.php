<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

class UserController extends Controller
{
    //get users data except user with the first role.
    public function read(){
        $firstRole = Role::get()->first()->toArray();
        $role = $firstRole['role_id'];
    
        // $data = User::where('role' ,'!=', $role)->get();
        $data = User::all();

        return response()->json($data, 200);
    }

    public function update(Request $request) {
        // update the user's name and password (optional)
    }

    public function delete($id){
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['msg' => 'User deleted'], 200);
    }
}
