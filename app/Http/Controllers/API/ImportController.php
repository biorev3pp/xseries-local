<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\ManageImport;
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
                $data['elevation_types'] = ['title'=>'Name','price'=>'Price','area'=>'Area','bedroom'=>'Bedroom','bathroom'=>'Bathroom','img'=>'Image','specifications'=>'Description','garage'=>'Garage','floor'=>'Number Of Floors','gallery'=>'Gallery'];
            }
            if(array_key_exists('Floors',$array))
            {
                $data['floor'] = ['title'=>'Title','home_id'=>'Elevation Title','image'=>'Image'];
            }
            if(array_key_exists('Floor Features',$array))
            {
                $data['floor_feature'] = ['home'=>'Elevation Name','floor'=>'Floor Title','title'=>'Feature Title','price'=>'Price','image'=>'Image','group'=>'Feature Or Feature Group'];
            }
            if(array_key_exists('Color Schemes',$array))
            {
                $data['color_scheme'] = ['home_id'=>'Elevation Or Elevation Type Name','title'=>'Color Scheme Title','img'=>'Image','price'=>'Price'];
            }
            if(array_key_exists('Color Scheme Features',$array))
            {
                $data['color_scheme_features'] = ['home'=>'Elevation Or Elevation Type Name','color_scheme_id'=>'Color Scheme Title','title'=>'Feature Title','price'=>'Price','upgraded'=>'Upgrade Or Base','upgrade_type'=>'Upgraded Type','material'=>'Material','manufacturer'=>'Manufacturer','name'=>'Name','m_id'=>'Manufacturer ID','img'=>'Feature Image',];
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
         Excel::import(new ManageImport($mapArray,$importing_on), $path);
        // $array = ();
        // dd($array);
        $com_success = Communities::where('imported_on',$importing_on)->count();
        $ele_success = Homes::where('imported_on',$importing_on)->count();
        $ele_type_success = Homes::where('imported_on',$importing_on)->where('parent_id','!=',0)->count();
        $color_success = ColorSchemes::where('imported_on',$importing_on)->count();
        $color_feature_success = HomeFeatures::where('imported_on',$importing_on)->count();
        $floor_success = Floor::where('imported_on',$importing_on)->count();
        $floor_feature_success = Features::where('imported_on',$importing_on)->count();
        $total_success = $com_success+$ele_success+$ele_type_success+$color_success+$color_feature_success+$floor_feature_success+$floor_success;

        $com_fail = ErrorHistory::where(['imported_on'=>$importing_on,'type' =>'community'])->count();
        $ele_fail = ErrorHistory::where(['imported_on'=>$importing_on,'type' =>'elevation'])->count();
        $ele_type_fail = ErrorHistory::where(['imported_on'=>$importing_on,'type' =>'elevation_type'])->count();
        $color_fail = ErrorHistory::where(['imported_on'=>$importing_on,'type' =>'color_scheme'])->count();
        $color_feature_fail = ErrorHistory::where(['imported_on'=>$importing_on,'type' =>'color_scheme_feature'])->count();
        $floor_fail = ErrorHistory::where(['imported_on'=>$importing_on,'type' =>'floor'])->count();
        $floor_feature_fail = ErrorHistory::where(['imported_on'=>$importing_on,'type' =>'floor_feature'])->count();
        $total_fail = $com_fail+$ele_fail+$ele_type_fail+$color_fail+$color_feature_fail+$floor_fail+$floor_feature_fail;

        $success_percent = ($total_success)/($total_fail+$total_success);
        $res = array(
            'success'       =>$total_success,
            'fail'          => $total_fail,
            'percentage'    => $success_percent 
        );
        // $res = ErrorHistory::where('imported_on',$importing_on)->get();
        // foreach($res as $r)
        // {
        //     $r = unserialize($r->data);
        // }
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
}
