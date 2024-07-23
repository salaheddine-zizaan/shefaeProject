<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\doctors;
use App\Models\planning;
use App\Models\speciality;
use Faker\Core\Color;
use App\Models\appointment;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    
        $plans = Array();
        $docs = Array();
        $plannings = planning::all();
        $doctors = doctors::all();
        $specialities = speciality::all();

        foreach($doctors as $doc){
            
            $docs [] =[
                'id' => $doc->id,
                'speciality' => $doc->speciality,
                'DocFName'=> $doc->DocFName,
                'DocLName'=> $doc->DocLName,
            ];
        }
        date_default_timezone_set("Etc/GMT+1");

        
        foreach($plannings as $planning){
            
            if($planning->plan_date>date('Y-m-d')){
                $plans [] =[
                    'id' => $planning->id,
                    'planDoc' => $planning->DocName,
                    'plan_date' => $planning->plan_date,
                    'start_time' => $planning->start_time,
                    'end_time' => $planning->end_time,
                ];
            }
        }
        
        foreach($specialities as $speciality){
            
            $sp [] =[
                'id' => $speciality->id,
                'speciality' => $speciality->speciality,
            ];
        }
        
        return view('welcome',['speciality'=>$sp],['plans'=>$plans],['Doctors'=>$docs]);
    }



    public function showPlans($sp){
        $plannings = planning::all();
        $doctors = doctors::all();
        
        foreach($plannings as $planning){
            if($planning->speciality===$sp){
                if($planning->plan_date>=date('Y-m-d')   /*  or $planning->plan_date==date('Y-m-d') */){
                    
                $plans[]=[
                    'id' => $planning->id,
                    'planDoc' => $planning->DocName,
                    'speciality' => $planning->speciality,
                    'plan_date' => $planning->plan_date,
                    'start_time' => $planning->start_time,
                    'end_time' => $planning->end_time,
                ];
            }
            }
            
        }

        if($plannings){
            return response()->json($plans);
        }else{
            return response()->json([
                'status'=>200
            ]);
        }
    }


    public function showPlansTimes($date){/* date return plan id */
        $planning = planning::find($date);
        $apps = appointment::where('appPlan',$date)->where('appTime',">",date("H:i:s"))->get();
        
        foreach($apps as $app){
            if($app->appStatus=='disponible'){
                $freeApp []=[
                    'appTime'=>$app->appTime,
                    'id'=>$app->id,
                ];
            }
        }

        return response()->json($freeApp);

    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function AppointmentSave(Request $request){
        function sendMsg($to,$dateTime,$dr){
            $to = substr($to, 1);
            $params=array(
                'token' => '0092734bl8gyqxb0',
                'to' => '212'.$to,
                'body' => 'votre rendez-vous reserver avec success
le ' .$dateTime.
' dr. '.$dr
                );
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.ultramsg.com/instance42833/messages/chat",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "utf-8",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_SSL_VERIFYHOST => 0,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => http_build_query($params),
                CURLOPT_HTTPHEADER => array(
                    "content-type: application/x-www-form-urlencoded"
                ),
                ));
        
                $response = curl_exec($curl);
                $err = curl_error($curl);
        
                curl_close($curl);
        
                if ($err) {
                echo "cURL Error #:" . $err;
                } else {
                echo $response;
                }
        }


        $id = request('Id');
        $appointment = appointment::find($id);
        $appointment->patientFName = request('FName');
        $appointment->patientLName = request('LName');
        $appointment->patientCIN = request('Cin');
        $appointment->patientContact = request('Contact');
        $appointment->patientNais = request('Nais');
        $appointment->appStatus = 'reserver';
        $appointment->appType = 'consultation';
        $appointment->Update();
        $to =request('Contact');
        $dateTime = $appointment->planDate." ".$appointment->appTime;
        $dr=$appointment->planDoc;
        sendMsg($to,$dateTime,$dr);
        return redirect('/')->with('status','rendez-vous réservé avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
