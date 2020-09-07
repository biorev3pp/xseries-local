<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Admins;
use Illuminate\Support\Facades\Hash;
use App\Models\Communities;
use App\Models\Homes;

class DashboardController extends Controller
{
    public $data;

    public function __construct(){
        $this->data['page_title'] = 'Dashboard';
        $this->data['menu'] = 'dashboard';
    }

    public function index(Request $request){
		if (isset(Auth::user()->id) && Auth::user()->admin_role_id==2) {
			$this->data['user']=Admins::whereId(Auth::user()->id)->first();
            if($request->session()->has('home_type_id')){
                $this->data['home'] = Homes::where('id', $request->session()->get('home_id'))->first();
                $this->data['home_type'] = Homes::where('id', $request->session()->get('home_type_id'))->first();
                $this->data['community'] = Communities::where('slug', $request->session()->get('community_slug'))->first();
            }   
            elseif($request->session()->has('home_id')){
                $this->data['home'] = Homes::where('id', $request->session()->get('home_id'))->first();
                $this->data['community'] = Communities::where('slug', $request->session()->get('community_slug'))->first();
                $this->data['home_type'] = null;
            }
			return view('user.dashboard')->with($this->data);
    	}else{
    		//die('in2');
    		return redirect(route('welcome'));
    	}
        
        
    }
    public function Update(Request $request)
    {
        //echo $id;
        //echo '<pre>';print_r($request->users_id);die;
        $users = Admins::whereId($request->users_id)->first();
        //echo '<pre>';print_r($users->name);die;
        $users->name = $request->name;
        $users->email = $request->email;
        $users->mobile = $request->mobile;
        if($request->password && $request->password!=''):
            $users->password = Hash::make($request->password);
        endif;
        // $users->status_id = $request->status;

        $users->save();

        return redirect()->back()->with('success', 'Profile Updated.');
    }
	public function destroy(Request $request)
    { 
		$users = Admins::find($request->user_id);
        if ($users != null) 
        {
            $users->delete();
            return redirect()->back()->with('success', 'User Deleted.');
        }
    }
	
}
