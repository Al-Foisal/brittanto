<?php
//SectionOperationController
namespace App\Models\Coaching;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;
class CoachingSection extends Model
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


    public function getSectionTypeAttribute()
    {
    	if( $this->type === 'regular')
    		$section_type = 'Regular Batch';
    	else if($this->type === 'special')
    		$section_type = 'Special Batch';
    	else if($this->type === 'bm')
    		$section_type = 'Bangla Medium';
    	else if($this->type === 'bv')
    		$section_type = 'Bangla Varsion';
    	else if($this->type === 'em')
    		$section_type = 'English Medium';
    	else 
    		$section_type = 'English Varsion';
    	return $section_type;
    }
}
