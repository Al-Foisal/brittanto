<?php

namespace App\Http\Controllers\Coaching;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coaching\CoachingStudent;
use App\Models\Coaching\CoachingPaidReceipt;
use App\Models\User;
use App\Models\Coaching\CoachingPdf;
use Illuminate\Support\Facades\Crypt; //for encription and decription
use PDF;
class PdfGeneratorController extends Controller
{
    public function getStudentPdf($student)
    {
    	$fixed_identity = auth()->user()->FI;
    	$student_id = $student;

    	$pdf = \App::make('dompdf.wrapper');

    	$student = CoachingStudent::where('std_id',$student_id)
    				->where('inst_identity',$fixed_identity)
    				->first();
    	$receipts = CoachingPaidReceipt::where('std_id',$student_id)
    				->where('inst_identity',$fixed_identity)
    				->get();
    	$output ='
<h3 style="text-align:center;">'. auth()->user()->name .'</h3> 
<p style="text-align:center;">'. auth()->user()->address .'</p>
        <hr>
<div class="row">
<div class="col-md-12 grid-margin stretch-card">
<div class="card">
<div class="card-body" >
<p class="card-title mb-0"> Student Details</p>
<div class="table-responsive">
    <table class="table table-hover table-bordered" style="border: 1px solid; padding:12px;width:100%;text-transform: capitalize;">
        <tr>
            <th style="text-align:right;">full name:</th>
            <td>'.$student->name.'</td>
            <th style="text-align:right;">school name:</th>
            <td>'.$student->school_name.'</td>
        </tr>
        <tr>
            <th style="text-align:right;">student ID:</th>
            <td>'. $student->std_id .'</td>
            <th style="text-align:right;">class:</th>
            <td>'. $student->amd_class .'</td>
        </tr>
        <tr>
            <th style="text-align:right;">admitted as:</th>
            <td>'. $student->admission_type .'</td>
            <th style="text-align:right;">class roll:</th>
            <td>'. $student->class_roll .'</td>
        </tr>
        <tr>
            <th style="text-align:right;">tution fee:</th>
            <td>'. $student->tution_fee .'</td>
            <th style="text-align:right;">address:</th>
            <td>'. $student->address .'</td>
        </tr>
        <tr>
            <th style="text-align:right;">guardian name:</th>
            <td>'. $student->guardian_name .'</td>
            <th style="text-align:right;">guardian phone:</th>
            <td>'. $student->grd_phone .'</td>
        </tr>
        <tr>
            <th style="text-align:right;">student phone:</th>
            <td>'. $student->std_phone .'</td>
            <th style="text-align:right;">commitment:</th>
            <td>'. $student->commitment .'</td>
        </tr>
        <tr>
            <th style="text-align:right;">reference:</th>
            <td>'. $student->reference .'</td>
            <th style="text-align:right;">section:</th>
            <td>'. $student->section.'</td>
        </tr>
        <tr>
            <th style="text-align:right;">admission date:</th>
            <td>'. $student->created_at .'</td>
        </tr>
    </table>
</div>
</div>
</div>
</div>
</div>


<div style="margin-top:50px;">
<div class="col-md-12 grid-margin stretch-card">
<div class="card">
<div class="card-body" >
<p class="card-title mb-0">
    Receipt Details
</p> <hr>
<div class="table-responsive">
    <table style="width:100%;border: 1px solid;">
        <thead style="border: 1px solid;">
            <tr>
                <th>Student Name</th>
                <th>Student ID</th>
                <th>Class</th>
                <th>Admitted as</th>
                <th>Batch</th>
                <th>Total Paid</th>
                <th>Serial</th>
                <th>Deposit</th>
            </tr>
        </thead>';
        
            foreach($receipts as $receipt):
            $output .='<tbody style="border-bottom: 1px solid;">
            <tr style="border-bottom: 1px solid;">
                <td>'. $receipt->name .'</td>
                <td>'. $receipt->std_id .'</td>
                <td>'. 'Class - '.$receipt->amd_class .'</td>
                <td>'. $receipt->admission_type .'</td>
                <td>'. $receipt->section .'</td>
                <td>'. $receipt->total_paid .'</td>
                <td>'. $receipt->receipt_serial .'</td>
                <td>'. $receipt->created_at .'</td>
            </tr>
            </tbody>';
            endforeach;
            $output .='      
        
    </table>
</div>
</div>
</div>
</div>
</div>

    	';
    	$pdf->loadHTML($output);
    	return $pdf->stream();
    }

    public function getStudentAttendenceSheetPdf($attendence)
    {
        $get_data = Crypt::decrypt($attendence);
        $get_class = $get_data["class"];
        $get_section_name = $get_data["section_name"];
        $get_section_type = $get_data["section_type"];

        $fixed_identity = auth()->user()->FI;
        $pdf = \App::make('dompdf.wrapper');

        $institution = User::where('FI',$fixed_identity)->first();
        $classes = CoachingStudent::select(['name','std_id'])->where([
            'amd_class' => $get_class,
            'section' => $get_section_name,
            'inst_identity' => $fixed_identity,
        ])->get();
        
$output ='
<div style="margin:-20 0 70px 0">
            <h2 style="font-weight:bold;text-align:center;">'.$institution->name.'</h2>
            <h4 style="font-weight:bold;text-align:center;line-height:0;">'.$institution->address.'</h4>
            <h4 style="font-weight:bold;text-align:center;">Class: '.$get_class.' | Section: '.$get_section_name.' | Type: '.$get_section_type.'</h4>
            <hr>
        </div>
            <table style="border:0 1px 0 1px solid;width:100%;border-top:none;">
                <thead style="border-bottom:1px: solid;">
                    <tr>
                        <th style="width:15%;border-right:1px solid;">Student Name</th>
                        <th style="width:12%;border-right:1px solid;">Student ID</th>';
                        for($i=1; $i<=32; $i++):
                        $output .='
                        <td style="width:2%;border-right:1px solid;"></td>';
                        endfor;
                $output .= '
                        <th>Action</th>
                    </tr>
                </thead>';
                
                    foreach($classes as $class):
                $output .= '
                <tbody style="border-bottom:1px: solid;">
                    <tr>
                        <td style="width:15%;border-right:1px solid;">'. $class->name .'</td>
                        <td style="width:12%;border-right:1px solid;">'. $class->std_id .'</td>';
                        for($i=1; $i<=32; $i++):
                        $output .='
                        <td style="width:2%;border-right:1px solid;"></td>';
                        endfor;
                $output .= '
                <td>eee</td>
                    </tr>
                </tbody>';
                    endforeach; 
            $output .=' 
            </table>
            <p style="text-align:right;">'.date("D-M-Y").'</p>

';

        $pdf->loadHTML($output);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream();
    }
}
