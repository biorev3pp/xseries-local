<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommunityAnalytics extends Model
{
    //
    protected $fillable = ['session_id','community_id','ip_address', 'country', 'state', 'city'];
    
}
