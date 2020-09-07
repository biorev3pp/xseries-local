<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeAnalytics extends Model
{
    //
    protected $table = 'home_analytics';
    protected $fillable = ['home_id','impression','click'];
}
