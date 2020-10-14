<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageHistory extends Model
{
    protected $table = 'image_histories';
    protected $guarded = [];
    protected $hidden = ['created_at','updated_at'];
}
