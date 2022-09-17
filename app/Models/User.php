<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'facebook', 
        'twitter', 
        'instagram', 
        'linkedin', 
        'youtube'
    ];
    protected $guard = 'user';

    protected $table = 'users';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function branch()
    {
        return $this->belongsToMany(Branch::class, 'agents')->withTimestamps();
    }

    public function deposit()
    {
        return $this->hasMany('App\Model\Deposit', 'user_id');
    }   

    public static function agentList()
    {
        return Self::wheretype('2')->get();
    }

    public function compliance()
    {
        return $this->hasOne(Compliance::class);
    }

    public function paymentLink()
    {
        return $this->hasMany(PaymentLink::class);
    }
}
