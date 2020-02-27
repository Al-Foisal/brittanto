<?php

namespace App\Http\Controllers\Coaching;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coaching\CoachingProceed;
use App\Models\Coaching\CoachingStudent;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\DB;
class ProceedOperationController extends Controller
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
        $data['user'] = User::select(['name','address'])->where('FI',$fixed_identity)->first();
        $data['receipt'] = CoachingProceed::where('inst_identity',$fixed_identity)->orderBy('id','desc')->first();
        // $data['receipts_total'] = DB::table('coaching_proceeds')
        //      ->select(DB::raw('first_money + second_money + third_money + fourth_money + fifth_money'))->where('inst_identity',$fixed_identity)->get();
        $f = new \NumberFormatter( locale_get_default(), \NumberFormatter::SPELLOUT );

        $data['words'] = $f->format(1212);
        return view('backend.coaching.proceed.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.coaching.proceed.create');
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
            'first_input_title' => 'required',
            'first_money' => 'required',
            'second_input_title' => 'required',
            'second_money' => 'required',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->withErrors($valid)->withInput();
        }

        $input = $request -> except(['_token']);

        $input['inst_identity'] = auth()->user()->FI;


        CoachingProceed::create($input);
        session()->flash('message','New Money Receipt Created successfully');
        return redirect()->route('coaching-proceeds.index');
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
        //
    }
}
