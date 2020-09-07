<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeTypeOptions extends Model
{
    protected $table = 'home_type_options';
    protected $fillable = ['state_id', 'design_type_id', 'id', 'patch', 'self_slug','status_id','default_color','updated_at','created_at'];


    public function designTypes(){
        return $this->belongsTo('App\Models\HomeDesignTypes','design_type_id','id');
    }
}
