<?php

namespace App\Models\Coaching\Fornt;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class CoachingForntPopularCourse extends Model
{
    use HasHashSlug;
	
    protected $guarded = [];
}
