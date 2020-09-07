<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeDesignOptions extends Model
{
    protected $table = 'home_design_options';
    protected $fillable = ['updated_at', 'created_at'];
    //protected $guarded =[];
    public function HomeDesignGroup(){
        return $this->belongsTo('App\Models\HomeDesignGroups','home_design_id','id');
    }
    public function HomeDesign(){
        return $this->belongsTo('App\Models\HomeDesigns','design_id','id')->with('HomeDesignTypes');
    }
}
