<?php

namespace App\Models\Coaching;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class CoachingMark extends Model
{
	use HasHashSlug;
    protected $guarded = [];

    public function getClassTypeAttribute()
    {
    	if($this->class == 20 )
    		$class = 'Play Group';
    	else if($this->class == 21 )
    		$class = 'Nursery' ;
    	else
    		$class = $this->class;
    	return $class;
    }
}
