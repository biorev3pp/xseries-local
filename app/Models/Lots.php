<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lots extends Model

{
	protected $table = 'lots';
	
	protected $fillable = [
		'id', 'plot_id', 'alias', 'groupID', 'price', 'phase','legend_id',
	];

    public function legend()
	{
        return $this->belongsTo('App\Models\Legends', 'legend_id', 'id');
    }
	public function plat()
	{
        return $this->belongsTo('App\Models\Plots', 'plot_id', 'id');
    }

    public function community()
	{
        return $this->plat()->with('community');
    }
	public function homes()
    {
        return $this->belongsToMany('App\Models\Homes');
    }


}

