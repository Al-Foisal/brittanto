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
        $data['student'] = CoachingStudent::where('std_id',$request->input(['std_id']))->where('inst_identity',$fixed_identity)->first();
        $data['receipts'] = CoachingPaidReceipt::where('std_id',$request->input(['std_id']))
                            ->where('inst_identity',$fixed_identity)
                            ->get();

        return view('backend.coaching.student.details',$data);
    }
}
