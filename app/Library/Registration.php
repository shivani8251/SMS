<?php
namespace App\Library;
use App\User;
use Illuminate\Support\Facades\Hash;
class Registration
{
    var $params, $mobile;
    public function __construct()
    {
        $input = request()->all();
        $list = [
            "mobile", "created_at"
        ];
        $this->mobile = $input['mobile'];

        foreach($list as $key)
        {
            if((isset($input[$key]))&&(!empty($input[$key])))
            {
                if($key=="created_at")
                {
                    $this->params[$key] = date('Y-m-d H:i:s');
                }
                else
                {
                    $this->params[$key] = $input[$key];
                }

            }
        }
        // if(empty($input['password']))
        // {
        //     $this->params['password'] = Hash::make($input['mobile']);
        // }
        // $this->params['status'] = 1;
        
    }
    public function register()
    {
        $user = User::where(['mobile' => $this->mobile])->first();
        if(!empty($user))
        {
            // if (User::where(['mobile'=>$this->mobile])->update($this->params)) {
                return $user->id;
            // }
        }
        else
        {
            // if(!empty($this->params['email']))
            // {
            //      $user = User::where(['email' => $this->params['email']])->first();

            //     if (!empty($user))
            //     {

            //         if (User::where(['email' => $this->params['email']])->update($this->params)) {
            //             return $user->id;
            //         }
            //     }
            //     else
            //     {
            //         if ($user = User::create($this->params))
            //         {
            //           return $user->id;
            //         }
            //     }
            // }
            // else
            // {

                if ($user = User::create($this->params)) {
                    return $user->id;
                }
            // }
        }
        return false;
    }

}
