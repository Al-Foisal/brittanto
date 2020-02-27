<?php
//ProceedOperationController
namespace App\Models\Coaching;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class CoachingProceed extends Model
{
    use HasHashSlug;
	
    protected $guarded = [];
}
