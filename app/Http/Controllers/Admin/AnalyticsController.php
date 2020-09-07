<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Communities;
use App\Models\CommunityAnalytics;
use App\Models\ElevationAnalytics;
use App\Models\ElevationTypeAnalytics;
use App\Models\ColorSchemeAnalytics;
use App\Models\SessionAnalytics;
use App\Models\Lots;
use App\Models\Features;
use App\Models\Homes;
use App\Admins;
use App\Models\AdminRoles;
use App\Models\ColorSchemes;
use App\Models\ColorSchemeUpgradeAnalytics;
use App\Models\ColorSchemeUpgrade;
use App\Models\HomeFeatures;
use App\Models\LotAnalytics;
use Illuminate\Support\Facades\Auth;

class AnalyticsController extends Controller
{
    public $data;

    public function __construct()
    {
        $this->data['page_title'] = 'Analytics';
        $this->data['menu'] = 'analytics';
    }

    public function index()
    {
        return view('admin.analytics')->with($this->data);
    }
    public function analytics(Request $request)
    {
        //dd($request);
        $list_data = '';
        $array = [];
        $condition = [];
        $array['pie_chart_data'] = array();
        $array['lot_list_data'] = array();
        $array['title'] = array();
        // $date = isset($request->date)?$request->date:date('Y-m-d','-1d');
        
        if($request->country_name){
            $condition['country'] = $request->country_name;
            //$analytics = XplatAnalytics::where('community_id',$request->id)->get();
        }
        if($request->state_name){
            $condition['state'] = $request->state_name;
        }

        if($request->city_name){
            $condition['city'] = $request->city_name;
        }
        if($request->community_id)
        {
        	$condition['community_id'] = $request->community_id;
        }

         if($request->home_id)
        {
            $condition['home_id'] = $request->home_id;
        }
       
       
        switch ($request->type) {
        	case 'community':
        		# code...
            if(Auth::user()->admin_role_id == 4):
                $manager_c_ids = Admins::whereId(Auth::user()->id)->get('community_ids')->first();
                $manager_c_ids = array_map('intval', explode(',',$manager_c_ids->community_ids));
                $communities = CommunityAnalytics::where($condition)->whereIn('community_id', $manager_c_ids)->whereBetween(\DB::raw('DATE(created_at)'),[$request->start_date,$request->end_date]); 
            else:
                $communities = CommunityAnalytics::where($condition)->whereBetween(\DB::raw('DATE(created_at)'),[$request->start_date,$request->end_date]); 
            endif;
           $analytics 		= $communities->get();
           $total_session	= $communities->count();
           $com_loop_ids  	= [];

           foreach($analytics as $k => $analytic){
                
                $com = Communities::where('id',$analytic->community_id)->get('name')->first();
                if(!in_array($analytic->community_id, $com_loop_ids))
                {
                	array_push($com_loop_ids,$analytic->community_id);	
    
    			$com_session = CommunityAnalytics::where($condition)->where('community_id',$analytic->community_id)->whereBetween(\DB::raw('DATE(created_at)'),[$request->start_date,$request->end_date])->count();
                if($com_session):
    
                    $popularity = self::get_percentage($total_session,$com_session);
                    $list_data .= '<tr><td>'.$com->name.'</td>
                        <td>'.$com_session.'</td>
                        <td>'.$total_session.'</td>
                        <td>'.round($popularity).'%</td>
                        </tr>'; 
                
                        $p = array(
                            "name" => $com->name,
                            "y"    => round($popularity),
                        );
                        array_push($array['pie_chart_data'],$p);
                endif;
    
                }
        }
        array_push($array['lot_list_data'],$list_data);
        array_push($array['title'], 'Community Analytics');
        break;

        case 'lot':
            # code...

        $elevation = LotAnalytics::where($condition)->whereBetween(\DB::raw('DATE(created_at)'),[$request->start_date,$request->end_date]); 

        $analytics       = $elevation->get();

        $total_session   = $elevation->count();
        $ele_loop_ids    = [];

            foreach($analytics as $k => $analytic){
                
                $ele = Lots::where('id',$analytic->lot_id)->get('alias')->first();
                if(!in_array($analytic->lot_id, $ele_loop_ids))
                {
                    array_push($ele_loop_ids,$analytic->lot_id);   

                $ele_session = LotAnalytics::where($condition)->where('lot_id',$analytic->lot_id)->whereBetween(\DB::raw('DATE(created_at)'),[$request->start_date,$request->end_date])->count();
                if($ele_session):

                    $popularity = self::get_percentage($total_session,$ele_session);
                    $list_data .= '<tr><td>'.$ele->alias.'</td>
                        <td>'.$ele_session.'</td>
                        <td>'.$total_session.'</td>
                        <td>'.round($popularity).'%</td>
                        </tr>'; 
                
                        $p = array(
                            "name" => $ele->alias,
                            "y"    => round($popularity),
                        );
                        array_push($array['pie_chart_data'],$p);
                endif;

                }
            }
            array_push($array['lot_list_data'],$list_data);
            array_push($array['title'], 'Lot Analytics');    
            
        break;                 
        	
        case 'elevation':
        		# code...

            if(Auth::user()->admin_role_id == 4):
                $manager_c_ids = Admins::whereId(Auth::user()->id)->get('community_ids')->first();
                $manager_c_ids = array_map('intval', explode(',',$manager_c_ids->community_ids));
                $elevation = ElevationAnalytics::where($condition)->whereIn('community_id', $manager_c_ids)->whereBetween(\DB::raw('DATE(created_at)'),[$request->start_date,$request->end_date]); 
            else:
                $elevation = ElevationAnalytics::where($condition)->whereBetween(\DB::raw('DATE(created_at)'),[$request->start_date,$request->end_date]); 
            endif; 
    
       $analytics 		= $elevation->get();

       $total_session	= $elevation->count();
       $ele_loop_ids  	= [];

        foreach($analytics as $k => $analytic){
            
            $ele = Homes::where('id',$analytic->home_id)->get('title')->first();
            if(!in_array($analytic->home_id, $ele_loop_ids))
            {
            	array_push($ele_loop_ids,$analytic->home_id);	
            if(Auth::user()->admin_role_id == 4):
                $manager_c_ids = Admins::whereId(Auth::user()->id)->get('community_ids')->first();
                $manager_c_ids = array_map('intval', explode(',',$manager_c_ids->community_ids));
                $ele_session = ElevationAnalytics::where($condition)->whereIn('community_id', $manager_c_ids)->where('home_id',$analytic->home_id)->whereBetween(\DB::raw('DATE(created_at)'),[$request->start_date,$request->end_date])->count();
            else:
                $ele_session = ElevationAnalytics::where($condition)->where('home_id',$analytic->home_id)->whereBetween(\DB::raw('DATE(created_at)'),[$request->start_date,$request->end_date])->count();
            endif;    
			
            if($ele_session):

                $popularity = self::get_percentage($total_session,$ele_session);
                $list_data .= '<tr><td>'.$ele->title.'</td>
                    <td>'.$ele_session.'</td>
                    <td>'.$total_session.'</td>
                    <td>'.round($popularity).'%</td>
                    </tr>'; 
            
                    $p = array(
                        "name" => $ele->title,
                        "y"    => round($popularity),
                    );
                    array_push($array['pie_chart_data'],$p);
            endif;

            }
        }
        array_push($array['lot_list_data'],$list_data);
        array_push($array['title'], 'Elevation Analytics');
        		break;	
         case 'elevation-type':
                # code...
                
      if(Auth::user()->admin_role_id == 4):
                $manager_c_ids = Admins::whereId(Auth::user()->id)->get('community_ids')->first();
                $manager_c_ids = array_map('intval', explode(',',$manager_c_ids->community_ids));
                $elevation = ElevationTypeAnalytics::where($condition)->whereIn('community_id', $manager_c_ids)
                ->whereBetween(\DB::raw('DATE(created_at)'),[$request->start_date,$request->end_date]); 
            else:
                $elevation = ElevationTypeAnalytics::where($condition)->whereBetween(\DB::raw('DATE(created_at)'),[$request->start_date,$request->end_date]); 
            endif;
    
       $analytics       = $elevation->get();

       $total_session   = $elevation->count();
       $ele_loop_ids    = [];

        foreach($analytics as $k => $analytic){
            
            $ele = Homes::where('id',$analytic->elevation_type_id)->get('title')->first();
            if(!in_array($analytic->elevation_type_id, $ele_loop_ids))
            {
                array_push($ele_loop_ids,$analytic->elevation_type_id);   
            if(Auth::user()->admin_role_id == 4):
                $manager_c_ids = Admins::whereId(Auth::user()->id)->get('community_ids')->first();
                $manager_c_ids = array_map('intval', explode(',',$manager_c_ids->community_ids));
                $ele_session = ElevationTypeAnalytics::where($condition)->whereIn('community_id', $manager_c_ids)->where('elevation_type_id',$analytic->elevation_type_id)->whereBetween(\DB::raw('DATE(created_at)'),[$request->start_date,$request->end_date])->count();
            else:
             $ele_session = ElevationTypeAnalytics::where($condition)->where('elevation_type_id',$analytic->elevation_type_id)->whereBetween(\DB::raw('DATE(created_at)'),[$request->start_date,$request->end_date])->count();
            endif;    
            if($ele_session):

                $popularity = self::get_percentage($total_session,$ele_session);
                $list_data .= '<tr><td>'.$ele->title.'</td>
                    <td>'.$ele_session.'</td>
                    <td>'.$total_session.'</td>
                    <td>'.round($popularity).'%</td>
                    </tr>'; 
            
                    $p = array(
                        "name" => $ele->title,
                        "y"    => round($popularity),
                    );
                    array_push($array['pie_chart_data'],$p);
            endif;

            }
        }
        array_push($array['lot_list_data'],$list_data);
        array_push($array['title'], 'Elevation Type Analytics');

                break;  

          case 'color-scheme':
                     # code...
        if(Auth::user()->admin_role_id == 4):
                $manager_c_ids = Admins::whereId(Auth::user()->id)->get('community_ids')->first();
                $manager_c_ids = array_map('intval', explode(',',$manager_c_ids->community_ids));
                $analytics     = ColorSchemeAnalytics::where($condition)->whereIn('community_id',$manager_c_ids)
                ->whereBetween(\DB::raw('DATE(created_at)'),[$request->start_date,$request->end_date])->get();
            else:   
                $analytics = ColorSchemeAnalytics::where($condition)->whereBetween(\DB::raw('DATE(created_at)'),[$request->start_date,$request->end_date])->get();
            endif;    
        $ele_loop_ids    = [];

        if(!isset($request->elevation_type_id))
        {
         if(Auth::user()->admin_role_id == 4):
                $manager_c_ids = Admins::whereId(Auth::user()->id)->get('community_ids')->first();
                $manager_c_ids = array_map('intval', explode(',',$manager_c_ids->community_ids));
                $total_session = ElevationAnalytics::where($condition)->whereIn('community_id',$manager_c_ids)->whereBetween(\DB::raw('DATE(created_at)'),[$request->start_date,$request->end_date])->count();
         else:
             $total_session = ElevationAnalytics::where($condition)->whereBetween(\DB::raw('DATE(created_at)'),[$request->start_date,$request->end_date])->count();
        endif;     
        
        foreach($analytics as $k => $analytic){
            
            $ele = ColorSchemes::where('id',$analytic->color_scheme_id)->get('title')->first();
            $type_name = Homes::where('id',$analytic->home_id)->get(['title','parent_id','id'])->first();
            if($type_name->parent_id==0):
                $ele_name  = Homes::where('id',$type_name->id)->get('title')->first();
            else:
                $ele_name  = Homes::where('id',$type_name->parent_id)->get('title')->first();
            endif;       
            if(!in_array($analytic->color_scheme_id, $ele_loop_ids))
            {
            array_push($ele_loop_ids,$analytic->color_scheme_id);   
            if(Auth::user()->admin_role_id == 4):
                $manager_c_ids = Admins::whereId(Auth::user()->id)->get('community_ids')->first();
                $manager_c_ids = array_map('intval', explode(',',$manager_c_ids->community_ids));
                $ele_session = ColorSchemeAnalytics::where($condition)->whereIn('community_id',$manager_c_ids)->where('color_scheme_id',$analytic->color_scheme_id)->whereBetween(\DB::raw('DATE(created_at)'),[$request->start_date,$request->end_date])->count();
            else:
                $ele_session = ColorSchemeAnalytics::where($condition)->where('color_scheme_id',$analytic->color_scheme_id)->whereBetween(\DB::raw('DATE(created_at)'),[$request->start_date,$request->end_date])->count();
            endif;    
            
            if($ele_session):
                $name = $ele->title." (".$type_name->title."-".$ele_name->title.")";    
                $popularity = self::get_percentage($total_session,$ele_session);
                $list_data .= '<tr><td>'.$name.'</td>
                    <td>'.$ele_session.'</td>
                    <td>'.$total_session.'</td>
                    <td>'.round($popularity).'%</td>
                    </tr>'; 
            
                    $p = array(
                        "name" => $name,
                        "y"    => round($popularity),
                    );
                    array_push($array['pie_chart_data'],$p);
                    
            endif;

            }
        }
        array_push($array['lot_list_data'],$list_data);
        array_push($array['title'], 'Color Scheme Analytics');
        }
    else
    {
        if(Auth::user()->admin_role_id == 4):
            $manager_c_ids = Admins::whereId(Auth::user()->id)->get('community_ids')->first();
            $manager_c_ids = array_map('intval', explode(',',$manager_c_ids->community_ids));
            $total_session = ElevationTypeAnalytics::where($condition)->whereIn('community_id',$manager_c_ids)
            ->where('elevation_type_id',$request->elevation_type_id)->whereBetween(\DB::raw('DATE(created_at)'),[$request->start_date,$request->end_date])->count();
        else:
            $total_session = ElevationTypeAnalytics::where($condition)->where('elevation_type_id',$request->elevation_type_id)->whereBetween(\DB::raw('DATE(created_at)'),[$request->start_date,$request->end_date])->count();
        endif;
           if($request->color_scheme_id)
        {
            $condition['color_scheme_id'] = $request->color_scheme_id;
        }
        $condition['home_id'] = $request->elevation_type_id;
        foreach($analytics as $k => $analytic){
            
            $ele = ColorSchemes::where('id',$analytic->color_scheme_id)->get('title')->first();
            if(!in_array($analytic->color_scheme_id, $ele_loop_ids))
            {
                array_push($ele_loop_ids,$analytic->color_scheme_id);   

            if(Auth::user()->admin_role_id == 4):
                $manager_c_ids = Admins::whereId(Auth::user()->id)->get('community_ids')->first();
                $manager_c_ids = array_map('intval', explode(',',$manager_c_ids->community_ids));
                $ele_session = ColorSchemeAnalytics::where($condition)->whereIn('community_id',$manager_c_ids)->where('color_scheme_id',$analytic->color_scheme_id)->whereBetween(\DB::raw('DATE(created_at)'),[$request->start_date,$request->end_date])->count();
            else:
                $ele_session = ColorSchemeAnalytics::where($condition)->where('color_scheme_id',$analytic->color_scheme_id)->whereBetween(\DB::raw('DATE(created_at)'),[$request->start_date,$request->end_date])->count();
            endif; 
            if($ele_session):
                $popularity = self::get_percentage($total_session,$ele_session);
                $list_data .= '<tr><td>'.$ele->title.'</td>
                    <td>'.$ele_session.'</td>
                    <td>'.$total_session.'</td>
                    <td>'.round($popularity).'%</td>
                    </tr>'; 
            
                    $p = array(
                        "name" => $ele->title,
                        "y"    => round($popularity),
                    );
                    array_push($array['pie_chart_data'],$p);
                    
            endif;

            }
        }
        array_push($array['lot_list_data'],$list_data);
        array_push($array['title'], 'Color Scheme Analytics');
        
    }
        break; 

        case 'upgrade':
             # code...
      if(Auth::user()->admin_role_id == 4):
            $manager_c_ids = Admins::whereId(Auth::user()->id)->get('community_ids')->first();
            $manager_c_ids = array_map('intval', explode(',',$manager_c_ids->community_ids));
            $analytics     = ColorSchemeUpgradeAnalytics::where($condition)->whereIn('community_id',$manager_c_ids)
            ->whereBetween(\DB::raw('DATE(created_at)'),[$request->start_date,$request->end_date])->get(); 
        else:
            $analytics = ColorSchemeUpgradeAnalytics::where($condition)->whereBetween(\DB::raw('DATE(created_at)'),[$request->start_date,$request->end_date])->get(); 
        endif; 
       $ele_loop_ids    = [];
        if(!isset($request->elevation_type_id))
        {
            if(Auth::user()->admin_role_id == 4):
                $manager_c_ids = Admins::whereId(Auth::user()->id)->get('community_ids')->first();
                $manager_c_ids = array_map('intval', explode(',',$manager_c_ids->community_ids));
                $total_session   = ElevationTypeAnalytics::where($condition)->whereIn('community_id',$manager_c_ids)->whereBetween(\DB::raw('DATE(created_at)'),[$request->start_date,$request->end_date])->count();
            else:
                $total_session   = ElevationTypeAnalytics::where($condition)->whereBetween(\DB::raw('DATE(created_at)'),[$request->start_date,$request->end_date])->count();
            endif;    
           
            foreach($analytics as $k => $analytic){
            
            $ele = HomeFeatures::where('id',$analytic->home_feature_id)->get('title')->first();
            if(!in_array(strtolower($ele->title), $ele_loop_ids))
            {
                array_push($ele_loop_ids,strtolower($ele->title));   
             if(Auth::user()->admin_role_id == 4):
                $manager_c_ids = Admins::whereId(Auth::user()->id)->get('community_ids')->first();
                $manager_c_ids = array_map('intval', explode(',',$manager_c_ids->community_ids));
                 $ele_session = ColorSchemeUpgradeAnalytics::where($condition)->whereIn('community_id',$manager_c_ids)->where('feature_name',$analytic->feature_name)->whereBetween(\DB::raw('DATE(created_at)'),[$request->start_date,$request->end_date])->count();
             else:
                  $ele_session = ColorSchemeUpgradeAnalytics::where($condition)->where('feature_name',$analytic->feature_name)->whereBetween(\DB::raw('DATE(created_at)'),[$request->start_date,$request->end_date])->count();
             endif;     
           
            if($ele_session):

                $popularity = self::get_percentage($total_session,$ele_session);
                $list_data .= '<tr><td>'.$ele->title.'</td>
                    <td>'.$ele_session.'</td>
                    <td>'.$total_session.'</td>
                    <td>'.round($popularity).'%</td>
                    </tr>'; 
            
                    $p = array(
                        "name" => $ele->title,
                        "y"    => round($popularity),
                    );
                    array_push($array['pie_chart_data'],$p);
            endif;

            }
        }
        array_push($array['lot_list_data'],$list_data);
        array_push($array['title'], 'Color Scheme Upgrade Analytics');
        }
        else
        {
        if(Auth::user()->admin_role_id == 4):
                    $manager_c_ids = Admins::whereId(Auth::user()->id)->get('community_ids')->first();
                    $manager_c_ids = array_map('intval', explode(',',$manager_c_ids->community_ids));
                    $total_session = ElevationTypeAnalytics::where($condition)->whereIn('community_id',$manager_c_ids)
                    ->where('elevation_type_id',$request->elevation_type_id)->whereBetween(\DB::raw('DATE(created_at)'),[$request->start_date,$request->end_date])->count();
                else:
                    $total_session = ElevationTypeAnalytics::where($condition)->where('elevation_type_id',$request->elevation_type_id)->whereBetween(\DB::raw('DATE(created_at)'),[$request->start_date,$request->end_date])->count();
                endif;    
         
         if($request->color_scheme_id)
        {
            
            $condition['color_scheme_id'] = $request->color_scheme_id;
            $condition['home_id'] = $request->elevation_type_id;
              if(Auth::user()->admin_role_id == 4):
                        $manager_c_ids = Admins::whereId(Auth::user()->id)->get('community_ids')->first();
                        $manager_c_ids = array_map('intval', explode(',',$manager_c_ids->community_ids));
                        $total_session = ColorSchemeAnalytics::where($condition)->whereIn('community_id',$manager_c_ids)
                        ->whereBetween(\DB::raw('DATE(created_at)'),[$request->start_date,$request->end_date])->count();    
                    else:
                        $total_session = ColorSchemeAnalytics::where($condition)->whereBetween(\DB::raw('DATE(created_at)'),[$request->start_date,$request->end_date])->count();    
                    endif;    
        }
        $condition['home_id'] = $request->elevation_type_id;
          foreach($analytics as $k => $analytic){
            
            $ele = HomeFeatures::where('id',$analytic->home_feature_id)->get('title')->first();
            if(!in_array(strtolower($ele->title), $ele_loop_ids))
            {
                array_push($ele_loop_ids,strtolower($ele->title));   
             if(Auth::user()->admin_role_id == 4):
                 $manager_c_ids = Admins::whereId(Auth::user()->id)->get('community_ids')->first();
                 $manager_c_ids = array_map('intval', explode(',',$manager_c_ids->community_ids));
                  $ele_session = ColorSchemeUpgradeAnalytics::where($condition)->whereIn('community_id',$manager_c_ids)->where('feature_name',$analytic->feature_name)->whereBetween(\DB::raw('DATE(created_at)'),[$request->start_date,$request->end_date])->count();
              else:
                   $ele_session = ColorSchemeUpgradeAnalytics::where($condition)->where('feature_name',$analytic->feature_name)->whereBetween(\DB::raw('DATE(created_at)'),[$request->start_date,$request->end_date])->count();
              endif;      
            
           
            if($ele_session):

                $popularity = self::get_percentage($total_session,$ele_session);
                $list_data .= '<tr><td>'.$ele->title.'</td>
                    <td>'.$ele_session.'</td>
                    <td>'.$total_session.'</td>
                    <td>'.round($popularity).'%</td>
                    </tr>'; 
            
                    $p = array(
                        "name" => $ele->title,
                        "y"    => round($popularity),
                    );
                    array_push($array['pie_chart_data'],$p);
            endif;

            }
        }
        array_push($array['lot_list_data'],$list_data);
        array_push($array['title'], 'Color Scheme Upgrade Analytics');
        }
        break;                   
        case 'feature':
            # code...
            $f_conditions = [];
            if($request->home_id)
            {
                $f_conditions['home_id'] =  $request->home_id;
            }
            if($request->floor_id)
            {
                $f_conditions['floor_id'] = $request->floor_id;
            }
            if(Auth::user()->admin_role_id == 4):
                $manager_c_ids = Admins::whereId(Auth::user()->id)->get('community_ids')->first();
                $manager_c_ids = array_map('intval', explode(',',$manager_c_ids->community_ids));
                $analytics =  SessionAnalytics::where($f_conditions)->whereIn('community_id', $manager_c_ids)->whereBetween(\DB::raw('DATE(created_at)'),[$request->start_date,$request->end_date])->get();
            else:
                $analytics =  SessionAnalytics::where($f_conditions)->whereBetween(\DB::raw('DATE(created_at)'),[$request->start_date,$request->end_date])->get();

            endif;    
                    $home_loop_ids    = array();
            $floor_loop_ids   = array();
            $feature_loop_ids = array();
            if(Auth::user()->admin_role_id == 4):
                $manager_c_ids = Admins::whereId(Auth::user()->id)->get('community_ids')->first();
                $manager_c_ids = array_map('intval', explode(',',$manager_c_ids->community_ids));
                $total_session = ElevationAnalytics::where($condition)->whereIn('community_id', $manager_c_ids)->count();
            else:
                $total_session = ElevationAnalytics::where($condition)->count();
            endif;    


            $feature_loop_two_ids = array();
            if($request->floor_id)
            {
                $condition['floor_id'] = $request->floor_id;
            }
            foreach($analytics as $k => $analytic){
                if(!in_array($analytic->feature_name, $feature_loop_two_ids) ){

                array_push($feature_loop_two_ids, $analytic->feature_name);
                $feature = Features::where('id',$analytic->feature_id)->get('title')->first();
                // $condition['lot_id'] = $analytic->lot_id;
                if(Auth::user()->admin_role_id == 4):
                    $manager_c_ids = Admins::whereId(Auth::user()->id)->get('community_ids')->first();
                    $manager_c_ids = array_map('intval', explode(',',$manager_c_ids->community_ids));
                    $success = SessionAnalytics::where($condition)->whereIn('community_id', $manager_c_ids)->where([
                    'feature_name'    => $analytic->feature_name
                ])->where('status', 'success')->count();
                else:
                $success = SessionAnalytics::where($condition)->where([
                    'feature_name'    => $analytic->feature_name
                ])->where('status', 'success')->count();
                endif;    

                if($success):
                //$total_session = $analytic->active+$analytic->succeed+$analytic->dropped;
                    $popularity = self::get_percentage($total_session,$success);
                    
                    $list_data .= '<tr><td>'.$feature->title.'</td>
                        <td>'.$success.'</td>
                        <td>'.$total_session.'</td>
                        <td>'.round($popularity).'%</td>
                        </tr>'; 
                
                        $p = array(
                            "name" => $feature->title,
                            "y"    => round($popularity),
                        );
                        array_push($array['pie_chart_data'],$p);
                endif;

                }

            }
            array_push($array['lot_list_data'],$list_data);
            array_push($array['title'], 'Option List Analytics');

            break;   
        default:
        		# code...
        		break;
        }
      
        return ($array);
    }
    public function get_percentage($total,$to)
    {
        $ratio = $to / $total;
	    return  number_format( $ratio * 100, 2 );
    }
    public function getCountriesExistsInAnalyticsTable()
    {
        # code...
        $countries = CommunityAnalytics::get("country")->unique("country");
        return($countries);
    }
    public function getStatesExistsInAnalyticsTable($country_name)
    {
        # code...
        $states = CommunityAnalytics::where('country',$country_name)->get("state")->unique("state");
        return($states);
    }
    public function getCitiesExistsInAnalyticsTable($state_name)
    {
        # code...
        $cities = CommunityAnalytics::where('state',$state_name)->get('city')->unique("city");
        return($cities);
    }
    public function getCommunitiesExistsInAnalyticsTable()
    {
        # code...
         $communities = [];
        if(Auth::user()->admin_role_id == 4):
            $manager_c_ids = Admins::whereId(Auth::user()->id)->get('community_ids')->first();
            $manager_c_ids = array_map('intval', explode(',',$manager_c_ids->community_ids));
            $communities = ElevationAnalytics::whereIn('community_id', $manager_c_ids)
            ->with("community")->get()->unique("community_id");
        else:
            $communities = ElevationAnalytics::with("community")->get()->unique("community_id");
        endif;
        return($communities);
    }
    public function getCommunitiesExistsInLotAnalyticsTable()
    {
        # code...
        $communities = [];
        if(Auth::user()->admin_role_id == 4):
            $manager_c_ids = Admins::whereId(Auth::user()->id)->get('community_ids')->first();
            $manager_c_ids = array_map('intval', explode(',',$manager_c_ids->community_ids));
            $communities = LotAnalytics::whereIn('community_id', $manager_c_ids)
            ->with("community")->get()->unique("community_id");
        else:
            $communities = LotAnalytics::with("community")->get()->unique("community_id");
        endif;
        return($communities);
    }
      public function getCommunitiesExistsInElevationTypeAnalyticsTable()
    {
        # code...
         $communities = [];
        if(Auth::user()->admin_role_id == 4):
            $manager_c_ids = Admins::whereId(Auth::user()->id)->get('community_ids')->first();
            $manager_c_ids = array_map('intval', explode(',',$manager_c_ids->community_ids));
            $communities = ElevationTypeAnalytics::whereIn('community_id', $manager_c_ids)
            ->with("community")->get()->unique("community_id");
        else:
            $communities = ElevationTypeAnalytics::with("community")->get()->unique("community_id");
        endif;
        return($communities);
    }
       public function getCommunitiesExistsInColorSchemeAnalyticsTable()
    {
        # code...
        if(Auth::user()->admin_role_id == 4):
            $manager_c_ids = Admins::whereId(Auth::user()->id)->get('community_ids')->first();
            $manager_c_ids = array_map('intval', explode(',',$manager_c_ids->community_ids));
            $communities = ColorSchemeAnalytics::whereIn('community_id', $manager_c_ids)
            ->with("community")->get()->unique("community_id");
        else:
            $communities = ColorSchemeAnalytics::with("community")->get()->unique("community_id");
        endif;
        return($communities);
    }
          public function getCommunitiesExistsInColorSchemeUpgradeAnalyticsTable()
    {
        # code...
        if(Auth::user()->admin_role_id == 4):
            $manager_c_ids = Admins::whereId(Auth::user()->id)->get('community_ids')->first();
            $manager_c_ids = array_map('intval', explode(',',$manager_c_ids->community_ids));
            $communities = ColorSchemeUpgradeAnalytics::whereIn('community_id', $manager_c_ids)
            ->with("community")->get()->unique("community_id");
        else:
            $communities = ColorSchemeUpgradeAnalytics::with("community")->get()->unique("community_id");
        endif;
        return($communities);
    }
      public function getElevationExistsInElevationTypeAnalyticsTable(Request $request)
    {
        # code...
        if($request->community_id):
            return ElevationTypeAnalytics::where('community_id',$request->community_id)->with("home")->get()->unique("home_id");
        else:
            if(Auth::user()->admin_role_id == 4):
                $manager_c_ids = Admins::whereId(Auth::user()->id)->get('community_ids')->first();
                $manager_c_ids = array_map('intval', explode(',',$manager_c_ids->community_ids));
                $elevations = ElevationTypeAnalytics::whereIn('community_id', $manager_c_ids)->with("home")->get()->unique("home_id");
                return $elevations;
            else: 
                return ElevationTypeAnalytics::with("home")->get()->unique("home_id");
            endif;
        endif;
    }
    
    
      public function getElevationTypeExistsInColorSchemeAnalyticsTable(Request $request)
    {
        # code...
        $data  = array();
        $data['home'] = array();
        $data['title'] = array();
        if($request->community_id){
            $data['home'] = $elevation = ColorSchemeAnalytics::where('community_id',$request->community_id)->with("home")->get()->unique("home_id");
        }
        else{
            if(Auth::user()->admin_role_id == 4):
                $manager_c_ids = Admins::whereId(Auth::user()->id)->get('community_ids')->first();
                $manager_c_ids = array_map('intval', explode(',',$manager_c_ids->community_ids));
                $data['home'] = $elevation = ColorSchemeAnalytics::whereIn('community_id', $manager_c_ids)
                ->with("home")->get()->unique("home_id");
            else:
                $data['home'] = $elevation = ColorSchemeAnalytics::with("home")->get()->unique("home_id");
            endif;
        }
        foreach ($elevation as $key => $ele) {
            if($ele->home->parent_id==0):
                $title = Homes::where('id',$ele->home->id)->get('title')->first();
                array_push($data['title'], $title->title);
            else:
                $title = Homes::where('id',$ele->home->parent_id)->get('title')->first();
                array_push($data['title'], $title->title);
            endif;    
        }
        return($data);
    }

