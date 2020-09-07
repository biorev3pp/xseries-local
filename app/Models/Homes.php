<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Homes extends Model
{
    protected $guarded = [];
    public function ColorScheme(){
    	return $this->hasMany('App\Models\ColorSchemes','home_id')->where('color_schemes.status_id','=',2);
    }
    public function floors()
    {
        return $this->hasMany('App\Models\Floor', 'home_id');
    }
	public function communities()
    {
        return $this->belongsToMany('App\Models\Communities');
    }
	public function lots()
    {
        return $this->belongsToMany('App\Models\Lots');
    }
}
