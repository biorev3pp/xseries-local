<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plots extends Model

{

    protected $table = 'plots';
    protected $fillable = ['community_id', 'svg', 'image', 'legand_group_id'];

    public function community(){

        return $this->belongsTo('App\Models\Communities', 'community_id', 'id');

    }

   public function legend_group(){

        return $this->belongsTo('App\Models\LegendGroups');

    }

}

