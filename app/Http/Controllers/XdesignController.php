<?php
namespace App\Http\Controllers;
session_start();


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
use App\Models\HomeTypeOptions;
use Session;



class XdesignController extends Controller
{
    public function index(Request $request, $id = null)
    {
        //echo "<pre>"; print_r($request->session()); die;
        if($request->session()->has('home_id')){
           $home_id= $request->session()->get('home_id');
        }else{
            return redirect(route('welcome'));
        }
        //$request->session()->forget('design_price');
        $lid=($request->session()->has('lot_id'))?$request->session()->get('lot_id'):'1';
        $home_id =($request->session()->has('home_id'))?$request->session()->get('home_id'):'1'; 
        $color_scheme_id = ($request->session()->has('color_scheme_id'))?$request->session()->get('color_scheme_id'):'1'; 
        $groupId = ($request->session()->has('home_group_id'))?$request->session()->get('home_group_id'):'1'; 

        $totalGroups = array();
        $totalGroups = ($request->session()->has('home_groups'))?$request->session()->get('home_groups'):[];
        $totalCount = count($totalGroups);
        //echo "<pre>"; print_r($totalGroups); die;

        $homes = Homes::where('id',$home_id)->get();

        //echo $groupId; die;
        $preSelectedArrayData = array();
        $preSelectedArrayData = ($request->session()->has('preSelectedArrayData'))?$request->session()->get('preSelectedArrayData'):[];
        
        
        $homeGroupCount = HomeDesignGroups::where('home_id', '=', $home_id)->get()->count();

        if(($homeGroupCount+3)== $totalCount){
            $linkAhead = "";
            $groupId = $groupId;
        } else{
            $groupId = $groupId;
            $leftGroupId = HomeDesignGroups::where('id','<>', $groupId)
                                        ->where('home_id','=', $home_id)
                                        ->get()->first();
            $linkAhead = $leftGroupId;
        }

        $homeDesignGroup = HomeDesignGroups::where('id', '=', $groupId)->get()->first();
        // get the home design types


        // get the home design types
        $homeDesignTypes = HomeDesignTypes::with('designs','options','designoptions')->get();

        $homeDesignTypes1 = HomeDesignTypes::with('designs')->get();
        

        /*echo "<pre>"; print_r($homeDesignTypes);
        dd($homeDesigns);*/

        $data = array();

        if (!$homeDesignTypes->isEmpty()) { 

            $i = 0;
            foreach($homeDesignTypes as $homeDesignType){
                //echo "hello";
                //echo $homeDesigns['design'];
                //echo "<pre>"; print_r($homeDesigns['designs']);

                $data[$i]['id'] = $homeDesignType['id'];
                $data[$i]['home_id'] = $homeDesignType['home_id'];
                $data[$i]['type'] = $homeDesignType['design'];
                $data[$i]['slug'] = $homeDesignType['slug'];
                $data[$i]['image'] = $homeDesignType['image'];
                $data[$i]['description'] = $homeDesignType['description'];
                $data[$i]['status_id'] = $homeDesignType['status_id'];
                
                if(!$homeDesignType['designs']->isEmpty())
                {
                    $homeDesigns = $homeDesignType['designs'];
                    $j = 0;
                    foreach($homeDesigns as $homeDesign){

                        $data[$i]['designs'][$j]['id'] = $homeDesign['id'];
                        $data[$i]['designs'][$j]['home_design_type_id'] = $homeDesign['home_design_type_id'];
                        $data[$i]['designs'][$j]['design'] = $homeDesign['design'];
                        $data[$i]['designs'][$j]['is_designer'] = $homeDesign['is_designer'];
                        $data[$i]['designs'][$j]['slug'] = $homeDesign['slug'];
                        $data[$i]['designs'][$j]['image'] = $homeDesign['image'];
                        $data[$i]['designs'][$j]['status_id'] = $homeDesign['status_id'];
                        $data[$i]['designs'][$j]['is_default'] = $homeDesign['is_default'];
                        $data[$i]['designs'][$j]['star'] = $homeDesign['star'];
                        $j++;
                    }
                    
                }

                if(!$homeDesignType['options']->isEmpty())
                {
                    $homeDesigns = $homeDesignType['options'];
                    $j = 0;
                    foreach($homeDesigns as $homeDesign){
                        $data[$i]['options'][$j]['id'] = $homeDesign['id'];
                        $data[$i]['options'][$j]['design_type_id'] = $homeDesign['design_type_id'];
                        $data[$i]['options'][$j]['patch'] = $homeDesign['patch'];
                        $data[$i]['options'][$j]['image'] = $homeDesign['image'];
                        $data[$i]['options'][$j]['slug'] = $homeDesign['slug'];
                        $data[$i]['options'][$j]['name'] = $homeDesign['name'];
                        $data[$i]['options'][$j]['status_id'] = $homeDesign['status_id'];
                        $data[$i]['options'][$j]['self_slug'] = $homeDesign['self_slug'];
                        $data[$i]['options'][$j]['is_default'] = $homeDesign['is_default'];
                        $j++;
                    }
                    
                }

                if(!$homeDesignType['designoptions']->isEmpty())
                {
                    $homeDesigns = $homeDesignType['designoptions'];
                    $j = 0;
                    $finalData = "";
                    foreach($homeDesigns as $homeDesign){

                        $data[$i]['designoptions'][$j]['id'] = $homeDesign['id'];
                        $data[$i]['designoptions'][$j]['cname'] = $homeDesign['cname'];
                        $data[$i]['designoptions'][$j]['mname'] = $homeDesign['mname'];
                        $data[$i]['designoptions'][$j]['mid'] = $homeDesign['mid'];
                        $data[$i]['designoptions'][$j]['murl'] = $homeDesign['murl'];
                        $data[$i]['designoptions'][$j]['price'] = $homeDesign['price'];
                        $data[$i]['designoptions'][$j]['design_option'] = $homeDesign['design_option'];
                        $data[$i]['designoptions'][$j]['is_designer'] = $homeDesign['is_designer'];
                        $data[$i]['designoptions'][$j]['combination_id'] = $homeDesign['id'];
                        $data[$i]['designoptions'][$j]['is_default'] = $homeDesign['is_default'];
                        $j++;
                    }
                    //echo $finalData."*****************************************";
                  //  $data[$i]['designs'][$j]['all_data'] = $finalData;

                }
                $i++;
            }
            
        }


        $data1 = array();

        if (!$homeDesignTypes1->isEmpty()) { 

            $i = 0;
            foreach($homeDesignTypes1 as $homeDesignType){
                //echo "hello";
                //echo $homeDesigns['design'];
                //echo "<pre>"; print_r($homeDesigns['designs']);

                $data1[$i]['id'] = $homeDesignType['id'];
                $data1[$i]['home_id'] = $homeDesignType['home_id'];
                $data1[$i]['type'] = $homeDesignType['design'];
                $data1[$i]['slug'] = $homeDesignType['slug'];
                $data1[$i]['image'] = $homeDesignType['image'];
                $data1[$i]['description'] = $homeDesignType['description'];
                $data1[$i]['status_id'] = $homeDesignType['status_id'];
                
                if(!$homeDesignType['designs']->isEmpty())
                {
                    $homeDesigns = $homeDesignType['designs'];
                    $j = 0;
                    foreach($homeDesigns as $homeDesign){

                        $data1[$i]['designs'][$j]['home_design_type_id'] = $homeDesign['home_design_type_id'];
                        $data1[$i]['designs'][$j]['design'] = $homeDesign['design'];
                        $data1[$i]['designs'][$j]['is_designer'] = $homeDesign['is_designer'];
                        $data1[$i]['designs'][$j]['slug'] = $homeDesign['slug'];
                        $data1[$i]['designs'][$j]['image'] = $homeDesign['image'];
                        $data1[$i]['designs'][$j]['status_id'] = $homeDesign['status_id'];


                        if(!$homeDesign['homeDesignOptions']->isEmpty())
                        {
                            $homeDesignOptions = $homeDesign['homeDesignOptions'];
                            $finalData = "";
                            foreach($homeDesignOptions as $homeDesignOption){
                        
                                /*$data1[$i]['options'][$j]['design_type_id'] = $homeDesign['id'];
                                $data1[$i]['options'][$j]['patch'] = $homeDesign['cname'];
                                $data1[$i]['options'][$j]['image'] = $homeDesign['mname'];
                                $data1[$i]['options'][$j]['slug'] = $homeDesign['mid'];
                                $data1[$i]['options'][$j]['name'] =$homeDesign['murl'];
                                $data1[$i]['options'][$j]['status_id'] = $homeDesign['price'];
                                $data1[$i]['options'][$j]['self_slug'] = $homeDesign['design_option'];
                                $j++;*/


                                $allData = $homeDesignOption['id']." ".$homeDesignOption['cname']." ".$homeDesignOption['mname']." ".$homeDesignOption['mid']." ".$homeDesignOption['murl']." ".$homeDesignOption['price']." ".$homeDesignOption['design_option'];

                                $finalData = $finalData.$allData;

                                $data[$i]['designs'][$j]['all_data'] = $finalData;
                            }
                        }
                        $j++;
                    }
                }
                $i++;
            }
            
        }

        //die;

        // get the home design types
        $homeTypeOptions = HomeTypeOptions::get();

        /*echo "<pre>"; print_r($data); 
        
        dd($data);
        die;*/

        /*foreach($data as $val){

            $designs = $val['designs'];
            //echo "<pre>"; print_r($designs); 

            foreach($designs as $value){
                $options = $value['options'];
                echo "<pre>"; print_r($options); 
                die;
            }
            
        }
        die;*/
        $homeDesignOptions = HomeDesignOptions::get();
    
        $homeDesigns = HomeDesigns::all();


        $imageData = [];
        $defaultData = HomeDesignTypes::where('design_group_id',$groupId)->where('priority', 0)->with('designs')->where('status_id','=',2)->get();
        foreach($defaultData as $value){
            if (!$value['designs']->isEmpty()){
                    foreach($value['designs'] as $value){
                        if($value['options'][0]['default_color'] == 1)
                        $imageData[] = $value['options'][0]['image'];
                    }
            }
        }
        $this->data['homeList'] = $homes;

        $this->data['data1'] = $data1;


        //return view('xdesign.index', compact('homeDesignTypes', 'homeDesigns', 'homeTypeOptions','homeDesignOptions','data'));

        return view('xdesign.index', compact('homeDesignTypes','data','groupId','imageData','homeDesignGroup','homeDesigns', 'homeTypeOptions','homeDesignOptions','data','preSelectedArrayData'))->with($this->data);

    }

