<?php

namespace App\Models\Coaching;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class CoachingVoucher extends Model
{
    use HasHashSlug;
	
    protected $guarded = [];

    public function getSetCostTypeAttribute()
    {
    	if($this->cost_type === 'daily_cost')
    		$set_cost_type = 'Daily Cost';
    	elseif ($this->cost_type === 'extra_income') 
    		$set_cost_type = 'Extra Income';
    	else
    		$set_cost_type = 'Per Class';
    	return  $set_cost_type;
    }
}
