<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BranchTransactions extends Model
{
    use HasFactory;

    protected $table = "branch_transactions";
    protected $guarded = [];
}
