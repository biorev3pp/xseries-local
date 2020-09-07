<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LegendGroups extends Model
{
	
	protected $table = 'legend_groups';
	 protected $fillable = [
        'id', 'plot_id', 'groupname','status_id','status_id',
    ];
    public function legends(){
        return $this->hasMany('App\Models\Legends', 'legend_group_id');
    }
}
