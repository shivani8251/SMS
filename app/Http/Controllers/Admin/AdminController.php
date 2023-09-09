<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Validator;
use App\Models\User;
use App\Http\Controllers\SMSController;
use Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
	use AuthenticatesUsers;

    protected function authenticated(Request $request, $user)
    {
        return redirect()->route('home');
    }

    public function index(Request $request)
    {
        // for($i=1; $i <=1570; $i++)
        // { 
        //     $data = User::find($i);

        //     if(isset($data->id))
        //     {
        //         $data->password = Hash::make($data->pwd);
        //         $updated = $data->save();
        //     }
        // }

        return view('admin.login');
    }


    public function register(Request $request)
    {
        // return redirect()->route('admin.register');
    }

    public function customlogin(Request $request)
    {
        $user = Admin::where('email_id', $request->username)->orWhere('username', $request->username)->first();
        if(isset($user->id))
        {
            if($user->user_type=='admin')
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

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }

    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        return redirect()->route('admin.login');
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }
}
