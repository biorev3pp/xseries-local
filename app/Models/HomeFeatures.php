<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeFeatures extends Model
{
    //protected $fillable = ['feature_id','color_scheme_id','title','img','price','priority','stared','feature_id','material','manufacturer','name','m_id'];
    protected $guarded=[];
	public function manufacturer(){
    	return $this->hasone('App\Models\Manufacturers','feature_id');
    }

}
