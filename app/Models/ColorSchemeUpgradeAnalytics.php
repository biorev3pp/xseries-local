<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ColorSchemeUpgradeAnalytics extends Model
{
    //
    protected $fillable = ['session_id','home_id','color_scheme_id','community_id','home_feature_id','feature_name','ip_address', 'country', 'state', 'city'];

     public function home()
    {
    	# code...
    	return $this->belongsTo('App\Models\Homes');
    }

     public function color_scheme()
    {
    	# code...
    	return $this->belongsTo('App\Models\ColorSchemes');
    }
    
     public function community()
         {

        return $this->belongsTo('App\Models\Communities');
        }
}

