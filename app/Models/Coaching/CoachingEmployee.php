<?php
//EmployeeOperationController
namespace App\Models\Coaching;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;
class CoachingEmployee extends Model
{
	use HasHashSlug;
	
    protected $guarded = [];

    public function getCommitTypeAttribute()
    {
    	return $this->commitment === 'per_class' ? 'Per Class' : 'Fixed';
    }
}
