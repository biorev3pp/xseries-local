<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ElevationAnalytics extends Model
{
    //
    protected $fillable = ['session_id','community_id','home_id','ip_address', 'country', 'state', 'city'];
    public function community(){

        return $this->belongsTo('App\Models\Communities');
    }
}
