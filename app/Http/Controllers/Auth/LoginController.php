<?php

namespace App\Http\Controllers\Auth;

use App\CentralLogics\Helpers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Settings;
use App\Models\Audit;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:user');
    }

    public function login()
    {
		$data['title']='Login';
        return view('auth.login', $data);
    } 

    public function submitlogin(Request $request)
    {
        $set = $data['set'] = Settings::first();
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required'
        ]);

        $validator->sometimes('g-recaptcha-response', 'required|captcha', function ($set) {
            return $set->recaptcha == 1;
        });

        if ($validator->fails()) {
            // adding an extra field 'error'...
            $data['title']='Login';
            $data['errors']=$validator->errors();
            return view('auth.login', $data);
        }

        $remember_me = $request->has('remember_me') ? true : false; 
        if (Auth::guard('user')->attempt([
            'email' => $request->email, 
            'password' => $request->password
            ], $remember_me)) {

        	$ip_address = user_ip();
        	$user = User::whereid(Auth::guard('user')->user()->id)->first();
        	if ($ip_address!=$user->ip_address && $set['email_notify'] == 1) {
    			send_email($user->email, $user->username, 'Suspicious Login Attempt', 'Sorry your account was just accessed from an unknown IP address<br> ' .$ip_address. '<br>If this was you, please you can ignore this message or reset your account password.');
        	}

	        $user->last_login = now();
	        $user->ip_address = $ip_address;
            $user->save();
         
            if(Session::has('oldLink')) {
                return Redirect::to(Session::get('oldLink'));
            }
            if ($user->type=='0') {
                return redirect()->route('partner.dashboard');
            }
            if ($user->type=='1') {
                return redirect()->route('agent.Dashboard');
            }
            if ($user->type=='2') {
                return redirect()->route('independent.dashboard');
            }
            if ($user->type=='3') {
                return redirect()->route('user.dashboard');
            }
            return back()->with('alert', 'Invalid user account');
        } else {
        	return back()->with('alert', 'Oops! You have entered invalid credentials')->withInput($request->only('email', 'remember'));
        }
    }
}
