<?php

namespace App\Http\Controllers\Coaching;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coaching\CoachingExamTitle;
use App\Models\Coaching\CoachingExamSectionSubject;
Use Validator;

class ExaminationTitleController extends Controller
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
        $data['exam'] = CoachingExamTitle::where('inst_identity',$fixed_identity)->orderBy('id','desc')->get();
         return view('backend.coaching.exam.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fixed_identity = auth()->user()->FI;
        $data = [];
        $next_title = CoachingExamTitle::select(['id','exam_title'])->where('inst_identity',$fixed_identity)->orderBy('id','desc')->first();
        if(empty($next_title)) 
            $title = 1;
        else 
            $title = substr($next_title->exam_title,5)+1; //generate test number
        $data['focus'] = str_pad($title,2,0,STR_PAD_LEFT);
        return view('backend.coaching.exam.create',$data);
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
            'exam_title' => 'required',
            'exam_date' => 'required',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $input = $request -> except(['_token']);

        //Institution Fixed identity
        $fixed_identity = auth()->user()->FI;
        
        $input['inst_identity'] = $fixed_identity;
        
        $input['start_time'] = date('h:i:s a', strtotime($input['start_time']));

        CoachingExamTitle::create($input);
        session()->flash('message','Examination Title added successfully');
        return redirect()->route('coaching-exam-titles.index');
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
        $exam = CoachingExamTitle::findBySlugOrFail($id);

        //Institution Fixed identity
        $fixed_identity = auth()->user()->FI;

        //barrier for others 
        if($fixed_identity !== $exam->inst_identity){
            session()->flash('message','Invalid entry checking.');
            return redirect()->back();
        }
        
        $exam -> delete();

        //delete subjects when test title is deleted
        $subjects = CoachingExamSectionSubject::where([
            'exam_title' => $exam->exam_title,
            'inst_identity' => $fixed_identity
        ])->get();
        
        foreach ($subjects as $subject) {
            $subject->delete();
        }

        session()->flash('message','@'.$exam->exam_title.' --- Deleted with respective subjects');
        return redirect()->route('coaching-exam-titles.index');
    }
}
