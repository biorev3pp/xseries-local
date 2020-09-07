<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ColorSchemeAnalytics extends Model
{
    //
    protected $fillable = ['session_id','home_id','community_id','color_scheme_id','ip_address', 'country', 'state', 'city'];
    public function home()
    {
    	# code...
    	return $this->belongsTo('App\Models\Homes');
    }
     public function community(){

        return $this->belongsTo('App\Models\Communities');
    }
}
