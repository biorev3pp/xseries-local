<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Floor;
use App\Models\Lots;
use App\Models\Features;
use App\Models\Homes;
use App\Models\ColorSchemes;
use App\Models\HomeFeatures;
use App\Models\HomeDesignTypes;
use App\Models\HomeDesigns;
use App\Models\HomeDesignOptions;
use App\Models\ColorSchemeUpgrade;
use App\Models\Communities;

class XfloorController extends Controller
{
    public function index(Request $request,$id = null)
    {
        $user = Auth::user();
        if(!$request->session()->has('home_id')){
            return redirect(route('welcome'));
        }
        $ses_data = $request->session()->all();
        $lid=($request->session()->has('lot_id'))?$request->session()->get('lot_id'):'1';
        $this->data['lot'] = Lots::whereId($lid)->with('community')->first(); 
        $community = Communities::where('slug', $request->session()->get('community_slug'))->first();
        $home = Homes::where('id',$request->session()->get('home_id'))->first();
        $home_type = null;
        if($request->session()->has('home_type_id')){  
            $home_type = Homes::where('id', $request->session()->get('home_type_id'))->first();
        }
        $floor_msg= ($request->session()->has('floor_msg'))?$request->session()->get('floor_msg'):'';
        $featureData = [];
        foreach($home->floors as $floor)
        {
            $featArr = [];
            foreach($floor->featureList as $feature)
            {
                $conflicts = [];
                $together = [];
                $dependency = [];
                if($feature->features_acl->conflicts)
                {
                    $conflicts = json_decode($feature->features_acl->conflicts);
                }
                if($feature->features_acl->togetherness)
                {
                    $together = json_decode($feature->features_acl->togetherness);
                }
                if($feature->features_acl->dependency)
                {
                    $dependency = json_decode($feature->features_acl->dependency);
                }              
                $featArr[$feature->id] = $feature->toArray();
                $featArr[$feature->id]['conflicts'] = $conflicts;
                $featArr[$feature->id]['togetherness'] = $together;
                $featArr[$feature->id]['dependency'] = $dependency;
                unset($featArr[$feature->id]['features_acl']);
            }
            foreach($featArr as $k=>$feature)
            {
                if(!empty($feature['conflicts']))
                {
                    foreach ($feature['conflicts'] as $conf) 
                    {
                        if(!in_array($k, $featArr[$conf]['conflicts']))
                        {
                            $featArr[$conf]['conflicts'][] = (string)$k;
                        }
                    }
                }
            }
            $ft = [];
            foreach($featArr as $data)
            {
                $data['conflicts'] = json_encode($data['conflicts']);
                $data['togetherness'] = json_encode($data['togetherness']);
                $data['dependency'] = json_encode($data['dependency']);
                if($data['parent_id']==0)
                {
                    $ft[$data['id']] = $data;
                }
                else
                {
                    $ft[$data['parent_id']]['child_feature'][] = $data;
                }
            }
            // sort array order_no wise
            array_multisort(array_column($ft, 'order_no'), SORT_ASC, $ft);
            foreach($ft as $k=>$f)
            {
                if(isset($f['child_feature'])):
                    $arr = $f['child_feature'];
                    array_multisort(array_column($arr, 'order_no'), SORT_ASC, $arr);
                    $ft[$k]['child_feature'] = $arr;
                endif;
            }
            $floor->features_data = $ft;
            unset($floor->features);
        } 

        if($request->session()->has('color_scheme_id')){
            $color_scheme_id = $request->session()->get('color_scheme_id');
            $color_scheme = ColorSchemes::where('id',$color_scheme_id)->first();
            $this->data['color_scheme'] = $color_scheme;
        }

        //Home Feature
        $home_feature = ['id' => '12', 'name' => 'color','image'=>'avery2.png'];
        $home_feature_option =['id'=>'12','home_feature_id'=>'12','name'=>'First Color','image'=>'avery2.png'];

        //Return View
        // $defaultHome = Homes::where('id',1)->first();
        
        // $this->data['homeList'] = $homes;
        // $this->data['defaultHome'] = $defaultHome;
        //for home data
        if($request->session()->has('home_upgrade_features')){ //with upgraded options
            $home_upgrade=$request->session()->get('home_upgrade_features');
            $this->data['myhome']=$myhome=ColorSchemeUpgrade::where(['color_scheme_id'=>$home_upgrade['color_scheme_id'],'concrete'=>$home_upgrade['concrete'],'window'=>$home_upgrade['window'],'side'=>$home_upgrade['side']])->first();
             //echo '<pre>';print_r($myhome);die;
            $this->data['home_option']='home_upgrade_features';

        }elseif($request->session()->has('color_scheme_id')){ ////with Color Scheme Only
            $color_scheme_id=$request->session()->get('color_scheme_id');
            $this->data['myhome']=$color_scheme=ColorSchemes::where('id',$color_scheme_id)->first();
            $this->data['myhome']->img=$color_scheme->base_img;
            $this->data['home_option']='color_scheme';
        }
        elseif($request->session()->has('home_type_id')){  //with Home Type 
            $this->data['myhome']=Homes::where('id',$request->session()->get('home_type_id'))->first();
            $this->data['home_option']='home';
        }
        elseif($request->session()->has('home_id')){  //with Home only
            $this->data['myhome']=Homes::where('id',$request->session()->get('home_id'))->first();
            $this->data['home_option']='home';
        }else{
            return redirect()->back();
        }
        return view('xfloor.index',compact('home', 'home_type', 'floor_msg', 'home_feature_option', 'home_feature', 'community'))->with($this->data);
    }
    public function finalHomePage(Request $request)
    {
        
        $lid = $request->session()->get('lot_id'); 
        $home_id = $request->session()->get('home_id'); 
        $color_scheme_id = ($request->session()->has('color_scheme_id'))?$request->session()->get('color_scheme_id'):'1'; 
        $homes = Homes::where('id',$home_id)->get();
        $color_scheme = ColorSchemes::where('id',$color_scheme_id)->first();


        $features = $request->feature_id;

        if(!isset($features))
        {
            $features = array();
        }

        //$features // set to session in last 

        $request->session()->put('floor_features', $features);
    /* On finish remove design options and update total price to floor price*/
        $request->session()->forget('design_options'); 
        $request->session()->put('total_price',$request->total_price);

         return redirect('/estimate');
        
    }

