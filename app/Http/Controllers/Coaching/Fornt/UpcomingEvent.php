<?php

namespace App\Http\Controllers\Coaching\Fornt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coaching\CoachingCounter;
use App\Models\Coaching\Fornt\CoachingForntUpcomingEvent;
use App\Models\Coaching\Fornt\CoachingForntUpcomingEventFeature;

use Validator,DB;

class UpcomingEvent extends Controller
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
        $data['events'] = CoachingForntUpcomingEvent::where('inst_identity',$fixed_identity)->get();
        return view('backend.coaching.fornt.UE.index_event',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.coaching.fornt.UE.create_event');
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
            'event_title' => 'required|max:56',
            'event_banar' => 'image|mimes:png,jpeg|max:500',
            'event_date' => 'required',
            'event_start' => 'required',
            'event_end' => 'required',
            'event_description' => 'required',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $input = $request -> except(['_token']);

        $input['inst_identity'] = $fixed_identity;
        
        if($request->hasFile('event_banar')){
            $event_banar = $request->event_banar;
            $file_name = ($fixed_identity.time()).'.'.$event_banar->extension();
            $event_banar->storeAs('public/storage/'.$fixed_identity.'/event',$file_name);
            $input['event_banar'] = $file_name;
        }

        $input['event_start'] = date('h:i:s a', strtotime($input['event_start']));
        $input['event_end'] = date('h:i:s a', strtotime($input['event_end']));

        CoachingForntUpcomingEvent::create($input);

        $event = CoachingCounter::select(['event_count'])->where('inst_identity',$fixed_identity)->first();
        CoachingCounter::select(['event_count'])->where('inst_identity',$fixed_identity)->update(['event_count'=> ++$event->event_count]);

        session()->flash('message','New Event Created successfully');
        return redirect()->route('upcoming-events.index');
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
        $data['event'] = CoachingForntUpcomingEvent::findBySlugOrFail($id);


        //Institution Fixed identity
        $fixed_identity = auth()->user()->FI;
        //barrier for others 
        if($fixed_identity !== $data['event']->inst_identity){
            session()->flash('message','Invalid entry checking.');
            return redirect()->back();
        }
        

        return view('backend.coaching.fornt.UE.update_event',$data);
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
            'event_title' => 'required|max:56',
            'event_banar' => 'image|mimes:png,jpeg|max:500',
            'event_date' => 'required',
            'event_start' => 'required',
            'event_end' => 'required',
            'event_description' => 'required',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $input = $request -> except(['_token']);

        $input['inst_identity'] = $fixed_identity;
        
        if($request->hasFile('event_banar')){
            $event_banar = $request->event_banar;
            $file_name = ($fixed_identity.time()).'.'.$event_banar->extension();
            $event_banar->storeAs('public/storage/'.$fixed_identity.'/event',$file_name);
            $input['event_banar'] = $file_name;
        }

        $input['event_start'] = date('h:i:s a', strtotime($input['event_start']));
        $input['event_end'] = date('h:i:s a', strtotime($input['event_end']));

        $event = CoachingForntUpcomingEvent::findBySlugOrFail($id);
        $event -> update($input);
        session()->flash('message','New Event Updated successfully');
        return redirect()->route('upcoming-events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = CoachingForntUpcomingEvent::findBySlugOrFail($id);


        //Institution Fixed identity
        $fixed_identity = auth()->user()->FI;
        //barrier for others 
        if($fixed_identity !== $event->inst_identity){
            session()->flash('message','Invalid entry checking.');
            return redirect()->back();
        }

        if(!empty($event->course_banar))
            unlink(storage_path('app/public/storage/'.$event->inst_identity.'/event/'.$event->course_banar));

        //delete event_feature when test title is deleted
        $event_features = CoachingForntUpcomingEventFeature::where([
            'event_id' => $event->id,
            'inst_identity' => $fixed_identity
        ])->get();
        
        foreach ($event_features as $event_feature) {
            $event_feature->delete();
        }
        

        $event -> delete();
        session()->flash('message','@'.$event->event_title.' --- Deleted Permanently');
        return redirect()->route('upcoming-events.index');
    }

    public function createEventCategory($id)
    {
        $data = [];
        $data['event_data'] = CoachingForntUpcomingEvent::findBySlugOrFail($id);
        return view('backend.coaching.fornt.UE.create_event_category',$data);
    }

    public function storeEventCategory(Request $request)
    {
         $request->validate([
            'createEventCategory.*.event_id' => 'required',
            'createEventCategory.*.event_category_title' => 'required',
            'createEventCategory.*.event_category_value' => 'required',
            'createEventCategory.*.event_category_value' => 'required',
        ]);
    
        foreach ($request->createEventCategory as $key => $value) {
            CoachingForntUpcomingEventFeature::create($value);
        }
        
        session()->flash('message','Category added.');
        return redirect()->route('upcoming-events.index');
    }

    public function deleteEventCategory($id)
    {
        $event_category = CoachingForntUpcomingEventFeature::findBySlugOrFail($id);


        //Institution Fixed identity
        $fixed_identity = auth()->user()->FI;
        //barrier for others 
        if($fixed_identity !== $event_category->inst_identity){
            session()->flash('message','Invalid entry checking.');
            return redirect()->back();
        }
        

        $event_category -> delete();
        session()->flash('message','@'.$event_category->event_category_title.' --- Deleted Permanently');
        return redirect()->route('upcoming-events.index');
    }
}
