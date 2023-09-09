<?php

namespace App\Library;

use App\Models\User;
use App\Models\Vendor;
use File;

class QrCode
{

    // Google Chart API URL
    private $googleChartAPI = 'https://chart.apis.google.com/chart',
    //open_ssl encryption decryption password;
    $password = 'yux&evtYC*<,Z<cq',

    $user_id, $user_type, $url;

    public function __construct($user_id = 0, $user_type = 'User')
    {
        $this->user_id = $user_id;
        $this->user_type = ucfirst($user_type);
    }

    public function generate($width = 300, $height = 300)
    {

        $targetDir = storage_path().'/app/public/'.strtolower($this->user_type).'/qrCode';
        //Check the folder is exist or not.
        if (!(File::isDirectory($targetDir))) {

            //create folder if doesn't exist.
            File::makeDirectory($targetDir, 0777, true, true);
        }

        $user = ($this->user_type == 'User') ? User::find($this->user_id) : Vendor::find($this->user_id);
        // $route = ($this->user_type == 'User') ? 'api' : 'vendor' ;

        if ($user) {

            $imageName =  'QR_'.md5($this->user_id . time()).'.png';

            //generate url with payee data, pa- payee account, pt- payee type, pid- payee id.
            $this->url = "upi://pay?pa=$user->phone&pt=".$this->user_type.'&pid='.$this->encrypt($this->user_id);

            //create & save QrCode.
            if ($this->qrCode(($targetDir.'/'.$imageName), $width, $height)){

                $user->qr_code = $imageName;
                //return save object.
                return $user->save();
            }
        }
        return false;
    }

    public function scanner($width = 500, $height = 500)
    {

        $targetDir = storage_path().'/app/public/'.strtolower($this->user_type).'/scanner';
        //Check the folder is exist or not.
        if (!(File::isDirectory($targetDir))) {

            //create folder if doesn't exist.
            File::makeDirectory($targetDir, 0777, true, true);
        }

        $user = ($this->user_type == 'User') ? User::find($this->user_id) : Vendor::find($this->user_id);
        // $route = ($this->user_type == 'User') ? 'api' : 'vendor' ;

        if ($user) {

            $imageName =  'QR_'.md5($this->user_id . time()).'.png';

            //generate url with payee data, pa- payee account, pt- payee type, pid- payee id.
            $this->url = "upi://pay?pa=$user->phone&pt=".$this->user_type.'&pid='.$this->encrypt($this->user_id);

            //create & save QrCode.
            if ($this->qrCode(($targetDir.'/'.$imageName), $width, $height)){

                return $imageName;
            }
        }
        return false;
    }

    private function qrCode($filename = null, $width = 300, $height = 300)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->googleChartAPI);
        curl_setopt($ch, CURLOPT_POST, true);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, "chs={$width}x{}&cht=qr&chl=" . urlencode($this->url).'&choe=UTF-8&chld=H|0"');
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'chs='.$width.'x'.$height.'&cht=qr&chl='.urlencode($this->url).'&choe=UTF-8&chld=H|0');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $img = curl_exec($ch);
        curl_close($ch);

        if ($img) {
            if ($filename) {
                if (!preg_match("#\.png$#i", $filename)) {
                    $filename .= ".png";
                }

                return file_put_contents($filename, $img);
            } else {
                header("Content-type: image/png");
                print $img;
                return true;
            }
        }
        return false;
    }
    
    public function encrypt($data){
        return openssl_encrypt($data, "AES-128-ECB", $this->password);
    }

    public function decrypt($data){
        return openssl_decrypt($data, "AES-128-ECB", $this->password);
    }

}

