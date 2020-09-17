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
            $array = (new ExcelHeadings)->toArray($request->excelFile);
            $data = [];
            $data['headings'] = $array;
            if(array_key_exists('Communities',$array))
            {
                $data['communities'] = ['Name','Location','State','City','Marker Image','Description','Zipcode','Logo Image','Banner','Latitude','Longitude','Gallery','Contact Number','Contact Email','Contact Person'];
            }
            if(array_key_exists('Elevations',$array))
            {
                $data['elevations'] = ['Name','Price','Area','Bedroom','Bathroom','Image','Description','Garage','Number Of Floors','Gallery'];
            }
            if(array_key_exists('Elevation Types',$array))
            {
                $data['elevation_types'] = ['Name','Price','Area','Bedroom','Bathroom','Image','Description','Garage','Floor','Gallery'];
            }
            if(array_key_exists('Floors',$array))
            {
                $data['floor'] = ['Title','Elevation Title','Image'];
            }
            if(array_key_exists('Floor Features',$array))
            {
                $data['floor_feature'] = ['Elevation Name','Floor Title','Feature Title','Price','Image','Feature Or Feature Group'];
            }
            if(array_key_exists('Color Schemes',$array))
            {
                $data['color_scheme'] = ['Elevation Or Elevation Type Name','Color Scheme Title','Image','Price'];
            }
            if(array_key_exists('Color Scheme Features',$array))
            {
                $data['color_scheme_features'] = ['Elevation Or Elevation Type Name','Color Scheme Title','Feature Title','Price','Upgrade Or Base','Upgraded Type','Material','Manufacturer','Name','Manufacturer ID','Feature Image',];
            }
            dd($data);
            return "Import Successful";
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   if($request->excelFile)
        {
            // Excel::import(new ManageImport, $request->excelFile);
            $array = (new ManageImport)->toArray($request->excelFile);
            dd($array);
            return "Import Successful";
        }
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
