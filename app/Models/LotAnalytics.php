<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LotAnalytics extends Model
{
    //
    protected $table='lot_analytics';
    protected $fillable = ['session_id','community_id','lot_id','ip_address', 'country', 'state', 'city'];

    public function community()
    {
    	# code...
    	return $this->belongsTo('App\Models\Communities');
    }
}
