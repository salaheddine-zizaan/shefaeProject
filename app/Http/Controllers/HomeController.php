<?php

namespace App\Http\Controllers;

use App\Models\appointment;
use App\Models\doctors;
use App\Models\planning;
use App\Models\speciality;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Faker\Core\Color;
use Illuminate\Http\Request;
use Nette\Utils\DateTime;
use Spatie\FlareClient\Time\Time;
use Carbon\Carbon;
use App\Models\facture;
use App\Models\appNotif;
use App\Events\appNotifSend;
use App\Models\User;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function sendMsg(){

        


                $params=array(
                    'token' => 'wrun6z4ivysv9dil',
                    'to' => '+212645975771',
                    'body' => 'votre rendez-vous reserver avecc success'
                    );
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                      CURLOPT_URL => "https://api.ultramsg.com/instance42568/messages/chat",
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



  
    function add_time($time,$plusMinutes){

        $endTime = strtotime("+{$plusMinutes} minutes", strtotime($time));
        return date('h:i', $endTime);
     }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function patientInfos($id)/* to show patient info */
    {
        $app = appointment::find($id);
        return response()->json($app);    
    }

    public function factureInfos($id)/* to show patient info */
    {
        $fac = facture::where("appId","like",$id)->get();
        foreach($fac as $app){
            $fact = [
                'id' => $app->id,
                'totalP'=>$app->totalP,
                'medicamentP'=>$app->medicamentP,
                'consultationP'=>$app->consultationP,
                'pDescription'=>$app->desc,
            ];
        }
          
        $app = appointment::find($id);
        return response()->json([
        'app'=>$app,
        'fac'=>$fact
        ]);    
    }



    public function patientDesc(Request $request,$id){
        $app = appointment::find($id);
        $app->appDesc = $request->input('desc');
        $app->update();
        return response()->json([
            'status'=>200,
            'message'=>'done'
        ]);
    }


    public function patientPDF($id){/* to create a pdf */
        $app = appointment::find($id);
            $patient = [
                'id' => $app->id,
                'patientFName'=>$app->patientFName,
                'patientLName'=>$app->patientLName,
                'patientCIN'=>$app->patientCIN,
                'patientContact'=>$app->patientContact,
                'patientSex'=>$app->patientSex,
                'appDesc'=>$app->appDesc,
                'appPlan'=>$app->appPlan,
                'planDate'=>$app->planDate,
                'planDoc'=>$app->planDoc,
                'appTime'=>$app->appTime,
                'appStatus'=>$app->appStatus,
                'appType'=>$app->appType,
                'appPaiement'=>$app->appPaiement,
                'patientNais'=>$app->patientNais,
            ];  
            view()->share('patient',$patient);
        $pdf = PDF::loadView('patientPDF',$patient);
        return $pdf->download($app->patientFName . '_' . $app->patientFName. '_' . $app->plan_date. '.pdf');

    }




    public function PdfFac($id){/* to create a pdf */
        $fac = facture::where("appId","like",$id)->get();
        foreach($fac as $ap){
            $fact = [
                'id' => $ap->id,
                'totalP'=>$ap->totalP,
                'medicamentP'=>$ap->medicamentP,
                'consultationP'=>$ap->consultationP,
                'pDescription'=>$ap->desc,
            ];
        }
          
        $app = appointment::find($id);

        view()->share('facture',$fact);
        $pdf = PDF::loadView('facPDF',$fact);
        return $pdf->download($app->patientFName . '_' . $app->patientFName. '_' . $app->plan_date.  '_facture.pdf');

    }

    public function index() /* dashboard home statics */
    {
        $apps = appointment::where('planDate',date('y-m-d'))->get();
        $app4 = appointment::where('appTime','>',date('H'))->where('planDate',date('y-m-d'))->get();
        
        $reserved = 0;
        $confirmed = 0;
        $passed = 0;
        $controle = 0;
        foreach($apps as $app){
            if($app->appStatus!='disponible')
            $reserved++;
        }
        foreach($apps as $app){
            if($app->appStatus=='valider')
            $confirmed++;
        }
        foreach($apps as $app){
            if($app->appStatus=='payer')
            $passed++;
        }
        foreach($apps as $app){
            if($app->appType=='controle')
            $controle++;
        }
        $rvs = null;
        foreach($app4 as $app){
            $rvs [] =[
                'id' => $app->id,
                'patientFName'=>$app->patientFName,
                'patientLName'=>$app->patientLName,
                'patientCIN'=>$app->patientCIN,
                'patientContact'=>$app->patientContact,
                'patientSex'=>$app->patientSex,
                'appDesc'=>$app->appDesc,
                'appPlan'=>$app->appPlan,
                'planDate'=>$app->planDate,
                'planDoc'=>$app->planDoc,
                'appTime'=>$app->appTime,
                'appStatus'=>$app->appStatus,
                'appType'=>$app->appType,
                'appPaiement'=>$app->appPaiement,
                'patientNais'=>$app->patientNais,
            ];
        }

        $statics = ['reserved'=>$reserved,'confirmed'=>$confirmed,'passed'=>$passed,'controle'=>$controle];

        if($rvs){
       // Sort the array 
        usort($rvs,function( $a, $b ) {
            return strtotime($a["appTime"]) - strtotime($b["appTime"]);
        });
        $j = 0;
        foreach($rvs as $ap){
            if($ap['appPaiement']!='non'){
                continue;
            }
            if($ap['appStatus']=='disponible' and $ap['appTime']<date('H')){
                continue;
            }
            if($j==5){
                break;
            }
            $rv4 [] =[               
                'id' => $ap['id'],
                'patientFName'=>$ap['patientFName'],
                'patientLName'=>$ap['patientLName'],
                'patientCIN'=>$ap['patientCIN'],
                'patientContact'=>$ap['patientContact'],
                'patientSex'=>$ap['patientSex'],
                'appDesc'=>$ap['appDesc'],
                'appPlan'=>$ap['appPlan'],
                'planDate'=>$ap['planDate'],
                'planDoc'=>$ap['planDoc'],
                'appTime'=>$ap['appTime'],
                'appStatus'=>$ap['appStatus'],
                'appType'=>$ap['appType'],
                'appPaiement'=>$ap['appPaiement'],
                'patientNais'=>$ap['patientNais'],
            ];
            $j++;
        }
        if(isset($rv4) ){
        return view('dashboard.home')->with(['statics'=>$statics,'rvs'=>$rv4]);
        }else{
            return view('dashboard.home')->with(['statics'=>$statics,'msg'=>"pas de rendez-vous planifier"]);
        }

    }
           

    else{
            $non = ['msg'=>'pas de rendez-vous aujourd\'hui'];
            return view('dashboard.home')->with(['statics'=>$statics,'msg'=>'pas de rendez-vous aujourd\'hui']);
    }
}



    public function appointment() {

        $sps = speciality::all();

        
        foreach($sps as $p){
            
            $sp [] =[
                'id' => $p->id,
                'speciality' => $p->speciality,
                
            ];
        }
        
        return view('dashboard/appointment')->with(['speciality'=>$sp]);
    }

    public function appsShow($sp,$date,$t){
        $time = date('H:i', strtotime($t));
        $endTime = date('H:i', strtotime($time . ' + 60 minutes')) ;

        $apps = appointment::where('appTime', '>=', $time)
                            ->where('appTime', '<', $endTime)
                            ->where('speciality','like',  $sp)
                            ->where('planDate','like',  $date)
                            ->get();
        
        foreach($apps as $ap){    
            $GetApp [] =[
                'id' => $ap['id'],
                'patientFName'=>$ap['patientFName'],
                'patientLName'=>$ap['patientLName'],
                'patientCIN'=>$ap['patientCIN'],
                'patientContact'=>$ap['patientContact'],
                'patientSex'=>$ap['patientSex'],
                'appDesc'=>$ap['appDesc'],
                'appPlan'=>$ap['appPlan'],
                'planDate'=>$ap['planDate'],
                'planDoc'=>$ap['planDoc'],
                'appTime'=>$ap['appTime'],
                'appStatus'=>$ap['appStatus'],
                'appType'=>$ap['appType'],
                'speciality'=>$ap['speciality'],
                'appPaiement'=>$ap['appPaiement'],
                'patientNais'=>$ap['patientNais'],
                'toDay'=>date('Y-m-d'),
                'toTime'=>date('H:i'),
                
            ];
            
        } 
        return response()->json($GetApp);

    }

    public function webhook(){
        
        $data = file_get_contents("php://input");
        $event = json_decode($data, true);
        if(isset($event)){
            //Here, you now have event and can process them how you like e.g Add to the database or generate a response
            $file = 'log.txt';  
            $data =json_encode($event)."\n";  
            file_put_contents($file, $data, FILE_APPEND | LOCK_EX);
        }
    }


    public function AppSave(Request $request){


        



        function sendMsg($to,$dateTime,$dr){
            $to = substr($to, 1);
            $params=array(
                'token' => 'wrun6z4ivysv9dil',
                'to' => '212'.$to,
                'body' => 'votre rendez-vous reserver avec success
le ' .$dateTime.
'
dr. '.$dr
                );
                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => "https://api.ultramsg.com/instance42568/messages/chat",
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
        
        return back()->with('status','rendez-vous réservé avec succès');
    }

    public function appDelete(Request $request){
        $now = $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', Carbon::now());
        $id = request('Id');
        $appointment = appointment::find($id);
        $appDate = $appointment->planDate." ".$appointment->appTime;
        $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $appDate);
        $date24hBefore = DateTime::createFromFormat('Y-m-d H:i:s', $appDate);
        $date24hBefore->modify('-24 hours');
        

        if($now<$date24hBefore){
            $appointment->patientFName ='';
            $appointment->patientLName ='';
            $appointment->patientCIN = '';
            $appointment->patientContact = '';
            $appointment->appStatus = 'disponible';
            $appointment->appType = '';
            $appointment->appDesc = '';
            $appointment->Update();
            return response()->json([
                'message'=>'done'
            ]); 
        }elseif($now>$date24hBefore and $now<$dateTime){
            $exist = appNotif::where('appId',$appointment->id)->get();
            if(count($exist)==0){
                appNotif::create([
                    'patientFName'=>$appointment->patientFName,
                    'patientLName'=>$appointment->patientLName,
                    'patientCIN'=>$appointment->patientCIN,
                    'patientContact'=>$appointment->patientContact,
                    'patientSex'=>'',
                    'appDesc'=>$appointment->appDesc,
                    'speciality'=>$appointment->speciality,
                    'appId'=>$appointment->id,
                    'planDate'=>$appointment->planDate,
                    'planDoc'=>$appointment->planDoc,
                    'appTime'=>$appointment->appTime,
                    'appStatus'=>$appointment->appStatus,
                    'appType'=>$appointment->appType,
                    'appPaiement'=>$appointment->appPaiement,
                    'patientNais'=>$appointment->patientNais,
                    'adminR'=>'non',
                    'notifStatus'=>'waiting',
                ]);
                event(new appNotifSend($appointment->id));
            }

            return response()->json([
                'message'=>'send'
            ]); 
        }else{
            return response()->json([
                'message'=>'impossible'
            ]); 
        }
    }

    public function planning() {
        $events = Array();
        $docs = Array();
        $plannings = planning::all();
        $doctors = doctors::all();
        
        foreach($doctors as $doctor){
            
            $docs [] =[
                'id' => $doctor->id,
                'DocFName' => $doctor->DocFName,
                'DocLName' => $doctor->DocLName,
                'speciality' => $doctor->speciality,
                'color' => $doctor->color,
            ];
        }

        

        foreach($plannings as $planning){
            $color =null;
            foreach($doctors as $doctor){
                $name=$doctor->DocFName." ".$doctor->DocLName;
                if($planning->DocName==$name){
                    $color =$doctor->color;
                }
            }
            
            $events [] =[
                'id' => $planning->id,
                'title' => $planning->DocName,
                'start' => $planning->plan_date." ".$planning->start_time,
                'end' => $planning->plan_date." ".$planning->end_time,
                'color'=>$color
            ];
        }
        
        return view('dashboard.planning',['events' => $events],['docs' => $docs]);
    }

    





    public function medecin() {
        $doctors = doctors::all();
        $specialities = speciality::all();
        foreach($doctors as $doctor){
            
            $docs [] =[
                'id' => $doctor->id,
                'DocFName' => $doctor->DocFName,
                'DocLName' => $doctor->DocLName,
                'speciality' => $doctor->speciality,
                'contact' => $doctor->contact,
                'color' => $doctor->color,
            ];
        }
        foreach($specialities as $speciality){
            
            $sp [] =[
                'id' => $speciality->id,
                'speciality' => $speciality->speciality,
            ];
        }
        return view('dashboard/medecin',['docs' => $docs],['speciality'=>$sp]);
    }

    
    public function facture() {
        return view('dashboard/facture');
    }


    public function settings() {
        return view('dashboard/settings');
    }


    public function addUser(){
        user::create([
            'name'=> request('name'),
            'username'=> request('username'),
            'role'=> request('role'),
            'password'=> request('password'),
            
            
        ]);
        return redirect('dashboard/settings');
    }
}