    public function designPage(Request $request)
    {
        $home_id=($request->session()->has('home_id'))?$request->session()->get('home_id'):'1';
        $color_scheme_id = ($request->session()->has('color_scheme_id'))?$request->session()->get('color_scheme_id'):'1'; 
        $homes = Homes::where('id',$home_id)->get();
        $color_scheme = ColorSchemes::where('id',$color_scheme_id)->first();


        $features = $request->feature_id;
        if(!isset($features))
        {
            $features = array();
        }

        //$features_id = 'F.'.implode('.',$features);

        //$var = implode('-', $encoded).'-'.$features_id;
        $request->session()->put('design_features', $features);
        //die('here ok');

        return redirect('/design');
    }


    public function estimate(Request $request)
    {
        $ses_data = $request->session()->all();
        //echo '<pre>';print_r($ses_data);die;
        if(($request->session()->has('total_price'))){
            $total_price=$request->session()->get('total_price');
        }else{
            return redirect(route('welcome'));
        }
       
        $optionData =  array();
        $options = ($request->session()->has('design_options'))?$request->session()->get('design_options'):[];
        $this->data['optiondata'] = HomeDesignOptions::whereIn('id', $options)->with('HomeDesign')->get();

        $lid = $request->session()->get('lot_id');
        $this->data['lot'] = Lots::whereId($lid)->with('community')->get()->first();
        
       $home_id=$request->session()->get('home_id'); 
        

        $this->data['home'] = Homes::where('id', $home_id)->with('floors')->get()->first();

        $this->data['features'] =($request->session()->has('floor_features'))?$request->session()->get('floor_features'):[];
        
        
        $this->data['home_title']=Homes::where('id',$home_id)->first()->title;
        if($request->session()->has('home_upgrade_features')){ //with upgraded options
            //die('home_upgrade_features');
           
            $home_upgrade=$request->session()->get('home_upgrade_features');
            $color_scheme_id=$request->session()->get('color_scheme_id');
            $this->data['myhome']=ColorSchemeUpgrade::where(['color_scheme_id'=>$home_upgrade['color_scheme_id'],'concrete'=>$home_upgrade['concrete'],'window'=>$home_upgrade['window'],'side'=>$home_upgrade['side']])->first();
            $this->data['myhome']->color_scheme=ColorSchemes::where('id',$color_scheme_id)->first();
            if($request->session()->get('home_upgrade_patches')):
                $home_upgrade_patches=$request->session()->get('home_upgrade_patches');
            else:
                $home_upgrade_patches = [];
            endif;
            //d//d($request->session()->all());
            //print_r($home_upgrade_patches); die;
            $this->data['home_upgrade_patches']=$home_patches=HomeFeatures::whereIn('id',$home_upgrade_patches)->get();
           // dd($request->session()->all());
            $this->data['home_option']='home_upgrade_features';

        }elseif($request->session()->has('color_scheme_id')){ ////with Color Scheme Only
            $color_scheme_id=$request->session()->get('color_scheme_id');
            $this->data['myhome']->color_scheme=$this->data['myhome']=$color_scheme=ColorSchemes::where('id',$color_scheme_id)->first();

            $this->data['myhome']->img=$color_scheme->base_img;
            $this->data['home_option']='color_scheme';

        }elseif($request->session()->has('home_id')){  //with Home only
            $request->session()->get('home_id');
            $this->data['myhome']=Homes::where('id',$home_id)->first();
            $this->data['home_option']='home';

        }else{
            return redirect()->back();
        }

        return view('xfloor.final')->with($this->data);

    }

