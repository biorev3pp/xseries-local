<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estimates extends Model
{
    protected $table = 'estimates';
    protected $fillable = ['admin_id','reference_id', 'community_id','lot_id','feature_id', 'home_id', 'total_price','color_scheme_id','home_feature_ids', 'home_msg'];
    public function admins(){
        return $this->belongsTo('App\Admins', 'admin_id');
    }
    public function communities(){
        return $this->belongsTo('App\Models\Communities', 'community_id');
    }
    public function lots(){
        return $this->belongsTo('App\Models\Lots', 'lot_id');
    }
    public function homes(){
        return $this->belongsTo('App\Models\Homes', 'home_id');
    }
      public function color_schemes(){
        return $this->belongsTo('App\Models\ColorSchemes', 'color_scheme_id');
    }
    public function floors(){
        return $this->belongsTo('App\Models\Floor', 'floor_id');
    }
      public function references(){
        return $this->belongsTo('App\Admins', 'reference_id');
    }
}
