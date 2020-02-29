<?php

namespace App\Http\Controllers\Coaching\Fornt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Coaching\Fornt\CoachingForntEducationalSolution;
use App\Models\Coaching\Fornt\CoachingForntEnrollToday;
use App\Models\Coaching\Fornt\CoachingForntMission;
use App\Models\Coaching\Fornt\CoachingForntNoticeBoard;
use App\Models\Coaching\Fornt\CoachingForntPopularCourse;
use App\Models\Coaching\Fornt\CoachingForntPopularCourseFeature;
use App\Models\Coaching\Fornt\CoachingForntUpcomingEvent;
use App\Models\Coaching\Fornt\CoachingForntUpcomingEventFeature;
use App\Models\Coaching\CoachingEmployee;
use App\Models\Coaching\CoachingOwner;
use App\Models\Coaching\CoachingCounter;
use App\Models\Coaching\CoachingStudent;
use App\Models\User;

use Validator,DB;

class CoachingForntController extends Controller
{
    public function showInstitutionList()
    {
        $data = [];
        $data['header_inner'] = false;
        $data['header_menu'] = false;
        $data['slide'] = false;
        $data['footer'] = false;

        $data['users'] = User::orderBy('name')->where('active',0)->get()->groupBy(function($item) {
            return $item->type;
        });
        return view('welcome',$data);
    }

    public function showInstitutionDetails($serial)
    {
        $data = [];
        $data['user'] = $user = User::where('FI',$serial)->first();
        $exist = $user ? true : abort('404');
        
        $data['header_inner'] = true;
        $data['header_menu'] = true;
        $data['slide'] = true;
        $data['footer'] = true;        

        $data['solutions'] = CoachingForntEducationalSolution::where('inst_identity',$serial)->orderBy('id','asc')->limit(3)->get();

        $data['courses'] = CoachingForntPopularCourse::where('inst_identity',$serial)->orderBy('id','desc')->get();

        $data['mission'] = CoachingForntMission::where('inst_identity',$serial)->first();

        $data['teachers'] = CoachingEmployee::where('inst_identity',$serial)->where('role','teacher')->get();

        $data['owners'] = CoachingOwner::where('inst_identity',$serial)->get();

        $data['events'] = CoachingForntUpcomingEvent::where('inst_identity',$serial)->orderBy('id','desc')->get();

        $data['notices'] = CoachingForntNoticeBoard::where('inst_identity',$serial)->orderBy('id','desc')->get();

        $data['count'] = CoachingCounter::where('inst_identity',$serial)->first();
        $data['students'] = CoachingStudent::where('inst_identity',$serial)->get();
//dd($data);
        return view('institution_details',$data);
    }

    public function storeOnlineStudent(Request $request)
    {
        $valid = Validator::make($request->all(),[
            'full_name' => 'required',
            'email' => 'required',
            'phone_number' => 'required',
            'message' => 'required',
            'inst_identity' => 'required',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $input = $request->except(['_token']);
        CoachingForntEnrollToday::create($input);
        session()->flash('message','Your request submit successfully and will call you back.');
        return redirect()->route('institution.details',$request->inst_identity);

    }

    public function showSingleCourse($id)
    {
        $data = [];

        $data['header_inner'] = true;
        $data['header_menu'] = false;
        $data['slide'] = false;
        $data['footer'] = true;
        

        $data['course'] = $course = CoachingForntPopularCourse::findBySlugOrFail($id);
        $data['user'] = User::where('FI',$course->inst_identity)->first();

        $data['features'] = CoachingForntPopularCourseFeature::where('course_id', $course->id)->get();
        return view('single_course',$data);
    }

    public function showSingleEvent($id)
    {
        $data = [];

        $data['header_inner'] = true;
        $data['header_menu'] = false;
        $data['slide'] = false;
        $data['footer'] = true;
        

        $data['event'] = $event = CoachingForntUpcomingEvent::findBySlugOrFail($id);
        $data['user'] = User::where('FI',$event->inst_identity)->first();

        $data['features'] = CoachingForntUpcomingEventFeature::where('event_id', $event->id)->get();
        return view('single_event',$data);
    }

}
