<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\appNotif;
use App\Models\appointment;

class NotificationController extends Controller
{


    public function notifDelete($id){
      $apps = appNotif::find($id)->delete();

    }
    public function appDelete($id){
      $notif = appNotif::find($id);
      $appId = $notif->appId;
      $appointment = appointment::find($appId);
      $appointment->patientFName ='';
      $appointment->patientLName ='';
      $appointment->patientCIN = '';
      $appointment->patientContact = '';
      $appointment->appStatus = 'disponible';
      $appointment->appType = '';
      $appointment->appDesc = '';
      $appointment->Update();
      $apps = appNotif::find($id)->delete();


    }

    public function showNotif(){
      $notifs = appNotif::all();
      foreach($notifs as $app){
        $notif = [
          'id' => $app->id,
          'patientFName'=>$app->patientFName,
          'patientLName'=>$app->patientLName,
          'patientCIN'=>$app->patientCIN,
          'patientContact'=>$app->patientContact,
          'patientSex'=>$app->patientSex,
          'appDesc'=>$app->appDesc,
          'appId'=>$app->appId,
          'planDate'=>$app->planDate,
          'planDoc'=>$app->planDoc,
          'appTime'=>$app->appTime,
          'appStatus'=>$app->appStatus,
          'appType'=>$app->appType,
          'appPaiement'=>$app->appPaiement,
          'patientNais'=>$app->patientNais,
          'adminR'=>$app->adminR,
          'notifStatus'=>$app->notifStatus,
        ];
    }
    return response()->json($notifs);
    
    }



    public function sendSms(){

        $params=array(
        'token' => '0092734bl8gyqxb0',
        'to' => '212645975771',
        'body' => 'votre rendez-vous reserver avecc success'
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



public function receiveSms(){
    function sendMsg(){
        $params=array(
            'token' => '0092734bl8gyqxb0',
            'to' => '212645975771',
            'body' => 'votre rendez-vous reserver avecc success'
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


    $params=array(
        'token' => '0092734bl8gyqxb0',
        'chatId' => '212645975771@c.us',
        'limit' => '1'
        );
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.ultramsg.com/instance42833/chats/messages?" .http_build_query($params),
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
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



    $data = file_get_contents("php://input");
    $event = json_decode($response, true);
    if(isset($event)){
        //Here, you now have event and can process them how you like e.g Add to the database or generate a response
        $file = 'log.txt';  
        $data =json_encode($event)."\n";  
        $from = $event[0]['from'];
        $msg = $event[0]['body'];
        echo "</br>";
        echo "</br>";
        echo "</br>";
        file_put_contents($file, $data, FILE_APPEND | LOCK_EX);
    }
    echo "</br>";
    echo $from;
    echo "</br>";

    echo $msg;
    echo "</br>";
    echo "</br>";

    if($msg=='1'){
        sendMsg();
    }
    

}

}