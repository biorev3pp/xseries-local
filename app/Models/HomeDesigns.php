<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeDesigns extends Model
{
    protected $table = 'home_designs';

    //protected $guarded = [];
    protected $fillable = ['id','home_design_type_id','design','is_designer','slug','image','star','updated_at','created_at'];

    public function HomeDesignTypes(){
        return $this->belongsTo('App\Models\HomeDesignTypes','home_design_type_id','id');
    }
    

    /*public function options()
    {
        return $this->hasMany('App\Models\HomeDesignOptions','home_design_id', 'id');
    }*/

    

    public function homeDesignOptions()
    {
        return $this->hasMany('App\Models\HomeDesignOptions','design_id', 'id');
    }
}