       public function getElevationTypeExistsInColorSchemeUpgradeAnalyticsTable(Request $request)
    {
        # code...
        $data  = array();
        $data['home'] = array();
        $data['title'] = array();
        if($request->community_id)
            $data['home'] = $elevation = ColorSchemeUpgradeAnalytics::where('community_id',$request->community_id)->with("home")->get()->unique("home_id");
        else{
            if(Auth::user()->admin_role_id == 4):
                $manager_c_ids = Admins::whereId(Auth::user()->id)->get('community_ids')->first();
                $manager_c_ids = array_map('intval', explode(',',$manager_c_ids->community_ids));
                $data['home'] = $elevation = ColorSchemeUpgradeAnalytics::whereIn('community_id', $manager_c_ids)
                ->with("home")->get()->unique("home_id");
            else:
                $data['home'] = $elevation = ColorSchemeUpgradeAnalytics::with("home")->get()->unique("home_id");
            endif;
        }
        foreach ($elevation as $key => $ele) {
            # code...
            $title = Homes::where('id',$ele->home->parent_id)->get('title')->first();
            array_push($data['title'], $title->title);
        }
        return($data);
    }

    public function getColorSchemeExistsInColorSchemeUpgradeAnalyticsTable($id)
    {
        # code...
        if(Auth::user()->admin_role_id == 4):
            $manager_c_ids = Admins::whereId(Auth::user()->id)->get('community_ids')->first();
            $manager_c_ids = array_map('intval', explode(',',$manager_c_ids->community_ids));
            $colorScheme = ColorSchemeUpgradeAnalytics::with("color_scheme")->whereIn('community_id', $manager_c_ids)
            ->where('home_id',$id)->get()->unique("color_scheme_id");
        else:
            $colorScheme = ColorSchemeUpgradeAnalytics::with("color_scheme")->where('home_id',$id)->get()->unique("color_scheme_id");
        endif;
        return($colorScheme);
    }
    public function getFloorsExistsInAnalyticsTable($id)
    {
        # code...
        $floors = SessionAnalytics::with("floor")->where('home_id',$id)->get()->unique("floor_id");
        return($floors);
    }
    public function getElevationExistsInFeatureAnalyticsTable(Request $request)
    {
        # code...
        if($request->community_id)
        {
           return SessionAnalytics::where('community_id',$request->community_id)->with('home')->get()->unique('home_id');
        }
        if(Auth::user()->admin_role_id == 4):
           $manager_c_ids = Admins::whereId(Auth::user()->id)->get('community_ids')->first();
           $manager_c_ids = array_map('intval', explode(',',$manager_c_ids->community_ids));
           return SessionAnalytics::whereIn('community_id', $manager_c_ids)->with('home')->get()->unique('home_id');
       else:
           return SessionAnalytics::with('home')->get()->unique('home_id');
       endif;    

    }
 
