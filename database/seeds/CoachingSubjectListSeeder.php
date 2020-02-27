<?php

use Illuminate\Database\Seeder;
use App\Models\Coaching\CoachingSubjectList;

class CoachingSubjectListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CoachingSubjectList::insert([
    		[
    			'subject_name' => 'Bangla 1st Part',
    			'subject_code' => 'BNG 101'
    		],
    		[
    			'subject_name' => 'Bangla 2nd Part',
    			'subject_code' => 'BNG 102'
    		]
    	]);
    }
}
