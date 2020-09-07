<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Communities;
use App\Models\States;
use App\Models\Cities;
use App\Models\Legends;
use App\Models\LegendGroups;
use Illuminate\Support\Facades\Validator;
use App\Models\Plots;
use App\Models\Lots;
use App\Models\Homes;
use App\Models\CommunitiesHomes;
use App\Models\HomesLots;
use Illuminate\Support\Facades\Auth;

class CommunitiesController extends Controller
{
    public $data;

    public function __construct()
    {
        $this->data['page_title'] = 'Communities';
        $this->data['menu'] = 'communities';
    }

    public function index()
    {
        $this->data['communities'] = Communities::all();
        return view('admin.communities.index')->with($this->data);
    }

    public function add()
    {   
        $communities = Communities::where('status_id', '!=', 7)->count();
        
            $this->data['states'] = States::all();
            return view('admin.communities.add')->with($this->data);

    }
			
    public function create(Request $request)
    {
        if ($request->isMethod('post')):
            $validator = Validator::make($request->all(), [
                'logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'banner' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'marker_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'svg' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'state_id' => 'required|numeric',
                'city_id' => 'required|numeric',                   
                'name' =>  ['required', 'regex:/^[a-zA-Z\s]*$/'],
                'location' => 'required',
                'description' => 'required',
                'zipcode' => 'required|numeric|digits_between:5,6',
                'contact_person' => ['required', 'regex:/^[a-zA-Z\s]*$/'],
                'contact_email' => 'required|email|max:180',
                'contact_number' => 'required|digits:10',
            ]);

            if ($validator->fails()) { 
                
                return redirect()->back()->withErrors($validator)->withInput();
                 //return redirect()->back()->with('exception', 'Validation failed, Kindly fill the form carefully !');
                
            }

            $name  = ''; $banner_name  = ''; $name_svg = ''; $name_plot = '';$svg_name='';

            if ($request->hasFile('logo')) {
                $image = $request->file('logo');
                $name = $image->getClientOriginalName();
                $size = $image->getClientSize();
                $destinationPath = public_path('uploads');
                $image->move($destinationPath, $name);
            }
            //Banner insert
            if ($request->hasFile('banner')) {
                $banner_image = $request->file('banner');
                $banner_name = $banner_image->getClientOriginalName();
                $size = $banner_image->getClientSize();
                $destinationPath = public_path('uploads');
                $banner_image->move($destinationPath, $banner_name);
            }    

            //Svg insert
            if ($request->hasFile('svg')) {
                $image_svg = $request->file('svg');
                $name_svg = $image_svg->getClientOriginalName();
                $svg_name = (explode(".",$name_svg))[0].time().".".(explode(".",$name_svg))[1];
                $size = $image_svg->getClientSize();
                $destinationPath = public_path('/uploads');
                $image_svg->move($destinationPath, $svg_name);   
                
            }       
        
            //Plot insert
            if ($request->hasFile('plot_image')) {
                $image_plot = $request->file('plot_image');
                $name_plot = $image_plot->getClientOriginalName();
                $size = $image_plot->getClientSize();
                $destinationPath = public_path('/uploads');
                $image_plot->move($destinationPath, $name_plot);
            }
            
           // echo $request['name']; die;
            $slug = str_replace(' ', '-', strtolower($request['name']));
            $community = Communities::create([
                'state_id' => $request['state_id'],
                'city_id' => $request['city_id'],                   
                'logo' => $name,
                'banner' => $banner_name,
                'name' => $request['name'],
                'location' => $request['location'],
                'slug' => $slug,
                'description' => $request['description'],
                'zipcode' => $request['zipcode'],
                'contact_person' => $request['contact_person'],
                'contact_email' => $request['contact_email'],
                'contact_number' => $request['contact_number'],
                'map_zoom' => 11,
                'community_type' =>$request['community_type']
            ]);
            if ($request->hasFile('marker_image')) {
                $image_marker = $request->file('marker_image');
                $name_marker = "pin-$community->id.png";
                $size = $image_marker->getClientSize();
                $destinationPath = public_path('/uploads');
                $image_marker->move($destinationPath, $name_marker);
                $community->marker_image = $name_marker;
                $community->save();
            }
            $plot = Plots::create([
                'community_id' => $community->id,
                "svg"          => $svg_name,
                'image'        => $name_plot
            ]);

            $legend_group = LegendGroups::create([
                'plot_id' => $plot->id,
                'groupname' => 'Color Legends',
                'status_id' =>2
            ]);

            Plots::where('id', $plot->id)->update([
                'legend_group_id' => $legend_group->id
            ]);
            if($svg_name){
            $plot_id = $plot->id;
            $xml = simplexml_load_string(file_get_contents(public_path('/uploads/'.$svg_name)));
            $json = json_encode($xml);
            $array = json_decode($json);
            $var = '@attributes';
            for($i = 0 ; $i < sizeof($array->g) ; $i++ ){
                // print_r( $array->g[$i]->$var->id);
                $lots = Lots::create([
                    "plot_id"   => $plot_id,
                    "groupID"   => $array->g[$i]->$var->id,
                    "alias"     => $i+1,
                    "price"     => "0",
                    "phase"     => "1",
                    "legend_id" => $legend_group->id
                ]);
            }
            }


            if (!empty($legend_group->id)) {
                /*return redirect()->route('communities')->with('message', 'Community added successfully.');*/
                return redirect('/admin/communities')->with('message', 'Community added successfully.');
            } else {
                return redirect('/admin/communities')->with('exception', 'Operation failed !');
            }   
            endif;
    }