    public function storeAnalytics(Request $request)
    {
        
            if($request->session()->has('color_scheme_id')){
                $com_slug   = $request->session()->get('community_slug');
                $c_id       = Communities::where('slug',$com_slug)->get('id')->first();
                $h_id 		= $request->session()->get('home_id');
                $l_id       = $request->session()->get('lot_id');
                $color_scheme_id = $request->session()->get('color_scheme_id');
                if($request->session()->has('analytic_com_id') && $request->session()->has('analytic_ele_id') && 
                 $request->session()->has('analytic_color_id'))
                {
                    $analytic_com_id = $request->session()->get('analytic_com_id'); 
                    $analytic_ele_id = $request->session()->get('analytic_ele_id'); 
                    $analytic_color_id = $request->session()->get('analytic_color_id');
                    if($request->session->has('home_type_id')){
                        $analytic_ele_type_id = $request->session()->get('analytic_ele_type_id');
                        $type_id = $request->session()->get('home_type_id');
                        if($analytic_com_id == $c_id->id && $analytic_ele_id == $h_id && $analytic_color_id == $color_scheme_id && $analytic_ele_type_id == $type_id )
                        {
                            return ['already counted'];
                        }
                        else{
                            $this->commonAnalyticsEntry($request);
                            ColorSchemeAnalytics::create([
                                'session_id'                => $request->session()->getId(),
                                'home_id'                   => $type_id,
                                'color_scheme_id'           => $color_scheme_id,
                                'community_id'				 => $c_id->id,
                                'ip_address'                => $request['ip'],
                                'country'                   => $request['country'],
                                'state'                     => $request['state'],
                                'city'                      => $request['city'],
                            ]);
                            $request->session()->put('analytic_color_id',$color_scheme_id);
                        }
                    }
                    else{
                        if($analytic_com_id == $c_id->id && $analytic_ele_id == $h_id && $analytic_color_id == $color_scheme_id)
                        {
                            return ['already counted'];
                        }
                        else{
                            $this->commonAnalyticsEntry($request);
                            ColorSchemeAnalytics::create([
                                'session_id'                => $request->session()->getId(),
                                'home_id'                   => $h_id,
                                'color_scheme_id'           => $color_scheme_id,
                                'community_id'				 => $c_id->id,
                                'ip_address'                => $request['ip'],
                                'country'                   => $request['country'],
                                'state'                     => $request['state'],
                                'city'                      => $request['city'],
                            ]);
                            $request->session()->put('analytic_color_id',$color_scheme_id);
                        }
                    }
                    return ['added'];
                }
                else
                {
                    $this->commonAnalyticsEntry($request);
                        ColorSchemeAnalytics::create([
                            'session_id'                => $request->session()->getId(),
                            'home_id'                   => $h_id,
                            'color_scheme_id'           => $color_scheme_id,
                            'community_id'				 => $c_id->id,
                            'ip_address'                => $request['ip'],
                            'country'                   => $request['country'],
                            'state'                     => $request['state'],
                            'city'                      => $request['city'],
                        ]);
                    $request->session()->put('analytic_color_id',$color_scheme_id);
                    return['added'];
            }
               
            }
            elseif($request->session()->has('floor_features')){
                $this->commonAnalyticsEntry($request);
                return ['added'];
            }
            else{
                $this->commonAnalyticsEntry($request);
                return ['added'];
            }

    }
    public function commonAnalyticsEntry($request)
    {
        # code...
        $com_slug   = $request->session()->get('community_slug');
        $c_id       = Communities::where('slug',$com_slug)->get('id')->first();
        $h_id 		= $request->session()->get('home_id');
        $l_id       = $request->session()->get('lot_id');
    
        if($request->session()->has('analytic_com_id') && $request->session()->has('analytic_ele_id') && $request->session()->has('analytic_lot_id'))
        {
            $analytic_com_id = $request->session()->get('analytic_com_id'); 
            $analytic_ele_id = $request->session()->get('analytic_ele_id');
            $analytic_lot_id = $request->session()->get('analytic_lot_id');
            if($request->session()->has('analytic_ele_type_id'))
            {
                $type_id    = $request->session()->get('home_type_id');
                $analytic_ele_type_id = $request->session()->get('analytic_ele_type_id');
                if($analytic_com_id == $c_id->id && $analytic_ele_id == $h_id && $analytic_ele_type_id ==$type_id && $analytic_lot_id==$l_id)
                {
                    return ['already counted'];
                }
                
                else
                {
                     CommunityAnalytics::create([
                         'session_id'       		 => $request->session()->getId(),
                         'community_id'				 => $c_id->id,
                         'ip_address'        		 => $request['ip'],
                         'country'          		 => $request['country'],
                         'state'            		 => $request['state'],
                         'city'             		 => $request['city'],
                     ]);
                    $request->session()->put('analytic_com_id',$c_id->id);
                    LotAnalytics::create([
                        'session_id'                => $request->session()->getId(),
                        'community_id'              => $c_id->id,
                        'lot_id'                    => $l_id,
                        'ip_address'                => $request['ip'],
                        'country'                   => $request['country'],
                        'state'                     => $request['state'],
                        'city'                      => $request['city'],
                    ]);
                    $request->session()->put('analytic_lot_id',$l_id);
                    ElevationAnalytics::create([
                         'session_id'       		 => $request->session()->getId(),
                         'community_id'				 => $c_id->id,
                         'home_id'					 =>	$h_id,
                         'ip_address'        		 => $request['ip'],
                         'country'          		 => $request['country'],
                         'state'            		 => $request['state'],
                         'city'             		 => $request['city'],
                     ]);
                    $request->session()->put('analytic_ele_id',$h_id);    
                    ElevationTypeAnalytics::create([
                         'session_id'                => $request->session()->getId(),
                         'home_id'                   => $h_id,
                         'community_id'				 => $c_id->id,
                         'elevation_type_id'         => $type_id,
                         'ip_address'                => $request['ip'],
                         'country'                   => $request['country'],
                         'state'                     => $request['state'],
                         'city'                      => $request['city'],
                     ]);
                    $request->session()->put('analytic_ele_type_id',$type_id);
                    return ['added'];
                }
            }
            else
            {
                if($analytic_com_id == $c_id->id && $analytic_ele_id == $h_id && $analytic_lot_id==$l_id)
                {
                    return ['already counted'];
                }
                
                else
                {
                     CommunityAnalytics::create([
                         'session_id'       		 => $request->session()->getId(),
                         'community_id'				 => $c_id->id,
                         'ip_address'        		 => $request['ip'],
                         'country'          		 => $request['country'],
                         'state'            		 => $request['state'],
                         'city'             		 => $request['city'],
                     ]);
                    $request->session()->put('analytic_com_id',$c_id->id);
                    LotAnalytics::create([
                        'session_id'                => $request->session()->getId(),
                        'community_id'              => $c_id->id,
                        'lot_id'                    => $l_id,
                        'ip_address'                => $request['ip'],
                        'country'                   => $request['country'],
                        'state'                     => $request['state'],
                        'city'                      => $request['city'],
                    ]);
                    $request->session()->put('analytic_lot_id',$l_id);
                    ElevationAnalytics::create([
                         'session_id'       		 => $request->session()->getId(),
                         'community_id'				 => $c_id->id,
                         'home_id'					 =>	$h_id,
                         'ip_address'        		 => $request['ip'],
                         'country'          		 => $request['country'],
                         'state'            		 => $request['state'],
                         'city'             		 => $request['city'],
                     ]);
                    $request->session()->put('analytic_ele_id',$h_id);
                    if($request->session()->has('home_type_id'))
                    {  
                    $type_id    = $request->session()->get('home_type_id');
                    ElevationTypeAnalytics::create([
                         'session_id'                => $request->session()->getId(),
                         'home_id'                   => $h_id,
                         'community_id'				 => $c_id->id,
                         'elevation_type_id'         => $type_id,
                         'ip_address'                => $request['ip'],
                         'country'                   => $request['country'],
                         'state'                     => $request['state'],
                         'city'                      => $request['city'],
                     ]);
                    $request->session()->put('analytic_ele_type_id',$type_id);
                    }
                    return ['added'];
                }
            }
            
          
        }
        
        else
        {
            CommunityAnalytics::create([
                     'session_id'       		 => $request->session()->getId(),
                     'community_id'				 => $c_id->id,
                     'ip_address'        		 => $request['ip'],
                     'country'          		 => $request['country'],
                     'state'            		 => $request['state'],
                     'city'             		 => $request['city'],
                 ]);
            $request->session()->put('analytic_com_id',$c_id->id);
            LotAnalytics::create([
                'session_id'                => $request->session()->getId(),
                'community_id'              => $c_id->id,
                'lot_id'                    => $l_id,
                'ip_address'                => $request['ip'],
                'country'                   => $request['country'],
                'state'                     => $request['state'],
                'city'                      => $request['city'],
            ]);
            $request->session()->put('analytic_lot_id',$l_id);
            ElevationAnalytics::create([
                     'session_id'       		 => $request->session()->getId(),
                     'community_id'				 => $c_id->id,
                     'home_id'					 =>	$h_id,
                     'ip_address'        		 => $request['ip'],
                     'country'          		 => $request['country'],
                     'state'            		 => $request['state'],
                     'city'             		 => $request['city'],
                 ]);
            $request->session()->put('analytic_ele_id',$h_id);
            if($request->session()->has('home_type_id'))
            {
                ElevationTypeAnalytics::create([
                        'session_id'                => $request->session()->getId(),
                        'home_id'                   => $h_id,
                        'elevation_type_id'         => $type_id,
                        'community_id'				 => $c_id->id,
                        'ip_address'                => $request['ip'],
                        'country'                   => $request['country'],
                        'state'                     => $request['state'],
                        'city'                      => $request['city'],
                    ]);
                $request->session()->put('analytic_ele_type_id',$type_id);
            }
            return ['added'];
        }
    }
    public function storeUpgradeFeatures(Request $request)
    {
        $analytic_com_id = $request->session()->get('analytic_com_id'); 
        //$analytic_ele_id = $request->session()->get('analytic_ele_id'); 
        $analytic_ele_type_id = $request->session()->get('analytic_ele_type_id');
        $analytic_color_id = $request->session()->get('analytic_color_id');

        if($request->session()->has('home_upgrade_patches'))
        {
            if($request->session()->has('analytic_upgrade_id'))
            {
                $temp_ids = $request->session()->get('analytic_upgrade_id');
                $f_ids    = $request->session()->get('home_upgrade_patches');
                foreach($f_ids as $id)
                {
                    $title = HomeFeatures::where('id',$feature_id)->get('title')->first();
                    if(!in_array($id,$temp_ids))
                    {
                        ColorSchemeUpgradeAnalytics::create([
                            'session_id'                => $request->session()->getId(),
                            'home_id'                   => $analytic_ele_type_id,
                            'community_id'              => $analytic_com_id,
                            'color_scheme_id'           => $analytic_color_id,
                            'feature_name'              => $title->title,
                            'home_feature_id'           => $id,   
                            'ip_address'                => $request['ip'],
                            'country'                   => $request['country'],
                            'state'                     => $request['state'],
                            'city'                      => $request['city'],
                        ]);
                    }
                }
                $request->session()->put('analytic_upgrade_id',$f_ids);  
                return ['added'];
                }
            
            else
            {
                $feature_ids = $request->session()->get('home_upgrade_patches');
                foreach($feature_ids as $feature_id)
                    {
                    $title = HomeFeatures::where('id',$feature_id)->get('title')->first();   
                        ColorSchemeUpgradeAnalytics::create([
                            'session_id'                => $request->session()->getId(),
                            'home_id'                   => $analytic_ele_type_id,
                            'community_id'              => $analytic_com_id,
                            'color_scheme_id'           => $analytic_color_id,
                            'home_feature_id'           => $feature_id,
                            'feature_name'              => $title->title,
                            'ip_address'                => $request['ip'],
                            'country'                   => $request['country'],
                            'state'                     => $request['state'],
                            'city'                      => $request['city'],
                        ]);
                    }
                $request->session()->put('analytic_upgrade_id',$feature_ids);  
                return ['added']; 
            }
        }
     
        else
        {
            return ['no upgrade options selected'];
        }
    } 

