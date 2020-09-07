<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
   	 protected $fillable = ['city', 'state_id'];
    
    public function state(){
        return $this->belongsTo('App\Models\States', 'state_id', 'id');
    }

    public function communities(){
        return $this->hasMany('App\Models\Communities', 'city_id', 'id');
    }
}
