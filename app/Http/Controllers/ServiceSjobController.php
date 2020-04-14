<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServiceSjob;
use App\Service_job;

class ServiceSjobController extends Controller
{
    //
    public function read(){
        $data = ServiceJob::all();

        return response()->json(['sjob' => $data]);
    }

    public function add(Request $request, $serviceId){
        $this->validate($request, [
            'sjob' => 'required'
        ]);

        $newSjob = $request->input('sjob');

        $sjob = new ServiceSjob([
            'service_id' => $serviceId,
            'sjob' => $newSjob
        ]);

        if ($sjob->save()) {
            $getSjob = Service_job::where('sjob_id', $newSjob)->first();
            $jobCost = $getSjob->price;
    
            return $jobCost;
        }   
    }
}
