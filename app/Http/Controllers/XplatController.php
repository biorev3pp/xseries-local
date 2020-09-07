<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Plots;
use App\Models\Communities;
use App\Models\CommunitiesHomes;
use App\Models\Lots;
use App\Models\Homes;
use App\Models\Legends;
use App\Models\HomesLots;
use App\Models\LegendGroups;
use App\Models\Settings;
use App\Models\Floors;


class XplatController extends Controller
{
    public function index(Request $request)
    {   
        $request->session()->put('pb_url_check',true);
        // dd($request->session()->get('home_id'));
        if($request->session()->has('home_id')){
            $home_id = $request->session()->get('home_id');
            $home = Homes::with('floors')->where('id',$home_id)->first();
        }
        else{ $home = [];}
        if($request->session()->has('home_type_id')){
            $home_type_id = $request->session()->get('home_type_id');
            if($home_id != $home_type_id){
                $home_type = Homes::where('id',$home_type_id)->first();
            }
            else{
                $home_type = null;
            }
        }
        else{ $home_type = null;}
        if($request->session()->has('community_slug')):
            $community = Communities::where('slug', $request->session()->get('community_slug'))->with('plot')->get()->first();
            $homes = [];
            if($community):
                $plot = Plots::where('community_id', $community->id)->get()->first();
                $legendData = LegendGroups::where('id', $plot->legend_group_id)->get()->first();
                $legends = Legends::where('legend_group_id', $plot->legend_group_id)->get();
                $xplatData = Lots::where('plot_id', $plot->id)->where('legend_id', $legends[0]->id)->get();
                $allhomes = CommunitiesHomes::where('communities_id', $community->id)->get();
                foreach ($allhomes as $key => $elevation) {
                $homes[] = $elevation->homes_id;
                }
                $range = ['max_grg' => Homes::whereIn('id', $homes)->max('garage'),
                'max_bed' => Homes::whereIn('id', $homes)->max('bedroom'),
                'max_bath' => Homes::whereIn('id', $homes)->max('bathroom'),
                'max_price' => Homes::whereIn('id', $homes)->max('price'),
                'max_floor' => Homes::whereIn('id', $homes)->max('floor'),
                'max_area' => Homes::whereIn('id', $homes)->max('area'),
                'min_grg' => Homes::whereIn('id', $homes)->min('garage'),
                'min_bed' => Homes::whereIn('id', $homes)->min('bedroom'),
                'min_bath' => Homes::whereIn('id', $homes)->min('bathroom'),
                'min_price' => Homes::whereIn('id', $homes)->min('price'),
                'min_floor' => Homes::whereIn('id', $homes)->min('floor'),
                'min_area' => Homes::whereIn('id', $homes)->min('area')];
                return view('xplat.index', compact('xplatData','community','legendData', 'legends', 'range', 'home','home_type'));
            else: return redirect(route('welcome')); endif;   
        else: return redirect(route('welcome')); endif;   
    }

    public function home()
    {
        return view('search');
    }

    public function community()
    {
        return view('community');
    }

