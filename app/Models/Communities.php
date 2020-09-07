<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Communities extends Model
{
    protected $table = 'communities';
    
    protected $fillable = ['state_id', 'city_id', 'name', 'location', 'marker', 'slug', 'logo', 'banner', 'zipcode','description', 'contact_person', 'contact_email','marker_image', 'contact_number', 'status_id','features','community_type', 'lat', 'lng', 'gallery', 'map_type_id', 'map_zoom'];

    public function city(){
        return $this->belongsTo('App\Models\Cities', 'city_id', 'id');
    }		

    public function state(){        
        return $this->belongsTo('App\Models\States', 'state_id', 'id');    
    }

    public function status(){
        return $this->belongsTo('App\Models\Statuses', 'status_id', 'id');
    }

    public function plot(){
        return $this->hasOne('App\Models\Plots', 'community_id');
    }
	public function homes()
    {
        return $this->belongsToMany('App\Models\Homes');
    }
        public function CommunitiesHomes()
    {
        return $this->hasMany('App\Models\CommunitiesHomes', 'communities_id');
    }
}
