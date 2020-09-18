<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Imports\ManageImport;
use App\Imports\ExcelHeadings;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Communities;

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
        // Excel::import(new ManageImport, $request->excelFile);
        $mapArray = json_decode($request->mapped);
        $dir = public_path('/uploads/excel/');
        $path = $dir.$request->session()->get('excel');
        $array = (new ManageImport($mapArray))->toArray($path);
        dd($array);
        return "Import Successful";
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
