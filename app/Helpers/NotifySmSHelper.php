<?php
namespace App\Helpers;

use App\Models\NotifySmSModel;
use App\Models\ZErrorLogsModel;

class NotifySmSHelper{

    public static function commonTemplate() : mixed{
        $sms = new NotifySmSModel;
        $sms->trycount              = '0';
        $sms->status                = '0';
        $sms->destination           = '9898375981';
        $sms->url                   = '';
        $post = [];
        $post['message']            = "Hello there, your Shuru-Up OTP is 022233";
        $post['number']             = '9898375981';
        $sms->params = json_encode($post);
        $sms->save();

        return true;
    }

    public static function sendVerification($otp,$mobile) : void{
        $sms = new NotifySmSModel;
        $sms->trycount              = '0';
        $sms->status                = '0';
        $sms->destination           = $mobile;
        $sms->url                   = '';
        $post = [];
        $post['message']            = "Hello there, your Shuru-Up OTP is ".$otp.".";
        $post['number']             = $sms->destination;
        $sms->params = json_encode($post);
        $sms->save();
        Self::send($sms);
    }

    public static function send($sms) : void{
        if($sms){
            $post = json_decode($sms->params, true);
            if(CommonHelper::setting('test_mobile') != ''){
                $post['number']    = CommonHelper::setting('test_mobile');
            }
            $post["apikey"] = CommonHelper::setting('third_party_magicsms_apikey');
            $post["senderid"] = CommonHelper::setting('third_party_magicsms_senderid');

            $request = "";
            foreach($post as $key => $val)
            {
                $request.= $key."=".urlencode($val);
                $request.= "&";
            }
            $request = substr($request, 0, strlen($request)-1);

            $url = "http://sms5.magicsms.co.in/V2/http-api.php?".$request;
            $sms->url = $url;
            $responseCode = 599;
            $status = 2;
            $response = 'Pending Response';
            $client = new \GuzzleHttp\Client(['verify' => false,'http_errors' => false]);
            try {
                $response = $client->get($sms->url, [
                    'headers' => [
                        'Content-Type'  => 'application/json',
                        'Accept'        => 'application/json'
                    ]
                ]);

                $responseCode = $response->getStatusCode();
                $response = $response->getBody()->getContents();
                
                if($responseCode == 200){
                    $responseA = json_decode($response);
                    if($responseA->status == 'OK'){
                        $status = 1;
                    }else{
                        $status = 2;
                    }
                }else{
                    $status = 2;
                }

            }catch (\Exception $e) {
                ZErrorLogsModel::create([
                    'type'          => 'SMS MagicSms',
                    'sub_type'      => 'Send',
                    'description'   => $e->getMessage()
                ]);
            }

            $sms->trycount              = $sms->trycount + 1;
            $sms->status                = $status;
            $sms->response              = $response;
            $sms->response_code         = $responseCode;
            $sms->save();
        }
    }
}