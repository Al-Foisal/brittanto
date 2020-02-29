<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coaching\CoachingStudent;
use App\Models\Coaching\CoachingEmployee;
use App\Models\Coaching\CoachingOwner;
use App\Models\Coaching\CoachingSectionSubject;
use App\Models\Coaching\CoachingExamTitle;
use App\Models\Coaching\CoachingMark;
use App\Models\Coaching\CoachingPaidReceipt;
use App\Models\Coaching\CoachingProceed;
use App\Models\Coaching\CoachingSection;
use App\Models\Coaching\CoachingCoachingsmsCounter;
use App\Models\Coaching\CoachingSubjectList;
use App\Models\Coaching\CoachingVoucher;
use App\Models\Feedback;
use App\Models\User;

class AdminController extends Controller
{
    public function adminRequest($fixed_identity)
    {
    	$data = [];

    	$data['user'] = User::where('FI',$fixed_identity)->first();

    	$data['classes'] = CoachingStudent::select(['amd_class'])
                        ->where('inst_identity',$fixed_identity)
                        ->groupBy('amd_class')
                        ->get();



        //selecting all the employees
        $data['employees'] = CoachingEmployee::orderBy('role','desc')->where('inst_identity',$fixed_identity)->get();

        //count all the teacher 
        $data['teacher'] = CoachingEmployee::where('role','teacher')->where('inst_identity',$fixed_identity)->count();

        //count all the staff
        $data['staff'] = CoachingEmployee::where('role','staff')->where('inst_identity',$fixed_identity)->count();



        $data['owners'] = CoachingOwner::where('inst_identity',$fixed_identity)
            ->get();


        $data['section_lists'] = CoachingSection::where('inst_identity',$fixed_identity)->orderBy('name','asc')->get();


        $data['receipt_get_year'] = CoachingPaidReceipt::selectRaw("YEAR(created_at) year")->where('inst_identity',$fixed_identity)->orderBy('year','asc')->distinct()->get();
        //$data['get_month'] = CoachingPaidReceipt::selectRaw("MONTH(created_at) month")->distinct()->get();
        $data['proceeds'] = CoachingPaidReceipt::select(['amd_class'])->where('inst_identity',$fixed_identity)->groupBy('amd_class')->get();



        $data['cost_sheet_get_year'] = CoachingPaidReceipt::selectRaw("YEAR(created_at) year")->where('inst_identity',$fixed_identity)->orderBy('year','desc')->distinct()->get();


    	return view('backend.admin.admin_check',$data);
    }
}
