<?php

namespace App\Library;

use App\Models\Notification as NotificationTable;
use App\Library\PushNotification;
use App\Models\Management;
use App\Models\User;
use App\Models\Vendor;

class Notification
{

    private $user_id, $user_type, $type = 'auto';

    public function __construct($user_id, $user_type)
    {

        $this->user_id = $user_id;
        $this->user_type = $user_type;
    }

    //This function send only normal notification.
    public function send(String $title, String $message = '')
    {
        
        $data = ['user_id' => $this->user_id, 'user_type' => $this->user_type, 'title' => $title, 'message' => $message,
                     'type' => $this->type];

        return NotificationTable::insert($data);
    }

    //This function send normal with push notification.
    public function sendWithPush(String $title, String $message = '')
    {

        $data = ['user_id' => $this->user_id, 'user_type' => $this->user_type, 'title' => $title, 'message' => $message,
                         'type' => $this->type];

        $responce = NotificationTable::insert($data);

        $firebaseToken = $this->device_token();
        if (!empty($firebaseToken)) {

            $pushNotification = new PushNotification($firebaseToken, $data);
            $responce = $pushNotification->send();
        }

        return $responce;
    }

    //Get device token.
    public function device_token()
    {
        $firebaseToken = NULL;

        if($this->user_type == 'User')
        {
            $firebaseToken = User::where('id', $this->user_id)->pluck('device_token');
            $firebaseToken = json_decode(json_encode($firebaseToken , true), true);
        }
        elseif($this->user_type == 'Vendor')
        {
            $firebaseToken = Vendor::where('id', $this->user_id)->pluck('device_token');
            $firebaseToken = json_decode(json_encode($firebaseToken , true), true);
        }
        elseif($this->user_type == 'SO' || $this->user_type == 'DO' || $this->user_type == 'PO')
        {
            $firebaseToken = Management::where('user_type', $this->user_type)->where('id', $this->user_id)->pluck('device_token');
            $firebaseToken = json_decode(json_encode($firebaseToken , true), true);
        }

        return $firebaseToken;
    }

}

