<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lots;
use App\Models\Homes;
use App\Models\ColorSchemes;
use App\Models\HomeFeatures;
use App\Models\Manufacturers;
use App\Models\Communities;
use App\Models\ColorSchemeUpgrade;
use Auth;

class XhomeController extends Controller
{    
    public $data;
    public function __construct(){
    
        $this->data['home_msg'] = '';
    }
    public function index(Request $request)
    {
       if($request->session()->has('lot_id')){
           $lid= $request->session()->get('lot_id');
        }else{
            return redirect(route('plat'));
        }
        // Forget floor sessions
        $request->session()->forget('floor_customization');
        $request->session()->forget('floor_features');
        $session_data = $request->session()->all();
        
        $this->data['sess_features'] = [];

        $lot = Lots::where('id', $lid)->first();
        
        $community = [];
        $community=($request->session()->has('community_slug'))?Communities::where('slug',$request->session()->get('community_slug'))->first():'';
        $home = Homes::with('ColorScheme')->where('id', $request->session()->get('home_id'))->first();
        if($request->session()->has('home_type_id')){  
            $home_type = Homes::with('ColorScheme')->where('id', $request->session()->get('home_type_id'))->first();
            $request->session()->put('base_price',  $home_type->price);
        }
        else{
            $home_type=null;
            $request->session()->put('base_price',  $home->price);
        }
        $request->session()->put('lot_price',  $lot->price);
        if(!$request->session()->has('total_price')){
            $request->session()->forget('home_price');
            $total_price=$lot->price+$home->price;
            $request->session()->put('total_price', $total_price);
        }
        
        if($request->session()->has('color_scheme_id')){
            $color_scheme_id=$request->session()->get('color_scheme_id');
            $this->data['sess_features']=$sesf=HomeFeatures::where(['color_scheme_id'=>$color_scheme_id,'upgraded'=>0])->orderBy('priority')->get();
            $color_scheme=ColorSchemes::where('id',$color_scheme_id)->first();

            $this->data['sess_features']->img=$color_scheme->base_img;

            if($request->session()->has('home_upgrade_features')){ //with upgraded options
           
            $home_upgrade=$request->session()->get('home_upgrade_features');
            $this->data['sess_features']->img=ColorSchemeUpgrade::where(['color_scheme_id'=>$home_upgrade['color_scheme_id'],'concrete'=>$home_upgrade['concrete'],'window'=>$home_upgrade['window'],'side'=>$home_upgrade['side']])->first()->img;
           
            if($request->session()->has('home_upgrade_patches')):
                $home_upgrade_patches=$request->session()->get('home_upgrade_patches');
            else:
                $home_upgrade_patches = [];
            endif;
            $this->data['home_upgrade_patches']=$home_patches=HomeFeatures::whereIn('id',$home_upgrade_patches)->get();
        }

         }
        
        $home_msg= ($request->session()->has('home_msg'))?$request->session()->get('home_msg'):'';
        $data_sess = $request->session()->all();
        
        if($home):
    	    return view('xhome.index',compact('home','home_msg', 'community','home_type'))->with($this->data);
        else: return redirect(route('welcome')); endif;   
    }
    
    public function GetColorSchemes(Request $request){
        $data=ColorSchemes::where(['home_id'=>$request->home_id,'status_id'=>2])->orderBy('priority')->get();
        $request->session()->forget('color_scheme_id');
        $request->session()->forget('home_customization');
        $request->session()->forget('home_upgrade_patches');
        $home=Homes::whereId($request->home_id)->get(['id','title','parent_id','price','slug'])->first();
        $home_title='';
        if($home->parent_id==0){
            $request->session()->forget('home_type_id');
            $floor_link = url('/floor/'.$request->session()->get('community_slug').'/'.$home->slug);
        }
        else{
            $request->session()->put('home_type_id',$home->id);
            $home_title = $home->title;
            $parent_home=Homes::whereId($home->parent_id)->get(['slug'])->first();
            $floor_link = url('/floor/'.$request->session()->get('community_slug').'/'.$parent_home->slug.'/'.$home->slug);
        }
        $home_price = $home->price;
        $total_price = $request->session()->get('lot_price')+$home_price;
        $request->session()->put('total_price', $total_price);
        $request->session()->put('base_price',  $home->price);
    	return response()->json(['success'=>'1','data'=>$data,'title'=>$home_title,'price'=>$home_price,'total_price'=>$total_price,'floor_link'=>$floor_link]);
    }
    public function GetFeatures(Request $request){
        $request->session()->forget('home_customization');
        $request->session()->forget('home_upgrade_patches');
        $request->session()->put('color_scheme_id', $request->color_scheme_id);
        $data=HomeFeatures::where(['color_scheme_id'=>$request->color_scheme_id,'upgraded'=>0,'status_id'=>2])->orderBy('priority')->get();
        $hid=($request->session()->has('home_type_id'))?$request->session()->get('home_type_id'):$request->session()->get('home_id');
        $home = Homes::where('id', $hid)->first();
        $home_price_only=$home->price+$request->color_scheme_price;
        $total_price=$request->session()->get('lot_price')+$home_price_only;
      
        $request->session()->put('total_price', $total_price);
        $request->session()->put('home_price', $home_price_only);
        $request->session()->put('home_customization', $request->home_customization);

    	return response()->json(['success'=>'1','data'=>$data,'total_cost'=>$total_price]);
    }
    public function Getupgradefeatures(Request $request){
        $color_scheme_id=$request->session()->get('color_scheme_id');
        $data=HomeFeatures::where(['group_id'=>$request->feature_id,'upgraded'=>$request->upgrade,'status_id'=>2])->first();
        $data2=ColorSchemeUpgrade::where(['color_scheme_id'=>$color_scheme_id,'concrete'=>$request->upgrade_concrete,'window'=>$request->upgrade_window,'side'=>$request->upgrade_siding])->first();
        $upgrade_array=array('color_scheme_id'=>$color_scheme_id,'concrete'=>$request->upgrade_concrete,'window'=>$request->upgrade_window,'side'=>$request->upgrade_siding);
        $request->session()->put('home_upgrade_features', $upgrade_array);
        return response()->json(['success'=>'1','data'=>$data,'data2'=>$data2]);
    }
    public function priceSession(Request $request){
        $request->session()->put('total_price', $request->home_price);// home_price=total_price
        $request->session()->put('home_customization', $request->home_customization);
        $lot_price=$request->session()->get('lot_price');
        $home_price_only=$request->home_price-$lot_price;
        $request->session()->put('home_price', $home_price_only);
        $request->session()->put('home_upgrade_patches', $request->home_upgrade_patches);
         
        return response()->json(['success'=>'1','home_price_only'=>$home_price_only]);

    }
    public function Finish(Request $request){
        $request->session()->put('total_price',$request->total_price);
        $request->session()->forget('floor_price');
        $request->session()->forget('floor_customization');
        $request->session()->forget('floor_features');
        $request->session()->forget('floor_id');
        $request->session()->forget('design_options');

        return response()->json(['success'=>'1','finish_url'=>route('estimate')]);

    }
    
    public function Getmanufacturer(Request $request){
    	$data=HomeFeatures::where('id',$request->feature_id)->first();
    	return response()->json(['success'=>'1','data'=>$data]);
    }
    public function saveMsg(Request $request){
        $request->session()->put('home_msg', $request->msg);
        $data='Your message has been saved successfully.';
        return response()->json(['success'=>'1','data'=>$data]);
    }
    public function userLogout(Request $request)
    {
        Auth::logout();
        $request->session()->forget('lot_id');
        return redirect('/');
    }
    
}
