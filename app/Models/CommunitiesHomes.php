<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CommunitiesHomes extends Pivot
{
    protected $table="communities_homes";
}