<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\ManageImport;
use App\Exports\ManageExport;
use App\Imports\ExcelHeadings;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Communities;
use App\Models\ColorSchemes;
use App\Models\HomeFeatures;
use App\Models\Homes;
use App\Models\Floor;
use App\Models\Features;
use App\Models\History;
use App\Models\ErrorHistory;
class ImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    /**
     * Read the sheet and send the columns available in the sheets
     */
    public function getColumnsToMap(Request $request)
    {
        # code...
        if($request->excelFile)
        {
            // Excel::import(new ManageImport, $request->excelFile);
            if($request->session()->has('excel'))
            {
                $dir = public_path('/uploads/excel/');
                $path = $dir.$request->session()->get('excel');
                unlink($path);
            }
            $array = (new ExcelHeadings)->toArray($request->excelFile);
            $data = [];
            $data['headings'] = $array;
            if(array_key_exists('Communities',$array))
            {
                $data['communities'] = ['name'=>'Name','location'=>'Location','state_id'=>'State','city_id'=>'City','marker_image'=>'Marker Image','description'=>'Description','zipcode'=>'Zipcode','logo'=>'Logo Image','banner'=>'Banner','lat'=>'Latitude','lng'=>'Longitude','gallery'=>'Gallery','contact_number'=>'Contact Number','contact_email'=>'Contact Email','contact_person'=>'Contact Person'];
            }
            if(array_key_exists('Elevations',$array))
            {
                $data['elevations'] = ['title'=>'Name','price'=>'Price','area'=>'Area','bedroom'=>'Bedroom','bathroom'=>'Bathroom','img'=>'Image','specifications'=>'Description','garage'=>'Garage','floor'=>'Number Of Floors','gallery'=>'Gallery'];
            }
            if(array_key_exists('Elevation Types',$array))
            {
                $data['elevation_types'] = ['title'=>'Name','parent_id'=>'Base Elevation','price'=>'Price','area'=>'Area','bedroom'=>'Bedroom','bathroom'=>'Bathroom','img'=>'Image','specifications'=>'Description','garage'=>'Garage','floor'=>'Number Of Floors','gallery'=>'Gallery'];
            }
            if(array_key_exists('Floors',$array))
            {
                $data['floor'] = ['title'=>'Title','home_id'=>'Elevation Title','image'=>'Image'];
            }
            if(array_key_exists('Floor Features',$array))
            {
                $data['floor_feature'] = ['home_id'=>'Elevation Name','floor_id'=>'Floor Title','title'=>'Feature Title','price'=>'Price','image'=>'Image','group'=>'Feature Or Feature Group'];
            }
            if(array_key_exists('Color Schemes',$array))
            {
                $data['color_scheme'] = ['home_id'=>'Elevation Or Elevation Type Name','title'=>'Color Scheme Title','img'=>'Image','price'=>'Price'];
            }
            if(array_key_exists('Color Scheme Features',$array))
            {
                $data['color_scheme_features'] = ['home_id'=>'Elevation Or Elevation Type Name','color_scheme_id'=>'Color Scheme Title','title'=>'Feature Title','price'=>'Price','upgraded'=>'Upgrade Or Base','upgrade_type'=>'Upgraded Type','material'=>'Material','manufacturer'=>'Manufacturer','name'=>'Name','m_id'=>'Manufacturer ID','img'=>'Feature Image'];
            }
            $file = $request->excelFile;
            $name = $file->getClientOriginalName();
            $destination = public_path('/uploads/excel/');
            $file->move($destination,$name);
            $request->session()->put('excel',$name);
            return $data;
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $importing_on = time();
        $mapArray = json_decode($request->mapped);
        $dir = public_path('/uploads/excel/');
        $path = $dir.$request->session()->get('excel');
        $flag = $mapArray->import_as;
         Excel::import(new ManageImport($mapArray,$importing_on,$flag), $path);
        // $array = ();
        // dd($array);
        $com_success = Communities::where('imported_on',$importing_on)->count();
        $ele_success = Homes::where('imported_on',$importing_on)->count();
        $ele_type_success = Homes::where('imported_on',$importing_on)->where('parent_id','!=',0)->count();
        $color_success = ColorSchemes::where('imported_on',$importing_on)->count();
        $color_feature_success = HomeFeatures::where('imported_on',$importing_on)->count();
        $floor_success = Floor::where('imported_on',$importing_on)->count();
        $floor_feature_success = Features::where('imported_on',$importing_on)->count();

        $com_fail = ErrorHistory::where(['imported_on'=>$importing_on,'type' =>'community','flag'=>'error'])->count();
        $ele_fail = ErrorHistory::where(['imported_on'=>$importing_on,'type' =>'elevation','flag'=>'error'])->count();
        $ele_type_fail = ErrorHistory::where(['imported_on'=>$importing_on,'type' =>'elevation_type','flag'=>'error'])->count();
        $color_fail = ErrorHistory::where(['imported_on'=>$importing_on,'type' =>'color_scheme','flag'=>'error'])->count();
        $color_feature_fail = ErrorHistory::where(['imported_on'=>$importing_on,'type' =>'color_scheme_feature','flag'=>'error'])->count();
        $floor_fail = ErrorHistory::where(['imported_on'=>$importing_on,'type' =>'floor','flag'=>'error'])->count();
        $floor_feature_fail = ErrorHistory::where(['imported_on'=>$importing_on,'type' =>'floor_feature','flag'=>'error'])->count();
        $total_skip = ErrorHistory::where(['imported_on'=>$importing_on,'flag'=>'skip'])->count();
        $total_fail = $com_fail+$ele_fail+$ele_type_fail+$color_fail+$color_feature_fail+$floor_fail+$floor_feature_fail;
        $total_success = $com_success+$ele_success+$ele_type_success+$color_success+$color_feature_success+$floor_feature_success+$floor_success+$total_skip;
        $total = $total_fail + $total_success;
        if($total !=0)
        {
            $success_percent = (($total_success)/($total_fail+$total_success))*100;
            $res = array(
                'success'       =>$total_success-$total_skip,
                'skip'          => $total_skip,
                'fail'          => $total_fail,
                'percentage'    => number_format($success_percent, 2) 
            );
            History::where('imported_on',$importing_on)->update([
                'success'    =>$total_success-$total_skip,
                'fail'       =>$total_fail,
                'skip'       =>$total_skip,
                'percent'    => number_format($success_percent, 2) 
            ]);
        }
        else
        {
            $res = array(
                'success'       =>0,
                'fail'          => 0,
                'percentage'    => 0 
            );
            History::where('imported_on',$importing_on)->update([
                'success'    =>0,
                'fail'       =>0,
                'percent' => 0 
            ]);
        }
        $request->session()->forget('excel');
        unlink($path);
        return response()->json($res);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function exportError($timestamp)
    {
        # code...
        $data['community'] = [];
        $data['elevation_type'] = [];
        $data['elevation'] = [];
        $data['color_scheme']   = [];
        $data['floor']  = [];
        $data['floor_feature']  = [];
        $data['color_scheme_feature'] = [];
        $data['floor_feature']  = [];

        //Community heading
        $data['community_heading'] = ['Name','Location','State','City','Marker Image','Description','Zipcode','Logo Image','Banner','Latitude','Longitude','Gallery','Contact Number','Contact Email','Contact Person','Status'];

        // Elevation 
        $data['home_heading'] = ['Elevation Title','Specifications','Price','Area','Bedroom','Bathroom','Garage','Floor','Gallery','Featured Image','Status'];

        // Elevation type
        $data['home_type_heading'] = ['Elevation Title','Base Elevation','Specifications','Price','Area','Bedroom','Bathroom','Garage','Floor','Gallery','Featured Image','Status','Message'];

        //floor 
        $data['floor_heading'] = ['Title','Elevation Title','Image','Status','Message'];

        //floor feature
        $data['floor_feature_heading'] = ['Elevation Name','Floor Title','Feature Title','Price','Image','Feature Or Feature Group','Status','Message'];

        // Color scheme
        $data['color_scheme_heading'] = ['Elevation Or Elevation Type Name','Color Scheme Title','Image','Price','Status','Message'];

        // color scheme feature.
        $data['color_scheme_feature_heading'] = ['Elevation Or Elevation Type Name','Color Scheme Title','Feature Title','Price','Upgrade Or Base','Upgraded Type','Material','Manufacturer','Name','Manufacturer ID','Feature Image','Status','Message'];

        //Community keys
        $com_key = ['name','location','state_id','city_id','marker_image','description','zipcode','logo','banner','lat','lng','gallery','contact_number','contact_email','contact_person'];

        //Elevations and Elevation types keys
        $ele_key = ['title','price','area','bedroom','bathroom','img','specifications','garage','floor','gallery'];

        //Floor keys
        $floor_key = ['title','home_id','image'];

        //Floor Features key
        $floor_feature_key = ['home_id','floor_id','title','price','image','group'];

        //Color Scheme Key
        $color_scheme_key = ['home_id','title','img','price'];

        //Color Scheme Feature key
        $color_feature_key = ['home_id','color_scheme_id','title','price','upgraded','upgrade_type','material','manufacturer','name','m_id','img'];

        //Community related data
        $com = Communities::where('imported_on',$timestamp)->get()->toArray();
        if($com)
        {
            foreach($com as $temp_com){
                $temp_com['status'] = 'imported';
                array_push($data['community'],$temp_com);
            }
        }
        $skipped_community = ErrorHistory::where(['imported_on'=>$timestamp,'flag'=>'skip','type'=>'community'])->get();

        foreach($skipped_community as $skip)
        {
            $d = unserialize($skip->data);
            foreach($com_key as $key){
                if(!array_key_exists($key,$d)){
                    $d[$key] = '';
                }
            }
            $d['status'] = 'skipped';
            array_push($data['community'],$d);
        }
        //Elevation related data
        $ele = Homes::where('imported_on',$timestamp)->where('parent_id',0)->get()->toArray();
        if($ele){
            foreach($ele as $temp_ele){
                $temp_ele['status'] = 'imported';
                array_push($data['elevation'],$temp_ele);
            }
        }
        $skipped_ele = ErrorHistory::where(['imported_on'=>$timestamp,'flag'=>'skip','type'=>'elevation'])->get();

        foreach($skipped_ele as $skip)
        {
            $d = unserialize($skip->data);
            foreach($ele_key as $key){
                if(!array_key_exists($key,$d)){
                    $d[$key] = '';
                }
            }
            $d['status'] = 'skipped';
            array_push($data['elevation'],$d);
        }

        // Elevation type success and skip entries
        $ele_type = Homes::where('imported_on',$timestamp)->where('parent_id','!=',0)->get()->toArray();
        if($ele_type){
            foreach($ele_type as $temp_type)
                {
                    $parent_elevation = Homes::where('parent_id',$type->parent_id)->first()->title;
                    $temp_type['parent_id'] = $parent_elevation;
                    $temp_type['status'] = 'imported';
                    $temp_type['msg'] = 'ok';
                    array_push($data['elevation_type'],$temp_ele);
                }
        }
        $skipped_ele_type = ErrorHistory::where(['imported_on'=>$timestamp,'flag'=>'skip','type'=>'elevation_type'])->get();

        foreach($skipped_ele_type as $skip)
        {
            array_push($ele_key,'parent_id');
            $d = unserialize($skip->data);
            foreach($ele_key as $key){
                if(!array_key_exists($key,$d)){
                    $d[$key] = '';
                }
            }
            $d['status'] = 'skipped';
            $d['msg'] = $skip->msg;
            array_push($data['elevation_type'],$d);
        }

        // Floor related data
        $floor = Floor::where('imported_on',$timestamp)->get()->toArray();
        if($floor){
            foreach($floor as $temp_floor)
            {
                $parent_elevation = Homes::where('id',$temp_floor->home_id)->first()->title;
                $temp_floor['home_id'] = $parent_elevation;
                $temp_floor['status'] = 'imported';
                $temp_color['msg'] = 'ok';
                array_push($data['floor'],$temp_floor);
            }
        }
        $skipped_floor = ErrorHistory::where(['imported_on'=>$timestamp,'flag'=>'skip','type'=>'floor'])->get();

        foreach($skipped_floor as $skip)
        {
            $d = unserialize($skip->data);
            foreach($floor_key as $key){
                if(!array_key_exists($key,$d)){
                    $d[$key] = '';
                }
            }
            $d['status'] = 'skipped';
            $d['msg'] = $skip->msg;
            array_push($data['floor'],$d);
        }

        // Floor Feature 
        $floor_feature = Features::where('imported_on',$timestamp)->get()->toArray();
        if($floor_feature){
            foreach($floor_feature as $temp_feature)
            {
                $cFloor = Floor::where('id',$temp_feature->floor_id)->first();
                $parent_elevation = Homes::where('id',$cFloor->home_id)->first()->title;
                $temp_feature['floor_id'] = $cFloor->title;
                $temp_feature['home_id'] = $parent_elevation;
                $temp_feature['status'] = 'imported';
                $temp_feature['msg'] = 'ok';
                array_push($data['floor_feature'],$temp_feature);
            }
        }
        $skipped_floor_feature = ErrorHistory::where(['imported_on'=>$timestamp,'flag'=>'skip','type'=>'floor_feature'])->get();

        foreach($skipped_floor_feature as $skip)
        {
            $d = unserialize($skip->data);
            foreach($floor_feature_key as $key){
                if(!array_key_exists($key,$d)){
                    $d[$key] = '';
                }
            }
            $d['status'] = 'skipped';
            $d['msg'] = $skip->msg;
            array_push($data['floor_feature'],$d);
        }
        // Color Schemes Related Data
        $color_scheme = ColorSchemes::where('imported_on',$timestamp)->get()->toArray();
        if($color_scheme)
        {
            foreach($color_scheme as $temp_color)
            {
                $color_scheme_parent_ele = Homes::where('id',$temp_color->home_id)->first()->title;
                $temp_color['home_id'] = $color_scheme_parent_ele;
                $temp_color['status'] = 'imported';
                $temp_color['msg'] = 'ok';
                array_push($data['color_scheme'],$temp_color);
            }
        }
        $skipped_color = ErrorHistory::where(['imported_on'=>$timestamp,'flag'=>'skip','type'=>'color_scheme'])->get();
        foreach($skipped_color as $skip)
        {
            $d = unserialize($skip->data);
            foreach($color_scheme_key as $key){
                if(!array_key_exists($key,$d)){
                    $d[$key] = '';
                }
            }
            $d['status'] = 'skipped';
            $d['msg'] = $skip->msg;
            array_push($data['color_scheme'],$d);
        }
        // Color Scheme Feature
        $color_scheme_feature = HomeFeatures::where('imported_on',$timestamp)->get()->toArray();
        if($color_scheme_feature)
        {
            foreach($color_scheme_feature as $temp_f)
            {
                $color = ColorSchemes::where('id',$f->color_scheme_id)->first();
                $home_id = $color->home_id;
                $parent_ele = Homes::where('id',$home_id)->first()->title;
                $temp_f['home_id'] = $parent_ele;
                $temp_f['msg'] = 'ok';
                $temp_f['color_scheme_id'] = $color->title;
                $temp_f['status'] = 'imported';
                array_push($data['color_scheme_feature'],$temp_f);
            }
        }
        $skipped_color_feature = ErrorHistory::where(['imported_on'=>$timestamp,'flag'=>'skip','type'=>'color_scheme_feature'])->get();
        foreach($skipped_color_feature as $skip)
        {
            $d = unserialize($skip->data);
            foreach($color_feature_key as $key){
                if(!array_key_exists($key,$d)){
                    $d[$key] = '';
                }
            }
            $d['status'] = 'skipped';
            $d['msg'] = $skip->msg;
            array_push($data['color_scheme_feature'],$d);
        }
        $export_file_name = History::where('imported_on',$timestamp)->get(['file_name'])->first()->file_name;
        $export = new ManageExport($data);
        return Excel::download($export,$export_file_name);
    }
}
