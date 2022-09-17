<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'fee';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'mobile_transfer' => 'boolean',
        'partner_deposit' => 'boolean',
        'partner_withdraw' => 'boolean',
        'agent_deposit' => 'boolean',
        'agent_withdraw' => 'boolean',
        'month_saving' => 'boolean',
        'three_months_saving' => 'boolean',
        'six_months_saving' => 'boolean',
        'personal_saving' => 'boolean',
        'general_saving' => 'boolean',
        'start_amount' => 'float',
        'end_amount' => 'float',
        'fee' => 'float',
        'currency' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
