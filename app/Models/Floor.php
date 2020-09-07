<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    protected $table = 'floors';
    protected $guarded = [];
    public function home()
    {
        return $this->belongsTo('App\Models\Homes', 'home_id','id');
    }

    public function features()
    {
        return $this->hasMany('App\Models\Features', 'floor_id');
    }

    public function featureList()
    {
        return $this->hasMany('App\Models\Features', 'floor_id');
    }
}