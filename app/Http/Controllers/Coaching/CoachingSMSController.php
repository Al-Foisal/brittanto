<?php

namespace App\Http\Controllers\Coaching;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coaching\CoachingStudent;
use App\Models\Coaching\CoachingMark;
use App\Models\Coaching\CoachingExamTitle;
use App\Models\Coaching\CoachingExamSectionSubject;
use App\Models\Coaching\CoachingsmsCounter;
use Validator,DB;

class CoachingSMSController extends Controller
{
    public function showExamSMSArea(Request $request)
    {
    	$fixed_identity = auth()->user()->FI;
    	
    	$data = [];
    	$data['students'] = CoachingStudent::select(['id','name','std_id','section','grd_phone','std_phone'])->where('section',$request->section_name)->where('inst_identity',$fixed_identity)->get();

        $data['exam_title'] = CoachingExamTitle::select('exam_title')->where('inst_identity',$fixed_identity)->get();

        //select sent sms for this month of year
        $sms_count = CoachingsmsCounter::where('inst_identity',$fixed_identity)
        ->whereMonth('created_at',date("m"))->whereYear('created_at',date("Y"))->first();

        //checking sms limitation
        if($sms_count){
            $limit = ( auth()->user()->service / 100 ) * 400;
            if($sms_count->count_sent_sms >= $limit)
                $data['disabled'] = 'disabled';
        }
        $data['disabled'] = '';

    	return view('backend.coaching.sms.show_exam_sms_area',$data);
    }

    public function sendExamSMS(Request $request)
    {
        $fixed_identity = auth()->user()->FI;

        //select sent sms for this month of year
        $sms_count = CoachingsmsCounter::where('inst_identity',$fixed_identity)
        ->whereMonth('created_at',date("m"))->whereYear('created_at',date("Y"))->first();

        //checking sms limitation
        if($sms_count){
            $limit = ( auth()->user()->service / 100 ) * 400;
            if($sms_count->count_sent_sms >= $limit){
                session()->flash('message','SMS limitation overhead');
                return back();
            }
        }

        //for distinct year, section and exam_title are counting
        $subjects = CoachingExamSectionSubject::select('subject')->where('exam_title',$request->exam_title)->where('section',$request->section)->where('inst_identity',$fixed_identity)->whereYear('created_at',date("Y"))->count();

        //for distinct year, section and exam_title are counting
        $checks = CoachingMark::select('subject')->where('exam_title',$request->exam_title)->where('section',$request->section)->where('inst_identity',$fixed_identity)->distinct('subject')->whereYear('created_at',date("Y"))->count();

        if ($subjects != $checks || $checks == 0 ) {
            session()->flash('message', 'For '.$request->section.' all the subjects number are not uploaded under '.$request->exam_title);
            return redirect()->route('coaching-students.index');
        }
        

        //$a for success and $b fail counting smsm
        $a=0;
        $b=0;
        
        // this will work for every student
    	foreach ($request->std_id as $key => $selected) 
    	{
            $number = '';

            //select student according to student ID
    		$student = CoachingStudent::select(['name','grd_phone','std_phone'])->where([
                'std_id' => $selected,
                'inst_identity' => $fixed_identity
            ])->first();

            //finding distinct subject according to test name
            $exam = CoachingMark::where([
                'student_id' => $selected,
                'exam_title' => $request->exam_title,
                'inst_identity' => $fixed_identity
            ])->whereYear('created_at',date("Y"))->distinct('subject')->get();

            $text1 = $student->name.',ID#'.$selected.','.$request->exam_title.':';

            $text2 = '';
            foreach ($exam as $exam_number) {

                //finding maximum marks for each subject
                $highest_mark = CoachingMark::where([
                    'section' => $request->section,
                    'exam_title' => $request->exam_title,
                    'subject' => $exam_number['subject'],
                    'inst_identity' => $fixed_identity
                ])->whereYear('created_at',date("Y"))->max('mark');

                $text2 = $text2.' '.$exam_number['subject'].' = '.$exam_number['mark'].'('.$exam_number['defined_mark'].')(1st-'.$highest_mark.'),';
                
            }
            
            
/** sms sending API code are starts from here */
            $url = "http://66.45.237.70/api.php";
            $number=$student->grd_phone.','.$student->std_phone;
            $text = $text1 .' '. $text2.''.auth()->user()->abbreviation;
            
            $data= array(
                'username'=>"01798032828",
                'password'=>"K92MDB3A",
                'number'=>"$number",
                'message'=>"$text"
            );

            $ch = curl_init(); // Initialize cURL
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $smsresult = curl_exec($ch);
            $p = explode("|",$smsresult);
            $sendstatus = $p[0];
//ar_dump($sendstatus);exit;
            if($sendstatus == "1101")
                ++$a;
            else
                ++$b;

/** sms sending API code are end here */

        }

        /*
        if in this month of year count_sent_sms 
        is empty then this will create a new row
        */
        if($sms_count == null){
            $input['count_sent_sms'] = $a;
            $input['inst_identity'] = $fixed_identity;
            CoachingsmsCounter::create($input);
        } else {
            /*
            if in this month of year count_sent_sms 
            is not empty then this will update 
            count_sent_sms column in this month
            of year
            */
            $sms_count->update(['count_sent_sms'=>$sms_count->count_sent_sms+$a]);
        }

        session()->flash('message','SMS sent successfully');
        return redirect()->route('coaching-students.index');

    }
}