    public function grouping(Request $request, $id = null)
    {
        
        if(($request->session()->has('home_id'))){
            $home_id=$request->session()->get('home_id');
        }else{
            return redirect(route('welcome'));
        }
        $request->session()->forget('design_price');


        $lid=$request->session()->has('lot_id');
        $home = Homes::where('id',$home_id)->get()->first();
        $homeDesignGroups = HomeDesignGroups::where('home_id',$home_id)->get();

        return view('xdesign.grouping', compact('homeDesignGroups','link', 'backlink', 'home'));

    }


    public function designPage(Request $request)
    {
        $sessionData = $request->session();
        $request->session()->put('home_group_id', $request->home_group_id);
        //echo "<pre>"; print_r($request->session()); die;
        $homeGroupCount = HomeDesignGroups::get();

        $homeGroup = array(); 
        //$x = 0;
        if (!$homeGroupCount->isEmpty()) { 
            foreach($homeGroupCount as $value){
                $homeGroup[] = $value['id'];
            }
        }
        $request->session()->put('home_groups', $homeGroup);
        //echo "<pre>"; print_r($homeGroup); die;
        return redirect('/design');
    }

    public function addIndesign(Request $request)
    {
        $encoded = base64_decode($request->link);

        //echo "<pre>"; print_r($encoded); die;

       // $encoded = explode('-', $encoded);

        $features_id = 'D'.$request->home_group_id;

        $var = $encoded.'-'.$features_id;

        //echo $var; die; print_r($request->all()); die;

        return redirect('/design/'.base64_encode($var));
    }

    
    public function designData(Request $request)
    {
        //echo "<pre>"; print_r($request->all()); die;
        
        $optionData = array();

        //echo "<pre>"; print_r($request->options); die;

        if(!empty($request->options)){
            $optionData = $request->options;
        }
        /*$encoded = base64_decode($request->homedata);
        $encoded = explode('-', $encoded);
        $lid = substr($encoded[0], 1);
        $hid = substr($encoded[1], 1);
        $hid = explode('.', $hid);
        $home_id = $hid[0]; 
        $color_scheme_id = (isset($hid[1]))?$hid[1]:'';*/


        $lid=($request->session()->has('lot_id'))?$request->session()->get('lot_id'):'1';
        $home_id =($request->session()->has('home_id'))?$request->session()->get('home_id'):'1'; 
        $color_scheme_id = ($request->session()->has('color_scheme_id'))?$request->session()->get('color_scheme_id'):'1'; 
        $groupId = ($request->session()->has('home_group_id'))?$request->session()->get('home_group_id'):'1'; 

        $totalGroups = array();

        $homes = Homes::where('id',$home_id)->get();
        $color_scheme = ($color_scheme_id !='')?ColorSchemes::where('id',$color_scheme_id)->first():'';


        $request->session()->put('design_options', $optionData);

        $request->session()->put('final_cost', $request->final_cost);

        /*$features = $request->feature_id;

        if(!isset($features))
        {
            $features = array();
        }*/

        if(!isset($optionData))
        {
            $optionData = array();
        }

        //$homeDesignOptionsId = base64_encode($optionData);

        /*$features_id = 'F.'.implode('.',$features);

        $homeDesignOptionsId = 'D.'.implode('.',$request->options);

        $var = implode('-', $encoded).'-'.$features_id.'-'.$homeDesignOptionsId;*/

        //echo $var; die;

        
        
        //$request->session()->put('total_price',$request->final_cost);

        return redirect('/estimate');


    }