    public function bulkEdit(Request $request){
        $lot_ids = explode(" ", $request->lot_ids);
        $data = array();
        foreach($lot_ids as $lot_id){
            $lots = Lots::where("id", $lot_id)->with('legend')->get()->first();
            
            if(empty($request->bulk_price)){
                $bulk_price = $lots->price;
            }   
            else{
                $bulk_price = $request->bulk_price;
            }

            if(empty($request->bulk_legend_id)){
                $bulk_legend_name = $lots->legend->name;
                $bulk_legend_id = $lots->legend_id;
            }
            else{
                $bulk_legend_name = $request->bulk_legend_name;
                $bulk_legend_id = $request->bulk_legend_id;
            }

            if(empty($request->bulk_phase)){
                $bulk_phase = $lots->phase;
            }   
            else{
                $bulk_phase = $request->bulk_phase;
            }

            $d =  array(
                "lot_id"            => $lot_id, 
                "bulk_price"        => $bulk_price,
                "bulk_legend_name"  => $bulk_legend_name,
                "bulk_phase"        => $bulk_phase,
            );
            array_push($data,$d);
            Lots::where('id',$lot_id)->update([
                "price"     => $bulk_price,
                "legend_id" => $bulk_legend_id,
                "phase"     => $bulk_phase
            ]);
                
        }
        
        return $data;
    }

    public function edit(Request $request, $id)
        {
       $this->data['states'] = States::all(); 
       $this->data['cities'] = Cities::all();   
       $id = base64_decode($id);
       $communities = Communities::where('id',$id)->where('status_id', '!=', 7)->get()->first();
              
       $this->data['plots'] = Plots::with('community')->where('id',$communities->id)->get()->first();
       $this->data['communities']= $communities;
         
       return view('admin.communities.edit')->with($this->data);
    }

    public function view($id = null)
    {
        $id =base64_decode($id); 
        $this->data['community'] = Communities::where('status_id', '!=', 7)->where('id', $id)->get()->first();
        $this->data['plat'] = Plots::where('community_id', $id)->get()->first();
        if($this->data['plat']){
            $this->data['legend_group'] = LegendGroups::with('legends')->where('plot_id', $this->data['plat']['id'])->get()->first();
            $this->data['lots'] = Lots::where('plot_id', $this->data['plat']['id'])->orderBy('alias', 'asc')->get();
        }
        return view('admin.communities.view')->with($this->data);
    }

