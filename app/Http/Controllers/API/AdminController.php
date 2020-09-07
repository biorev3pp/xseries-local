<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Communities;
use App\Models\Homes;
use App\Models\Floor;
use App\Models\ColorSchemes;
use App\Models\HomeFeatures;
use Validator;
use App\Models\HomeDesignGroups;
use App\Models\HomeDesignTypes;
use App\Models\HomeDesigns;

USE DB;

class AdminController extends Controller
{
    public function communityStatus($id)
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

    public function homeStatus($id)
    {

        $homes = Homes::find($id);

        $home_id = $homes->id;
        $status = $homes->status_id;

        $result = 1;
        
        if($status==1) 
        {
            Homes::where('id', $home_id)->update(['status_id' => 2]);
            $result = 2;
        } 
        else 
        {
            Homes::where('id', $home_id)->update(['status_id' => 1]);
            $result = 1;
        }
        return json_encode($result);
    }

    public function floorStatus($id)
    {

        $floor = Floor::find($id);

        $floor_id = $floor->id;
        $floor_status = $floor->status_id;

        $result = 1;
        
        if($floor_status==1) 
        {
            Floor::where('id', $floor_id)->update(['status_id' => 2]);
            $result = 2;
        } 
        else 
        {
            Floor::where('id', $floor_id)->update(['status_id' => 1]);
            $result = 1;
        }
        return json_encode($result);
    }

    public function colorschemeStatus($id)
    {

        $scheme = ColorSchemes::find($id);

        $scheme_id = $scheme->id;
        $scheme_status = $scheme->status_id;

        $result = 1;
        
        if($scheme_status==1) 
        {
            ColorSchemes::where('id', $scheme_id)->update(['status_id' => 2]);
            $result = 2;
        } 
        else 
        {
            ColorSchemes::where('id', $scheme_id)->update(['status_id' => 1]);
            $result = 1;
        }
        return json_encode($result);
    }

    public function colorfeatureStatus($id)
    {

        $color_feature = HomeFeatures::find($id);

        $color_feature_id = $color_feature->id;
        $color_feature_status = $color_feature->status_id;

        $result = 1;
        
        if($color_feature_status==1) 
        {
            HomeFeatures::where('id', $color_feature_id)->update(['status_id' => 2]);
            $result = 2;
        } 
        else 
        {
            HomeFeatures::where('id', $color_feature_id)->update(['status_id' => 1]);
            $result = 1;
        }
        return json_encode($result);
    }

    public function DesignGroupStatus($id)
    {

        $designGroups = HomeDesignGroups::find($id);
        //print_r($designGroups);die;
        $designGroups_id = $designGroups->id;
        $status = $designGroups->status_id;

        $result = 1;
        
        if($status==1) 
        {
            HomeDesignGroups::where('id', $designGroups_id)->update(['status_id' => 2]);
            $result = 2;
        } 
        else 
        {
            HomeDesignGroups::where('id', $designGroups_id)->update(['status_id' => 1]);
            $result = 1;
        }
        return json_encode($result);
    }


    public function DesignTypeStatus($id)
    {

        $designType = HomeDesignTypes::find($id);
        //print_r($designGroups);die;
        $designType_id = $designType->id;
        $status = $designType->status_id;

        $result = 1;
        
        if($status==1) 
        {
            HomeDesignTypes::where('id', $designType_id)->update(['status_id' => 2]);
            $result = 2;
        } 
        else 
        {
            HomeDesignTypes::where('id', $designType_id)->update(['status_id' => 1]);
            $result = 1;
        }
        return json_encode($result);
    }


    public function DesignStatus($id)
    {

       $design = HomeDesigns::find($id);
       $design_id = $design->id;
       $status = $design->status_id;

       $result = 1;
        if ($status==1) 
        {
            HomeDesigns::where('id', $design_id)->update(['status_id' => 2]);
            $result = 2;
        } 
        else 
        {
            HomeDesigns::where('id', $design_id)->update(['status_id' => 1]);
            $result = 1;
        }


        return json_encode($result);
    }
}
