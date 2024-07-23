<?php

namespace App\Console\Commands;
use App\Models\appointment;
use Illuminate\Console\Command;

class SendValidationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:sendValidation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = ' demande de validation de rendez-vous';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {


        function sendMsg($to,$dateTime,$dr){
            $to = substr($to, 1);
            $params=array(
                'token' => '0092734bl8gyqxb0',
            'to' => '212'.$to,
            'body' => 'pour valider votre  rendez-vous
le ' .$dateTime.
'
avec dr. '.$dr.
'
envoyer :1'.
'
si non envoyer : 2'
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
        
        $app4 = appointment::where('planDate',"=",date('Y-m-d', strtotime("+1 day")))->get();
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
                if($app->appStatus == "reserver"){
                    $to =$app->patientContact;
                    $dateTime = $app->planDate." ".$app->appTime;
                    $dr=$app->planDoc;
                    sendMsg($to,$dateTime,$dr);
                }
            }
    }
}
