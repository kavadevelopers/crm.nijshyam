<?php
namespace App\Helpers;

use App\Models\NotifyWpModel;
use App\Models\ZErrorLogsModel;

class NotifyWpHelper{

    public static function commonTemplate() : mixed{
        $wp = new NotifyWpModel;
        $wp->type = '';
        $wp->trycount = '0';
        $wp->status = '0';
        $wp->campaignname = 'test_image_and_url';
        $wp->destination = '919898375981';
        $wp->username = 'Mehul Kava';
        $post = [];
        
        $post['templateName']       = $wp->campaignname;
        $post['authToken']          = '';
        $post['originWebsite']      = '';
        $post['language']           = 'en';
        $post['name']               = $wp->username;
        $post['sendto']             = $wp->destination;
        $post['myfile']             = 'https://engees.11za.com/shuruup-454facbd-7bf0-4da0-b44f-f824c14e1572/Template/IMG/Frame_114567-539841.png';
        $post['isTinyURL']          = 'yes';
        $post['buttonValue']        = 'https://www.shuruup.com/login';
        //$post['isTinyURL'] = 'no';
        
        $postJson['variables'] = ['Investor Name'];
        if(count($postJson['variables']) > 0){
            foreach ($postJson['variables'] as $key => $value) {
                $post['data'][$key] = $value;
            }
        }


        $wp->params = json_encode($post);
        $wp->save();

        return true;
    }

    public static function send($row) : mixed {
        $postJson = json_decode($row->params, true);
        if(CommonHelper::setting('test_mobile') != ''){
            $postJson['sendto']    = '91'.CommonHelper::setting('test_mobile');
        }
        $postJson['authToken'] = CommonHelper::setting('third_party_wp_11za_authtoken');
        $postJson['originWebsite'] = CommonHelper::setting('third_party_wp_11za_origin_website');
        $responseCode = 599;
        $status = 2;
        $response = 'Pending Response';
        $client = new \GuzzleHttp\Client(['verify' => false,'http_errors' => false]);
        try {
            $response = $client->post('https://app.11za.in/apis/template/sendTemplate', [
                'headers' => [
                    'Content-Type'  => 'application/json',
                    'Accept'        => 'application/json'
                ],
                'json' => $postJson
            ]);

            $responseCode = $response->getStatusCode();
            $response = $response->getBody()->getContents();
            
            if($responseCode == 200){
                $status = 1;
            }else{
                $status = 2;
            }

        }catch (\Exception $e) {
            ZErrorLogsModel::create([
                'type'          => 'WhatsApp 11Za',
                'sub_type'      => 'Send',
                'description'   => $e->getMessage()
            ]);
        }
        $row->trycount              = $row->trycount + 1;
        $row->status                = $status;
        $row->response              = $response;
        $row->response_code         = $responseCode;
        $row->save();
    }
}