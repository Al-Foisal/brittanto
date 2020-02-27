<?php
//StudentOperationController
namespace App\Models\Coaching;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;
class CoachingStudent extends Model
{
	use HasHashSlug;
	
    protected $guarded = [];

    protected static $modelSalt = "posts";

    public function getClassTypeAttribute()
    {
    	if($this->amd_class == 20 )
    		$amd_class = 'Play Group';
    	else if($this->amd_class == 21 )
    		$amd_class = 'Nursery' ;
    	else
    		$amd_class = $this->amd_class;
    	return $amd_class;
    }


    /*public function getAdmissionTypeAttribute()
    {
    	if( $this->amd_type === 'regular')
    		$section_amd_type = 'Regular Batch';
    	else if($this->amd_type === 'regular')
    		$section_amd_type = 'Special Batch';
    	else if($this->amd_type === 'bm')
    		$section_amd_type = 'Bangla Medium';
    	else if($this->amd_type === 'bv')
    		$section_amd_type = 'Bangla Varsion';
    	else if($this->amd_type === 'em')
    		$section_amd_type = 'English Medium';
    	else 
    		$section_amd_type = 'English Varsion';
    	return $section_amd_type;
    }*/
    
    public function getAdmissionTypeAttribute()
    {
    	return $this->amd_type === 'regular' ? 'Regular Batch' : 'Special Batch' ;
    }
}
