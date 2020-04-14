<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    public function __construct(){
        $this->middleware('jwt.auth',
            ['except' => ['dashboard','index']]
        );
    }

    public function index(Request $request)
    {
        // if($request->session()->exists('credentials')){
        //     return view('home');
        // }
        // else{
        //     return redirect('/login');
        // }
        return view('home');
    }

    public function dashboard(){
        return view('dashboard');
    }

    public function cekData(){
        $data = "Data all cars";
        return response()->json($data,200);
    }

    public function dataAuth(){
        $data = "Welcome" . Auth::user()->name;
        return response()->json($data, 200);
    }
}
