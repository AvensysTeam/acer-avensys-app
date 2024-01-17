<?php

namespace App\Helper;
use Aws\Sns\SnsClient;

class Helper{
    public static function sendSms($mobile, $message){
        //client wants to disable this for now
        return true;
        $sms = new SnsClient([
            'version' => 'latest',
            'region' => 'eu-north-1',
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID'),
                'secret' => env('AWS_SECRET_ACCESS_KEY'),
            ],
        ]);
        $sms->SetSMSAttributes(
            [
                'attributes' => [
                    'DefaultSenderID' => 'acerrr',//env sendier id
                    'DefaultSMSType' => 'Transactional'
                ]
            ]
        );
        return $sms->publish([
            'Message' => $message,
            'PhoneNumber' => '+923087482172',
        ]);
    }
}
