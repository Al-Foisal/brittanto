<?php

namespace App\Http\Controllers\Coaching;

use App\Http\Controllers\Controller;
use App\Models\Coaching\CoachingSubjectList;
use Illuminate\Http\Request;
use Validator;

class SubjectListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = [];
        // $data['subjects'] = CoachingSubjectList::where('inst_identity',auth()->user()->FI)->orderBy('id','desc')->get();
        // return view('backend.coaching.subject.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.coaching.subject.create');
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
            'subject_name' => 'required',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $input = $request -> except(['_token']);
        $input['subject_name'] = $subject_name = strtoupper(trim($request->subject_name));

        $duplicate = CoachingSubjectList::where('inst_identity',auth()->user()->FI)->where('subject_name',$subject_name)->first();
        if($duplicate){
            session()->flash('message','Duplicate entery!!');
            return redirect()->back();
        }
        $input['inst_identity'] = auth()->user()->FI;
        CoachingSubjectList::create($input);
        session()->flash('message','Subject created successfully!!');
        return redirect()->back();
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject = CoachingSubjectList::findBySlugOrFail($id);


        //Institution Fixed identity
        $fixed_identity = auth()->user()->FI;
        //barrier for others 
        if($fixed_identity !== $subject->inst_identity){
            session()->flash('message','Invalid entry checking.');
            return redirect()->back();
        }

        $subject -> delete();
        session()->flash('message','@'.$subject->subject_name.' --- Deleted Permanently');
        return redirect()->route('subject-lists.create');
    }
}
