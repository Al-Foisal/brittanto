<?php

namespace App\Models\Coaching;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class CoachingExamSectionSubject extends Model
{
    use HasHashSlug;
    protected $guarded = [];

}
