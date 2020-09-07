<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class HomesLots extends Pivot
{
    protected $table="homes_lots";
	protected $fillable = [
        'id', 'lots_id', 'homes_id',
    ];
	
}