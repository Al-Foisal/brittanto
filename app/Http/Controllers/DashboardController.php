<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coaching\CoachingStudent;
use App\Models\Coaching\CoachingEmployee;
use App\Models\Coaching\CoachingSection;
use App\Models\User;
use App\Models\Feedback;
use DB;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        if(auth()->user()->active == 0)
        {
            auth()->logout();
            session()->flash('message','Your account is not activated');
            return redirect()->route('login');
        }

    	$fixed_identity = auth()->user()->FI;
    	$data = [];
    	$data['student_service'] = $student_service = auth()->user()->service;
    	$data['student_number'] = CoachingStudent::select(['id'])
    							->where('inst_identity',$fixed_identity)
    							->count();

    	$data['employee_service'] = (int)($student_service/4);
    	$data['employee_number'] = CoachingEmployee::select(['id'])
    							->where('inst_identity',$fixed_identity)
    							->count();

        $data['sections'] = CoachingSection::select('type', DB::raw('count(*) as count'))->where('inst_identity',$fixed_identity)
                    ->groupBy('type')
                    ->get();

        if(auth()->user()->type == 'admin')
            $data['users'] = User::all();

    	return view('backend.dashboard',$data);
    }

    public function docs()
    {
        return view('backend.docs');
    }

    public function feedback(Request $request)
    {
        $input = $request->except(['_token']);
        Feedback::create($input);
        session()->flash('message','Thanks for your feedback');
        return redirect()->route('dashboard');
    }
}
