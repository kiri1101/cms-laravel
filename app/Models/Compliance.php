<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compliance extends Model {
    
    protected $table = "compliance";
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
