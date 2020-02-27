<?php

namespace App\Http\Controllers\Coaching\Fornt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator,DB;
use App\Models\Coaching\Fornt\CoachingForntEducationalSolution;

class EducationalSolution extends Controller
{
    function ES_index()
    {
        return view('backend.coaching.fornt.ES.solution');
    }

    function ES_fetch_data(Request $request)
    {
        $fixed_identity = auth()->user()->FI;
        if($request->ajax())
        {
            $data = CoachingForntEducationalSolution::where('inst_identity',$fixed_identity)->orderBy('id','asc')->limit(3)->get();
            echo json_encode($data);
        }
    }

    function ES_add_data(Request $request)
    {
        $fixed_identity = auth()->user()->FI;
        if($request->ajax())
        {
            $data = array(
                'solution_title'    =>  $request->solution_title,
                'description'     =>  $request->description,
                'inst_identity' => $fixed_identity,
            );
            $id = CoachingForntEducationalSolution::insert($data);
            if($id > 0)
            {
                echo '<div class="alert alert-success">Data Inserted</div>';
            }
        } 
    }

    function ES_update_data(Request $request)
    {
        $fixed_identity = auth()->user()->FI;
        if($request->ajax())
        {
            $data = array(
                $request->column_name       =>  $request->column_value
            );
            DB::table('coaching_fornt_educational_solutions')
                ->where('id', $request->id)
                ->where('inst_identity',$fixed_identity)
                ->update($data);
            echo '<div class="alert alert-success">Data Updated</div>';
        }
    }

    function ES_delete_data(Request $request)
    {
        $fixed_identity = auth()->user()->FI;
        if($request->ajax())
        {
            CoachingForntEducationalSolution::where('id', $request->id)
                ->where('inst_identity',$fixed_identity)
                ->delete();
            echo '<div class="alert alert-success">Data Deleted</div>';
        }
    }
}
