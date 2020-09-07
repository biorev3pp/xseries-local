<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Legends extends Model
{
    //
	protected $table = 'legends';
	 protected $fillable = [
        'legend_group_id', 'colorcode', 'rgbacode','name',
    ];

    public function lots()
	{
        return $this->hasMany('App\Models\Lots', 'legend_id', 'id');
    }

    public function legend_group()
    {
        return $this->belongsTo('App\Models\LegendGroups', 'legend_group_id', 'id');
    }
	
	
}
