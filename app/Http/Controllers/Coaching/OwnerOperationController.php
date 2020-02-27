<?php

namespace App\Http\Controllers\Coaching;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coaching\CoachingOwner;
use App\Models\Coaching\CoachingCounter;
use Validator;

class OwnerOperationController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fixed_identity = auth()->user()->FI;

        $data['owners'] = CoachingOwner::where('inst_identity',$fixed_identity)
            ->get();
            
        return view('backend.coaching.owner.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.coaching.owner.create');
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
            'position' => 'required',
            'email' => 'required',
            'phone' => 'required|regex:/(8801)[0-9]{9}/',
            'message' => 'required',
            'image' => 'image|mimes:png,jpeg|max:50'
        ]);

        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $input = $request -> except(['_token']);

        $input['inst_identity'] = $fixed_identity;
        
        if($request->hasFile('image')){
            $image = $request->image;
            $file_name = ($fixed_identity.time()).'.'.$image->extension();
            $image->storeAs('public/storage/'.$fixed_identity.'/owner',$file_name);
            $input['image'] = $file_name;
        }

        CoachingOwner::create($input);

        $owner = CoachingCounter::select(['owner_count'])->where('inst_identity',$fixed_identity)->first();
        CoachingCounter::select(['owner_count'])->where('inst_identity',$fixed_identity)->update(['owner_count'=> ++$owner->owner_count]);

        session()->flash('message','Owner registered successfully');
        return redirect()->route('coaching-owners.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['owner'] = CoachingOwner::findBySlugOrFail($id);


        //Institution Fixed identity
        $fixed_identity = auth()->user()->FI;
        //barrier for others 
        if($fixed_identity !== $data['owner']->inst_identity){
            session()->flash('message','Invalid entry checking.');
            return redirect()->back();
        }
        

        return view('backend.coaching.owner.edit',$data);
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
            'position' => 'required',
            'phone' => 'required|regex:/(8801)[0-9]{9}/',
            'message' => 'required',
        ]);
        
        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $input = $request -> only(['name','position','phone','message']);
        $owner = CoachingOwner::findOrFail($id);
        $owner -> update($input);

        session()->flash('message','Updated record successfully.');
        return redirect()->route('coaching-owners.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $owner = CoachingOwner::findBySlugOrFail($id);


        //Institution Fixed identity
        $fixed_identity = auth()->user()->FI;
        //barrier for others 
        if($fixed_identity !== $owner->inst_identity){
            session()->flash('message','Invalid entry checking.');
            return redirect()->back();
        }
        
        if(!empty($owner->image))
            unlink(storage_path('app/public/storage/'.$owner->inst_identity.'/owner/'.$owner->image));

        $owner -> delete();
        session()->flash('message','@'.$owner->name.' --- Deleted Permanently');
        return redirect()->route('coaching-owners.index');
    }
}
