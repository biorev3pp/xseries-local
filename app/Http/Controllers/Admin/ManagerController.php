<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\HelperTrait;
use Validator;
use App\Validators\FloorValidator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Admins;
use App\Models\AdminRoles;
use App\Models\Communities;
use App\Models\ColorSchemes;
use App\Models\ColorSchemeUpgrade;
use App\Models\HomeFeatures;
use App\Models\States;
use App\Models\Cities;
use App\Models\Homes;
use App\Models\Legends;
use App\Models\LegendGroups;
use App\Models\Estimates;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Models\Floor;
use App\Models\Features;
USE DB;
use File;
use Crypt;
use App\Models\CommunitiesHomes;
use App\Models\HomesLots;
use App\Models\Plots;
use App\Models\Lots;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    public function __construct()
    {
        $this->title = 'Manager';
        $this->data['page_title'] = $this->title;
        $this->data['menu'] = 'manager';
    }
    
    public function index()
    {
        $manager_c_ids = Admins::whereId(Auth::user()->id)->get('community_ids')->first();
        if($manager_c_ids->community_ids!=null)
        $manager_c_ids = array_map('intval',explode(',',$manager_c_ids->community_ids));
        else
        $manager_c_ids = [];
        $communities = Communities::whereIn('id', $manager_c_ids)->get();
        $homes = [];
        $home_ids = [];
        
        if($manager_c_ids):
            foreach($manager_c_ids as $c_id):
                $temp = Communities::whereId($c_id)->with('homes')->first();
                foreach($temp->homes as $home):
                    if(!in_array($home->id, $home_ids)):
                        array_push($home_ids,$home->id);
                        array_push($homes,$home);
                    endif;
                endforeach;
            endforeach;
        endif;
        $leads = Admins::where('admin_role_id',2)->get();
        $this->data['menu'] = 'dashboard';
        $this->data['communities'] = $communities;
        $this->data['homes'] = $homes;
        $this->data['leads'] = $leads;
        return view('admin-manager.dashboard')->with($this->data);
    }
    
       public function Homeindex()
    {   
        $homes = [];
        $home_ids = [];
        $community_ids = Admins::whereId(Auth::user()->id)->get('community_ids')->first();
        if($community_ids->community_ids):
            $community_ids = explode(',',$community_ids->community_ids);
            foreach($community_ids as $c_id):
                $temp = Communities::whereId($c_id)->with('homes')->first();
                foreach($temp->homes as $home):
                    if(!in_array($home->id, $home_ids)):
                        array_push($home_ids,$home->id);
                        array_push($homes,$home);
                    endif;
                endforeach;
            endforeach;
        endif;

        $this->data['menu'] = 'homes';
        $this->data['homes'] = $homes;
        return view('admin-manager.homes.home-index')->with($this->data);
    }
    
    public function LotHomes($community_id,$lot_id)
    {
        $id=base64_decode($lot_id);
        $this->data['lots'] = $lot= Lots::with('Homes')->find($id);
        $home_ids=[];
        foreach($lot->Homes as $home){
            $home_ids[]=$home->id;
        }
        //echo '<pre>';print_r($lot);die;
        $this->data['homes_not_on_lot'] = $homes=Communities::with('Homes')->find(base64_decode($community_id));
        $this->data['lot_id']=$lot_id;
        $this->data['community_id']=$community_id;
        $this->data['communities']= Communities::where('status_id', '!=', 7)->where('id', base64_decode($community_id))->get()->first();
        //echo '<pre>';print_r($homes);die;
       
        return view('admin-manager.communities.lot-homes')->with($this->data);
    }

     public function Analyticsindex()
    {
        $this->data['menu'] = 'analytics';
        return view('admin-manager.analytics')->with($this->data);
    }

    
      public function estimates(Request $request)
    {
            $estimates_array=[];
            $this->data['estimates'] = [];
            $community_ids = Admins::whereId(Auth::user()->id)->get('community_ids')->first();
            if($community_ids->community_ids):
                $community_ids_array = explode(',',$community_ids->community_ids);
                foreach($community_ids_array as $community_id):
                    $estimates = Estimates::where('community_id',$community_id)->with(['communities', 'admins', 'homes', 'lots','references'])->get();
                    array_push($estimates_array,$estimates);
                endforeach;
                $collection = collect($estimates_array);
                $collapsed = $collection->collapse();
                $this->data['estimates'] = $collapsed;
            endif;
            $this->data['menu'] = 'estimates';

            return view('admin-manager.estimates')->with($this->data);
        
    }
      public function listUsers(Request $request)
    {
        
            $this->data['leads']=$leads=Admins::where('admin_role_id',2)->get();
            $this->data['menu'] = 'leads';
            return view('admin-manager.leads.index')->with($this->data);
      
    }

    public function Featureindex($id)
    {
        $floorid = base64_decode($id);
        $floor = Floor::where('id',$floorid)->first();
        $features = Features::with('feature_groups')->where('floor_id',$floorid)->where('parent_id',0)->get();
        $this->data['floor'] = $floor;
        $this->data['features'] = $features;
        return view('admin-manager.features.index')->with($this->data);
    }
    
      public function gallery($id = null)
    {
        $id = base64_decode($id); 
        $this->data['home'] = Homes::where('id', $id)->get()->first();
         $this->data['menu'] = 'homes';
        return view('admin-manager.homes.home-gallery')->with($this->data);
    }

    public function Floorindex()
    {
        $this->title = 'Floors';
        $this->data['page_title'] = $this->title;
        $this->data['menu'] = 'floors';
        $homes = [];
        $community_ids = Admins::whereId(Auth::user()->id)->get('community_ids')->first();
        if($community_ids->community_ids):
            $community_ids = explode(',',$community_ids->community_ids);
            foreach($community_ids as $c_id):
                 $temp = Communities::whereId($c_id)->with('homes')->first();
                 if($temp->homes)
                    array_push($homes,$temp->homes);
            endforeach;
        endif;
        $collection = collect($homes);
        $collapsed = $collection->collapse();
        $floors =[];
        foreach ($collapsed as $key => $home) 
        {
            $floors[$home->id]['floor'] = Floor::where('home_id', $home->id)->get();
            $floors[$home->id]['home'] = $home;
            $this->data['homes'] = $homes;
        }
         $this->data['floors'] = $floors;
        return view('admin-manager.floors.index')->with($this->data);
    }

    public function listColorScheme($home_id)
    {
        $id=base64_decode($home_id);
        $homes = Homes::where('id',$id)->first();
        $color_schemes = ColorSchemes::where('home_id',$id)->orderBy('priority')->get();
        $this->data['menu'] = 'homes';
        return view('admin-manager.homes.home-color-scheme',compact('color_schemes','homes'))->with($this->data);
    }
    
     public function listFeature($color_scheme_id)
    {
        $id=base64_decode($color_scheme_id);
        $features = HomeFeatures::where(['color_scheme_id'=>$id,'upgraded'=>0])->orderBy('priority')->get();
        $home_id = ColorSchemes::where('id', $id)->get()->first();
        $homes = Homes::where('id',$home_id->home_id)->first();
        $color_scheme = ColorSchemes::where('id',$home_id->id)->first();
        $color_scheme_upgrades = ColorSchemeUpgrade::where('color_scheme_id',$id)->get();
        $this->data['home_id'] = base64_encode($home_id->home_id);
        //echo '<pre>';print_r($features);die;
        $this->data['menu'] = 'homes';
        return view('admin-manager.homes.home-color-features',compact('features','homes','color_scheme','color_scheme_upgrades'))->with($this->data);
    }
      public function listHomeElevationType($home_id)
    {
        $id = base64_decode($home_id);  
        $homes = Homes::where('id',$id)->first();
        $elevation_types  = Homes::where('parent_id',$id)->get();
        $this->data['menu'] = 'homes';
        return view('admin-manager.homes.home-elevation-type',compact('elevation_types','homes'))->with($this->data);
    }

    public function showCommunities()
    {
        $communities = [];
        $community_ids = Admins::whereId(Auth::user()->id)->get('community_ids')->first();
      
         if($community_ids->community_ids):
            $community_ids = explode(',',$community_ids->community_ids);
             foreach($community_ids as $c_id):
    
              $temp = Communities::whereId($c_id)->first();
              array_push($communities,$temp);
             endforeach;
        endif; 
        
        $this->data['communities'] = $communities;
        $this->data['menu'] = 'communities';
        return view('admin-manager.communities.index')->with($this->data);
    }
    
    public function createCustomer(Request $request)
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
                                    'admin_role_id' => 2,
                                    'mobile' => $request['mobile'],
                                    'password' => Hash::make($request['password'])]);
            return redirect()->back()->with('success','Account Created.');
        endif;
    }
    
    public function deleteCustomer(Request $request)
    {
        $users = Admins::find($request->user_id);
        if ($users != null) 
        {
            $users->delete();
            return redirect()->back()->with('success', 'Customer Deleted.');
        }    
    }
    public function CommunityHomes($community_id)
    {
        $id=base64_decode($community_id);
        $this->data['communities'] = $community= Communities::with('Homes')->find($id);
        $home_ids=[];
        foreach($community->Homes as $home){
            $home_ids[]=$home->id;
        }
        $this->data['menu'] = 'communities';
        $this->data['homes_not_in_community'] = $homes= Homes::whereNotIn('id',$home_ids)->get();
        $this->data['community_id']=$community_id;
        return view('admin-manager.communities.community-homes')->with($this->data);
    }
    
      public function view($id = null)
    {
        $id =base64_decode($id); 
        $this->data['community'] = Communities::where('status_id', '!=', 7)->where('id', $id)->get()->first();
        $this->data['plat'] = Plots::where('community_id', $id)->get()->first();
        $this->data['legend_group'] = LegendGroups::with('legends')->where('plot_id', $this->data['plat']['id'])->get()->first();
        $this->data['lots'] = Lots::where('plot_id', $this->data['plat']['id'])->orderBy('alias', 'asc')->get();
        return view('admin-manager.communities.view')->with($this->data);
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
    
    public function assignEstimates()
    {
         $unassigned_estimates_array = [];
         $community_ids = Admins::whereId(Auth::user()->id)->get('community_ids')->first();
        if($community_ids->community_ids):
            $community_ids_array = explode(',',$community_ids->community_ids);
            foreach($community_ids_array as $community_id):
                $unassigned_estimates = Estimates::where([
                    'admin_id'      => Auth::user()->id,
                    'reference_id'  => Auth::user()->id,
                    'community_id'  => $community_id
                    ])->with(['communities', 'admins', 'homes', 'lots'])->get();
                if(sizeof($unassigned_estimates) > 1):
                    foreach($unassigned_estimates as $unassigned_estimate):
                        array_push($unassigned_estimates_array,$unassigned_estimate);
                    endforeach;
                else:
                    if($unassigned_estimates->first()):
                        array_push($unassigned_estimates_array,$unassigned_estimates->first());
                    endif;
                endif;
            endforeach;
        endif;
        $this->data['menu'] = 'estimates';
        $this->data['unassigned_estimates'] = $unassigned_estimates_array;
        $this->data['customers']            = Admins::whereAdminRoleId(2)->get(); 
        
         return view('admin-manager.assign-estimates')->with($this->data);
    }
    
    
    public function estimateToCustomer(Request $request)
    {
        $assignTo = $request['customer_id'];
        Estimates::whereId($request['estimate_id'])->update(['admin_id'=>$assignTo,'reference_id'=>Auth::user()->id]);
        
        return redirect()->back()->with('success','Estimate Assigned.');
    }
    
    public function mailEstimate(Request $request)
    {
            $url                = url('/');
            $estimate_id        = base64_encode($request['estimate_id']);
            $customer_id        = base64_encode($request['customer_id']);
            $email              = $request['email'];
            $name               = $request['name'];
            $url                = $url.'/estimates/src/email/'.base64_encode($email).'/id/'.$estimate_id.'/uid/'.$customer_id;
            $data                = ['subject'=> 'Xplat-Estimations',
                                     'view' => 'mail-estimate',
                                     'url' => $url,
                                     'name' => $name];
            Mail::to($email)->send(new SendMail($data));

            return ['status' => 'success', 'message' =>  'Estimation mail sent.'];

    }
    
    public function replicateEstimate(Request $request)
    {
        $estimate       = Estimates::find($request->id);
        $newEstimate    = $estimate->replicate();
        $newEstimate->save();
        return redirect()->back()->with('success','Estimate Replicated.');
    }
    public function downloadEstimateSentByMail($email,$estimate_id,$user_id)
    {
        $email       = base64_decode($email);
        $estimate_id = base64_decode($estimate_id);
        $user_id     = base64_decode($user_id);
    
        //route estimates/src/email/{email}/id/{estimate_id}/uid/{user_id}
         $admin      = Admins::where('id',$user_id)->first();

         $this->data['estimates'] = Estimates::where('id',$estimate_id)->with(['communities', 'homes', 'lots'])->get()->first();
          if(isset($this->data['estimates']->homes)):
                $name = 'Estimate_'.ucwords($this->data['estimates']->communities->slug).'_Lot-'.$this->data['estimates']->lots->alias.'_'.str_replace(' ', '-', ucwords($this->data['estimates']->homes->title));
            else:
                $name = 'Estimate_'.ucwords($this->data['estimates']->admins->name).'_'.ucwords($this->data['estimates']->communities->slug).'_Lot-'.$this->data['estimates']->lots->alias;
            endif;
            ini_set('memory_limit', '-1');
            ini_set('max_execution_time', 300); //300 seconds = 5 minutes
            $pdf = \PDF::loadView('user.user-pdf',$this->data)->setPaper('a4', 'portrait');
            return $pdf->download($name.'.pdf');
            
    }
    
}