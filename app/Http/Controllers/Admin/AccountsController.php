<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\HelperTrait;
use Validator;
use App\Validators\FloorValidator;
use Illuminate\Support\Facades\Hash;
use App\Admins;
use App\Models\Communities;
use App\Models\AdminRoles;
use App\Models\Homes;
USE DB;
use File;
use Crypt;
use Illuminate\Support\Facades\Auth;

class AccountsController extends Controller
{
    public function __construct()
    {
        $this->title = 'Accounts';
        $this->data['page_title'] = $this->title;
        $this->data['menu'] = 'accounts';
    }

    public function index()
    {   
        if(Auth::user()->admin_role_id == 1){
            $accounts = Admins::with('roles')->whereNotIn('admin_role_id',[1,2])->get();
        }
        if(Auth::user()->admin_role_id == 3){
            $accounts = [];
            $admin = Admins::where('id', Auth::user()->id)->first();
            if($admin->manager_ids):
            $manager_ids = explode(',', $admin->manager_ids);
            foreach($manager_ids as $manager_id):
                $account = Admins::where('id', $manager_id)->first();
                array_push($accounts, $account);
            endforeach;
            endif;
        }
        // return $accounts;
        $this->data['accounts'] = $accounts;
        return view('admin.accounts.index')->with($this->data);
    }

     public function create(Request $request)
    {
        
           $validator   = Validator::make($request->all(),[
            'email'     => 'required|email|unique:users',
            'name'      => ['required', 'regex:/^[a-zA-Z\s]*$/'],
            'password'  => 'required',
            'mobile'    => 'required|digits:10'
            ]);
         if ($validator->fails()) {
            return redirect()->back()
                        ->with('error','Kindly fill the form carefully.There should be valid name, email address and phone number.');
        }
        $user = Admins::where('email', $request['email'])->get()->first();
        if($user):
            return redirect()->back()->with('error','Email Already Exists.');
        else:
            $user  = Admins::Create(['email' => $request['email'],
                                    'name' => $request['name'],
                                    'admin_role_id' => $request['account_role'],
                                    'mobile' => $request['mobile'],
                                    'password' => Hash::make($request['password'])]);
            if(Auth::user()->admin_role_id == 3):
                if($user->admin_role_id != 2):
                    $admin = Admins::where('id', Auth::user()->id)->first();
                    if(!$admin->manager_ids):
                        $managers_array=[];
                    else:  
                        $managers_array = explode(',', $admin->manager_ids);
                    endif;
                    array_push($managers_array, $user->id);
                    Admins::where('id', Auth::user()->id)->update(['manager_ids' => implode(',', $managers_array)]);
                endif;
            endif;
            return redirect()->back()->with('success','Account Created.');
        endif;
    }
    
