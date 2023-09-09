<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Image;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            // 'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'mobileno' => ['required', 'min:10', 'max:10'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $address = NULL;
        if(isset($data['address']))
        {
            $address = $data['address'];
        }

        $events = NULL;
        if(isset($data['events']))
        {
            $events = $data['events'];
        }

        $city = NULL;
        if(isset($data['city']))
        {
            $city = $data['city'];
        }

        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'date_of_birth' => date("Y-m-d", strtotime($data['date_of_birth'])),
            'age' => $data['age'],
            'password' => Hash::make($data['password']),
            'school' => $data['school'],
            'class' => $data['class'],
            'mobileno' => $data['mobileno'],
            'city' => $city,
            'profile_pic' => $data['profile_pic'],
            'schoolid_proof' => $data['schoolid_proof'],
            'address' => $address,
            'events' => $events,
        ]);

        // if($user)
        // {
        //     $result = ['status' => true, 'message' => 'Student registered successfully !'];
        // }
        // else
        // {
        //     $result = ['status' => false, 'message' => 'Something went wrong !'];
        // }

        // return response()->json($result);
    }

    public function uploadStudentProfilePic(Request $request)
    {

        if ($file = $request->file('file'))
        {
            $ext = $request->file('file')->getClientOriginalExtension();
            $imgName = rand(100000000, 999999999).'_img.'.$ext;

            $file = $request->file->storeAs('public/students/profile_pic', $imgName);

            $fileSize = $request->file('file')->getSize(); // Getting file size
            $fileSizeInKB = $fileSize/1024; // Getting file size in KB

            if (intval($fileSizeInKB)>=101) {
                Image::make($request->file('file')->getRealPath())->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('public/storage/students/profile_pic/'.$imgName);
            }
            else
            {
                Image::make($request->file('file')->getRealPath())->save('public/storage/students/profile_pic/'.$imgName);
            }

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

    public function uploadStudentSchoolProof(Request $request)
    {

        if ($file = $request->file('file'))
        {
            $ext = $request->file('file')->getClientOriginalExtension();
            $imgName = rand(100000000, 999999999).'_img.'.$ext;

            $file = $request->file->storeAs('public/students/schoolid_proof', $imgName);

            $fileSize = $request->file('file')->getSize(); // Getting file size
            $fileSizeInKB = $fileSize/1024; // Getting file size in KB

            if (intval($fileSizeInKB)>=101) {
                Image::make($request->file('file')->getRealPath())->resize(500, 500, function ($constraint) {
                    $constraint->aspectRatio();
                })->save('public/storage/students/schoolid_proof/'.$imgName);
            }
            else
            {
                Image::make($request->file('file')->getRealPath())->save('public/storage/students/schoolid_proof/'.$imgName);
            }

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
}
