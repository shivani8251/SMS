<?php

namespace App\Library;


class StrConverter
{

    var $string;
    //add Your secret key here.
    public $secret_key = 'TE210904ME';
    //add Your secret iv here.
    public $secret_iv = 'TE1038HIMe';

    public function __construct($string)
    {
        $this->string = $string;
    }


    //Conver the Encryption/Decryption.
    public function encrypt() {
        if ($this->string == '') { return 0; }
        $output = false;
        $encrypt_method = "AES-256-CBC";
        
        // hash
        $key = hash('sha256', $this->secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $this->secret_iv), 0, 16);
        $output = openssl_encrypt($this->string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);

        return $output;
    }

    public function decrypt() {
        if ($this->string == '') { return 0; }
        $output = false;
        $encrypt_method = "AES-256-CBC";

        // hash
        $key = hash('sha256', $this->secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $this->secret_iv), 0, 16);
        $output = openssl_decrypt(base64_decode($this->string), $encrypt_method, $key, 0, $iv);

        return $output;
    }

}