    public function view($id)
    {
        
        $linked_homes           = [];
        $linked_manager         = [];    
        $this->data['account']  = Admins::where('id',base64_decode($id))->get()->first();
        if($this->data['account']->admin_role_id == 4)
        {
             $disc_c_ids           = [];
             $managers               = [];
            if($this->data['account']->community_ids):
                $conn_c_ids = explode(',',$this->data['account']->community_ids);
                foreach($conn_c_ids as $c_id):
                    $v = Communities::where('id',$c_id)->first();
                    array_push($linked_homes,$v);
                endforeach;   
            endif;
                $managers = Admins::where('admin_role_id', 4)->get();
                foreach($managers as $manager):
                    if($manager->community_ids):
                        $c_ids = explode(',',$manager->community_ids);
                        foreach($c_ids as $c_id):
                            array_push($disc_c_ids, $c_id);
                        endforeach;
                    endif;
                endforeach;
        $this->data['disconnected_homes'] = Communities::whereNotIn('id',$disc_c_ids)->get();
        $this->data['connected_homes'] = $linked_homes;
        return view('admin.accounts.view')->with($this->data);
        }
        if($this->data['account']->admin_role_id == 3)
        {
            $managers = [];
            $disc_manager_ids=[];
            if($this->data['account']->manager_ids):
                $manager_ids = explode(',', $this->data['account']->manager_ids);
                foreach($manager_ids as $manager_id):
                    $manager = Admins::where('id', $manager_id)->get()->first();
                    array_push($managers, $manager);
                endforeach;
            endif;
            $admins = Admins::where('admin_role_id',3)->get();
            foreach($admins as $admin):
                if($admin->manager_ids):
                    $m_ids = explode(',',$admin->manager_ids);
                    foreach($m_ids as $m_id):
                        array_push($disc_manager_ids, $m_id);
                    endforeach;
                endif;
            endforeach;    
             $this->data['connected_managers'] = $managers;
             $this->data['disconnected_managers'] =Admins::whereNotIn('id',$disc_manager_ids)->where('admin_role_id',4)->get(); 
             return view('admin.accounts.view-manager')->with($this->data);
        }
       
    }
    public function connectCommunitiesToManager(Request $request)
    { 
            $admin = Admins::where('id',$request->manager_id)->first();
             if(!$admin->community_ids):
                $c_array=[];
             else:  
                $c_array = explode(',', $admin->community_ids);
             endif;
             foreach($request->community_ids as $c_id):
              array_push($c_array, $c_id);  
             endforeach;
             Admins::where('id',$request->manager_id)->update(['community_ids' => implode(',', $c_array)]);
             return redirect()->back()->with('success','Connection Established.');
        
    }
     public function connectManagerToAdmin(Request $request)
    { 
            
            $admin = Admins::whereId($request->admin_id)->first();
             if(!$admin->manager_ids):
                $m_array=[];
             else:  
                $m_array = explode(',', $admin->manager_ids);
             endif;
             foreach($request->manager_ids as $m_id):
              array_push($m_array, $m_id);  
             endforeach;
             Admins::whereId($request->admin_id)->update(['manager_ids' => implode(',', $m_array)]);
             return redirect()->back()->with('success','Connection Established.');
        
    }
    public function getAdminRoles(){
        if(Auth::user()->admin_role_id == 1){
        $admin_roles = AdminRoles::where('id','!=',1)->get();
        }
        if(Auth::user()->admin_role_id == 3){
            $admin_roles = AdminRoles::whereNotIn('id',[1,3])->get();
        }
        return $admin_roles;
    }

    public function updateAccounts(Request $request)
    {
        // return $request->name;
        $account = Admins::find($request->id);
        $account->name = $request->name;
        $account->email = $request->email;
        $account->mobile = $request->mobile;
        if($request->password):
            $account->password = Hash::make($request->password);
        endif;
        $account->status_id = $request->status;
        $account->admin_role_id = $request->account_role;
        $account->save();
        return redirect()->back()->with('success', 'Account Updated');
    }
    
    public function deleteManagerCommunities(Request $request)
    {
        $c_id = base64_decode($request->community_id);
        $admin   = Admins::where('id',$request->manager_id)->get('community_ids')->first();
        $com_ids = explode(',',$admin->community_ids);
        $com_ids = array_diff($com_ids, [$c_id]);
        Admins::whereId($request->manager_id)->update(['community_ids' => implode(',', $com_ids)]); 
        return redirect()->back()->with('success','Deleted Successfully.'); 
    }
      public function deleteAdminManagers(Request $request)
    {
        $admin_id   = $request->admin_id;
        $manager_id = base64_decode($request['manager_id']);
        $admin   = Admins::whereId($admin_id)->get('manager_ids')->first();
        $m_ids = explode(',',$admin->manager_ids);
        $m_ids = array_diff($m_ids, [$manager_id]);
        Admins::whereId($admin_id)->update(['manager_ids' => implode(',', $m_ids)]); 
        return redirect()->back()->with('success','Deleted Successfully.'); 
    }

    public function deleteAccounts(Request $request)
    {
        $account = Admins::find($request->id);
        if ($account != null) 
        {   
            $account->delete();
            return redirect()->back()->with('success', 'Account Deleted');
        }
    }
    
}