<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeDesignTypes extends Model
{
    protected $table = 'home_design_types';
    protected $guarded =[];
    public function HomeDesignGroups(){
        return $this->belongsTo('App\Models\HomeDesignGroups','design_group_id','id');
    }
    public function HomeDesigns(){
        return $this->hasMany('App\Models\HomeDesigns','home_design_type_id','id');
    }
    public function home(){
        return $this->hasMany('App\Models\Homes','home_id','id');
    }
    
   /* protected $fillable = ['city_id', 'name', 'location', 'marker', 'slugIndex', 'logo', 'banner', 'description', 'contact_person', 'contact_email', 'contact_number', 'status_id'];

    public function city(){
        return $this->belongsTo('App\Models\Cities', 'city_id', 'id');
    }

    public function status(){
        return $this->belongsTo('App\Models\Statuses', 'status_id', 'id');
    }

    public function plot(){
        return $this->hasOne('App\Models\Plots', 'community_id');
    }*/

    // get the options for a particular home design
    /*public function options()
    {
        return $this->hasMany('App\Models\HomeTypeOptions','design_type_id', 'id');
    }

    public function designs()
    {
        return $this->hasMany('App\Models\HomeDesigns','home_design_type_id', 'id')->where('status_id','=',2);
    }*/

    /*public function designs()
    {
        return $this->hasMany('App\Models\HomeDesigns','home_design_type_id', 'id')->where('status_id','=',2)->with('options');
    }*/



    public function designoptions()
    {
        return $this->hasMany('App\Models\HomeDesignOptions','home_type_id', 'id');
    } 

    public function options()
    {
        return $this->hasMany('App\Models\HomeTypeOptions','design_type_id', 'id');
    }

    public function designs()
    {
        return $this->hasMany('App\Models\HomeDesigns','home_design_type_id', 'id')->with('homeDesignOptions');
    }



}
