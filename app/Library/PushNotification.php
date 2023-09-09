<?php

namespace App\Library;

class PushNotification
{

    private $fields;

    public function __construct(Array $tokens, Array $data)
    {

        $this->fields = [
            "registration_ids" => $tokens,
            "notification" => [
                "title" => $data['title'],
                "body" => $data['message'],
                "datetime" => date("d-m-Y h:i A"),
                // "target" => $data['target'] 
            ]
        ];
    }

    public function send()
    {
        $SERVER_API_KEY = "AAAAJV46HR4:APA91bFZbLVYmpMW-55X_T8TyNJGRIYwZp0thaO3yrsqFA9VWvnedvMnO0i_olTd-UzNep0uWv-0kuiI8B0L2BHYNC4bnmJUUHrAvg0dKUoOJy3hJZLBI0ktHz6wItoN_7qIbkCfpIUT";
        
        $data = json_encode($this->fields);
        
        $headers = [
            'Authorization: key=' . $SERVER_API_KEY,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
      
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
               
        return curl_exec($ch);
    }

}

