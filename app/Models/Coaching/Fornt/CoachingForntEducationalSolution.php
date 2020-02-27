<?php

namespace App\Models\Coaching\Fornt;

use Illuminate\Database\Eloquent\Model;

use Balping\HashSlug\HasHashSlug;

class CoachingForntEducationalSolution extends Model
{
    use HasHashSlug;
	
    protected $guarded = [];

    protected $timestaps = false;
}
