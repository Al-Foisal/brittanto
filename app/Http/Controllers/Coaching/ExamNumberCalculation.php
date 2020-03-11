<?php

namespace App\Http\Controllers\Coaching;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coaching\CoachingStudent;
use App\Models\Coaching\CoachingExamTitle;
use App\Models\Coaching\CoachingSubjectList;
use App\Models\Coaching\CoachingExamSectionSubject;
use App\Models\Coaching\CoachingMark;
use Validator;
use Illuminate\Support\Facades\Crypt; //for encription and decription
use DB;

class ExamNumberCalculation extends Controller
{
    public function showNumberArea($id)
    {
        $fixed_identity = auth()->user()->FI;

        $data = [];

        //select subject of a test from given id
        $data['exam'] = $examination = CoachingExamSectionSubject::findBySlugOrFail($id);

        //select all the student under a class and section
        $data['students'] = CoachingStudent::select(['name','std_id'])
                        ->where('amd_class', $examination->class)
                        ->where('section', $examination->section)
                        ->where('inst_identity', $examination->inst_identity)
                        ->get();

        return view('backend.coaching.exam.exam_number_area',$data);
    }

    public function storeNumberArea(Request $request, $id)
    {
        $exam = CoachingExamSectionSubject::findBySlugOrFail($id);
        //$title_id to reach (exam.section.subject_show) route
        $title_id = CoachingExamTitle::where('exam_title',$exam->exam_title)->where('inst_identity',$exam->inst_identity)->first();

        foreach ($request->input('student_name') as $key => $name) {
            if($request->mark[$key] > $exam->mark){
                session()->flash('message','Invalid mark '.$request->mark[$key].' out of '.$exam->mark.' for serial '.++$key);
                return back();
            }
        }
        //Institution Fixed identity
        $fixed_identity = auth()->user()->FI;
    	foreach ($request->input('student_name') as $key => $name) {

            $input = $request -> except(['_token']);
            $input = [
                [

                    'student_name' => $request->student_name[$key],
                    'student_id' => $request->student_id[$key],
                    'mark' => $request->mark[$key],
                    'section' => $request->section[$key],
                    'exam_title' => $request->exam_title[$key],
                    'subject' => $request->subject[$key],
                    'class' => $request->class[$key],
                    'defined_mark' => $request->defined_mark[$key],
                    'inst_identity' => $request->inst_identity[$key],
                    'created_at' => now(),
                    'updated_at' => now(),

                ],
            ];

            DB::table('coaching_marks')->insert($input);

        }

            session()->flash('message','Marks stored');
            return redirect()->route('exam.section.subject_show',$title_id);
    }

    public function detailNumberArea($id)
    {
        $data = [];
        
        $data['exam'] = $test = CoachingExamSectionSubject::findBySlugOrFail($id);

        // print all by distinct year
        $data['subject_number'] = CoachingMark::where([
            'section' => $test->section,
            'subject' => $test->subject,
            'inst_identity' => $test->inst_identity,
        ])->whereYear('created_at',$test->created_at)->get();

        return view('backend.coaching.exam.exam_number_details',$data);
    }

    public function editNumberArea($id)
    {
        $data = [];
        $data['number'] = CoachingMark::findBySlugOrFail($id);
        return view('backend.coaching.exam.exam_number_edit',$data);
    }

    public function updateNumberArea(Request $request, $id)
    {
        $valid = Validator::make($request->all(),[
            'mark' => 'required'            
        ]);

        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $input = $request -> only(['mark']);
        $number = CoachingMark::findBySlugOrFail($id);

        if ($number->defined_mark < $request->input(['mark'])) {
            session()->flash('message','Invalid mark entry '.$request->input(['mark']).' out of '.$number->defined_mark);
            return redirect()->back();
        }
        $number->update($input);

        //$title_id to reach (exam.section.subject_show) route
        $title_id = CoachingExamSectionSubject::where([
                                                    'inst_identity' => $number->inst_identity,
                                                    'class' => $number->class ,
                                                    'section' => $number->section,
                                                    'subject' => $number->subject,
                                                ])->first();
                                                

        session()->flash('message','Marks updated for @'.$number->student_name);
        return redirect()->route('exam.number.area_detail',$title_id);
    }

    public function showExamSectionSubject($title_id)
    {
        $id = CoachingExamTitle::findBySlugOrFail($title_id);
        $data = [];
        $data['exam_title'] = $id->exam_title;
        $data['lists'] = CoachingSubjectList::orderBy('subject_name','asc')->get();

        return view('backend.coaching.exam.exam_section_subject',$data);
    }

    public function storeExamSectionSubject(Request $request)
    {
        $valid = Validator::make($request->all(),[
            'class' => 'required|digits_between:1,2',
            'section' => 'required',
            'subject' => 'required',
            'Mark' => 'required|max:3',
            'exam_title' => 'required',
            
        ]);

        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $input = $request -> except(['_token']);

        //Institution Fixed identity
        $fixed_identity = auth()->user()->FI;

        $input['inst_identity'] = $fixed_identity;

        $check = CoachingExamSectionSubject::select('subject')
            ->where([
                'subject' => $request->subject,
                'section' => $request->section,
                'exam_title' => $request->exam_title,
                'inst_identity' => $fixed_identity
            ])->first();
        if ($check) {
            session()->flash('message',$request->subject.' duplicate entry for batch '.$request->section);
            return back();
        }
        CoachingExamSectionSubject::create($input);
        session()->flash('message','Exam subject save successfully.');
        return redirect()->back();
    }

    public function deleteExamSectionSubject($id)
    {
        $exam_section = CoachingExamSectionSubject::findBySlugOrFail($id);


        //Institution Fixed identity
        $fixed_identity = auth()->user()->FI;
        //barrier for others 
        if($fixed_identity !== $exam_section->inst_identity){
            session()->flash('message','Invalid entry checking.');
            return redirect()->back();
        }

        $exam_section -> delete();
        session()->flash('message','@'.$exam_section->name.' --- Deleted Permanently');
        return redirect()->back();
    }
}
