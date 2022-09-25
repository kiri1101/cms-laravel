<?php

namespace App\Http\Controllers;

use App\Models\Settings;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function dashboard()
    {
        $set=Settings::first();
        $data['title'] = $set->site_name.' Dashboard';
        return view('independent.dashboard.index', $data);
    }
}
