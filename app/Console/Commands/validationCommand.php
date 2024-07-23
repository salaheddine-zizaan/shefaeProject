<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\appointment;

class validationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:validation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'validation de rendez-vous';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        function sendMsg($to){
            $to = substr($to, 1);
            $params=array(
                'token' => '0092734bl8gyqxb0',
                'to' => '212'.$to,
                'body' => 'votre rendez-vous valider avec success'
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

        function sendMsg2($to){
            $to = substr($to, 1);
            $params=array(
                'token' => '0092734bl8gyqxb0',
                'to' => '212'.$to,
                'body' => 'votre rendez-vous annuler avecc success'
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
        function receiveSms($from){
            
        
            $from = substr($from, 1);
            $params=array(
                'token' => '0092734bl8gyqxb0',
                'chatId' => '212'.$from.'@c.us',
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
                file_put_contents($file, $data, FILE_APPEND | LOCK_EX);
            }            
            return $msg;
        }
        $app4 = appointment::where('planDate',">",date('y-m-d'))->where('appTime','>',date('h'))->where('appStatus','reserver')->get();
            foreach($app4 as $app){
                $rvs [] =[
                    'id' => $app->id,
                    'patientContact'=>$app->patientContact,
                    'appPlan'=>$app->appPlan,
                    'planDate'=>$app->planDate,
                    'planDoc'=>$app->planDoc,
                    'appTime'=>$app->appTime,
                    'appStatus'=>$app->appStatus,
                    'appPaiement'=>$app->appPaiement,
                ];
                $to=$app->patientContact;
                $msg = receiveSms($to);
                if($msg == "1"){
                    $app->appStatus = "valider";
                    $app->Update();
                    sendMsg($app->patientContact);
                }
                if($msg == "2"){
                    $app->patientFName ='';
                    $app->patientLName ='';
                    $app->patientCIN = '';
                    $app->patientContact = '';
                    $app->appStatus = 'disponible';
                    $app->appType = '';
                    $app->appDesc = '';
                    $app->Update();
                    sendMsg2($to);
                }
            }
    }
}
