<?php

namespace App\Http\Controllers\Coaching;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coaching\CoachingSection;
use Validator;

class SectionOperationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fixed_identity = auth()->user()->FI;

        $data['sections'] = CoachingSection::where('inst_identity',$fixed_identity)->orderBy('name','asc')->get();
        return view('backend.coaching.section.index',$data);
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
        $next_section = CoachingSection::select(['id','name'])->where('inst_identity',$fixed_identity)->orderBy('id','desc')->first();

        if($next_section)
            $data['focus'] = substr($next_section->name,4)+1;
        else
            $data['focus'] = 1;

        return view('backend.coaching.section.create',$data);
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
            'gender' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'type' => 'required',
            'class' => 'required',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $input = $request -> except(['_token']);

        $input['inst_identity'] = auth()->user()->FI;
        $abbreviation = auth()->user()->abbreviation;
        $input['name'] = $abbreviation[0].'-'.str_pad($input['class'],2,0,STR_PAD_LEFT).$request->input('name');

        //$date = date('h:i:s a', strtotime($mysql_column['time']));
        $input['start_time'] = date('h:i:s a', strtotime($input['start_time']));
        $input['end_time'] = date('h:i:s a', strtotime($input['end_time']));

        CoachingSection::create($input);
        session()->flash('message','New section created successfully');
        return redirect()->route('coaching-sections.index');
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
        $data = [];

        $data['section'] = CoachingSection::findBySlugOrFail($id);

        //Institution Fixed identity
        $fixed_identity = auth()->user()->FI;

        //barrier for others 
        if($fixed_identity !== $data['section']->inst_identity){
            session()->flash('message','Invalid entry checking.');
            return redirect()->back();
        }

        return view('backend.coaching.section.edit',$data);
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
            'gender' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'type' => 'required',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }
        
        $input = $request -> only(['gender','type','start_time','end_time','hint']);
        
        //$date = date('h:i:s a', strtotime($mysql_column['time']));
        $input['start_time'] = date('h:i:s a', strtotime($request->start_time));
        $input['end_time'] = date('h:i:s a', strtotime($request->end_time));

        
        $section = CoachingSection::findBySlugOrFail($id);
        
        $section -> update($input);

        session()->flash('message','Correction successful.');
        return redirect()->route('coaching-sections.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {/*
        $section = CoachingSection::findBySlugOrFail($id);


        //Institution Fixed identity
        $fixed_identity = auth()->user()->FI;
        //barrier for others 
        if($fixed_identity !== $section->inst_identity){
            session()->flash('message','Invalid entry checking.');
            return redirect()->back();
        }
        

        $section -> delete();
        session()->flash('message','@'.$section->name.' --- Deleted Permanently');
        return redirect()->route('coaching-sections.index');*/
    }
}
