<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Transaction;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Image;

class ProfileController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $data['user'] = Admin::where('id', Auth::id())->first();
        return view("admin.profile")->with($data);
    }

    public function upload(Request $request)
    {
        if ($file = $request->file('file'))
        {
            $ext = $request->file('file')->getClientOriginalExtension();
            $imgName = rand(100000000, 999999999).'_img.'.$ext;
            $file = $request->file->storeAs('public/users', $imgName);
            $data = $imgName;

            return response()->json([
                "success" => true,
                "file" => $data
            ]);
        }
        else
        {
            return response()->json([
                "success" => false
            ]);
        }
    }

    public function update(Request $request)
    {
        $chkUniqueUsername = Admin::where('is_active', 'Yes')->where('status', 'Active')->where('username', $request->username)->where('id', '!=', $request->user_id)->get()->count();
        $chkUniqueEmail = Admin::where('is_active', 'Yes')->where('status', 'Active')->where('email_id', $request->email_id)->where('id', '!=', $request->user_id)->get()->count();
        $chkUniqueMobile = Admin::where('is_active', 'Yes')->where('status', 'Active')->where('mobile', $request->mobile)->where('id', '!=', $request->user_id)->get()->count();

        if($chkUniqueUsername>0)
        {
           return response()->json([ 'status' => false, 'message' => 'The username already exist !' ]); 
        }
        else if($chkUniqueEmail>0)
        {
           return response()->json([ 'status' => false, 'message' => 'The email id already exist !' ]); 
        }
        else if($chkUniqueMobile>0)
        {
           return response()->json([ 'status' => false, 'message' => 'The mobile number already exist !' ]); 
        }
        else
        {
            $user = Admin::find($request->user_id);
            if(isset($user->id))
            {
                $user->full_name = $request->full_name;
                $user->username = $request->username;
                $user->email_id = $request->email_id;
                $user->mobile = $request->mobile;
                if(isset($request->profilepic))
                {
                    if($request->profilepic!=$user->profilepic)
                    {
                        $user->profilepic = $request->profilepic;
                    }
                }
                $query = $user->save();

                if ($query)
                {
                    return response()->json([
                        "status" => true,
                        'message' => 'Profile updated successfully !'
                    ]);
                }
                else
                {
                    return response()->json([
                        "status" => false,
                        'message' => 'Profile not updated !'
                    ]);
                }
            }
            else
            {
                return response()->json([
                    "status" => false,
                    'message' => 'Data not found !'
                ]);
            }
        }
    }

    public function changePassword(Request $request)
    {

        $adminPass = Admin::where("id", $request->id)->value("password");

        if (Hash::check($request->old_password, $adminPass))
        {
            $admin = Admin::find($request->id);
            $admin->pwd = $request->password;
            $admin->password = Hash::make($request->password);
            $query = $admin->save();

            if ($query)
            {
                return response()->json([
                    "status" => true,
                    'message' => 'Your password changed successfully !'
                ]);
            }
            else
            {
                return response()->json([
                    "status" => false,
                    'message' => 'Something went wrong !'
                ]);
            }
        }
        else
        {
            return response()->json(["status" => false, 'message' => 'Please enter valid old password !']);
        }
    }

    public function branding(Request $request)
    {
        if(Auth::user()->user_type=='admin' || Auth::user()->user_type=='reseller')
        {
            $data['user'] = Admin::where('id', Auth::id())->first();
            return view("admin.branding")->with($data);
        }
        else
        {
            abort(404);
        }
    }

    public function uploadBusinessLogo(Request $request)
    {
        if ($file = $request->file('file'))
        {
            $ext = $request->file('file')->getClientOriginalExtension();
            $imgName = rand(100000000, 999999999).'_img.'.$ext;
            $file = $request->file->storeAs('public/users/business_logos', $imgName);
            $data = $imgName;

            return response()->json([
                "success" => true,
                "file" => $data
            ]);
        }
        else
        {
            return response()->json([
                "success" => false
            ]);
        }
    }

    public function updateBusinessDetails(Request $request)
    {
        $user = Admin::find($request->user_id);
        if(isset($user->id))
        {
            $user->company = $request->company;
            $user->business_contact = $request->business_contact;
            if(isset($request->business_logo))
            {
                if($request->business_logo!=$user->business_logo)
                {
                    $user->business_logo = $request->business_logo;
                }
            }
            $query = $user->save();

            if ($query)
            {
                return response()->json([
                    "status" => true,
                    'message' => 'Details updated successfully !'
                ]);
            }
            else
            {
                return response()->json([
                    "status" => false,
                    'message' => 'Details not updated !'
                ]);
            }
        }
        else
        {
            return response()->json([
                "status" => false,
                'message' => 'Data not found !'
            ]);
        }
    }

    public function updateCredit(Request $request)
    {
        $user = Admin::find($request->id);
        if(isset($user->id))
        {
            $updatedCredit = intval($user->credit)+intval($request->credit);
            $user->credit = $updatedCredit;
            $query = $user->save();

            $trans = new Transaction;
            $trans->credit = $request->credit;
            $trans->per_sms_price = 0;
            $trans->tax_status = 'No';
            $trans->tax_amount = 0;
            $trans->total_amount = 0;
            $trans->login_user_unique_id = Auth::user()->user_unique_id;
            $trans->user_unique_id = Auth::user()->user_unique_id;
            $trans->type = 'user';
            $trans->txn_type = 'credit';
            $trans->save();

            if ($query)
            {
                return response()->json([
                    "status" => true,
                    'message' => 'Credit added successfully !'
                ]);
            }
            else
            {
                return response()->json([
                    "status" => false,
                    'message' => 'Credit not updated !'
                ]);
            }
        }
        else
        {
            return response()->json([
                "status" => false,
                'message' => 'Data not found !'
            ]);
        }
    }

}
