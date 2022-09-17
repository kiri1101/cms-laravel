<?php

namespace App\Http\Controllers;

use App\CentralLogics\Helpers;
use App\Models\Branch;
use App\Models\Branch_user;
use App\Models\Branchtransactions;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PartnerController extends Controller
{
    public function dashboard()
    {
        $set=Settings::first();
        $data['title']=$set->site_name.' Dashboard';
        return view('partner.dashboard', $data);
    }

    public function branchDashboard()
    {
       $data['set'] = Settings::first();
       $data['branches'] = Branch::all();
       $data['title']='Partner Branches';
        return view('partner.branch.index', $data);
    }

    public function Newbranch()
    {
		$data['title'] = 'New Branch';
        $data['agent'] = User::agentList();
        return view('partner.branch.new', $data);
    } 

    public function Createbranch(Request $request)
    {        
        $validator = Validator::make($request->all(), [
            'name'      => 'required|max:255|unique:branch,name',
            'country'   => 'required',
            'state'     => 'required',
            'mobile'    => 'required|min:9|unique:branch,mobile',
            'zipcode'   => 'required',
            'postal'    => 'required',
            'address'   => 'required',
            'chief_id'     => 'required|numeric|integer',
        ]);

        // validation fail response
        if ($validator->fails()) {
            return redirect()->route('partner.newbranch')
                        ->withErrors($validator)
                        ->withInput();
        }

        //get branch chief
        $chief = User::find($request->chief_id);

        // get data
        $data['name'] = $request->name;
        $data['chief'] = $chief->first_name .' '. $chief->last_name;
        $data['country'] = $request->country;
        $data['state'] = $request->state;
        $data['mobile'] = $request->mobile;
        $data['zip_code'] = $request->zipcode;
        $data['postal_code'] = $request->postal;
        $data['address'] = $request->address;
        $data['partner'] = User::find($request->id)->business_name;

        //Check if branch exist
        $branchname = Branch::branchExist($data);
        if (! isset($branchname)) {
            return back()->with('warning', 'Branch already exist');
        }

        //Initiate creation of new branch
        DB::beginTransaction();
        try {
            $branchName = Helpers::createBranch($data);

            if (! isset($branchName)) {
                DB::rollBack();
                return back()->with('warning', 'Branch not saved');
            }

            DB::commit();
            return redirect()->route('branch.dashboard')->with('success', 'Branch was successfully created');
        } catch (\Exception $th) {
            report($th);
            DB::rollBack();
            return back()->with('alert', 'Operation failed!');
        }
    } 
    
    public function Managebranch($id)
    {
        $data['client'] = $branch = Branch::find($id);
        $data['title'] = $branch->name;
        return view('partner.branch.edit', $data);
    }

    public function Branchupdate(Request $request)
    {
        Branch::find($request->id)->update([
            'name' => $request->name,
            'country' => $request->country,
            'state' => $request->state,
            'mobile' => $request->mobile,
            'zip_code' => $request->zip_code,
            'postal_code' => $request->postal,
            'address' => $request->address,
            'chief' => $request->chief
        ]);

        return back()->with('success', 'Update was Successful!');
    }  

    public function Destroybranch($id)
    {
        if (! array_key_exists($id, Branch::pluck('id')->all())) {
            return back()->with('alert', 'Oops! Your operation Failed. Please Try again later');
        }

        Branch::find($id)->delete();
        return back()->with('success', 'Branch was successfully deleted');
    }
    
    public function agentDashboard()
    {
       $data['set'] = Settings::first();
       $data['agent'] = User::agentList();
       $data['title'] = 'Partner Agents';
        return view('partner.agent.index', $data);
    }

    public function newAgent()
    {
		$data['title']='New Agent';
        return view('partner.agent.new', $data);
    } 

    public function createAgent(Request $request)
    {        
        $validator = Validator::make($request->all(), [
            'business_name'     => 'required|max:255|unique:users,business_name',
            'first_name'        => 'required',
            'last_name'         => 'required',
            'email'             => 'required|min:9|unique:users,email',
            'country'           => 'required',
            'phone'             => 'required',
        ]);

        // validation fail response
        if ($validator->fails()) {
            return redirect()->route('partner.newagent')
                        ->withErrors($validator)
                        ->withInput();
        }

        $set = Settings::first();

        if ($set->email_verification == 1) {
            $email_verify = 0;
        }else {
            $email_verify = 1;
        }

        //Start Transaction
        DB::transaction();
        try {
            //Collect data
            $data['first_name'] = $request->first_name;
            $data['last_name'] = $request->last_name;
            $data['business_name'] = $request->business_name;
            $data['phone'] = $request->phone;
            $data['email'] = $request->email;
            $data['country'] = $request->country;
            $data['email_verify'] = $email_verify;
            $data['balance_reg'] = $set->balance_reg;
            $data['password'] = Hash::make($request->password);
            $data['email_verification'] = $set->email_verification;
            $data['welcome_message'] = $set->welcome_message;
            $data['site_name'] = $set->site_name;
            
            //Save agent
            $agentUser = Helpers::createAgent($data);

            if (! isset($agentUser)) {
                DB::rollBack();
                return back()->with('Operation failed!');
            }

            DB::commit();    
            return back()->with('success', 'Agent was successfully created');
        } catch (\Throwable $th) {
            DB::rollBack();
            report($th);
            return back()->with('alert', 'Operation failed!');
        }
    } 

    public function manageAgent($id)
    {
        $data['client'] = $agent = User::find($id);
        $data['title'] = $agent->business_name;
        $data['branch'] = Branch::all();
        return view('partner.agent.edit', $data);
    }

    public function agentUpdate(Request $request)
    {
        try {
            $data = User::findOrFail($request->id);
            $data->business_name = $request->username;
            $data->first_name = $request->first_name;
            $data->last_name = $request->last_name;
            $data->email = $request->email;
            $data->country = $request->country;
            $data->phone = $request->phone;
            $data->save();

            return back()->with('success', 'Update was Successful!');
        } catch (\Throwable $th) {
            report($th);
            return back()->with('alert', 'An error occured');
        }
    }  

    // public function Destroyagent($id)
    // {
    //     $check = User::whereid($id)->first();
    //     if ($check != null && $check['is_agent'] == 1) {

    //         User::whereId($id)->delete();
    //         return back()->with('success', 'Agent was successfully deleted');
    //     } else {
    //         return back()->with('alert', 'Oops! Your operation Failed. Pleas Try again later');
    //     }
    // }

    public function transactionDashboard()
    {
        $data['set'] = Settings::first();
        $data['transaction'] = BranchTransactions::wherepartner(Auth::guard('user')->user()->id)->get();
        $data['title'] = 'Partner Transactions';
         return view('partner.transactions.index', $data);        
    }

    public function logout()
    {
        if (Auth::check()) {
            $user = User::findOrFail(Auth::user()->id);
            $user->fa_expiring = Carbon::now()->subMinutes(30);
            $user->save();
            session()->forget('oldLink');
            Auth::logout();
            session()->flash('message', 'Just Logged Out!');
            return redirect()->route('login');
        }else{
            return redirect()->route('login');
        }
    }
}
