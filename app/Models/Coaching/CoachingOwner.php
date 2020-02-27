<?php
//OwnerOperationController
namespace App\Models\Coaching;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;
class CoachingOwner extends Model
{
	use HasHashSlug;
	
    protected $guarded = [];
}
