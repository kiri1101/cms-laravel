<?php

namespace App\Http\Controllers\Auth;

use App\CentralLogics\Helpers;
use App\Models\User;
use App\Models\Settings;
use App\Models\Audit;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Countrysupported;
use App\Models\Compliance;
use App\Models\Gateway;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Session;
use Stripe\Stripe;
use Stripe\StripeClient;
use Stripe\Token;
use Stripe\Charge;

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
    protected $redirectTo = '/user/dashboard';

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

    public function register()
    {
        $data['title']='Register';
        $data['country']=Countrysupported::wherestatus(1)->get();
        return view('auth.register', $data);
    }    

    public function submitregister(Request $request)
    {
        $set = $data['set']=Settings::first();
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|numeric|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $validator->sometimes('g-recaptcha-response', 'required|captcha', function ($set) {
            return $set->recaptcha == 1;
        });

        if ($validator->fails()) {
            // adding an extra field 'error'...
            $data['title']='Register';
            $data['errors']=$validator->errors();
            $data['country']=Countrysupported::wherestatus(1)->get();
            return view('auth.register', $data);
        }

        if ($set->email_verification == 1) {
            $email_verify = 0;
        } else {
            $email_verify = 1;
        }

        $country = Country::whereid($request->country)->first();
        $country_supported = Countrysupported::wherecountry_id($request->country)->first();
        // $currency = Currency::whereStatus(1)->first();
        $data = [];
        $data['first_name'] = $request->first_name;
        $data['last_name'] = $request->last_name;
        $data['country'] = $request->country;
        $data['pay_support'] = $country_supported->id;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['email_verify'] = $email_verify;
        $data['balance_reg'] = $set->balance_reg;
        $data['password'] = $request->password;

        if($set->stripe_connect == 1) {
            $gate = Gateway::find(103);
            $stripe = new StripeClient($gate->val2);
         
            DB::beginTransaction();
            try{
                $stripe->accounts->create([
                    'type' => 'custom',
                    'country' => $country->iso,
                    'email' => $request->email,
                    'capabilities' => [
                        'card_payments' => ['requested' => true],
                        'transfers' => ['requested' => true],
                    ],
                    'tos_acceptance' => [
                        'date' => time(),
                        'ip' => $_SERVER['REMOTE_ADDR'], 
                    ],                  
                    'business_profile' => [
                        'url' => url('/'),
                    ],
                ]);

                $user = new User();
                $user->image = 'person.png';
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->country = $request->country;
                $user->pay_support = $country_supported->id;
                $user->phone = $request->phone;
                $user->email = $request->email;
                $user->email_verify = $email_verify;
                $user->verification_code = strtoupper(Str::random(6));
                $user->email_time = Carbon::parse()->addMinutes(5);
                $user->balance = $set->balance_reg;
                $user->ip_address = user_ip();
                $user->password = Hash::make($request->password);
                $user->public_key='PUB-'.str_random(32);        
                $user->secret_key='SEC-'.str_random(32); 
                $user->last_login=Carbon::now();
                $user->save();

            } catch (\Stripe\Exception\RateLimitException $e) {
                return back()->with('alert', $e->getMessage());
            } catch (\Stripe\Exception\InvalidRequestException $e) {
                return back()->with('alert', $e->getMessage());
            } catch (\Stripe\Exception\AuthenticationException $e) {
                return back()->with('alert', $e->getMessage());
            } catch (\Stripe\Exception\ApiConnectionException $e) {
                return back()->with('alert', $e->getMessage());
            } catch (\Stripe\Exception\ApiErrorException $e) {
                return back()->with('alert', $e->getMessage());
            } catch (\Exception $e) {
                return back()->with('alert', $e->getMessage());
            }
        } else {
            $user = new User();
            $user->image = 'person.png';
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->country = $request->country;
            $user->pay_support = $country_supported->id;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->email_verify = $email_verify;
            $user->verification_code = strtoupper(Str::random(6));
            $user->email_time = now()->addMinutes(5);
            $user->balance = $set->balance_reg;
            $user->ip_address = user_ip();
            $user->password = Hash::make($request->password);
            $user->public_key='PUB-'.str_random(32);        
            $user->secret_key='SEC-'.str_random(32); 
            $user->last_login = now();
            $user->save();
        }

        if ($set->email_verification == 1) {
            $text = "Before you can start accepting payments, you need to confirm your email address. Your email verification code is ".$user->verification_code;
            send_email($user->email, $user->first_name.' '.$user->last_name, 'Hello '.$request->first_name, $text);
            send_email($user->email, $user->first_name.' '.$user->last_name, 'Welcome to '.$set->site_name, $set->welcome_message);
        }

        if (Auth::guard('user')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            return redirect()->route('user.dashboard');
        }
    }  

    public function registerPartner(Request $request) 
    {
        $set=Settings::first();
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|numeric|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $validator->sometimes('g-recaptcha-response', 'required|captcha', function ($set) {
            return $set->recaptcha == 1;
        });

        if ($validator->fails()) {
            // adding an extra field 'error'...
            $data['title']='Register';
            $data['errors']=$validator->errors();
            $data['country']=Countrysupported::wherestatus(1)->get();
            return view('auth.register', $data);
        }

        if ($set->email_verification == 1) {
            $email_verify = 0;
        } else {
            $email_verify = 1;
        }

        $user = new User();
        $user->image = 'person.png';
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->email_verify = $email_verify;
        $user->verification_code = strtoupper(Str::random(6));
        $user->email_time = now()->addMinutes(5);
        $user->balance = $set->balance_reg;
        $user->type = "0"; //['Partner'=>0, 'Agent'=>1, 'Agent Pro'=>2, 'Customer'=>3]
        $user->ip_address = user_ip();
        $user->password = Hash::make($request->password);
        $user->public_key='PUB-'.str_random(32);        
        $user->secret_key='SEC-'.str_random(32); 
        $user->last_login = now();
        $user->save();

        if ($set->email_verification == 1) {
            $text = "Before you can start accepting payments, you need to confirm your email address. Your email verification code is ".$user->verification_code;
            send_email($user->email, $user->first_name.' '.$user->last_name, 'Hello '.$request->first_name.' '.$request->last_name, $text);
            send_email($user->email, $user->first_name.' '.$user->last_name, 'Welcome to '.$set->site_name, $set->welcome_message);
        }

        if (Auth::guard('user')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            return redirect()->route('partner.dashboard')->with('success', 'Welcome To HaurizonPay');
        }
    }  

    public function registerAgent(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|numeric|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $validator->sometimes('g-recaptcha-response', 'required|captcha', function ($set) {
            return $set->recaptcha == 1;
        });
        
        if ($validator->fails()) {
            // adding an extra field 'error'...
            $data['title']='Register';
            $data['errors']=$validator->errors();
            $data['country']=Countrysupported::wherestatus(1)->get();
            return back()->with($data);
        }

        $set=Settings::first();

        if ($set->email_verification == 1) {
            $email_verify = 0;
        }else {
            $email_verify = 1;
        }

        DB::beginTransaction();
        try {
            $user = new User();
            $user->image = 'person.png';
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->email_verify = $email_verify;
            $user->verification_code = strtoupper(Str::random(6));
            $user->email_time = now()->addMinutes(5);
            $user->balance = $set->balance_reg;
            $user->type = "2";  //['Partner'=>0, 'Agent'=>1, 'Agent Pro'=>2, 'Customer'=>3]
            $user->ip_address = user_ip();
            $user->password = Hash::make($request->password);
            $user->public_key='PUB-'.str_random(32);        
            $user->secret_key='SEC-'.str_random(32); 
            $user->last_login = now();
            $user->save();
    
            if ($set->email_verification == 1) {
                $text = "Before you can start accepting payments, you need to confirm your email address. Your email verification code is ".$user->verification_code;
                send_email($user->email, $user->first_name.' '.$user->last_name, 'Hello '.$request->first_name.' '.$request->last_name, $text);
                send_email($user->email, $user->first_name.' '.$user->last_name, 'Welcome to '.$set->site_name, $set->welcome_message);
            }
    
            if (Auth::guard('user')->attempt([
                'email' => $request->email,
                'password' => $request->password,
            ])) {
                
                DB::commit();
                return redirect()->route('agentpro.dashboard')->with('success', 'Welcome To HaurizonPay');
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            report($th);
            return back()->with('alert', 'Operation Failed!');
        }
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
