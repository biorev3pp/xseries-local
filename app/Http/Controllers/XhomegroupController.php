<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\XFloor\Floor;
use App\Models\HomeDesignTypes;
use App\Models\HomeDesigns;
use App\Models\HomeDesignOptions;
use App\Models\Homes;
use App\Models\ColorSchemes;
use App\Models\HomeDesignGroups;


class XhomegroupController extends Controller
{
    public function index($id = null)
    {
        $link = $id;
        
        $encoded = base64_decode($id);
        $encoded = explode('-', $encoded);
        $lid = substr($encoded[0], 1);
        $hid = substr($encoded[1], 1);

        $hid = explode('.', $hid);
        $home_id = $hid[0]; 
        $color_scheme_id = $hid[0];
        $homes = Homes::where('id',$home_id)->get();

    	// get the home design types
        $homeDesignGroups = HomeDesignGroups::get();

        //echo "<pre>"; print_r($data);  die;
        //$homeDesignOptions = HomeDesignOptions::all();
        //$homeDesigns = HomeDesigns::all();

        $this->data['homeList'] = $homes;
        return view('xhomegroup.index', compact('homeDesignGroups','data','link'))->with($this->data);

    }

    public function designData(Request $request)
    {
        //echo "<pre>"; print_r($request->all()); die;
        

        $optionData = array();
        /*foreach($request->options as $val){
            if(!empty($val)){
                $homeDesignOptions[] = HomeDesignOptions::with('HomeDesign')->find($val);
            }
        }

        $i = 0;
        foreach($homeDesignOptions as $val){
            $optionData[$i]['patch'] = $val->patch;
            $optionData[$i]['slug'] = $val->slug;
            $optionData[$i]['mname'] = $val->mname;
            $optionData[$i]['murl'] = $val->murl;
            $optionData[$i]['star'] = $val->star;
            $optionData[$i]['price'] = $val->price;
            $i++;
        }*/

        //echo "<pre>"; print_r($optionData); die;
       
        $encoded = base64_decode($request->homedata);

        $encoded = explode('-', $encoded);

        $lid = substr($encoded[0], 1);
        $hid = substr($encoded[1], 1);

        $hid = explode('.', $hid);
        $home_id = $hid[0]; 
        $color_scheme_id = (isset($hid[1]))?$hid[1]:'';

        //echo $color_scheme_id; 


        $homes = Homes::where('id',$home_id)->get();
        $color_scheme = ($color_scheme_id !='')?ColorSchemes::where('id',$color_scheme_id)->first():'';


        $features = $request->feature_id;

        if(!isset($features))
        {
            $features = array();
        }

        if(!isset($optionData))
        {
            $optionData = array();
        }

        //$homeDesignOptionsId = base64_encode($optionData);

        $features_id = 'F.'.implode('.',$features);

        $homeDesignOptionsId = 'D.'.implode('.',$request->options);

        $var = implode('-', $encoded).'-'.$features_id.'-'.$homeDesignOptionsId;

        //echo $var; die;

        return redirect('/designestimate/'.base64_encode($var));


    }


    /*public function finalHomePage(Request $request)
    {
        $encoded = base64_decode($request->link);

        $encoded = explode('-', $encoded);

        $lid = substr($encoded[0], 1);
        $hid = substr($encoded[1], 1);

        $hid = explode('.', $hid);
        $home_id = $hid[0]; 
        $color_scheme_id = (isset($hid[1]))?$hid[1]:'';
        $homes = Homes::where('id',$home_id)->get();
        $color_scheme = ($color_scheme_id !='')?ColorSchemes::where('id',$color_scheme_id)->first():'';


        $features = $request->feature_id;
        if(!isset($features))
        {
            $features = array();
        }

        $features_id = 'F.'.implode('.',$features);

        $var = implode('-', $encoded).'-'.$features_id;

        return redirect('/estimate/'.base64_encode($var));
    }

    public function estimate($id = null)
    {
        $encoded = base64_decode($id);
        $encoded = explode('-', $encoded);
        //dd($encoded);
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

        return view('xfloor.final')->with($this->data);

    }*/



}
