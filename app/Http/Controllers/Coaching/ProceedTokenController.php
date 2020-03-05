<?php

namespace App\Http\Controllers\Coaching;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coaching\CoachingProceed;
use App\Models\Coaching\CoachingStudent;
use App\Models\User;
use App\Models\Coaching\CoachingPaidReceipt;
use Validator;
use Illuminate\Support\Facades\Crypt; //for encription and decription

class ProceedTokenController extends Controller
{

    public function showProceed()
    {
    	return view('backend.coaching.proceed.receipt');
    }

    public function findAndGenerateProceed(Request $request)
    {

    	$valid = Validator::make($request->all(),[
            'std_id' => 'required',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $student_id = $request->input('std_id');
        $fixed_identity = auth()->user()->FI;

		
		$data = [];

		//for user information
		$data['user'] = User::select(['name','address'])->where('FI',$fixed_identity)->first();

        //for student information
        $data['students'] = $students = CoachingStudent::where('std_id',$student_id)->where('inst_identity',$fixed_identity)->first();

        if($students === null ){
            session()->flash('message','Invalid ID or Less Information');
            return redirect()->back();
        }

        //for receipt details
        $data['receipt'] = CoachingProceed::where('inst_identity',$fixed_identity)->orderBy('id','desc')->first();

        //last student serial number for a unique institution
        $last_inserted_receipt_serial = 
            CoachingPaidReceipt::select(['receipt_serial'])
                                    ->where('inst_identity',$fixed_identity)
                                    ->orderBy('id', 'DESC')
                                    ->first();

        //making serial number autometically
        if (empty($last_inserted_receipt_serial->receipt_serial)) {
            $data['serial'] = 1;
        } else {
            $data['serial'] = $last_inserted_receipt_serial->receipt_serial + 1;
        }

    	return view('backend.coaching.proceed.receipt',$data);
    }

    public function saveReceipt($save_proceed)
    { 
        $get_data = Crypt::decrypt($save_proceed);

        $input['proceed_id'] = $get_data["id"];//student id

        $input['std_id'] = $student_id = $get_data["std_id"];//student id 
        $input['name'] = $get_data["name"];
        $input['amd_class'] = $get_data["amd_class"];
        $input['amd_type'] = $get_data["amd_type"];
        $input['section'] = $get_data["section"];

        $input['total_paid'] = (int)$get_data["total"]; //total paid value
        $input['receipt_serial'] = $get_data["serial"];  //receipt serial number
        $input['inst_identity'] = $fixed_identity = auth()->user()->FI;

        $check = CoachingPaidReceipt::select(['std_id'])
                ->where('std_id',$student_id)
                ->whereMonth('created_at',date("m"))
                ->whereYear('created_at',date("Y"))
                ->where('inst_identity',$fixed_identity)
                ->first();

        if($check){
            session()->flash('message','The student has already paid for this month if something else add in VOUCHER sheet as an "Extra Income" type');
            return redirect()->route('proceed.show');
        }
        CoachingPaidReceipt::create($input);

        return redirect()->route('proceed.show');
    }

    public function paidProceed()   
    {

        $fixed_identity = auth()->user()->FI;
        $data = [];
        $data['get_year'] = CoachingPaidReceipt::selectRaw("YEAR(created_at) year")->where('inst_identity',$fixed_identity)->orderBy('year','asc')->distinct()->get();
        //$data['get_month'] = CoachingPaidReceipt::selectRaw("MONTH(created_at) month")->distinct()->get();
        $data['proceeds'] = CoachingPaidReceipt::select(['amd_class'])->where('inst_identity',$fixed_identity)->groupBy('amd_class')->get();

        return view('backend.coaching.proceed.paid_receipt',$data);
    }

    public function viewSelfProceed($selfview)
    {   

        $get_data = Crypt::decrypt($selfview);

        $proceed_id = $get_data["proceed_id"];//proceed table id
        $student_id = $get_data["std_id"];//student id
        $id = $get_data["id"];//student id
        $fixed_identity = auth()->user()->FI;

        
        $data = [];

        //for user information
        $data['user'] = User::select(['name','address'])->where('FI',$fixed_identity)->first();

        //for student information
        $data['students'] = $students = CoachingStudent::where('std_id',$student_id)->where('inst_identity',$fixed_identity)->first();

        //for receipt details
        $data['receipt'] = CoachingProceed::where('inst_identity',$fixed_identity)->where('id',$proceed_id)->first();

        $data['serial'] = 
            CoachingPaidReceipt::select(['receipt_serial','created_at'])
                                    ->where('inst_identity',$fixed_identity)
                                    ->where('proceed_id', $proceed_id)
                                    ->where('std_id',$student_id)
                                    ->where('id',$id)
                                    ->first();

        if($students === null ){
            session()->flash('message','The student were deleted.');
            return redirect()->back();
        }

        return view('backend.coaching.proceed.self_view_receipt',$data);
    }
}
