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
    public function index()
    {
    	$data = [];
    	$data['users'] = User::all();
    	return view('backend.admin.user_list',$data);
    }
}
