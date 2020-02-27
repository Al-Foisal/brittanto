<?php

namespace App\Http\Controllers\Coaching\Fornt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coaching\Fornt\CoachingForntMission;
use Validator,DB;

class MissionAndVision extends Controller
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
        $data['mvs'] = CoachingForntMission::where('inst_identity',$fixed_identity)->get();
        $data['mvc'] = CoachingForntMission::where('inst_identity',$fixed_identity)->count();
        return view('backend.coaching.fornt.MV.index_mv',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.coaching.fornt.MV.create_mv');
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
            'mission_description' => 'required',
            'vision_description' => 'required',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $input = $request -> except(['_token']);

        $input['inst_identity'] = $fixed_identity;

        CoachingForntMission::create($input);
        session()->flash('message','Content added successfully');
        return redirect()->route('mission-and-visions.index');
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
         $data['mv'] = CoachingForntMission::findBySlugOrFail($id);


        //Institution Fixed identity
        $fixed_identity = auth()->user()->FI;
        //barrier for others 
        if($fixed_identity !== $data['mv']->inst_identity){
            session()->flash('message','Invalid entry checking.');
            return redirect()->back();
        }
        

        return view('backend.coaching.fornt.MV.update_mv',$data);
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
            'mission_description' => 'required',
            'vision_description' => 'required',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $input = $request -> except(['_token']);

        $input['inst_identity'] = $fixed_identity;

        $event = CoachingForntMission::findBySlugOrFail($id);
        $event -> update($input);
        session()->flash('message','New content added successfully');
        return redirect()->route('mission-and-visions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
