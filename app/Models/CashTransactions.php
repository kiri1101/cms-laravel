<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashTransactions extends Model
{
    use HasFactory;
    
    protected $table = "cash_transactions";
    protected $guarded = [];
}
