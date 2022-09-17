<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model {

    protected $guarded = [];

    public static function branchExist($data)
    {
        return Self::wherename($data->name)->Orwhere('chief', $data->chief)->get();
    }
    
    public function users() 
    {
        return $this->belongsToMany(User::class, 'agents')->withTimestamps();
    }
}