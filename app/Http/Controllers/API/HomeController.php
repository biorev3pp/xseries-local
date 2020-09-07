<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Homes;

class HomeController extends Controller
{
    //
    public function getHomeGallery($id = null)
    {
        $data = '';
        $home = Homes::where('id', $id)->get()->first();
        if ($home):
            $gallery = explode(',', $home->gallery);
            foreach ($gallery as $key => $value) {
                if($value):
                    $data.='<div class="col-lg-4 col-md-6 col-sm-6">
                        <figure class="effect-romeo">
                            <img src="'.asset('uploads/homes/'.$value).'" class="img-fluid">
                            <span id="uploaded_image"></span>
                            <figcaption>
                                <p><a href="javascript:void(0)" id="ablock'.$id.$key.'" onclick="deleteImage('.$id.$key.')" class="text-white" data-gname="'.$value.'"><i class="fas fa-trash"></i> </a></p>
                            </figcaption>
                        </figure>
                    </div>';
                endif;
            }
            return ['gallery' => $data];
        else:
            return ['gallery' => ''];
        endif;
    }

    public function deleteHomeImage(Request $request)
    {
        $id = $request->hid;
        $file = $request->gname;
        $gallery = Homes::whereId($id)->first();
        $gallery = explode(',', $gallery->gallery);

        $gallery = array_diff($gallery, [$file]);
        Homes::whereId($id)->update(['gallery' => implode(',', $gallery)]);
        return ['message'   => 'Image deleted Successfully']; 
    }

    // Floor

    public function getFloorGallery($id = null)
    {
        $data = '';
        $home = Homes::where('id', $id)->get()->first();
        if ($home):
            $gallery = explode(',', $home->floor_plan);
            foreach ($gallery as $key => $value) {
                if($value):
                    $data.='<div class="col-lg-4 col-md-6 col-sm-6">
                        <figure class="effect-romeo">
                            <img src="'.asset('uploads/floors/'.$value).'" class="img-fluid">
                            <span id="uploaded_image"></span>
                            <figcaption>
                                <h2></h2>
                                <p><a href="javascript:void(0)" id="floorblock'.$id.$key.'" onclick="deleteFloorImage('.$id.$key.')" class="text-white" data-gname="'.$value.'"><i class="la la-trash"></i> </a></p>
                            </figcaption>
                        </figure>
                    </div>';
                endif;
            }
            return ['gallery' => $data];
        else:
            return ['gallery' => ''];
        endif;
    }

    public function deleteFloorImage(Request $request)
    {
        $id = $request->hid;
        $file = $request->gname;
        $gallery = Homes::whereId($id)->first();
        $gallery = explode(',', $gallery->floor_plan);

        $gallery = array_diff($gallery, [$file]);
        Homes::whereId($id)->update(['floor_plan' => implode(',', $gallery)]);
        return ['message'   => 'Image deleted Successfully']; 
    }

    public function getElevation(Request $request){
        $elevation = [];
        $home = Homes::with('floors')->where('id', $request->hid)->first();
        $elevation['home'] = $home;
        $elevation['floor_data'] = $home->floors;
        $gallery = explode(",", $home->gallery);  
        $elevation['gallery'] = $gallery;
        return $elevation;
    }
    function getDistance(Request $request) {
        $response =  file_get_contents('https://maps.googleapis.com/maps/api/distancematrix/json?origins='.$request->lat.','.$request->lng.'&destinations=place_id:'.$request->pid.'&key=AIzaSyDW-MNsJkIli84no9ZFtyx5uJrEUFPCACE');
        return ['status' =>  'success', 'data' => json_decode($response)];
    }
}
