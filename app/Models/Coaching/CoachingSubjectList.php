<?php

namespace App\Models\Coaching;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class CoachingSubjectList extends Model
{
    use HasHashSlug;
    protected $guarded = [];
}