    public function designEstimate(Request $request, $id = null)
    {

        //echo "<pre>"; print_r($id); die;


        $encoded = base64_decode($id);
        $encoded = explode('-', $encoded);

        $optionData =  substr($encoded[4], 2);

        $options = explode('.', $optionData);


        $this->data['optiondata'] = HomeDesignOptions::whereIn('id', $options)->with('HomeDesign')->get()->first();

        //echo "<pre>"; print_r($this->data['optiondata']); die;

        //print_r($optionData); die;

        $lid = substr($encoded[0], 1);
        $this->data['lot'] = Lots::whereId($lid)->with('community')->get()->first();
        
        $hid = substr($encoded[1], 1);
        $hid = explode('.', $hid);
        $home_id = $hid[0]; 
        $color_scheme_id = (isset($hid[1]))?$hid[1]:'';
        $this->data['color_scheme'] = $color_scheme=($color_scheme_id !='')?ColorSchemes::where('id',$color_scheme_id)->with('home')->first():'';
        //echo '<pre>';print_r($color_scheme);die;

        $this->data['home'] = Homes::where('id', $home_id)->with('floors')->get()->first();

        $this->data['features'] = (isset($encoded[2]))?explode('.', substr($encoded[2], 2)):[];
        //for home data
        $home_id=$request->session()->get('home_id');
        if($request->session()->has('home_upgrade_features')){ //with upgraded options
            $request->session()->get('home_upgrade_features');
            $this->data['myhome']=ColorSchemeUpgrade::where(['color_scheme_id'=>$color_scheme_id,'concrete'=>$request->upgrade_concrete,'window'=>$request->upgrade_window,'side'=>$request->upgrade_siding])->first();
            $this->data['home_option']='home_upgrade_features';

        }elseif($request->session()->has('color_scheme_id')){ ////with Color Scheme Only
            $color_scheme_id=$request->session()->get('color_scheme_id');
            $this->data['myhome']=ColorSchemes::where('id',$color_scheme_id)->first();
            $this->data['home_option']='color_scheme';

        }elseif($request->session()->has('home_id')){  //with Home only
            $request->session()->get('home_id');
            $this->data['myhome']=Homes::where('id',$home_id)->first();
            $this->data['home_option']='home';

        }else{
            return redirect()->back();
        }

        return view('xfloor.final')->with($this->data);

    }

    public function getFloorsData(Request $request)
    {
        if($request->ajax())
        {
            $data = Floor::where('id',$request->floorid)->first();  
            $data->image =  asset('/uploads/floors/'.$data->image);
            return response()->json($data);
        }
        return "Unauthorised Access !!!";
    }

    public function getFeatureData(Request $request)
    {
        if($request->ajax())
        {
            $features = $request->featureid;
            $data = array();
            if(!empty($features))
            {
                $data = Features::whereIn('id',$features)->get();
                foreach ($data as $key => $value) 
                {
                    $data[$key]->image =  asset('/uploads/features/'.$value->image);
                }    
            }
            return response()->json($data);
        }
        return "Unauthorised Access !!!";
    }

    public function saveMsg(Request $request)
    {   
        $request->session()->put('floor_msg', $request->msg);
        $msg = "Your message has been saved";
        return response()->json(['success'=>'1','data'=>$msg]);
    }

    public function priceSession(Request $request){
        $request->session()->forget('floor_customization');
        $request->session()->put('total_price', $request->total_price);
        $request->session()->put('floor_customization', $request->floor_customization);

        $request->session()->put('floor_features', json_decode($request->feature_id));
        if($request->session()->has('home_price'))
        {
            $floor_price=$request->total_price-$request->session()->get('home_price')-$request->session()->get('lot_price');  
        }
        else
        {
            $floor_price=$request->total_price-$request->session()->get('base_price')-$request->session()->get('lot_price'); 
        }    
        $request->session()->put('floor_price', $floor_price);
        return response()->json(['success'=>'1','floor_price'=>$floor_price, 'customization' => $request->floor_customization]);
    }
    
}
