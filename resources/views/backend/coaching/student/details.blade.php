@extends('layouts.backend')

@section('title') {{ auth()->user()->abbreviation . ' Student Details'}} @stop

@section('css')

<style>

    /** The wrapper that will contain our two forms **/
    .content-wrapper {
        border-left: 5px solid white;
        padding: 1.5rem 0.5rem;
        border-radius: 30px;
    }
    .card{
        border-radius: 5px;
    }

    .table.table-bordered td {
        text-align: left;
        font-size: 20px;
    }
    .table.table-bordered th {
        text-transform: capitalize;
        font-weight: bold;
        text-align: right;
        width: 10%;
    }

    tbody { font-family: 'Ubuntu', sans-serif; }
    /**** Styling the form elements **/

    .card .card-title {
        color: #787878;
        margin-bottom: 1.2rem;
        text-transform: uppercase;
        font-size: 0.975rem;
        font-weight: 500;
    }
    .card .card-title {
        color: #787878;
        margin-bottom: 1.2rem;
        text-transform: uppercase;
        font-size: 0.975rem;
        font-weight: 500;
        font-family: 'Ubuntu', sans-serif;
    }
    .card-title-resize{
        text-align: justify;
        margin: 0 30px;
        border-radius: 4px;
        padding: 10px;
    }

</style>

@stop
@section('foisal')


<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body" >
                <p class="card-title mb-0">

            {{-- back button using js --}}
                    <button onclick="goBack()" class="btn btn-secondary" style="float: left;">
                        Back
                    </button>

                    <b class="card-title-resize">Student Details</b>
                    
                    <a href="{{ route('pdf.student.details',$student->std_id) }}" target="_blank" class="btn btn-secondary" style="float: right;" title="Covert this page into PDF">
                        Download pdf
                    </a>
                </p>
                <hr>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered ">
                        <tr>
                            <th>full name:</th>
                            <td>{{$student->name}}</td>
                            <th>school name:</th>
                            <td>{{ $student->school_name }}</td>
                        </tr>
                        <tr>
                            <th>student ID:</th>
                            <td>{{ $student->std_id }}</td>
                            <th>class:</th>
                            <td>{{ $student->amd_class }}</td>
                        </tr>
                        <tr>
                            <th>admitted as:</th>
                            <td>{{ $student->admission_type }}</td>
                            <th>class roll:</th>
                            <td>{{ $student->class_roll }}</td>
                        </tr>
                        <tr>
                            <th>tution fee:</th>
                            <td>{{ $student->tution_fee }}</td>
                            <th>address:</th>
                            <td>{{ $student->address }}</td>
                        </tr>
                        <tr>
                            <th>guardian name:</th>
                            <td>{{ $student->guardian_name }}</td>
                            <th>guardian phone:</th>
                            <td>{{ $student->grd_phone }}</td>
                        </tr>
                        <tr>
                            <th>student phone:</th>
                            <td>{{ $student->std_phone }}</td>
                            <th>commitment:</th>
                            <td>{{ $student->commitment }}</td>
                        </tr>
                        <tr>
                            <th>reference:</th>
                            <td>{{ $student->reference }}</td>
                            <th>section:</th>
                            <td>{{ $student->section}}</td>
                        </tr>
                        <tr>
                            <th>admission date:</th>
                            <td>{{ date('m/d/Y || h:i:s a', strtotime($student->created_at)) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- student details end --}}

{{-- student money receipt --}}
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body" >
                <p class="card-title mb-0">
                    Receipt Details
                </p> <hr>
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Student ID</th>
                                <th>Class</th>
                                <th>Admitted as</th>
                                <th>Batch</th>
                                <th>Total Paid</th>
                                <th>Serial</th>
                                <th>Deposit</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($receipts as $receipt)
                            <tr>
                                @php
                                //to see receipt details of a student
                                $selfview = [
                                    'proceed_id' => $receipt->proceed_id, 
                                    'std_id' => $receipt->std_id, 
                                ];
                                $selfview = Crypt::encrypt($selfview);
                                @endphp
                                <td>{{ $receipt->name }}</td>
                                <td>{{ $receipt->std_id }}</td>
                                <td>{{ 'Class - '.$receipt->amd_class }}</td>
                                <td>{{ $receipt->admission_type }}</td>
                                <td>{{ $receipt->section }}</td>
                                <td>{{ $receipt->total_paid }}</td>
                                <td>{{ $receipt->receipt_serial }}</td>
                                <td>{{ $receipt->created_at }}</td>
                                <td><a href="{{ route('proceed.selfview',$selfview) }}" class="btn btn-link">Details</a></td>
                            </tr>
                            @endforeach      
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- student money receipt end --}}

{{-- student exam starts --}}
{{-- <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">

            @foreach($test_titles as $title)
            @php 
                $tests = \App\Models\Coaching\CoachingMark::where('exam_title',$title->exam_title)->where('inst_identity',auth()->user()->FI)->get();
            @endphp
            <div class="card-body" >
                <p class="card-title mb-0">
                    {{ $title->exam_title }}
                </p> <hr>
                <div class="table-responsive">
                    <table class="table table-sm table-hover">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Student ID</th>
                                <th>Class</th>
                                <th>Batch</th>
                                <th>Subject</th>
                                <th>Total Marks</th>
                                <th>Obtained Marks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tests as $test)
                            <tr>
                                <td>{{ $test->student_name }}</td>
                                <td>{{ $test->student_id }}</td>
                                <td>{{ 'Class - '.$test->class }}</td>
                                <td>{{ $test->section }}</td>
                                <td>{{ $test->subject }}</td>
                                <td>{{ $test->defined_mark }}</td>
                                <td>{{ $test->mark }}</td>
                            </tr>
                            @endforeach      
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div> --}}
{{-- student exam end --}}

@stop

@section('js')

{{-- js for back button --}}
<script>
    function goBack() {
      window.history.back();
  }
</script>
@stop

