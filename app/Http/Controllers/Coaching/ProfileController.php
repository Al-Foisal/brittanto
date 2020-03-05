<?php

namespace App\Http\Controllers\Coaching;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coaching\CoachingStudent;
use App\Models\Coaching\CoachingPaidReceipt;
Use Validator,DB;
use App\Models\User;
use App\Models\Coaching\CoachingMark;

class ProfileController extends Controller
{
    public function showStudentProfile(Request $request)
    {
    	$fixed_identity = auth()->user()->FI;
    	$valid = Validator::make($request->all(),[
            'std_id' => 'required',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

    	$data = [];
    	// $id = CoachingStudent::select('id')->where('std_id',$request->input(['std_id']))->where('inst_identity',$fixed_identity)->first();
    	// dd($id);
        $data['student'] = $student = CoachingStudent::where('std_id',$request->input(['std_id']))->where('inst_identity',$fixed_identity)->first();

        if(!$student){
            session()->flash('message','Student not found bearing ID#'.$request->std_id);
            return redirect()->route('coaching-students.index');
        }
        $data['receipts'] = CoachingPaidReceipt::where('std_id',$request->input(['std_id']))
                            ->where('inst_identity',$fixed_identity)
                            ->get();

        return view('backend.coaching.student.details',$data);
    }
}
