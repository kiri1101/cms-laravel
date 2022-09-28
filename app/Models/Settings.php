<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model {
    protected $table = "settings";
    protected $guarded = [];

    public function currencyCode($currency)
    {
        $settings = Self::first();
        switch ($currency) {
            case 'extra1':
                $code = $settings->extra1_code;
                break;
            case 'extra2':
                $code = $settings->extra2_code;
                break;
            case 'extra3':
                $code = $settings->extra3_code;
                break;           
            case 'extra4':
                $code = $settings->extra4_code;
                break;
            case 'extra5':
                $code = $settings->extra5_code;
                break;
            
            default:
                $code = $settings->base_code;
                break;
        }

        return $code;
    }
}