    /*public function modify(Request $request){
        $this->data['communities'] = Communities::where('status_id', '!=', 7)->get();
        return view('admin.communities.edit')->with($this->data);
    }*/
    public function modify(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'banner' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'marker_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'state_id' => 'required|numeric',
            'city_id' => 'required|numeric',                   
            'name' => 'required|string|max:250',
            'location' => 'required',
            'description' => 'required',
            'zipcode' => 'required|numeric|digits_between:5,6',
            'contact_person' => 'required|string|max:250',
            'contact_email' => 'required|string|max:180',
            'contact_number' => 'required|numeric|digits:10',
        ]);       
        if ($validator->fails()) { return back()->withErrors($validator)->withInput();  }

        $communities = Communities::find($id);
        $plots = Plots::find($communities->id);
        $communities->name = $request->name;
        $communities->location = $request->location;
        $communities->slug = str_replace(' ', '-', strtolower($request['name']));
        $communities->state_id = $request->state_id;
        $communities->city_id = $request->city_id;
        $communities->zipcode = $request->zipcode;

                if($request->hasFile('logo')) {
                    $logo_image = $request->file('logo');
                    $logo_name = $logo_image->getClientOriginalName();
                    $logo_image->move(public_path('/uploads'), $logo_name);
                    $communities->logo = $request->file('logo')->getClientOriginalName();
                }

                 if($request->hasFile('banner')) {
                    $banner_image = $request->file('banner');
                    $banner_name = $banner_image->getClientOriginalName();
                    $banner_image->move(public_path('/uploads'), $banner_name);
                    $communities->banner = $request->file('banner')->getClientOriginalName();
                }

                if($request->hasFile('marker_image')) {
                    $marker_image = $request->file('marker_image');
                    $marker_name = "pin-$communities->id.png";
                    $marker_image->move(public_path('/uploads'), $marker_name);
                    $communities->marker_image = $marker_name;
                }
            //    if($request->hasFile('svg')) {
            //         $image_svg = $request->file('svg');
            //         $name_svg = $image_svg->getClientOriginalName();
            //         $svg_name = (explode(".",$name_svg))[0].time().".".(explode(".",$name_svg))[1];
            //         $size = $image_svg->getClientSize();
            //         $destinationPath = public_path('/uploads/svg');
            //         $image_svg->move($destinationPath, $svg_name);
                    
            //         $plot_id = $plots->id;
            //         $xml = simplexml_load_string(file_get_contents(public_path('/uploads/svg/'.$svg_name)));
            //         $json = json_encode($xml);
            //         $array = json_decode($json);
            //         $var = '@attributes';
            //         for($i = 0 ; $i < sizeof($array->g) ; $i++ ){
            //             // print_r( $array->g[$i]->$var->id);
            //             $lots = Lots::create([
            //                 "plot_id"   => $plot_id,
            //                 "groupID"   => $array->g[$i]->$var->id,
            //                 "alias"     => $i+1,
            //                 "price"     => "0",
            //                 "phase"     => "1",
            //                 "legend_id" => $plots->legend_id
            //             ]);
            //         }   
            //         $plots->svg = $svg_name;
            //     }

            //      if($request->hasFile('plot_image')) {
            //         $plot_image = $request->file('plot_image');
            //         $plotimg_name = $plot_image->getClientOriginalName();
            //         $plot_image->move(public_path('/uploads'), $plotimg_name);
            //         $plots->image = $request->file('plot_image')->getClientOriginalName();
            //     }      


        $communities->description = $request->description;
        $communities->contact_person = $request->contact_person;
        $communities->contact_email = $request->contact_email;
        $communities->contact_number = $request->contact_number;
        

        $communities->save();

        return redirect()->back()->with('message', 'Community Updated.');
    }

	public function upload_csv(Request $request)
		{
			

            /*if($request->hasFile('csv_file')) {
                 $csvfile = $request->file('csv_file');
                 // dd($csvfile);
                // print_r($csvfile);die;
                    $file = fopen($csvfile, "r");
                    $all_data = array();
                    while (($data = fgetcsv($file, 200, ",")) !==FALSE {



                    }    
                  
                }*/
                $request->validate([
                        'csv_file' => 'required|mimes:csv,txt',
                    ]);


                   if($request->isMethod('post')){
                    $data = $request->all();
                    $csvfile = $request->file('csv_file');
                    $handle = fopen($csvfile,"r");
                    $header = fgetcsv($handle, 0, ',');
                    $countheader= count($header); 
                    while ( ($datad = fgetcsv($handle, 1000, ",")) !==FALSE )
                    {
                        
                        $lot['alias'] = $datad[0];
                        $lot['plot_id'] = $request['plot_id'];
                        $lot['groupID'] = $datad[1];
                        $lot['price'] = $datad[2];
                        $lot['phase'] = $datad[3];
                        $lot['legend_id'] = $datad[4];

                         Lots::create($lot);
                    }

                 }   
			
        //echo 'done'; die;
                 return redirect()->back()->with('message', 'Lots Added successfully.');
		}



    public function destroy(Request $request){
        $this->data['communities'] = Communities::where('status_id', '!=', 7)->get();

       return view('admin.communities.index')->with($this->data);
    }
	public function CommunityHomes($community_id){
        $id=base64_decode($community_id);
        $this->data['communities'] = $community= Communities::with('Homes')->find($id);
        $home_ids=[];
        foreach($community->Homes as $home){
            $home_ids[]=$home->id;
        }
        //echo '<pre>';print_r($home_ids);
        $this->data['homes_not_in_community'] = $homes= Homes::whereNotIn('id',$home_ids)->get();
        $this->data['community_id']=$community_id;
        //$community = Communities::find($community_id)->all();
        //echo '<pre>';print_r($homes);die;
        return view('admin.communities.community-homes')->with($this->data);


    }
    
    public function storeCommunityHomes(Request $request)
    {
        
        foreach($request->assign as $home_id){
            CommunitiesHomes::create([
            'communities_id'=>base64_decode($request->community_id),
            'homes_id'=>$home_id,
            
        ]);

        }
        
        return redirect()->back()->with('message', 'Home added to community successfully.');
    }
	/*public function destroyCommunityHomes(Request $request)
    {
           CommunitiesHomes::where(['communities_id'=>base64_decode($request->community_id),'homes_id'=>base64_decode($request->home_id)])->delete();
           return redirect()->back()->with('message','Home successfully removed from this community'); 
    }*/
    public function destroyCommunityHomes($id)
    {
        $communities = CommunitiesHomes::where('homes_id',$id);
        if($communities != null)
        {
            $communities->delete();
            return redirect()->back()->with('message','Home successfully removed from this community'); 
        }
    }
	public function LotHomes($community_id,$lot_id){
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
       
        return view('admin.communities.lot-homes')->with($this->data);


    }
    
    public function storeLotHomes(Request $request)
    {
        
        foreach($request->assign as $home_id){
            HomesLots::create([
            'lots_id'=>base64_decode($request->lot_id),
            'homes_id'=>$home_id,
            
        ]);

        }
        
        return redirect()->back()->with('message', 'Home added to lot successfully.');
    }

    public function destroyLotHomes(Request $request){
           HomesLots::where(['lots_id'=>base64_decode($request->lot_id),'homes_id'=>base64_decode($request->home_id)])->delete();
           return redirect()->back()->with('message','Home successfully removed from this lot'); 
    }

    public function changeStatus($id)
    {

        $communities = Communities::find($id);

        $community_id = $communities->id;
        $status = $communities->status_id;

        $result = 1;
        if ($status==1) 
        {
            Communities::where('id', $community_id)->update(['status_id' => 2]);
            $result = 2;
        } 
        else 
        {
            Communities::where('id', $community_id)->update(['status_id' => 1]);
            $result = 1;
        }
        return json_encode($result);
    }

     public function update_lot(Request $request)
        {

           /* Lots::where('id', $request->id)->update(['alias' => $request->alias,
                                                        'groupID' => $request->groupid,
                                                        'price' => $request->price,]);*/
            Lots::where('id', $request->id)->update(['alias' => $request->alias,
                                                        'groupID' => $request->groupid,
                                                        'price' => $request->price,'legend_id' => $request->status]);
            $status= Legends::whereId($request->status)->get()->first();

            return Response(['stas' => $status->name, 'success', 'Lot Updated Successfully']);
        }

    public function lotdelete($id)
    {
      
        $Lot = Lots::find($id);
       if ($Lot != null) 
        {
            $Lot->delete();
            return redirect()->back()->with('success', 'Lot Deleted Successfully');
        }
    }  

    public function uploadFile(Request $request)
    {
     

        $id=$request->community_id;
        $gallery =  Communities::whereId($id)->first();
        $gallery = explode(',', $gallery->gallery);
         if($request->hasfile('uploadImage')) 
        { 
          $file = $request->file('uploadImage');
          $extension = $file->getClientOriginalExtension(); 
          $filename =time().'.'.$extension;
          //$file->move('uploads', $filename);
          $file->move(public_path('uploads'), $filename);
          array_push($gallery, $filename);
          Communities::whereId($id)->update(['gallery' => implode(',', $gallery)]);
        }

       
       return response()->json(['message'   => 'Image Upload Successfully', 'class_name'  => 'alert-success' ]); 
 
    }

    public function saveLatlong(Request $request)
    {
        $id=$request->community_id;
        Communities::whereId($id)->update(['lat' => $request->lat,'lng' => $request->lng,'marker' => $request->address,'map_zoom'=>$request->map_zoom,'map_type_id'=>$request->map_type_id]);
        return response()->json(['message'   => 'location saved Successfully']); 
            

    }
    public function distance($lat1, $lon1, $lat2, $lon2, $unit) {
      if (($lat1 == $lat2) && ($lon1 == $lon2)) {
        return 0;
      }
      else {
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
          return round(($miles * 1.609344),2);
        } else if ($unit == "N") {
          return round(($miles * 0.8684),2);
        } else {
          return round($miles,2);
        }
      }
    }
    public function nearbyLocations(Request $request)
    {
        $lat=$request->lat;
        $lng=$request->lng;
        $type=$request->type;
        $id=$request->community_id;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='.$lat.','.$lng.'&rankby=distance&type='.$type.'&key=AIzaSyDW-MNsJkIli84no9ZFtyx5uJrEUFPCACE&libraries=places,drawing');
    
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        $obj=json_decode($response);
        $community=Communities::where('status_id', '!=', 7)->where('id', $id)->get()->first()->toArray();

        $saved_record=json_decode($community['nearby'],true);
        if($saved_record ==''){
           $saved_record= []; 
        }
         
        $all_ids = [];
        if(array_key_exists($type, $saved_record)){
           foreach ($saved_record[$type] as $key => $value) {
            $all_ids[] = $value['uid'];
            } 
        }
        $content='';
        if($obj->status =='OK'){ 
            foreach($obj->results as $key =>$result ){
                if(in_array($result->place_id, $all_ids)){
                    $status='Published';
                    $css = "text-success";
                    $action_btn='<a class="nearby_delete text-success fs-25"><i class="fa fa-toggle-on"></i></a>';

                }else{
                    $status='Unpublished';
                    $css = "text-danger";
                    $action_btn='<a class="add_new text-danger fs-25"><i class="fa fa-toggle-off"></i></a>';
                }        
                
                $miles=$this->distance($community['lat'],$community['lng'],$result->geometry->location->lat,$result->geometry->location->lng,'M');
                 if(Auth::user()->admin_role_id == 4):
                    $content .='<tr type="'.$type.'" name="'.$result->name.'" address="'.$result->vicinity.'" distance="'.$miles.'" uid="'.$result->place_id.'" lat="'.$result->geometry->location->lat.'" lng="'.$result->geometry->location->lng.'"> <td>'.++$key.'</td> <td>'.$result->name.'</td> <td>'.$result->vicinity.'</td><td>'.$miles.'</td> <td id="st_'.$result->place_id.'" class="'.$css.'">'.$status.'</td> </tr>';
                else:
                    $content .='<tr type="'.$type.'" name="'.$result->name.'" address="'.$result->vicinity.'" distance="'.$miles.'" uid="'.$result->place_id.'" lat="'.$result->geometry->location->lat.'" lng="'.$result->geometry->location->lng.'"> <td>'.++$key.'</td> <td>'.$result->name.'</td> <td>'.$result->vicinity.'</td><td>'.$miles.'</td> <td id="st_'.$result->place_id.'" class="'.$css.'">'.$status.'</td> <td class="text-center" id="action_'.$result->place_id.'">'.$action_btn.'</td> </tr>';
                endif; 
                
            }
            

        }else{
           $content='No Record Found.'; 
        }
       
        return response()->json(['message'   => 'Successfull','data'=>$content]); 
            

    }
    public function addNewLocations(Request $request)
    {
        
        $name=$request->name;
        $address=$request->address;
        $distance=$request->distance;
        $uid=$request->uid;
        $lat=$request->lat;
        $lng=$request->lng;
        $id=$request->community_id;
        $type=$request->type;
        $nearby = Communities::whereId($id)->first()->toArray();
        if(empty($nearby['nearby'])){
            $nearby_data=array($type =>array( array('name'=>$name,'lat'=>$lat,'lng'=>$lng,'address'=>$address,'distance'=>$distance,'uid'=>$uid))); // First time
        }else{
           $nearby_data=$nearby['nearby']=json_decode($nearby['nearby'],true);
        
        $data=array('name'=>$name,'lat'=>$lat,'lng'=>$lng,'address'=>$address,'distance'=>$distance,'uid'=>$uid);

        if(!array_key_exists($type, $nearby_data)){
            $nearby_data[$type]=[];
        }
        array_push($nearby_data[$type], $data);  
        }
        $nearby_data=json_encode($nearby_data);
       
        Communities::whereId($id)->update(['nearby' => $nearby_data]);
        return response()->json(['message'   => 'Location saved successfully','nearby_data'=>$nearby_data]);
            

    }
    public function deleteNewLocations(Request $request)
    {
        $uid=$request->uid;
        $id=$request->community_id;
        $type=$request->type;
        $nearby = Communities::whereId($id)->first()->toArray();
        
        $nearby_data=$nearby['nearby']=json_decode($nearby['nearby'],true);
        //echo '<pre>';print_r($nearby_data[$type]);
        
       foreach ($nearby_data[$type] as $key => $value) {
        if($value['uid']==$uid){
            unset($nearby_data[$type][$key]);
            break;

        }

       }
        $nearby_data=json_encode($nearby_data);
       
        Communities::whereId($id)->update(['nearby' => $nearby_data]);
        return response()->json(['message'   => 'Location removed successfully','nearby_data'=>$nearby_data]);           

    }
}