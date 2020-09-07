<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Communities;
use App\Models\Legends;
use App\Models\Plots;
use App\Models\Lots;
use App\Models\Homes;
use App\Models\HomesLots;   
use Illuminate\Support\Facades\Auth;

class CommunitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $communities = Communities::with(['city', 'state', 'status'])->where('communities.status_id', '!=', 7)->paginate(10);
        return $communities;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function updateColorLegend(Request $request)
    {
        $split = str_split($request->cl_code, 2);
            $r = hexdec($split[0]);
            $g = hexdec($split[1]);
            $b = hexdec($split[2]);
            $ccode = "rgb(" . $r . ", " . $g . ", " . $b . ")";
        if($request->cl_id):
            Legends::where('id', $request->cl_id)->update(['name' => $request->cl_name,
                                                            'colorcode' => $ccode]);
        else:
            Legends::insert(['name' => $request->cl_name, 'legend_group_id' => $request->cl_gid,
                            'colorcode' => $ccode]);
        endif;
        return ['status' =>'success'];
    }

    public function getColorLegend($gid = null)
    {
        $legends =  Legends::where('legend_group_id', $gid)->get();
        $html = '';
        foreach ($legends as $key => $value) {
            //rgb(237, 230, 113)
            $color_code=str_replace(array( 'rgb(', ')', ' '), array('', '',''), $value->colorcode);
            $color_code=explode(',',$color_code);
            $hexValue = strtoupper(dechex($color_code[0]) . dechex($color_code[1]) . dechex($color_code[2]));
            if(Auth::user()->admin_role_id == 4):
                $html.='<tr><td width="50px">'.($key+1).'</td><td>'.$value->name.'</td><td width="70px" style="background:#'.$hexValue.'" class="badge-left"></td></tr>';
            else:
              $html.='<tr><td width="50px">'.($key+1).'</td><td>'.$value->name.'</td><td width="70px" style="background:#'.$hexValue.'" class="badge-left"></td><td width="70px"><a id="rowbtn'.$value->id.'" href="javascript:void(0)" onclick="colorLegendUpdate(2, '.$value->legend_group_id.', '.$value->id.')" data-name="'.$value->name.'" data-color-code="'.$hexValue.'"> <i class="fa fa-edit"></i> </a> <a id="rowdbtn'.$value->id.'" href="javascript:void(0)" onclick="deleteColorLegend('.$value->id.')"> <i class="fas fa-trash"></i> </a> </td></tr>';    
            endif;    
           
        }
        return ['status' =>'success', 'data' => $html];

    }

    public function deleteColorLegend(Request $request)
    {
        $id = $request->id;
        $lots =  Lots::where('legend_id', $id)->get()->count();
        if($lots >= 1):
            return ['status' => 'error', 'message'   => 'Can not be deleted. Some lots still have this color legend.'];
        else:
            Legends::where('id', $id)->delete();
            return ['status' => 'success', 'message'   => 'Color Legend has been deleted Successfully.']; 
        endif;
    }
    


    
    public function getActiveList()
    {
        $return = ''; $counting = []; $listing = '';
        $communities = Communities::where('status_id', 2)->get();
        if($communities->count()):
            $return = '<div class="row">';
            foreach ($communities as $key => $value) {
                $return.='<div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="card my-3 cmbox">
                            <div class="card-body p-3">
                                <img src="/uploads/'.$value->banner.'" class="img-fluid">                           
                                <h2>'.ucwords($value->name).'</h2>
                                <p>'.$value->location.'</p>
                                <div class="row">
                                    <div class="col-6 pr-0">
                                        <button type="button" community="'.base64_encode($value->id).'" class="btn-primary home_list">Elevations</button>
                                    </div>
                                    <div class="col-6 text-right">
                                        <a href="'.url('plats/'.$value->slug).'" class="btn-success">Plats</a>
                                    </div>
                                </div>
                            </div>
                        </div>							
                    </div>';
                if(array_key_exists($value->city_id, $counting)): 
                    $counting[$value->city_id]['count'] = $counting[$value->city_id]['count'] + 1;
                else: 
                    $counting[$value->city_id]['count'] = 1; $counting[$value->city_id]['name'] = $value->city->city.' - '.$value->state->code;
                endif;
            }
            $return .= '</div>';
        else:
            $return = '<p class="text-center picon">
                            <img src="/images/no_data_found.gif" alt="No data found" height="150px" class="mt-100">
                        </p>';
        endif;
        if(count($counting) >= 1):
            $listing = '<ul class="list-group">';
            foreach ($counting as $ckey => $cvalue) {
                $listing.='<li>'.$cvalue['name'].'<span class="badge-right">'.$cvalue['count'].'</span></li>';
            }
            $listing .= '</ul>';
        else:
            $listing = '<p class="text-white text-center my-3"> No active community at present</p>';
        endif;
        return ['listing' => $return, 'counting' => $listing];
    }
    
    public function getHtmlList($id)
    {
        $return = ''; $counting = []; $listing = '';
        $communities = Communities::where('status_id', 2)->where('city_id', $id)->get();
        if($communities->count()):
            $return = '<div class="row">';
            foreach ($communities as $key => $value) {
                $return.='<div class="col-xl-4 col-lg-6 col-md-12 col-sm-12 col-12">
                        <div class="card my-3 cmbox">
                            <div class="card-body p-3">
                                <img src="/uploads/'.$value->banner.'" class="img-fluid">                           
                                <h2>'.ucwords($value->name).'</h2>
                                <p>'.$value->location.'</p>
                                <div class="row">
                                    <div class="col-6 pr-0">
                                        <button type="button" community="'.base64_encode($value->id).'" class="btn-primary  home_list">Elevations</button>
                                    </div>
                                    <div class="col-6  text-right">
                                        <a href="'.url('plats/'.$value->slug).'" class=" btn-success">Plats</a>
                                    </div>
                                </div>
                            </div>
                        </div>							
                    </div>';
                if(array_key_exists($value->city_id, $counting)): 
                    $counting[$value->city_id]['count'] = $counting[$value->city_id]['count'] + 1;
                else: 
                    $counting[$value->city_id]['count'] = 1; $counting[$value->city_id]['name'] = $value->city->city.' - '.$value->state->code;
                endif;
            }
            $return .= '</div>';
        else:
            $return = '<p class="text-center picon">
                            <img src="/images/no_data_found.gif" alt="No data found" height="150px" class="mt-100">
                        </p>';
        endif;
        if(count($counting) >= 1):
            $listing = '<ul class="list-group">';
            foreach ($counting as $ckey => $cvalue) {
                $listing.='<li>'.$cvalue['name'].'<span class="badge-right">'.$cvalue['count'].'</span></li>';
            }
            $listing .= '</ul>';
        else:
            $listing = '<p class="text-white text-center my-3"> No active community at present</p>';
        endif;
        return ['listing' => $return, 'counting' => $listing];
    }

    public function setlotcount(Request $request)
    {
        $plot = Plots::where('community_id', $request->cid)->get()->first();
        $legends = Legends::where('legend_group_id', $plot->legend_group_id)->get();

        $html = '<ul class="list-group">';

        foreach($legends as $key => $row):
            $count = Lots::where('legend_id', $row->id)->where('plot_id', $plot->id)->get()->count();
            $html .='<li>
                        <span style="background:'.$row->colorcode.'" class="badge-left"></span>   
                        '.$row->name.'
                        <span class="badge-right">'. $count.'</span>
                    </li>';
        endforeach;
        $html .='</ul>';
        $response = ['html' => $html, 'status' => 'success'];
        return $response;
    }

    public function sethomeform(Request $request)
    {
        session_start();
        $lot = Lots::where('id',$request->lid)->first();
        unset($_SESSION['selectedSession']);
        
        $lot = Lots::with('community')->where('id', $request->lid)->get()->first();
        $home = Homes::with('floors')->where('id', $request->hid)->get()->first();
        $response['title'] = $home->title;
        $response['imglink'] = asset('uploads/homes/'.$home->img);
        $response['alt'] = $home->title;
        $response['desc'] = $home->specifications;
        $response['price'] = intval($home->price);
        $response['floor'] = $home->floor.' Floors';
        if(Auth::check()): $response['loginid'] = 1;
        else: $response['loginid'] = 0; endif;
        $response['bed'] = $home->bedroom.' Bedrooms';
        $response['bath'] = $home->bathroom.' Bathrooms';
        $response['garg'] = $home->garage.' Garages';
        $response['area'] = $home->area;
        $response['floor_data'] = $home->floors;
        $gallery = explode(",", $home->gallery);  
        $response['gallery'] = $gallery;
        $response['linfo'] = 'Lot No '.$lot->alias;
        $response['spec'] = '<li><span class="xplat-title">Price</span><span>$ '. number_format($home->price).'</span></li><li><span class="xplat-title">Floor Area</span>
        <span>'.number_format($home->area, 0).' SQ FT</span></li><li><span class="xplat-title">Status</span><span> Available</span></li>';
        return $response;
    }
    public function getLots(Request $request)
    { 
        # code...
        $this->data['lots'] = $lots = Lots::select('lots.*', 'legends.colorcode', 'legends.name')->where('plot_id', $request->pid)->join('legends', 'legends.id' ,'=', 'lots.legend_id')->orderBy('alias', 'asc')->get();
        $connected_lots = [];
        $home_id = $request->session()->get('home_id');
        foreach ($lots as $key => $lot) {
            $home = HomesLots::where('homes_id', $home_id)->where('lots_id', $lot->id)->get()->count();
            if($home >= 1) array_push($connected_lots, ['groupID' => $lot->groupID, 'colorcode' => $lot->colorcode]);
        }
        $this->data['connected_lots'] = $connected_lots;
        return $this->data;
    }
    public function disableLots(Request $request)
    {
        # code...
        $this->data['lots'] = $lots = Lots::select('lots.*', 'legends.colorcode', 'legends.name')->where('plot_id', $request['pid'])->join('legends', 'legends.id' ,'=', 'lots.legend_id')->orderBy('alias', 'asc')->get();
        $connected_lots = [];
        $request->session()->put('home_id', $request->home_id);
        $request->session()->forget('home_type_id');
        $request->session()->forget('color_scheme_id');
        $request->session()->forget('home_upgrade_features');
        $request->session()->forget('home_upgrade_patches');
        $request->session()->forget('home_customization');
        $request->session()->forget('floor_features');
        $request->session()->forget('floor_customization');
        
        foreach ($lots as $key => $lot) {
            $home = HomesLots::where('homes_id', $request->home_id)->where('lots_id', $lot->id)->get()->count();
            if($home >= 1) array_push($connected_lots, ['groupID' => $lot->groupID, 'colorcode' => $lot->colorcode]);
        }
        $this->data['connected_lots'] = $connected_lots;
        $home = Homes::where('id', $request->home_id)->get(['title','slug'])->first();
        $home_price = Homes::where('id', $request->home_id)->pluck('price');
        $community_slug = $request->session()->get('community_slug');
        $this->data['home_link'] = url('/home/'.$community_slug.'/'.$home->slug);
        $home_types = Homes::where('parent_id', $request->home_id)->get();
        $this->data['home_types'] = $home_types;
        $this->data['title'] = $home->title;
        $this->data['price'] = $home_price;
        return $this->data;
    }
    public function getAllLots(Request $request)
    {
        # code...
        return Lots::where('plot_id',$request->pid)->get(); 
    }
    public function selectElevationType(Request $request){
        $request->session()->put('home_type_id', $request->home_type_id);
        $home_type = Homes::where('id',$request->home_type_id)->get(['parent_id','slug','price','id'])->first();
        $home = Homes::where('id',$home_type->parent_id)->get(['slug'])->first();
        $lot_id = $request->session()->get('lot_id');
        $lot = Lots::where('id',$lot_id)->get('price')->first();
        $link = url('/home/'.$request->session()->get('community_slug').'/'.$home->slug.'/'.$home_type->slug);
        $total_price = $lot->price+$home_type->price;
        $request->session()->put('total_price',$total_price);
        return response()->json(['home_price'=>$home_type->price,'total_price'=>$total_price,'home_link'=>$link]);
    }
    public function search(Request $request) 
    {
        $lots = HomesLots::where('lots_id', $request->lid)->get();
        //echo '<pre>';print_r($lots);die;
        $html = '';
        if($lots->count() >= 1):
            foreach($lots as $row) {
                $home = Homes::where('id', $row->homes_id)->whereBetween("$request->type", [$request->minv, $request->maxv])->get()->first();
                if($home):
                    $sechome = '';
                    if($request->session()->has('home_id')): $sechome = $request->session()->get('home_id'); endif;
                    if($sechome == $home->id): $css = 'active'; else: $css = ''; endif;
                    $html .='<div class="search-single available-img-box shuffle-item shuffle-item--hidden d-block align-items-center pt-3 pl-3 pr-3 pb-2 m-0 border-bottom "> 
                    <div class="home-img">
                        <img src="'.asset('uploads/homes/'.$home->img).'" alt="'.$home->title.'" class="w-100">
                        <span class="text-white">
                            <svg class="mr-1" onclick="homePopup('.$request->lid.','.$home->id.')" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-info"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg>
                            <svg class="'.$css.' check-home" onclick="disableLots('.$request->lid.','.$home->id.')" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                        </span>
                        </div>
                    <p class="m-0 mt-2 home-data-wrap text-left">
                        <span class="text-white">'.$home->title.'</span>
                        <span class="d-block text-white"> $'.env('CURRENCY').number_format($home->price).'</span>
                        <span class="d-flex justify-content-between home-icons mt-2">
                            <span>
                                <span class="material-icons mr-1">
                                king_bed
                                </span>
                                '.$home->bedroom.' Beds
                            </span>
                            <span>
                                <span class="material-icons mr-1">
                                bathtub
                                </span>
                                '.$home->bathroom.' Baths
                            </span>
                            <span>
                                <span class="material-icons mr-1">
                                drive_eta
                                </span>
                                '.$home->garage.' Garages
                            </span>
                        </span>
                    </p>                            
                </div>';
                endif;
            }
        else:
            $html .='<div class="xplat_search-result text-white py-3"><p>No Home design specified for this lot.</p></div>';
        endif;
        $response = ['html' => $html, 'status' =>'success'];
        return $response;

    }

	public function CommunityHomes($community_id){
        $id=base64_decode($community_id);
        $communities= Communities::with('Homes')->find($id);
		//echo '<pre>';print_r($homes);die;
		$homes='';
		foreach($communities->Homes as $home){
        	 			
               $homes.='<div class="col-xl-6 col-lg-6 col-md-12 col-12">
                    <div class="card my-3">
                        <div class="card-body p-2 chomes-list">
                            <div class="imgwrap chomes-list">
                                <img src="'.asset('uploads/homes/'.$home->img).'" class="img-fluid">      
                            </div>  
                            <div class="div-title">                   
                                <h5 class="m-0">'.$home->title.'</h5>
                            </div>
                            <div class="row div-details">
                                <div class="col-6">
                                    <p><b>Area</b><span>'.number_format($home->area).' Sq.ft </span></p>
                                    <p><b>Price</b><span>$ '.number_format($home->price).'</span></p>
                                    <p><b>Floors </b><span>'.$home->floor.'</span></p>
                                </div>
                                <div class="col-6">
                                    <p><b>Bedrooms </b><span>'.$home->bedroom.'</span></p>
                                    <p><b>Bathrooms </b><span>'.$home->bathroom.'</span></p>  
                                    <p><b>Garage </b><span>'.$home->garage.'</span></p>
                                </div>
                                <div class="col-12">
                                    <p class="spacs my-3">'.substr($home->specifications, 0, 200).'....</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
		}
        $response = ['homes' => $homes, 'status' => 'success'];
        return $response;
    }

    public function changeStatus(Request $request)
    {
        $community = Communities::where('id', $request->community)->get()->first();
        if ($community->status_id == 1):
            Communities::where('id', $community->id)->update(['status_id' => 2]);
            return 2;
        else:
            Communities::where('id', $community->id)->update(['status_id' => 1]);
            return 1;
        endif;
    }

    public function getGallery($id = null)
    {
        $data = '';
        $community = Communities::where('id', $id)->get()->first();
        if ($community):
            $gallery = explode(',', $community->gallery);
            foreach ($gallery as $key => $value) {
                if($value):
                    if(Auth::user()->admin_role_id == 4)
                    {
                        $data.='<div class="col-lg-4 col-md-6 col-sm-6">
                        <figure class="effect-romeo">
                            <img src="'.asset('uploads/'.$value).'" class="img-fluid">
                            <span id="uploaded_image"></span>
                            <figcaption>
                            </figcaption>
                        </figure>
                    </div>';
                    }
                    else
                    {
                       $data.='<div class="col-lg-4 col-md-6 col-sm-6">
                        <figure class="effect-romeo">
                            <img src="'.asset('uploads/'.$value).'" class="img-fluid">
                            <span id="uploaded_image"></span>
                            <figcaption>
                                <p><a href="javascript:void(0)" id="ablock'.$id.$key.'" onclick="deleteImage('.$id.$key.')" class="text-white" data-gname="'.$value.'"><i class="fa fa-trash"></i> </a></p>
                            </figcaption>
                        </figure>
                    </div>'; 
                    }
                    
                endif;
            }
            return ['gallery' => $data];
        else:
            return ['gallery' => ''];
        endif;
    }

    public function deleteImage(Request $request)
    {
        $id = $request->cid;
        $file = $request->gname;
        $gallery = Communities::whereId($id)->first();
        $gallery = explode(',', $gallery->gallery);

        $gallery = array_diff($gallery, [$file]);
        Communities::whereId($id)->update(['gallery' => implode(',', $gallery)]);
        return ['message'   => 'Image deleted Successfully']; 
    }
    
}
