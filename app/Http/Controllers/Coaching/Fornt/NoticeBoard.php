<?php

namespace App\Http\Controllers\Coaching\Fornt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coaching\Fornt\CoachingForntNoticeBoard;
use Validator,DB,Storage;


class NoticeBoard extends Controller
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
        $data['notices'] = CoachingForntNoticeBoard::where('inst_identity',$fixed_identity)->get();
        return view('backend.coaching.fornt.NB.index_notice',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.coaching.fornt.NB.create_notice');
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
            'notice_title' => 'required',
            'notice_content' => 'mimes:pdf|max:1024',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $input = $request -> except(['_token']);

        $input['inst_identity'] = $fixed_identity;
        
        if($request->hasFile('notice_content')){
            $notice_content = $request->notice_content;
            $file_name = ($fixed_identity.time()).'.'.$notice_content->extension();
            $notice_content->storeAs('public/storage/'.$fixed_identity.'/notice',$file_name);
            $input['notice_content'] = $file_name;
        }

        CoachingForntNoticeBoard::create($input);
        session()->flash('message','New Notice Created successfully');
        return redirect()->route('notice-boards.index');
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
        $notice = CoachingForntNoticeBoard::findBySlugOrFail($id);

        //Institution Fixed identity
        $fixed_identity = auth()->user()->FI;
        //barrier for others 
        if($fixed_identity !== $notice->inst_identity){
            session()->flash('message','Invalid entry checking.');
            return redirect()->back();
        }

        if(!empty($notice->notice_content))
            unlink(storage_path('app/public/storage/'.$notice->inst_identity.'/notice/'.$notice->notice_content));
        $notice -> delete();
        
        session()->flash('message','@'.$notice->notice_title.' --- Deleted Permanently');
        return redirect()->route('notice-boards.index');
    }
}
