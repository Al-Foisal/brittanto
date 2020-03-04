<?php

namespace App\Http\Controllers\Coaching;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coaching\CoachingEmployee;
use App\Models\Coaching\CoachingCounter;
use App\Models\User;
Use Validator;

class EmployeeOperationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fixed_identity = auth()->user()->FI;

        $data = [];

        //selecting all the employees
        $data['employees'] = CoachingEmployee::orderBy('role','desc')->where('inst_identity',$fixed_identity)->get();

        //count all the teacher 
        $data['teacher'] = CoachingEmployee::where('role','teacher')->where('inst_identity',$fixed_identity)->count();

        //count all the staff
        $data['staff'] = CoachingEmployee::where('role','staff')->where('inst_identity',$fixed_identity)->count();


        return view('backend.coaching.employee.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fixed_identity = auth()->user()->FI;
        //calculation of employee limit
        $employee_service = (int)(auth()->user()->service/4);
        $employee_number = CoachingEmployee::select(['id'])
                                ->where('inst_identity',$fixed_identity)
                                ->count();

        $data = [];

        //rest of the employee
        $data['employee'] = (int)($employee_service - $employee_number);

        return view('backend.coaching.employee.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fixed_identity = auth()->user()->FI;

        $valid = Validator::make($request->all(),[
            'name' => 'required',
            'thr_study_inst' => 'required',
            'role' => 'required',
            'study' => 'required',
            'salary' => 'required|digits_between:1,10',
            'address' => 'required',
            'commitment' => 'required',
            'phone' => 'required|regex:/(8801)[0-9]{9}/',
            'image' => 'image|mimes:png,jpeg|max:50'
        ]);

        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $input = $request -> except(['_token']);

        //Institution Fixed identity
        $input['inst_identity'] = auth()->user()->FI; 
        if($request->input(['role']) === 'staff')
            $input['commitment'] = 'fixed';

        if($request->hasFile('image')){
            $image = $request->image;
            $file_name = ($fixed_identity.time()).'.'.$image->extension();
            $image->storeAs('public/storage/'.$fixed_identity.'/employee',$file_name);
            $input['image'] = $file_name;
        }

        CoachingEmployee::create($input);

        if ($request->role == 'teacher') {
            //count total number of teacher or find last inserted teacher serial
            $teacher = CoachingCounter::select(['teacher_count'])->where('inst_identity',$fixed_identity)->first();
            CoachingCounter::select(['teacher_count'])->where('inst_identity',$fixed_identity)->update(['teacher_count'=> ++$teacher->teacher_count]);
        }

        session()->flash('message','Employee added successfully');
        return redirect()->route('coaching-employees.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['employee'] = CoachingEmployee::findBySlugOrFail($id);


        //Institution Fixed identity
        $fixed_identity = auth()->user()->FI;
        //barrier for others 
        if($fixed_identity !== $data['employee']->inst_identity){
            session()->flash('message','Invalid entry checking.');
            return redirect()->back();
        }
        
        return view('backend.coaching.employee.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $fixed_identity = auth()->user()->FI;
        $valid = Validator::make($request->all(),[
            'name' => 'required',
            'salary' => 'required|digits_between:1,10',
            'commitment' => 'required',
            'phone' => 'required|regex:/(8801)[0-9]{9}/',
            'image' => 'image|mimes:png,jpeg|max:50',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }   
        $input = $request -> only(['name','phone','salary','commitment','image']);

        if($request->hasFile('image')){
            $image = $request->image;
            $file_name = ($fixed_identity.time()).'.'.$image->extension();
            $image->storeAs('public/storage/'.$fixed_identity.'/employee',$file_name);
            $input['image'] = $file_name;
        }
        $employee = CoachingEmployee::findBySlugOrFail($id);
        
        $employee -> update($input);

        session()->flash('message','Correction successful.');
        return redirect()->route('coaching-employees.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = CoachingEmployee::findBySlugOrFail($id);


        //Institution Fixed identity
        $fixed_identity = auth()->user()->FI;
        //barrier for others 
        if($fixed_identity !== $employee->inst_identity){
            session()->flash('message','Invalid entry checking.');
            return redirect()->back();
        }
        
        if(!empty($employee->image))
            unlink(storage_path('app/public/storage/'.$employee->inst_identity.'/employee/'.$employee->image));

        $employee -> delete();
        session()->flash('message','@'.$employee->name.' --- Deleted Permanently');
        return redirect()->route('coaching-employees.index');
    }
}
