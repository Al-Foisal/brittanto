<?php

namespace App\Http\Controllers\Coaching;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coaching\CoachingSection;

class allJsRequest extends Controller
{
    public function findSectionUnderClass(Request $request)
    {
    	$fixed_identity = auth()->user()->FI;
        $select = $request->get('select');
        $value = $request->get('value');
        $dependent = $request->get('dependent');

        $data = CoachingSection::where($select, $value)
        ->where('inst_identity',$fixed_identity)
        ->get();
        $output = '<option value="">Select '.ucfirst($dependent).'</option>';
        foreach($data as $row)
        {
        	$output .= '<option value="'.$row->name.'">'.$row->name.'|'.$row->gender.'|'.$row->start_time.'|'.$row->section_type.'</option>';
        }
        echo $output;
    }
}
