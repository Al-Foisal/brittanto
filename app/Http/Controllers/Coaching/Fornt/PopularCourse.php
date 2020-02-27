<?php

namespace App\Http\Controllers\Coaching\Fornt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coaching\CoachingCounter;
use App\Models\Coaching\Fornt\CoachingForntPopularCourse;
use App\Models\Coaching\Fornt\CoachingForntPopularCourseFeature;
use Validator,DB;

class PopularCourse extends Controller
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
        $data['courses'] = CoachingForntPopularCourse::where('inst_identity',$fixed_identity)->get();
        return view('backend.coaching.fornt.PC.index_course',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.coaching.fornt.PC.create_course');
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
            'course_title' => 'required',
            'course_banar' => 'image|mimes:png,jpeg|max:500',
            'course_label' => 'required',
            'total_seat' => 'required|digits_between:1,5',
            'course_duration' => 'required',
            'course_fee' => 'required|digits_between:2,5',
            'course_description' => 'required',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $input = $request -> except(['_token']);

        $input['inst_identity'] = $fixed_identity;
        
        if($request->hasFile('course_banar')){
            $course_banar = $request->course_banar;
            $file_name = ($fixed_identity.time()).'.'.$course_banar->extension();
            $course_banar->storeAs('public/storage/'.$fixed_identity.'/course',$file_name);
            $input['course_banar'] = $file_name;
        }

        CoachingForntPopularCourse::create($input);

        $course = CoachingCounter::select(['course_count'])->where('inst_identity',$fixed_identity)->first();
        CoachingCounter::select(['course_count'])->where('inst_identity',$fixed_identity)->update(['course_count'=> ++$course->course_count]);

        session()->flash('message','New Course Created successfully');
        return redirect()->route('popular-courses.index');
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
        $data['course'] = CoachingForntPopularCourse::findBySlugOrFail($id);


        //Institution Fixed identity
        $fixed_identity = auth()->user()->FI;
        //barrier for others 
        if($fixed_identity !== $data['course']->inst_identity){
            session()->flash('message','Invalid entry checking.');
            return redirect()->back();
        }
        

        return view('backend.coaching.fornt.PC.update_course',$data);
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
        $fixed_identity = auth()->user()->FI;
        
        $valid = Validator::make($request->all(),[
            'course_title' => 'required',
            'course_banar' => 'image|mimes:png,jpeg|max:500',
            'course_label' => 'required',
            'total_seat' => 'required|digits_between:1,5',
            'course_duration' => 'required',
            'course_fee' => 'required|digits_between:2,5',
            'course_description' => 'required',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $input = $request -> except(['_token']);

        $input['inst_identity'] = $fixed_identity;
        
        if($request->hasFile('course_banar')){
            $course_banar = $request->course_banar;
            $file_name = ($fixed_identity.time()).'.'.$course_banar->extension();
            $course_banar->storeAs('public/storage/'.$fixed_identity.'/course',$file_name);
            $input['course_banar'] = $file_name;
        }
        $course = CoachingForntPopularCourse::findBySlugOrFail($id);
        $course -> update($input);

        session()->flash('message','Updated record successfully.');
        return redirect()->route('popular-courses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $course = CoachingForntPopularCourse::findBySlugOrFail($id);


        //Institution Fixed identity
        $fixed_identity = auth()->user()->FI;
        //barrier for others 
        if($fixed_identity !== $course->inst_identity){
            session()->flash('message','Invalid entry checking.');
            return redirect()->back();
        }
        
        if(!empty($course->course_banar))
            unlink(storage_path('app/public/storage/'.$course->inst_identity.'/course/'.$course->course_banar));
        
        $course -> delete();

        //delete subjects when test title is deleted
        $course_features = CoachingForntPopularCourseFeature::where([
            'course_id' => $course->id,
            'inst_identity' => $fixed_identity
        ])->get();
        
        foreach ($course_features as $course_feature) {
            $course_feature->delete();
        }

        session()->flash('message','@'.$course->course_title.' --- Deleted Permanently');
        return redirect()->route('popular-courses.index');
    }

    public function createCourseCategory($id)
    {
        $data = [];
        $data['course_data'] = CoachingForntPopularCourse::findBySlugOrFail($id);
        return view('backend.coaching.fornt.PC.create_course_category',$data);
    }

    public function storeCourseCategory(Request $request)
    {
         $request->validate([
            'createCourseCategory.*.course_id' => 'required',
            'createCourseCategory.*.course_category_title' => 'required',
            'createCourseCategory.*.course_category_value' => 'required',
            'createCourseCategory.*.course_category_value' => 'required',
        ]);
    
        foreach ($request->createCourseCategory as $key => $value) {
            CoachingForntPopularCourseFeature::create($value);
        }
        
        session()->flash('message','Category added.');
        return redirect()->route('popular-courses.index');
    }

    public function deleteCourseCategory($id)
    {
        $course_category = CoachingForntPopularCourseFeature::findBySlugOrFail($id);


        //Institution Fixed identity
        $fixed_identity = auth()->user()->FI;
        //barrier for others 
        if($fixed_identity !== $course_category->inst_identity){
            session()->flash('message','Invalid entry checking.');
            return redirect()->back();
        }
        

        $course_category -> delete();
        session()->flash('message','@'.$course_category->course_category_title.' --- Deleted Permanently');
        return redirect()->route('popular-courses.index');
    }
}
