<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Validator;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\SMSController;
use Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function index(Request $request)
    {
        return view('user.login');
    }

    public function customlogin(Request $request)
    {
        $user = Admin::where('email_id', $request->username)->orWhere('username', $request->username)->first();
        if(isset($user->id))
        {
            if(($user->user_type=='user' || $user->user_type=='reseller') && $user->is_active=='Yes' && $user->status=='Active')
            {
                $this->validateLogin($request);
                if (method_exists($this, 'hasTooManyLoginAttempts') &&
                    $this->hasTooManyLoginAttempts($request)) {
                    $this->fireLockoutEvent($request);

                    return $this->sendLockoutResponse($request);
                }

                if ($this->attemptLogin($request)) {
                    return $this->sendLoginResponse($request);
                }

                $this->incrementLoginAttempts($request);

                return $this->sendFailedLoginResponse($request);
            }
            else
            {
                return $this->sendFailedLoginResponse($request);
            }
        }
        else
        {
            return $this->sendFailedLoginResponse($request);
        }
    }

    public function userLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails())
        {
            $result = [ 'status' => false, 'message' => "Please fill all required fields" ];
        }
        else
        {
            $user = Admin::where('email_id', $request->email)->first();
            if ($user)
            {
                if($user->user_type=='user' || $user->user_type=='reseller')
                {
                    if(Hash::check($request->password, $user->password))
                    {
                        Auth::login($user);
                        // dd(Auth::check());
                        $result = [ 'status' => true, 'message' => 'Login successfully !' ];
                    }
                    else
                    {
                        $result = [ 'status' => false, 'message' => 'Password not matched !' ];
                    }
                }
                else
                {
                    $result = [ 'status' => false, 'message' => 'Login unauthenticated !' ];
                }
            }
            else
            {
                $result = [ 'status' => false, 'message' => 'Email address not matched !' ];
            }
        }

        return response()->json($result);
    }
}
