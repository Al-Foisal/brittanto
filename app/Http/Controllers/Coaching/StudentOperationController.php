<?php

namespace App\Http\Controllers\Coaching;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coaching\CoachingStudent;
use App\Models\Coaching\CoachingPaidReceipt;
Use Validator;
use App\Models\User;
use App\Models\Coaching\CoachingCounter;

class StudentOperationController extends Controller
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
        $data['classes'] = CoachingStudent::select(['amd_class'])
                        ->where('inst_identity',$fixed_identity)
                        ->groupBy('amd_class')
                        ->get();

         return view('backend.coaching.student.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $fixed_identity = auth()->user()->FI;

        //total and registered student
        $student_service = auth()->user()->service;
        $student_number = CoachingStudent::select(['id'])
                                ->where('inst_identity',$fixed_identity)
                                ->count();

        $data = [];

        //rest of the student
        $data['student'] = (int)($student_service - $student_number);

        return view('backend.coaching.student.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(),[
            'name' => 'required',
            'amd_class' => 'required|digits_between:1,2',
            'amd_type' => 'required',
            'class_roll' => 'required|digits_between:1,19',
            'tution_fee' => 'required|digits_between:1,19',
            'address' => 'required',
            'guardian_name' => 'required',
            'grd_phone' => 'required|regex:/(8801)[0-9]{9}/',
            'reference' => 'required',
            'section' => 'required',
            'image' => 'image|mimes:png,jpeg|max:50'
        ]);

        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $input = $request -> except(['_token']);

        //Institution Fixed identity
        $fixed_identity = auth()->user()->FI;
        
        //last student serial number for a unique institution
        $last_inserted_std_serial = CoachingStudent::select(['std_serial'])
                                    ->where('amd_class',$request->input(['amd_class']))
                                    ->where('inst_identity',$fixed_identity)
                                    ->orderBy('id', 'DESC')
                                    ->first();

        //making serial number autometically
        if (empty($last_inserted_std_serial->std_serial)) {
            $serial = 1;
        } else {
            $serial = $last_inserted_std_serial->std_serial + 1;
        }

        $class = str_pad($request->input(['amd_class']),2,0,STR_PAD_LEFT);
        $serial = str_pad($serial,3,0,STR_PAD_LEFT);

        //making student ID
        $input['std_id'] = $student_id = date('y').$fixed_identity.$class.$serial;

        $input['std_serial'] = $serial;
        $input['inst_identity'] = $fixed_identity;

        if($request->hasFile('image')){
            $image = $request->image;
            $file_name = ($fixed_identity.time()).'.'.$image->extension();
            $image->storeAs('public/storage/'.$fixed_identity.'/student',$file_name);
            $input['image'] = $file_name;
        }
        


        CoachingStudent::create($input);

        $student = CoachingCounter::select(['student_count'])->where('inst_identity',$fixed_identity)->first();
        CoachingCounter::select(['student_count'])->where('inst_identity',$fixed_identity)->update(['student_count'=> ++$student->student_count]);

        
        session()->flash('message',$student_id);
        return redirect()->route('coaching-students.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [];

        //select student under the get id
        $data['student'] = $student = CoachingStudent::findBySlugOrFail($id);

        //all the paid receipt of this student
        $data['receipts'] = CoachingPaidReceipt::where('std_id',$student->std_id)
                            ->where('inst_identity',auth()->user()->FI)
                            ->get();

        return view('backend.coaching.student.details',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [];

        $data['student'] = CoachingStudent::findBySlugOrFail($id);

        //Institution Fixed identity
        $fixed_identity = auth()->user()->FI;

        //barrier for others 
        if($fixed_identity !== $data['student']->inst_identity){
            session()->flash('message','Invalid entry checking.');
            return redirect()->back();
        }

        return view('backend.coaching.student.edit',$data);
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
        $valid = Validator::make($request->all(),[
            'name' => 'required',
            'amd_type' => 'required',
            'grd_phone' => 'required|regex:/(8801)[0-9]{9}/',
            'tution_fee' => 'required|digits_between:1,19',
            'amd_class' => 'required',
            'section' => 'required',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $input = $request -> only(['name','school_name','amd_type','grd_phone','std_phone','tution_fee','amd_class','section']);

        $student = CoachingStudent::findOrFail($id);
        
        $student -> update($input);

        session()->flash('message','Correction successful.');
        return redirect()->route('coaching-students.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = CoachingStudent::findBySlugOrFail($id);

        //Institution Fixed identity
        $fixed_identity = auth()->user()->FI;
        //barrier for others 
        if($fixed_identity !== $student->inst_identity){
            session()->flash('message','Invalid entry checking.');
            return redirect()->back();
        }

        if(!empty($student->image))
            unlink(storage_path('app/public/storage/'.$student->inst_identity.'/student/'.$student->image));

        $student -> delete();

        session()->flash('message','@'.$student->name.' --- Deleted Permanently From Class '.$student->amd_class);
        return redirect()->route('coaching-students.index');
    }
}
