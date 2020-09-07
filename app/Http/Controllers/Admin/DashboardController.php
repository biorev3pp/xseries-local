<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\States;
use App\Models\Cities;
use App\Models\Communities;
use App\Models\Homes;
use App\Admins;
use App\Models\Estimates;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Imports\CommunitiesImport;
use Maatwebsite\Excel\Facades\Excel;

class DashboardController extends Controller
{
    public $data;
    public function __construct(){
        $this->data['page_title'] = 'Dashboard';
        $this->data['menu'] = 'dashboard';
    }

    public function index()
    {
        if (isset(Auth::user()->id) && Auth::user()->admin_role_id==1  || Auth::user()->admin_role_id==3) {  
            $communities = Communities::all();
            $homes = Homes::where('parent_id',0)->get();
            $leads = Admins::where('admin_role_id',2)->get();
            $this->data['communities'] = $communities;
            $this->data['homes'] = $homes;
            $this->data['leads'] = $leads;
            return view('admin.dashboard')->with($this->data);
        }else{
            return redirect(route('welcome'));
        }
    }

    public function indexnew()
    {
        $communities = Communities::all();
        $homes = Homes::all();
        $leads = Leads::all();
        $this->data['communities'] = $communities;
        $this->data['homes'] = $homes;
        $this->data['leads'] = $leads;
        return view('admin.dashboard2')->with($this->data);
    }

    public function listStates(){
        $states = States::get();
        $this->data['menu'] = 'states';
        return view('admin.states',compact('states'))->with($this->data);
    }
    public function listCities(){
        $cities = Cities::all();
        $this->data['menu'] = 'cities';
       	return view('admin.cities',compact('cities'))->with($this->data);
    }
    public function listUsers(Request $request){
        if (isset(Auth::user()->id) && Auth::user()->admin_role_id==1) {
            $this->data['leads']=$leads=Admins::where('admin_role_id',2)->get();
             $this->data['menu'] = 'leads';
            return view('admin.leads.index')->with($this->data);
        }
        else
        {
            return redirect(route('dashboard'));
        }        
    }
    public function Update(Request $request)
    {
        $users = Admins::whereId($request->users_id)->first();
        $users->name = $request->name;
        $users->email = $request->email;
        $users->mobile = $request->mobile;
        if($request->password):
            $users->password = Hash::make($request->password);
        endif;
        $users->status_id = $request->status;

        $users->save();
        return redirect()->back()->with('success', 'User Updated.');
    }
    public function destroy(Request $request)
    { 
        $users = Admins::find($request->user_id);
        if ($users != null) 
        {
            $users->delete();
            return redirect()->back()->with('success', 'Lead Deleted.');
        }
    }
      public function destroyEstimates(Request $request)
    { 
        $estimates = Estimates::find($request->estimate_id);
        if ($estimates != null) 
        {
            $estimates->delete();
            return redirect()->back()->with('success', 'Estimate Deleted.');
        }
    }
      public function estimates(Request $request)
      {
        $this->data['estimates'] = Estimates::with(['communities', 'admins', 'homes', 'color_schemes'])->get();
        $this->data['menu'] = 'estimates';
        return view('admin.estimates')->with($this->data);
    }

    public function userEstimates(Request $request)
    {        
        $this->data['community']=($request->session()->has('community_slug'))?Communities::where('slug',$request->session()->get('community_slug'))->first():'';
        $this->data['home'] = ($request->session()->has('home_id'))?Homes::where('id',$request->session()->get('home_id'))->first():'';
        $this->data['home_type'] = null;
        if($request->session()->has('home_id')){
            $this->data['home_type'] = Homes::where('id',$request->session()->get('home_id'))->first();
        }
        $this->data['estimates'] = Estimates::with(['communities', 'admins', 'homes', 'color_schemes'])->where('admin_id', Auth::user()->id)->get();
        $this->data['menu'] = 'estimates';
        return view('user.estimates')->with($this->data);
    
    }
}