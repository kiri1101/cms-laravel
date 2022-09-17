<?php 

namespace App\CentralLogics;

use App\Models\Branch;
use App\Models\Currency;
use App\Models\Fee;
use App\Models\Settings;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class Helpers {
    public static function get_user_info($user_id)
    {
        return User::find($user_id);
    }

    public static function set_symbol($amount, $currency)
    {
        return Self::currency_symbol($currency) .' '. Self::format_number($amount, 2);
    }

    public static function currency_symbol($currency)
    {
        $currency_code = Self::currency_code($currency); 
        return Currency::wherename($currency_code)->value('symbol');
    }

    public static function format_number($value, $param)
    {
        $float = (float) $value;
        return round($float, $param);
    }

    public static function currency_code($currency)
    {
        $setting = Settings::findOrFail(1);
        if($currency=='base') {
            $currency_code = $setting->base_code;
        }
        if($currency=='extra1') {
            $currency_code = $setting->extra1_code;
        }
        if($currency=='extra2') {
            $currency_code = $setting->extra2_code;
        }
        if($currency=='extra3') {
            $currency_code = $setting->extra3_code;
        }
        if($currency=='extra4') {
            $currency_code = $setting->extra4_code;
        }
        if($currency=='extra5') {
            $currency_code = $setting->extra5_code;
        }
        return $currency_code ?? NULL;
    }

    public static function currencyCode($currency) 
    {
        if ($currency == 'base') {
            $currency_code = Settings::first()->base_code;
        } 
        if ($currency == 'extra1') {
            $currency_code = Settings::first()->extra1_code;            
        } 
        if ($currency == 'extra2') {
            $currency_code = Settings::first()->extra2_code;            
        } 
        if ($currency == 'extra3') {
            $currency_code = Settings::first()->extra3_code;            
        } 
        if ($currency == 'extra4') {
            $currency_code = Settings::first()->extra4_code;            
        } 
        if ($currency == 'extra5') {
            $currency_code = Settings::first()->extra5_code;            
        }

        return $currency_code;
    }

    public static function storeCommission($data)
    {
        $mobile_transfer = $data['mobileTransfer'];
        $partner_deposit = $data['partner_deposit'];
        $partner_withdraw = $data['partner_withdraw'];
        $agent_deposit = $data['agent_deposit'];
        $agent_withdraw = $data['agent_withdraw'];
        $month_saving = $data['month_saving'];
        $three_months_saving = $data['three_months_saving'];
        $six_months_saving = $data['six_months_saving'];
        $personal_saving = $data['personal_saving'];
        $general_saving = $data['general_saving'];
        $start_amount = $data['start_amount'];
        $end_amount = $data['end_amount'];
        $fee = $data['fee'];
        $currency = $data['currency'];
        $transaction_id = Str::random(40);

        try {
            $fees = new Fee;
            if (isset($mobile_transfer)) {
                $fees->mobile_transfer = $mobile_transfer;
            }
    
            if (isset($partner_deposit)) {
                $fees->partner_deposit = $partner_deposit;
            }
    
            if (isset($partner_withdraw)) {
                $fees->partner_withdraw = $partner_withdraw;
            }
    
            if (isset($agent_deposit)) {
                $fees->agent_deposit = $agent_deposit;
            }
    
            if (isset($agent_withdraw)) {
                $fees->agent_withdraw = $agent_withdraw;
            }
            
            if (isset($month_saving)) {
                $fees->month_saving = $month_saving;
            }
    
            if (isset($three_months_saving)) {
                $fees->three_months_saving = $three_months_saving;
            }
    
            if (isset($six_months_saving)) {
                $fees->six_months_saving = $six_months_saving;
            }
    
            if (isset($personal_saving)) {
                $fees->personal_saving = $personal_saving;
            }
    
            if (isset($general_saving)) {
                $fees->general_saving = $general_saving;
            }
    
            $fees->start_amount = $start_amount;
            $fees->end_amount = $end_amount;
            $fees->fee = $fee;
            $fees->currency = $currency;
            $fees->transaction_id = $transaction_id; 
            $fees->save();

            return $transaction_id;
        } catch (\Throwable $th) {
            report($th);
            return false;
        }
    }

    public static function currencyCheck($currency, $startAmount, $endAmount)
    {
        //check if start amount OR end amount already exist
        return Fee::where('currency', $currency)
                    ->where('start_amount', '<=', $startAmount) ->Orwhere('end_amount', '>=', $endAmount)
                    ->get();
    }

    public static function createBranch($data) 
    {
        $name = $data['name'];
        $chief = $data['chief'];
        $country = $data['country'];
        $state = $data['state'];
        $mobile = $data['mobile'];
        $zipcode = $data['zip_code'];
        $postal = $data['postal_code'];
        $address = $data['address'];
        $partner = $data['partner'];

        //Start DB Commit
        $branch = new Branch;
        $branch->name = $name;
        $branch->chief = $chief;
        $branch->country = $country;
        $branch->state = $state;
        $branch->mobile = $mobile;
        $branch->zipcode = $zipcode;
        $branch->postal_code = $postal;
        $branch->address = $address;
        $branch->partner = $partner;
        $branch->save();

        return $name;
    }

    public static function createAgent($data)
     {
        $firstName = $data['first_name'];
        $lastName = $data['last_name'];
        $businessName = $data['business_name'];
        $phone = $data['phone'];
        $email = $data['email'];
        $country = $data['country'];
        $emailVerify = $data['email_verify'];
        $balanceReg = $data['balance_reg'];
        $password = $data['password'];
        $emailVerification = $data['email_verification'];
        $welcomeMessage = $data['welcome_message'];
        $siteName = $data['site_name'];
        $code = Str::random(40);

        try {
            $user = new User();
            $user->image = 'person.png';
            $user->first_name = $firstName;
            $user->last_name = $lastName;
            $user->business_name = $businessName;
            $user->phone = $phone;
            $user->email = $email;
            $user->country = $country;
            $user->email_verify = $emailVerify;
            $user->verification_code = strtoupper(Str::random(6));
            $user->email_time = now()->addMinutes(5);
            $user->balance = $balanceReg;
            $user->ip_address = user_ip();
            $user->password = Hash::make($password);
            $user->public_key='PUB-'.str_random(32);        
            $user->secret_key='SEC-'.str_random(32); 
            $user->last_login = now();
            $user->save();

            if ($emailVerification == 1) {
                $text = "Before you can start accepting payments, you need to confirm your email address. Your email verification code is ".$user->verification_code;
                send_email($user->email, $user->business_name, 'Hello '.$businessName, $text);
                send_email($user->email, $user->business_name, 'Welcome to '.$siteName, $welcomeMessage);
            }
    
            return $code;
        } catch (\Throwable $th) {
            report($th);
            return false;
        }

     }
}
