<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Features extends Model
{
    protected $table = 'features';

    public function floor(){
        return $this->belongsTo('App\Models\Floor', 'floor_id','id');
    }

    public function features_acl()
    {
    	return $this->belongsTo('App\Models\FloorAclSetting', 'id','feature_id')->withDefault();
    }

    public function feature_groups()
    {
    	return $this->hasMany('App\Models\Features','parent_id')->orderBy('order_no');
    }
}
