<?php
//ProceedTokenController
namespace App\Models\Coaching;

use Illuminate\Database\Eloquent\Model;

class CoachingPaidReceipt extends Model
{
	
    protected $guarded = [];

    public function getAdmissionTypeAttribute()
    {
    	return $this->amd_type === 'regular' ? 'Regular Batch' : 'Special Batch' ;
    }
}
