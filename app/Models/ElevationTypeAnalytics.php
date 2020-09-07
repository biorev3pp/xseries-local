<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ElevationTypeAnalytics extends Model
{
    //
    protected $fillable = ['session_id','home_id','community_id','elevation_type_id','ip_address', 'country', 'state', 'city'];
    
    public function home(){

        return $this->belongsTo('App\Models\Homes');
    }
     public function community(){

        return $this->belongsTo('App\Models\Communities');
    }
}