    public function plat($id = null, $home_id, $home_type_id, Request $request)
    {   
        $request->session()->put('pb_url_check',true);
        $community = Communities::where('slug', $id)->with('plot')->get()->first();
        $home = Homes::with('floors')->where('id',$home_id)->first();
        if($home_id!= $home_type_id):
            $home_type = Homes::where("id", $home_type_id)->first();
            $request->session()->put('home_type_id', $home_type_id);
        else:
            $home_type = null;
        endif;
        $request->session()->put('home_id', $home_id);
        $homes = [];
        if($community):
            $request->session()->put('community_slug', $community->slug);
            if($request->session()->has('community_slug')):
                $community = Communities::where('slug', $request->session()->get('community_slug'))->with('plot')->get()->first();
                $homes = [];
                if($community):
                    $plot = Plots::where('community_id', $community->id)->get()->first();
                    $legendData = LegendGroups::where('id', $plot->legend_group_id)->get()->first();
                    $legends = Legends::where('legend_group_id', $plot->legend_group_id)->get();
                    $xplatData = Lots::where('plot_id', $plot->id)->where('legend_id', $legends[0]->id)->get();
                    $allhomes = CommunitiesHomes::where('communities_id', $community->id)->get();
                    foreach ($allhomes as $key => $elevation) {
                    $homes[] = $elevation->homes_id;
                    }
                    $range = ['max_grg' => Homes::whereIn('id', $homes)->max('garage'),
                    'max_bed' => Homes::whereIn('id', $homes)->max('bedroom'),
                    'max_bath' => Homes::whereIn('id', $homes)->max('bathroom'),
                    'max_price' => Homes::whereIn('id', $homes)->max('price'),
                    'max_floor' => Homes::whereIn('id', $homes)->max('floor'),
                    'max_area' => Homes::whereIn('id', $homes)->max('area'),
                    'min_grg' => Homes::whereIn('id', $homes)->min('garage'),
                    'min_bed' => Homes::whereIn('id', $homes)->min('bedroom'),
                    'min_bath' => Homes::whereIn('id', $homes)->min('bathroom'),
                    'min_price' => Homes::whereIn('id', $homes)->min('price'),
                    'min_floor' => Homes::whereIn('id', $homes)->min('floor'),
                    'min_area' => Homes::whereIn('id', $homes)->min('area')];
                    return view('xplat.index', compact('xplatData','community','legendData', 'legends', 'range','home','home_type'));
                else: return redirect(route('welcome')); endif;   
            else: return redirect(route('welcome')); endif;
            // return redirect(route('plat'));   
        else: return redirect(route('welcome')); endif;   
    }
    public function search(Request $request) 
    {
        $lots = HomesLots::where('lots_id', $request->lid)->get();
        $lot = Lots::where('id',$request->lid)->first();
        // return $request->session()->get('home_id');
        $connected_lots = HomesLots::where('homes_id', $request->session()->get('home_id'))->where('lots_id', $request->lid)->pluck('lots_id')->toArray();
        // return $connected_lots;
        if(in_array($request->lid, $connected_lots)){
            $request->session()->put('lot_id', $request->lid);
            $request->session()->put('lot_group', $lot->groupID);
            $lot = Lots::with('community')->where('id', $request->lid)->get()->first();
            $request->session()->put('community_slug', $lot->community->community->slug);
        }
        else{
            $request->session()->forget('lot_id');
        }
        
		//echo '<pre>';print_r($lots);die;
        $html = '';
        if($lots->count() >= 1):
            $hid = $request->session()->has('home_type_id')?$request->session()->get('home_type_id'):$request->session()->get('home_id');
            $lot_price = Lots::where('id',$request->lid)->get('price')->first();
            $home_price = Homes::whereId($hid)->get('price')->first();
            $total_price = $lot_price->price + $home_price->price;
            $request->session()->put('total_price',$total_price);
            // $request->session()->forget('home_id');
            foreach($lots as $row) {
                $home = Homes::findOrFail($row->homes_id);
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
    public function refresh(Request $request){
        $request->session()->forget('lot_id');
    }
        public function sendMailToAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z\s]*$/',
            'email' => 'required|email',
            'usermobile' => 'required|digits:10',
        ]);
        $home_id = ($request->session()->has('home_id'))?($request->session()->get('home_id')):1;

        $community_slug =($request->session()->has('community_slug'))?$request->session()->get('community_slug'):'big-fork-landing';
        
        $community = Communities::where('slug',$community_slug)->first();
        $home_title = Homes::where('id',$home_id)->get('title')->first();

        $mail_to_admin = '<html>
             <head>
            <title></title>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap" rel="stylesheet">
            <style type="text/css">
               
                body,
                table,
                td,
                a {
                    -webkit-text-size-adjust: 100%;
                    -ms-text-size-adjust: 100%;
                }

                table,
                td {
                    mso-table-lspace: 0pt;
                    mso-table-rspace: 0pt;
                }

                img {
                    -ms-interpolation-mode: bicubic;
                }
                img {
                    border: 0;
                    height: auto;
                    line-height: 100%;
                    outline: none;
                    text-decoration: none;
                }

                table {
                    border-collapse: collapse !important;
                }

                body {
                    height: 100% !important;
                    margin: 0 !important;
                    padding: 0 !important;
                    width: 100% !important;
                }
                a[x-apple-data-detectors] {
                    color: inherit !important;
                    text-decoration: none !important;
                    font-size: inherit !important;
                    font-family: inherit !important;
                    font-weight: inherit !important;
                    line-height: inherit !important;
                }

                @media screen and (max-width:600px) {
                    h1 {
                        font-size: 32px !important;
                        line-height: 32px !important;
                    }
                }
                div[style*="margin: 16px 0;"] {
                    margin: 0 !important;
                }
            </style>
        </head>

        <body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr> 
                    <td bgcolor="#1953D8 " align="center" style="padding: 0px 10px 0px 10px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                            <tr>
                                <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 0 0 0; border-radius: 4px 4px 0px 0px; color: #111111; font-family: "Montserrat", sans-serif; font-size: 44px; font-weight: 400; letter-spacing: 4px; line-height: 44px;">
                                    <h1 style="font-size: 44px; font-weight: 400; margin: 2;"><img src="http://xhomes-premium.biorev.studio/images/logo2.png" width="225" height="220" style="display: block; border: 0px;" />
                                    </h1>                        </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
                <tr>
                    <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                            <tr>
                                <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; color: #666666; font-family: "Montserrat", sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                    
                                </td>
                            </tr>
                            
                       
                            <tr>
                                <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 20px 30px; color: #666666; font-family: "Montserrat", sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                    <h3 style="margin: 0; text-align: left;">Hi!<br><br></h3>
                                    <p style="margin: 0;">I am interested in below:.</p><br>
                                    <p style="margin: 0;">Community: '.$community->name.'</p><br>
                                    <p style="margin: 0;">Home: '.$home_title->title.'</p><br><br><br><br>

                                    <h3 style="margin: 0; text-align: left;">User Details!<br><br></h3>
                                    <p style="margin: 0;">Name: '.$request->name.'</p><br>
                                    <p style="margin: 0;">Email: '.$request->email.'</p><br>
                                    <p style="margin: 0;">Contact No: '.$request->usermobile.'</p>
                                    <p style="margin: 0;">Contact No: '.$request->userMessage.'</p><br><br><br>

                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: "Montserrat", sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                    <p style="margin: 0;">Cheers,<br>XSeries Team</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px; margin-bottom:50px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                            <tr>
                                <td bgcolor="#FFECD1" align="center" style="padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: "Montserrat", sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                    <p style="margin: 0; font-size: 12px;"><a href="#" target="_blank" style="color: sky#1953D8 ;">Biorev</a></p>
                                    <h2 style="font-size: 12px; font-weight: 400; color: #111111; margin: 0;">Copyright 2020 | All Rights Reserved</h2>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
               
            </table>
        </body>
        </html>
        <script rel="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script rel="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script rel="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"></script>';

        $mail_to_user ='
        <html>
             <head>
            <title></title>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta http-equiv="X-UA-Compatible" content="IE=edge" />
            <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap" rel="stylesheet">
            <style type="text/css">
               
                body,
                table,
                td,
                a {
                    -webkit-text-size-adjust: 100%;
                    -ms-text-size-adjust: 100%;
                }

                table,
                td {
                    mso-table-lspace: 0pt;
                    mso-table-rspace: 0pt;
                }

                img {
                    -ms-interpolation-mode: bicubic;
                }
                img {
                    border: 0;
                    height: auto;
                    line-height: 100%;
                    outline: none;
                    text-decoration: none;
                }

                table {
                    border-collapse: collapse !important;
                }

                body {
                    height: 100% !important;
                    margin: 0 !important;
                    padding: 0 !important;
                    width: 100% !important;
                }
                a[x-apple-data-detectors] {
                    color: inherit !important;
                    text-decoration: none !important;
                    font-size: inherit !important;
                    font-family: inherit !important;
                    font-weight: inherit !important;
                    line-height: inherit !important;
                }

                @media screen and (max-width:600px) {
                    h1 {
                        font-size: 32px !important;
                        line-height: 32px !important;
                    }
                }
                div[style*="margin: 16px 0;"] {
                    margin: 0 !important;
                }
            </style>
        </head>

        <body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
            
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
             
                <tr>
                    <td bgcolor="#1953D8 " align="center"><p class="text-center" style="color:white;">Welcome XSeries 360 | <a style="color:white;" href="#">View in browser</a></p>
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                            <tr>
                                <td align="center" valign="top" style="padding: 40px 10px 0 10px;"> </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr> 
                    <td bgcolor="#1953D8 " align="center" style="padding: 0px 10px 0px 10px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                            <tr>
                                <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 0 0 0; border-radius: 4px 4px 0px 0px; color: #111111; font-family: "Montserrat", sans-serif; font-size: 44px; font-weight: 400; letter-spacing: 4px; line-height: 44px;">
                                    <h1 style="font-size: 44px; font-weight: 400; margin: 2;"><img src="http://xhomes-premium.biorev.studio/images/logo2.png" width="225" height="220" style="display: block; border: 0px;" />
                                    </h1>                        </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                
                <tr>
                    <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                            <tr>
                                <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; color: #666666; font-family: "Montserrat", sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                    
                                </td>
                            </tr>
                            
                       
                            <tr>
                                <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 20px 30px; color: #666666; font-family: "Montserrat", sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                    <h3 style="margin: 0; text-align: left;">Hi!<br><br></h3>
                                    <p style="margin: 0;">Thank you for contacting us.</p><br>
                                    <p style="margin: 0;">We will reply to your message as soon as we can.We will get in touch with you and will get back to you within some time.<br>If you have any questions,please feel free to reply this email.</p>
                                </td>
                            </tr>
                            <tr>
                                <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: "Montserrat", sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                    <p style="margin: 0;">Cheers,<br>XSeries Team</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px; margin-bottom:50px;">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                            <tr>
                                <td bgcolor="#FFECD1" align="center" style="padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: "Montserrat", sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                                    <p style="margin: 0; font-size: 12px;"><a href="#" target="_blank" style="color: sky#1953D8 ;">Biorev</a></p>
                                    <h2 style="font-size: 12px; font-weight: 400; color: #111111; margin: 0;">Copyright 2020 | All Rights Reserved</h2>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
               
            </table>
        </body>
        </html>
        <script rel="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script rel="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script rel="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"></script>
';
    // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
        $headers .= 'From: <gulshan@biorev.studio>' . "\r\n";

        // Always set content-type when sending HTML email
        $headers_admin = "MIME-Version: 1.0" . "\r\n";
        $headers_admin .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
        $headers_admin .= 'From: <gulshan@biorev.studio>' . "\r\n";
        $setting = Settings::where('status', 1)->where('name','contact_email')->get()->first();
     
        mail($request->email,"Xseries360",$mail_to_user,$headers);
         //$setting->value
        mail($setting->value,"Xseries Contact Request",$mail_to_admin,$headers_admin);
        return ["success"];
    }
}
