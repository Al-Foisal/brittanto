<?php

use Illuminate\Database\Seeder;
use App\Models\Coaching\CoachingExamTitle;
class ExamTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CoachingExamTitle::insert([
    		[
    			'exam_title' => 'Test-01',
    			'exam_date' => date("d-m-Y"),
                'start_time' => '01:01:00 pm',
    			'inst_identity' => 601,
    		],
    		[
    			'exam_title' => 'Test-02',
    			'exam_date' => date("d-m-Y"),
                'start_time' => '01:01:00 pm',
    			'inst_identity' => 601,
    		],
    		[
    			'exam_title' => 'Test-03',
    			'exam_date' => date("d-m-Y"),
                'start_time' => '01:01:00 pm',
    			'inst_identity' => 601,
    		],
    		[
    			'exam_title' => 'Test-04',
    			'exam_date' => date("d-m-Y"),
                'start_time' => '01:01:00 pm',
    			'inst_identity' => 601,
    		],
    	]);
    }
}
