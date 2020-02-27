<?php

namespace App\Http\Controllers\Coaching;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coaching\CoachingPaidReceipt;
use App\Models\Coaching\CoachingEmployee;
use App\Models\Coaching\CoachingDailyTeacherSalary;
use App\Models\Coaching\CoachingVoucher;
use Validator,Redirect,Response;
use DB;

class CoachingSalaryController extends Controller
{
    public function showSalaryForm($id)
    {
    	$fixed_identity = auth()->user()->FI;
        $employee = CoachingEmployee::findBySlugOrFail($id);
        if ($employee->commitment !== 'per_class'){
            session()->flash('message','Invalid entry checking.');
            return redirect()->route('coaching-employees.index');
        }            
    	$data = [];
    	$data['teacher'] = CoachingEmployee::where('id',$employee->id)->first();
    	return view('backend.coaching.finance.salary_calculation',$data);
    }

    public function storeSalaryForm(Request $request)
    {
        $valid = Validator::make($request->all(),[
            'name' => 'required',
            'class' => 'required',
            'per_class' => 'required',
            'total' => 'required',
            'teacher_id' => 'required',
        ]);    

        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }
    	$fixed_identity = auth()->user()->FI;
    	$input = $request -> except(['_token']);
    	$input['inst_identity'] = $fixed_identity;

    	$check = CoachingDailyTeacherSalary::create($input);
        session()->flash('message','Salary added');
        return redirect()->back();

    }

    public function updateSalaryForm(Request $request)
    {
        $fixed_identity = auth()->user()->FI;
        $update_status = CoachingDailyTeacherSalary::findOrFail($request->input(['id']));
        $update_status->update(['status'=>'paid']);

        //adding teacher cost to voucher table
        $input['cost_name'] = $update_status->name;
        $input['comment'] = $update_status->comment;
        $input['cost_type'] = 'per_class';
        $input['cost'] = $update_status->total;
        $input['paid_id'] = $update_status->id;
        $input['inst_identity'] = $fixed_identity;
        CoachingVoucher::create($input);

        session()->flash('message','Salary updated');
        return redirect()->back();
    }

    public function showVoucher()
    {
        $fixed_identity = auth()->user()->FI;
        $data = [];
        $data['vouchers'] = CoachingVoucher::whereYear('created_at',date("Y"))
            ->whereMonth('created_at',date("m"))
            ->where('inst_identity',$fixed_identity)
            ->orderBy('cost_type','desc')
            ->get();
        return view('backend.coaching.finance.voucher',$data);
    }

    public function storeVoucher(Request $request)
    {
        $valid = Validator::make($request->all(),[
            'cost_name' => 'required',
            'cost_type' => 'required',
            'cost' => 'required',
        ]);    

        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }
        $fixed_identity = auth()->user()->FI;
        $input = $request -> except(['_token']);
        $input['inst_identity'] = $fixed_identity;

        CoachingVoucher::create($input);
        session()->flash('message','Voucher added');
        return redirect()->route('voucher.show');
    }

    public function deleteVoucher($id)
    {
        $voucher = CoachingVoucher::findBySlugOrFail($id);

        if ($voucher->cost_type === 'per_class') {
            $delete_paid = CoachingDailyTeacherSalary::findOrFail($voucher->paid_id);
            $delete_paid -> delete();
        }
        

        //Institution Fixed identity
        $fixed_identity = auth()->user()->FI;
        //barrier for others 
        if($fixed_identity !== $voucher->inst_identity){
            session()->flash('message','Invalid entry checking.');
            return redirect()->back();
        }
        
        $voucher -> delete();
        

        session()->flash('message','@'.$voucher->cost_name.' --- Deleted From Voucher List');
        return redirect()->route('voucher.show');
    }

    public function costSheet()
    {
        $fixed_identity = auth()->user()->FI;
        $data = [];
        $data['get_year'] = CoachingPaidReceipt::selectRaw("YEAR(created_at) year")->where('inst_identity',$fixed_identity)->orderBy('year','desc')->distinct()->get();

        return view('backend.coaching.finance.cost_sheet',$data);
    }
}
