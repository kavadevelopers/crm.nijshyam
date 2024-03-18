<?php
namespace App\Helpers;

use App\Models\NotifyEmailModel;
use App\Models\ZErrorLogsModel;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;


class NotifyEmailHelper{

    public static function commonTemplate() : mixed{
        $email = new NotifyEmailModel;
        $email->trycount                = '0';
        $email->status                  = '0';
        $email->destination             = 'mehul9921@gmail.com';
        $email->subject                 = 'test email';
        $email->body                    = 'This is test body';
        $email->save();

        return true;
    }

    public static function send($email) : void{
        $responseCode = 599;
        $status = 2;
        $response = 'Pending Response';
        try{
            $mail               = new PHPMailer();
            $mail->isSMTP();
            $mail->IsHTML(true);
            $mail->SMTPDebug    = 0;
            $mail->SMTPAuth     = true;
            $mail->SMTPSecure   = 'ssl';
            $mail->CharSet      = "utf-8";
            $mail->Host         = CommonHelper::setting('smtp_mail_host');
            $mail->Port         = CommonHelper::setting('smtp_mail_port');
            $mail->Username     = CommonHelper::setting('smtp_mail_user');
            $mail->Password     = CommonHelper::setting('smtp_mail_password');
            $mail->SetFrom(CommonHelper::setting('smtp_mail_send_from'),CommonHelper::setting('smtp_mail_send_from_name'));
            $mail->Subject      = $email->subject;
            $mail->Body         = $email->body;

            if(CommonHelper::setting('test_email') != ''){
                foreach (explode(',', $email->destination) as $key => $value) {
                    $mail->AddAddress($value);
                }
            }else{
                foreach (explode(',', CommonHelper::setting('test_email')) as $key => $value) {
                    $mail->AddAddress($value);
                }
            }

            if($email->attechments != NULL && is_array($email->attechments) && count($email->attechments) > 0) {
                foreach ($email->attechments as $key => $value) {
                    $mail->addStringAttachment(file_get_contents($value['url']), $value['name']);
                }
            }

            if($mail->Send()){
                $responseCode = 200;
                $status = 1;
                $response = 'Mail sent';
            }

        }catch(Exception $e){
            ZErrorLogsModel::create([
                'type'          => 'Email PhpMailer',
                'sub_type'      => 'Send',
                'description'   => $e->getMessage()
            ]);
        }

        $email->trycount              = $email->trycount + 1;
        $email->status                = $status;
        $email->response              = $response;
        $email->response_code         = $responseCode;
        $email->save();
    }
}