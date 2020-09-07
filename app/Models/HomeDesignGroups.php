<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeDesignGroups extends Model
{
    protected $guarded = [];
    /*protected $table = 'home_design_groups';
	 protected $fillable = [
        'id', 'home_id', 'title','img','status_id',
    ];*/
    public function HomeDesignType(){
        return $this->hasMany('App\models\HomeDesignTypes','design_group_id','id');
    }
    public function HomeDesignOptions(){
        return $this->hasMany('App\models\HomeDesignOptions','home_design_id','id');
    }

    public function home()
    {
        return $this->belongsTo('App\Models\Homes', 'home_id','id');
    }
}
