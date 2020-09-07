<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ColorSchemes extends Model
{
	protected $fillable = ['home_id','title','price','img','base_img','priority','status_id'];
    protected $table = 'color_schemes';
	public function home()
    {
        return $this->belongsTo('App\Models\Homes', 'home_id','id');
    }
}
