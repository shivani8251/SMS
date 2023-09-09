<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SMSController extends Controller
{

    public function __construct()
    {
    }


    public static function sendSMS($mobileno, $otp)
    {
        $message = "$otp is the OTP for EDUO Login/Register. OTP is valid for 5 Minutes. Do not share this OTP with anyone. Regards, Team Programmics Technology";
        $url = "http://sms.programmics.tech/api?userid=chandra.pro&password=chandra@2020&mobno=".$mobileno."&msg=".urlencode($message)."&senderid=PRGMCS&route=4&template_id=1707160465079587546&unicode=0";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");

        $response = curl_exec($ch);

        // SmsApiLog::create(['data'=>$response]);

        return json_decode($response, true);

    }




}