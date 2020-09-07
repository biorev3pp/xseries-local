<?php
namespace App\Http\Controllers;
session_start();

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Floor;
use App\Models\Lots;
use App\Models\Features;
use App\Models\Homes;
use App\Models\ColorSchemes;
use App\Models\HomeFeatures;
use App\Models\Communities;
use App\Models\ColorSchemeUpgrade;
use App\Models\Estimates;
class HomeController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function estimate(Request $request)
    {
        if ($request->session()->has('total_price')) {
            $total_price = $request->session()->get('total_price');
        } else {
            return redirect(route('welcome'));
        }
        $home_id = $request->session()->get('home_id');
        $lid = $request->session()->get('lot_id');
        $this->data['lot'] = Lots::whereId($lid)->get()->first();
        $this->data['community'] = Communities::where('slug', $request->session()->get('community_slug'))->get()->first();
        $this->data['home'] = Homes::where('id', $home_id)->with('floors')->get()->first();
        $this->data['home_type'] = null;
        if ($request->session()->has('home_type_id')) {
            $this->data['home_type'] = Homes::whereId($request->session()->get('home_type_id'))->get()->first();
        }
        $this->data['features'] = $request->session()->has('floor_features') ? $request->session()->get('floor_features') : [];
        if ($request->session()->has('home_upgrade_features')) {
            //with upgraded options
            $home_upgrade = $request->session()->get('home_upgrade_features');
            $color_scheme_id = $request->session()->get('color_scheme_id');
            $this->data['myhome'] = ColorSchemeUpgrade::where(['color_scheme_id' => $home_upgrade['color_scheme_id'], 'concrete' => $home_upgrade['concrete'], 'window' => $home_upgrade['window'], 'side' => $home_upgrade['side']])->first();
            $this->data['myhome']->color_scheme = ColorSchemes::where('id', $color_scheme_id)->first();
            if ($request->session()->get('home_upgrade_patches')):
                $home_upgrade_patches = $request->session()->get('home_upgrade_patches');
            else:
                $home_upgrade_patches = [];
            endif;

            $this->data['home_upgrade_patches'] = $home_patches = HomeFeatures::whereIn('id', $home_upgrade_patches)->get();
        } elseif ($request->session()->has('color_scheme_id')) {
            //with Color Scheme Only
            $color_scheme_id = $request->session()->get('color_scheme_id');
            $this->data['myhome']->color_scheme = $this->data['myhome'] = $color_scheme = ColorSchemes::where('id', $color_scheme_id)->first();

            $this->data['myhome']->img = $color_scheme->base_img;
            $this->data['home_option'] = 'color_scheme';
        } elseif ($request->session()->has('home_id')) {
            //with Home only
            $this->data['myhome'] = Homes::where('id', $home_id)->first();
        } else {
            return redirect()->back();
        }
        $this->estimatesEntry($request,$this->data['community']->id);
        if (isset($request->action) && $request->action == 'pdf') {
            ini_set('memory_limit', '-1');
            ini_set('max_execution_time', 300); //300 seconds = 5 minutes
            $pdf = \PDF::loadView('pdf', $this->data)->setPaper('a4', 'portrait');
            return $pdf->download('xseries.pdf');
        } else {
            return view('estimate')->with($this->data);
        }
    }
    public function viewPdf(Request $request)
    {
        if ($request->session()->has('total_price')) {
            $total_price = $request->session()->get('total_price');
        } else {
            return redirect(route('welcome'));
        }
        $home_id = $request->session()->get('home_id');
        $lid = $request->session()->get('lot_id');
        $this->data['lot'] = Lots::whereId($lid)->get()->first();
        $this->data['community'] = Communities::where('slug', $request->session()->get('community_slug'))->get()->first();
        $this->data['home'] = Homes::where('id', $home_id)->with('floors')->get()->first();

        $this->data['features'] = $request->session()->has('floor_features') ? $request->session()->get('floor_features') : [];

        $this->data['home_title'] = Homes::where('id', $home_id)->first()->title;
        if ($request->session()->has('home_upgrade_features')) {
            //with upgraded options
            $home_upgrade = $request->session()->get('home_upgrade_features');
            $color_scheme_id = $request->session()->get('color_scheme_id');
            $this->data['myhome'] = ColorSchemeUpgrade::where(['color_scheme_id' => $home_upgrade['color_scheme_id'], 'concrete' => $home_upgrade['concrete'], 'window' => $home_upgrade['window'], 'side' => $home_upgrade['side']])->first();
            $this->data['myhome']->color_scheme = ColorSchemes::where('id', $color_scheme_id)->first();
            if ($request->session()->get('home_upgrade_patches')):
                $home_upgrade_patches = $request->session()->get('home_upgrade_patches');
            else:
                $home_upgrade_patches = [];
            endif;
            $this->data['home_upgrade_patches'] = $home_patches = HomeFeatures::whereIn('id', $home_upgrade_patches)->get();
            $this->data['home_option'] = 'home_upgrade_features';
        } elseif ($request->session()->has('color_scheme_id')) {
            //with Color Scheme Only
            $color_scheme_id = $request->session()->get('color_scheme_id');
            $this->data['myhome']->color_scheme = $this->data['myhome'] = $color_scheme = ColorSchemes::where('id', $color_scheme_id)->first();
            $this->data['myhome']->img = $color_scheme->base_img;
            $this->data['home_option'] = 'color_scheme';
        } elseif ($request->session()->has('home_id')) {
            //with Home only
            $request->session()->get('home_id');
            $this->data['myhome'] = Homes::where('id', $home_id)->first();
            $this->data['home_option'] = 'home';
        } else {
            return redirect()->back();
        }

        return view('pdf')->with($this->data);
    }
    public function estimatesEntry(Request $request,$cid)
    {
        # code...
        $total_price = $request->session()->get('total_price');
        $hid = $request->session()->has('home_type_id')?$request->session()->get('home_type_id'):$request->session()->get('home_id');
        $lid = $request->session()->get('lot_id');
        $upgrade_ids;
        if($request->session()->has('home_upgrade_patches'))
        {
            $temp =  $request->session()->get('home_upgrade_patches');
            $upgrade_ids = implode(',',$temp);
        }
        if($request->session()->has('color_scheme_id')){
            if(Estimates::where([
                'admin_id'   => Auth::user()->id,
                'lot_id' => $lid,
                'community_id'      => $cid,
                'home_id'           => $hid,
                'color_scheme_id'   => $request->session()->get('color_scheme_id'),
                'total_price'       => $total_price])->count()==0)
            {
                Estimates::create(['admin_id'   => Auth::user()->id,
                                    'community_id'      => $cid,
                                    'home_id'           => $hid,
                                    'lot_id'            => $lid,
                                    'reference_id'      => Auth::user()->id,
                                    'color_scheme_id'   => $request->session()->get('color_scheme_id'),
                                    'home_feature_ids'  => isset($upgrade_ids)?$upgrade_ids:null,
                                    'total_price'       => $total_price,
                                    'home_msg' =>($request->session()->has('home_msg'))?$request->session()->get('home_msg'):'',
                                    ]);
            }
        }
        elseif($request->session()->has('floor_features')){
            $f_ids = json_encode($request->session()->get('floor_features'));
            if(Estimates::where([
                'admin_id'          => Auth::user()->id,
                'community_id'      => $cid,
                'home_id'           => $hid,
                'color_scheme_id'   => $request->session()->get('color_scheme_id'),
                'feature_id'        =>$f_ids,
                'lot_id' => $lid,
                'total_price'       =>  $total_price])->count()==0)
            {
                 Estimates::create([
                'admin_id' => Auth::user()->id,
                'community_id' => $cid,
                'home_id' => $hid,
                'lot_id' => $lid,
                'color_scheme_id'   => $request->session()->get('color_scheme_id'),
                'reference_id' =>Auth::user()->id,
                'feature_id'  =>$f_ids,
                'total_price' =>  $total_price,
                'home_msg' =>($request->session()->has('floor_msg'))?$request->session()->get('floor_msg'):'',
                ]);
            }
        }
        else{
            if(Estimates::where(['admin_id' => Auth::user()->id,
            'lot_id' => $lid,
            'home_id' => $hid,
            'community_id' => $cid,
            'total_price' => $total_price])->count()==0)
            {	
                Estimates::create(['admin_id' => Auth::user()->id,
                    'reference_id' =>Auth::user()->id,
                    'lot_id' => $lid,
                    'home_id' => $hid,
                    'community_id' => $cid,
                    'total_price' => $total_price]);
            }
        }
    }
}
