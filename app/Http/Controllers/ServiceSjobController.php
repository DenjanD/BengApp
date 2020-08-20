<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServiceSjob;
use App\Service_job;
use Illuminate\Support\Facades\DB;

class ServiceSjobController extends Controller
{
    //
    public function read(){
        $data = ServiceSJob::all();

        return response()->json(['sjob' => $data]);
    }

    public function readservicejob($id){
        $data = DB::table("service_sjobs")
        ->select('sjob_id','name AS job','price')
        ->join('service_jobs','sjob','=','sjob_id')
        ->where('service_id',$id)
        ->orderBy('id')
        ->get();

        return response()->json($data, 200);
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

    public function delete($servId, $jobId){
        $sjob = Service_job::where('sjob_id', $jobId)->first();
        $jobCost = $sjob->price;

        $sjobDel = DB::table('service_sjobs')
        ->where('service_id',$servId)
        ->where('sjob',$jobId);

        $sjobDel->delete();

        return $jobCost;
        
    }
}