    public function storeFloorFeatures(Request $request)
    {
        $analytic_com_id = $request->session()->get('analytic_com_id'); 
        $analytic_ele_id = $request->session()->get('analytic_ele_id'); 

       if($request->session()->has('floor_features'))
        {
         if($request->session()->has('analytic_features_id'))
         {
           
            $temp_arr = []; 
            $temp_ids = $request->session()->get('analytic_features_id');
            foreach($temp_ids as $temp):
            foreach($temp as $id):
            array_push($temp_arr,$id);
            endforeach;
            endforeach;
           $all_feature_ids    = $request->session()->get('floor_features');
         foreach($all_feature_ids as $feature_ids):
         foreach($feature_ids as $feature_id):
            if(!in_array($feature_id,$temp_arr)){
            $floor_id = Features::where('id', $feature_id)->get(['floor_id','title'])->first();
             SessionAnalytics::create([
                     'floor_id'             => $floor_id->floor_id,
                     'home_id'              => $analytic_ele_id,
                     'feature_id'           => $feature_id,
                     'feature_name'         => $floor_id ->title,
                     'community_id'         => $analytic_com_id,
                     'session_id'           => $request->session()->getId(),
                     'ip_address'           => $request['ip'],
                     'country'              => $request['country'],
                     'state'                => $request['state'],
                     'city'                 => $request['city'],
                     'status'               => 'success'
                 ]);
            }
        endforeach; 
        endforeach; 
         $request->session()->put('analytic_upgrade_id',$all_feature_ids); 
            
        }
        
        else
        {
        $all_feature_ids = $request->session()->get('floor_features');
         foreach($all_feature_ids as $feature_ids):
         foreach($feature_ids as $feature_id):

            $floor_id = Features::where('id', $feature_id)->get(['floor_id','title'])->first();
             SessionAnalytics::create([
                     'floor_id'             => $floor_id->floor_id,
                     'home_id'              => $analytic_ele_id,
                     'feature_id'           => $feature_id,
                     'feature_name'         => $floor_id->title,
                     'community_id'         => $analytic_com_id,
                     'session_id'           => $request->session()->getId(),
                     'ip_address'           => $request['ip'],
                     'country'              => $request['country'],
                     'state'                => $request['state'],
                     'city'                 => $request['city'],
                     'status'               => 'success'
                 ]);
        endforeach; 
        endforeach; 
         $request->session()->put('analytic_features_id',$all_feature_ids);  
          return ['added']; 
        }
        
     }
     
     else
     {
         return ['no Feature options selected'];
     }
    } 
}