    public function finalPrice(Request $request)
    {
        echo "<pre>"; print_r($request->all()); die;

    }
    public function priceSession(Request $request){

        $optionData = array();

        //echo "<pre>"; print_r(json_decode(stripslashes($_POST['preSelectedArray']))); die;

        if(!empty($_POST['selectedOptions'])){
            $optionData = json_decode(stripslashes($_POST['selectedOptions']));
        }

        if(!empty($_POST['imageData'])){
            $imageData = json_decode(stripslashes($_POST['imageData']));
        }


        //echo "<pre>"; print_r($optionData); 

        $designOptions =($request->session()->has('design_options'))?$request->session()->get('design_options'):[];

        if(isset($designOptions) && !empty($designOptions)){

            $res = array_merge($designOptions, $optionData);
            $res = array_unique($res);
            $request->session()->put('design_options', $res); 

            echo "<pre>"; print_r($designOptions);
            echo "already set"; //die;


        } else {
            $request->session()->put('design_options', $optionData);
           echo "not set"; //die;
        }

        if(!empty($_POST['imageData'])){
            $imageData = json_decode(stripslashes($_POST['imageData']));
        }


        
        $request->session()->put('imageData', $imageData);
        $request->session()->put('total_price', $request->total_price);
        $request->session()->put('design_customization', $request->design_customization);
        if($request->session()->has('home_price')){
          $design_price=$request->total_price-$request->session()->get('floor_price')-$request->session()->get('home_price')-$request->session()->get('lot_price');  
          }else{
            $design_price=$request->total_price-$request->session()->get('floor_price')-$request->session()->get('base_price')-$request->session()->get('lot_price'); 
          }
        

        $request->session()->put('design_price', $design_price);
        return response()->json(['success'=>'1','design_price'=>$design_price, 'customization' => $request->design_customization]);

    }

    public function designSession(Request $request){

        $designArray[$request->type] = array(
                                "designId" => $request->designId,
                                "colorId" => $request->colorId, 
                                "combinationId" => $request->combinationId,   
                                "sessionImage" => $request->sessionImage,
                                "sessionName" => $request->sessionName,
                                "sessionPrice" => $request->sessionPrice,
                                "sessionType" => $request->sessionType
                        
                );
        //echo "<pre>"; print_r($designArray);
        if(!empty($designArray)){

            if(isset($_SESSION['selectedSession'])){
                $res = array_merge($_SESSION['selectedSession'], $designArray); 
                $_SESSION['selectedSession'] = $res;
                echo "<pre>"; print_r($_SESSION['selectedSession']);
            }else {
                //array_push($selectedArray, $designArray); 
                $_SESSION['selectedSession'] = $designArray;
            }
        }

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
