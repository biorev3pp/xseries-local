<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LotHomeSettings extends Model
{
    //
	protected $table = 'lot_home_settings';
	 protected $fillable = [
        'id', 'lot_id', 'home_id',
    ];

    public function home(){
        return $this->belongsTo('App\Models\Homes', 'lot_id');
    }
	
}
