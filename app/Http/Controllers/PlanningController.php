<?php

namespace App\Http\Controllers;

use App\Models\planning;
use App\Models\doctors;
use App\Models\appointment;
use Illuminate\Http\Request;
use DateTime;
use DateInterval;
use Symfony\Component\Console\Input\Input;


function add_time($time,$plusMinutes){

    $endTime = strtotime("+{$plusMinutes} minutes", strtotime($time));
    return date('H:i', $endTime);
 }

class PlanningController extends Controller
{


    public function store()
    {   
        $doctors = doctors::all();
        $sp=null;
        $nom = request('DocName');
        foreach($doctors as $doc){
            if($doc->DocFName.' '.$doc->DocLName==$nom){
                $sp=$doc->speciality;
            }

        }
        $addedplan = planning::create([
            'DocName'=> request('DocName'),
            'speciality'=> $sp,
            'plan_date'=> request('plan-date'),
            'start_time'=> request('start-hour'),
            'end_time'=> request('end-hour')
        ]);
        
        $endtime =  date("H:i", strtotime($addedplan->end_time));
        
        $Timing =  date("H:i", strtotime($addedplan->start_time));

        while($Timing<$endtime){
            
            appointment::create([
                'patientFName'=>'',
                'patientLName'=>'',
                'patientCIN'=>'',
                'patientContact'=>'',
                'patientSex'=>'',
                'appDesc'=>'',
                'speciality'=>$sp,
                'appPlan'=>$addedplan->id,
                'planDate'=>request('plan-date'),
                'planDoc'=>$nom,
                'appTime'=>$Timing,
                'appStatus'=>'disponible',
                'appType'=>'',
                'appPaiement'=>'non',
                'patientNais'=>request('plan-date'),
            ]);
            $Timing = add_time($Timing,15);
        }

        
         return redirect('dashboard/planning');
    
    }

    public function update(Request $request){
        $id = $request->input('editid');
        $doctors = doctors::all();
        $plan = planning::find($id);
        $apps = appointment::where('appPlan',$id)->delete();
        $nom = request('DocName');

        foreach($doctors as $doc){
            if($doc->DocFName.' '.$doc->DocLName==$request->input('DocName')){
                $sp=$doc->speciality;
            }
        }
        
        $plan->DocName = $request->input('DocName');
        $plan->speciality = $sp;
        $plan->plan_date = $request->input('edit-plan-date');
        $plan->start_time = $request->input('edit-start-hour');
        $plan->end_time = $request->input('edit-end-hour');
        $plan->update();
        
        $endtime = $plan->end_time;
        $Timing = $plan->start_time;

        while($Timing<$endtime){
            
            appointment::create([
                'patientFName'=>'',
                'patientLName'=>'',
                'patientCIN'=>'',
                'patientContact'=>'',
                'patientSex'=>'',
                'appDesc'=>'',
                'speciality'=>$sp,
                'appPlan'=>$plan->id,
                'planDate'=>$request->input('edit-plan-date'),
                'planDoc'=>$nom,
                'appTime'=>$Timing,
                'appStatus'=>'disponible',
                'appType'=>'',
                'appPaiement'=>'non',
                'patientNais'=>$plan->plan_date,
            ]);
            $Timing = add_time($Timing,15);
        }

        
        
        return redirect('dashboard/planning');
    }


    public function edit($id)
    {
        $plan = planning::find($id);
        if($plan){
            return response()->json([
                'status'=>200,
                'plan'=> $plan,
            ]);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=> 'plan n\'existe pas',
            ]);
        }
    }


    public function destroy($id){
        $planning = planning::find($id);
        if(! $planning){
            return response()->json([
                'error'=>'Unable to locate the event'
            ],404);
            
        }

        $planning->delete();
        return $id;
    }


    public function showData($id){
        $data = planning::find($id);
        return view('dashboard.planning',['planning' => $data]);
    }
}
