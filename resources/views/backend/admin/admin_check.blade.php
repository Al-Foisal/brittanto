@extends('layouts.admin')

@section('title') {{ ' Student List'}} @stop

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

    .table td { font-size: 20px; }
    tbody { font-family: 'Ubuntu', sans-serif; }
    /**** Styling the form elements **/

    .card .card-title {
    color: #787878;
    margin-bottom: 1.2rem;
    text-transform: uppercase;
    font-size: 0.975rem;
    font-weight: 500;
}.card .card-title {
    color: #787878;
    margin-bottom: 1.2rem;
    text-transform: uppercase;
    font-size: 0.975rem;
    font-weight: 500;
    font-family: 'Ubuntu', sans-serif;
}
.card-title-resize{
    border-right: 2px solid;
    margin: 0 30px;
    border-radius: 4px;
    padding: 10px;
}


/** css for auto popup */
#popup_this {
    top: 50%;
    left: 50%;
    text-align:center;
    margin-top: -50px;
    margin-left: -100px;
    position: fixed;
    background: #fff;
    padding: 30px;
}
.b-close {
    position: absolute;
    right: 0;
    top: 0;
    cursor: pointer;
    color: #fff;
    padding: 5px 10px;
}
</style>

@stop
@section('foisal')


<!-- submission f lash message starts -->
@if(session()->has('message'))
<div class="alert alert-info">
	{{session('message')}}
</div>
@endif

<!-- student operation starts -->

@if($classes)

@foreach($classes as $set_class)
@php

//select all the Section under a single classes
    $sections = \App\Models\Coaching\CoachingSection::select(['id','name','type','class','gender'])->where('class',$set_class->amd_class)->where('inst_identity',$user->FI)->get();

//count total Section under a single classes
    $total_section = \App\Models\Coaching\CoachingSection::where('class',$set_class->amd_class)->where('inst_identity',$user->FI)->count();

//making class in words
    $f = new \NumberFormatter( locale_get_default(), \NumberFormatter::SPELLOUT );        
    $class_in_words = $f->format($set_class->amd_class);
    $replace_class = str_replace(' ','_',$class_in_words);
@endphp

<div class="accordion" id="accordionExample{{$replace_class}}">
    <div class="card">
        <div class="card-header" id="headingOne{{$replace_class}}">
            <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne{{$replace_class}}" aria-expanded="true" aria-controls="collapseOne{{$replace_class}}">
                    @if($set_class->amd_class == 20 || $set_class->amd_class == 21 )
                        <h4 class="text-capitalize">{{'Class: '.$set_class->class_type.' | Batch: '.$total_section}}</h4>
                    @else
                        <h4 class="text-capitalize">{{'Class: '.$set_class->amd_class.' | ('.$class_in_words.') | Batch: '.$total_section}}</h4>
                    @endif
                </button>
            </h5>
        </div>

        <div id="collapseOne{{$replace_class}}" class="collapse" aria-labelledby="headingOne{{$replace_class}}" data-parent="#accordionExample{{$replace_class}}">

            <div class="card-body">

                {{-- printing section per class starts --}}
                @foreach($sections as $section)

                @php 

                //select all student under a class
                    $students = \App\Models\Coaching\CoachingStudent::select(['id','name','std_id','tution_fee','amd_type','image','inst_identity'])->where('amd_class',$section->class)->where('section',$section->name)->where('inst_identity',$user->FI)->get();

                //count total student under a class
                    $total_student = \App\Models\Coaching\CoachingStudent::where('amd_class',$section->class)->where('section',$section->name)->where('inst_identity',$user->FI)->count();

                @endphp


                @if(!empty($section) && $total_student != 0 )
                <div class="accordion" id="accordionExample{{$section->name}}">
                    <div class="card">
                        <div class="card-header" id="headingOne{{$section->name}}">
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne{{$section->name.'_'.$replace_class}}" aria-expanded="true" aria-controls="collapseOne{{$section->name.'_'.$replace_class}}">
                                    <h4 class="text-capitalize">{{'Batch: '.$section->name.' | Batch Type: '.$section->section_type.' | Gender: '.$section->gender}}</h4>
                                </button>
                            </h5>
                        </div>

                        <div id="collapseOne{{$section->name.'_'.$replace_class}}" class="collapse" aria-labelledby="headingOne{{$section->name}}" data-parent="#accordionExample{{$section->name}}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body" >

                                                <p class="card-title mb-0">
                                                    <b class="card-title-resize">
                                                        Class: {{ $section->class_type }}
                                                    </b>
                                                    <b class="card-title-resize">
                                                        Students: {{ $total_student }}
                                                    </b>

                                                    <div class="btn-group" role="group">
                                                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                          Sent SMS Form Here    
                                                      	</button>
                                                      	<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

                                                      		<form action="{{ route('sms.exam.show') }}" method="post">
                                                      			@csrf
                                                      			<input type="hidden" name="section_name" value="{{ $section->name }}">
                                                      			<button type="submit" class="btn btn-secondary dropdown-item">Exam Number SMS</button>
                                                      		</form>
                                                      	</div>
                                                      </div>

                                                    

                                                </p> <hr>

                                                <div class="table-responsive">
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Student Image</th>
                                                                <th>Student Name</th>
                                                                <th>Student ID</th>
                                                                <th>Tuition fee</th>
                                                                <th>Admitted as</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($students as $student)

                                                            <tr>
                                                                <td>
                                                                    <img src="{{ asset('storage/storage/'.$student->inst_identity.'/student/'.$student->image)}}">
                                                                </td>
                                                                <td>{{ $student->name }}</td>
                                                                <td>{{ $student->std_id }}</td>
                                                                <td>{{ $student->tution_fee }}</td>
                                                                <td>{{ $student->admission_type }}</td>
                                                            </tr>
                                                        @endforeach      
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>
                @endif
                @endforeach
                {{-- printing section per class ends --}}
            </div>
        </div>
    </div>
</div>
@endforeach

@endif
<!-- student operation ends -->

<hr>

<!-- employee operation starts -->
@if($employees)

<div id="f" class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            
            <div class="card-body">
                <p class="card-title mb-0">
                    <b class="card-title-resize">
                        Teachers: {{ $teacher }}
                    </b>
                    <b class="card-title-resize">
                        Staff: {{ $staff }}
                    </b>
                </p> <hr>
                <div class="table-responsive">
                    <table class="table table-hover table-sm table-bordered">
                        <thead>
                            <tr>
                                <th id="hint">Employee Image</th>
                                <th id="hint">Employee Name</th>
                                <th id="hint">Enrollment</th>
                                <th id="hint">Education</th>
                                <th id="hint">Institution</th>
                                <th id="hint">Address</th>
                                <th id="hint">Phone</th>
                                <th id="hint">Salary</th>
                                <th id="hint">Commitment</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/storage/'.$employee->inst_identity.'/employee/'.$employee->image)}}">
                                </td>
                                <td id="hint">{{ $employee->name }}</td>
                                <td id="hint">{{ $employee->role }}</td>
                                <td id="hint">{{ $employee->study }}</td>
                                <td id="hint">{{ $employee->thr_study_inst }}</td>
                                <td id="hint">{{ $employee->address }}</td>
                                <td id="hint">{{ $employee->phone }}</td>
                                <td id="hint">{{ $employee->salary }}</td>
                                <td id="hint">{{ $employee->commit_type }}</td>
                            </tr>
                            @endforeach      
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endif

<!-- employee operation ends -->


<hr>


<!-- owner operation starts -->
@if($owners)
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">            
            <div class="card-body">
                <p class="card-title mb-0">Owner List</p> <hr>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Owner Image</th>
                                <th>Owner Name</th>
                                <th>Position</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($owners as $owner)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/storage/'.$owner->inst_identity.'/owner/'.$owner->image)}}">
                                </td>
                                <td>{{ $owner->name }}</td>
                                <td>{{ $owner->position }}</td>
                                <td>{{ $owner->email }}</td>
                                <td>{{ $owner->phone }}</td>
                                <td>{{ $owner->message }}</td>
                            </tr>
                            @endforeach      
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endif
<!-- owner operation ends -->


<hr>


<!-- owner operation ends -->
@if($section_lists)

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            
            <div class="card-body">
                <p class="card-title mb-0">Batch List</p> <hr>
                <div class="table-responsive">
                    <table class="table table-hover table-sm">
                        <thead>
                            <tr>
                                <th>Batch Name</th>
                                <th>Gender</th>
                                <th>Batch Starts and End</th>
                                <th>Batch Type</th>
                                <th>Class</th>
                                <th>Hints</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($section_lists as $section_list)
                            <tr>
                                <td>{{ $section_list->name }}</td>
                                <td>{{ $section_list->gender }}</td>
                                <td>{{ $section_list->start_time.' TO '.$section_list->end_time }}</td>
                                <td>{{ $section_list->section_type }}</td>
                                <td>{{ $section_list->class_type }}</td>
                                <td id="hint">{{ $section_list->hint }}</td>
                            </tr>
                            @endforeach      
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endif
<!-- owner operation ends -->


<hr>


<!-- receipt operation starts -->
@if($receipt_get_year)
@foreach($receipt_get_year as $set_year)
@php 
        //making year in words
    $f = new \NumberFormatter( locale_get_default(), \NumberFormatter::SPELLOUT );        
    $year_in_words = $f->format($set_year->year);
    $replace_year = str_replace(' ','_',$year_in_words);
@endphp

<div class="accordion" id="accordionExample{{$replace_year}}">
    <div class="card">
        <div class="card-header" id="headingOne{{$replace_year}}">
            <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne{{$replace_year}}" aria-expanded="true" aria-controls="collapseOne{{$replace_year}}">
                    <h4 class="text-capitalize">year: {{$set_year->year}} ({{$year_in_words}})</h4>
                </button>
            </h5>
        </div>

        <div id="collapseOne{{$replace_year}}" class="collapse" aria-labelledby="headingOne{{$replace_year}}" data-parent="#accordionExample{{$replace_year}}">

            <div class="card-body">

                @php
                    //select all distinct month under distinct year
                    $get_month = \App\Models\Coaching\CoachingPaidReceipt::selectRaw("MONTH(created_at) month")->where('inst_identity',$user->FI)->whereYear('created_at',$set_year->year)->distinct()->orderBy('month','asc')->get();
                @endphp
                {{-- printing value per month starts --}}
                @foreach($get_month as $set_month)
                @php 
                    //making month in words
                $f = new \NumberFormatter( locale_get_default(), \NumberFormatter::SPELLOUT );        
                $month_in_words = $f->format($set_month->month);
                $replace_month = str_replace(' ','_',$month_in_words);
                @endphp

                <div class="accordion" id="accordionExample{{$replace_month}}">
                    <div class="card">
                        <div class="card-header" id="headingOne{{$replace_month}}">
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne{{$replace_month.'_'.$replace_year}}" aria-expanded="true" aria-controls="collapseOne{{$replace_month.'_'.$replace_year}}">
                                    <h4 class="text-capitalize">month: {{$set_month->month}} ({{$set_year->year}})</h4>
                                </button>
                            </h5>
                        </div>

                        <div id="collapseOne{{$replace_month.'_'.$replace_year}}" class="collapse" aria-labelledby="headingOne{{$replace_month}}" data-parent="#accordionExample{{$replace_month}}">
                            <div class="card-body">

                                {{-- select class groupBy --}}
                                @foreach($proceeds as $proceed)
                                @php
                                //select all row under distinct month in distinct year
                                $paid_proceeds = \App\Models\Coaching\CoachingPaidReceipt::where('amd_class',$proceed->amd_class)->where('inst_identity',$user->FI)->whereMonth('created_at',$set_month->month)->whereYear('created_at',$set_year->year)->orderBy('std_id','asc')->get();

                                //select total row under distinct month in distinct year
                                $total = \App\Models\Coaching\CoachingPaidReceipt::select('id')->where('amd_class',$proceed->amd_class)->where('inst_identity',$user->FI)->whereMonth('created_at',$set_month->month)->whereYear('created_at',$set_year->year)->count();

                                $money = \App\Models\Coaching\CoachingPaidReceipt::select('total_paid')->where('amd_class',$proceed->amd_class)->where('inst_identity',$user->FI)->whereMonth('created_at',$set_month->month)->whereYear('created_at',$set_year->year)->sum('total_paid');

                                @endphp
                                <div class="row">
                                    <div class="col-md-12 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body" >



                                                <p class="card-title mb-0">
                                                    <b class="card-title-resize">
                                                        Class: {{ $proceed->amd_class }}
                                                    </b>
                                                    <b class="card-title-resize">
                                                        Students: {{ $total }}
                                                    </b>
                                                    <b class="card-title-resize">
                                                        Total: {{ $money }}
                                                    </b>
                                                </p> <hr>
                                                <div class="table-responsive">
                                                    <table class="table table-sm table-bordered table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Student Name</th>
                                                                <th>Student ID</th>
                                                                <th>Class</th>
                                                                <th>Admitted as</th>
                                                                <th>Section</th>
                                                                <th>Total Paid</th>
                                                                <th>Serial</th>
                                                                <th>Time</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            {{-- select all row groupby class under a date --}}
                                                            @foreach($paid_proceeds as $paid)
                                                            <tr>
                                                            	<td id="hint"> {{ $paid->name }} </td>
                                                                <td id="hint">{{ $paid->std_id }}</td>
                                                                <td id="hint">{{ 'Class - '.$paid->amd_class }}</td>
                                                                <td id="hint">{{ $paid->admission_type }}</td>
                                                                <td id="hint">{{ $paid->section }}</td>
                                                                <td id="hint">{{ $paid->total_paid }}</td>
                                                                <td id="hint">{{ $paid->receipt_serial }}</td>
                                                                <td id="hint">{{ $paid->created_at }}</td>
                                                            </tr> 
                                                            @endforeach      
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>    
                </div>
                @endforeach
                {{-- printing value per month ends --}}
            </div>
        </div>
    </div>    
</div>
@endforeach

@endif
<!-- receipt operation ends -->


<hr>


<!-- cost sheet operation starts -->
@if($cost_sheet_get_year)
@foreach($cost_sheet_get_year as $set_year)
@php 
        //making year in words
    $f = new \NumberFormatter( locale_get_default(), \NumberFormatter::SPELLOUT );        
    $year_in_words = $f->format($set_year->year);
    $replace_year = str_replace(' ','_',$year_in_words);
@endphp

<div class="accordion" id="accordionExampleCost{{$replace_year}}">
    <div class="card">
        <div class="card-header" id="headingOneCost{{$replace_year}}">
            <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOneCost{{$replace_year}}" aria-expanded="true" aria-controls="collapseOneCost{{$replace_year}}">
                    <h4 class="text-capitalize">year: {{$set_year->year}} ({{$year_in_words}})</h4>
                </button>
            </h5>
        </div>

        <div id="collapseOneCost{{$replace_year}}" class="collapse" aria-labelledby="headingOneCost{{$replace_year}}" data-parent="#accordionExampleCost{{$replace_year}}">

            <div class="card-body">

                @php
                    //select all distinct month under distinct year
                    $get_month = \App\Models\Coaching\CoachingPaidReceipt::selectRaw("MONTH(created_at) month")->where('inst_identity',$user->FI)->whereYear('created_at',$set_year->year)->distinct()->orderBy('month','asc')->get();
                @endphp
                {{-- printing value per month starts --}}
                @foreach($get_month as $set_month)
                @php 
                    //making month in words
                $f = new \NumberFormatter( locale_get_default(), \NumberFormatter::SPELLOUT );        
                $month_in_words = $f->format($set_month->month);
                $replace_month = str_replace(' ','_',$month_in_words);
                @endphp

                <div class="accordion" id="accordionExampleCost{{$replace_month}}">
                    <div class="card">
                        <div class="card-header" id="headingOneCost{{$replace_month}}">
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOneCost{{$replace_month.'_'.$replace_year}}" aria-expanded="true" aria-controls="collapseOneCost{{$replace_month.'_'.$replace_year}}">
                                    <h4 class="text-capitalize">month: {{$set_month->month}} ({{$set_year->year}})</h4>
                                </button>
                            </h5>
                        </div>

                        <div id="collapseOneCost{{$replace_month.'_'.$replace_year}}" class="collapse" aria-labelledby="headingOneCost{{$replace_month}}" data-parent="#accordionExampleCost{{$replace_month}}">
                            <div class="card-body">

                                
                                <div class="row">
                                    <div class="col-md-12 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body" >

@php
    $income_from_student = DB::table('coaching_paid_receipts')
                ->whereYear('created_at',$set_year->year)
            ->whereMonth('created_at',$set_month->month)
            ->where('inst_identity',$user->FI)
            ->sum('total_paid');

        $extra_income = DB::table('coaching_vouchers')
                ->whereYear('created_at',$set_year->year)
            ->whereMonth('created_at',$set_month->month)
            ->where('cost_type','extra_income')
            ->where('inst_identity',$user->FI)
            ->sum('cost');

        $per_class_paid = DB::table('coaching_vouchers')
                ->whereYear('created_at',$set_year->year)
            ->whereMonth('created_at',$set_month->month)
            ->where('cost_type','per_class')
            ->where('inst_identity',$user->FI)
            ->sum('cost');

        $daily_cost = DB::table('coaching_vouchers')
                ->whereYear('created_at',$set_year->year)
            ->whereMonth('created_at',$set_month->month)
            ->where('cost_type','daily_cost')
            ->where('inst_identity',$user->FI)
            ->sum('cost');

        $fixed_paid = DB::table('coaching_employees')
            ->where('commitment','fixed')
            ->where('inst_identity',$user->FI)
            ->sum('salary');
@endphp

                                                <p class="card-title mb-0">
                                                    
                                                </p> <hr>
                                                <div class="table-responsive">
                                                    <table class="table table-hover  table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th id="hint">Income/Cost Title</th>
                                                                <th id="hint">Type</th>
                                                                <th id="hint">Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td id="hint">Total Payment From Student</td>
                                                                <td id="hint">Add</td>
                                                                <td id="hint">{{ $income_from_student }}</td>

                                                            </tr>
                                                            <tr>
                                                                <td id="hint">Total Extra Income</td>
                                                                <td id="hint">Add</td>
                                                                <td id="hint">{{ $extra_income }}</td>

                                                            </tr>
                                                            <tr>
                                                                <td id="hint">Daily Per Class Payment</td>
                                                                <td id="hint">Less</td>
                                                                <td id="hint">{{ $per_class_paid }}</td>

                                                            </tr>
                                                            <tr>
                                                                <td id="hint">Daily Random Cost</td>
                                                                <td id="hint">Less</td>
                                                                <td id="hint">{{ $daily_cost }}</td>

                                                            </tr>
                                                            <tr>
                                                                <td id="hint">Monthely Payment</td>
                                                                <td id="hint">Less</td>
                                                                <td id="hint">{{ $fixed_paid }}</td>
                                                            </tr>
                                                            @php
                                                                $income = $income_from_student+$extra_income-$per_class_paid-$daily_cost-$fixed_paid;
                                                            @endphp
                                                            <tr>
                                                                <td id="hint"></td>
                                                                <td id="hint">Income:</td>
                                                                <td id="hint">{{ $income }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>
                @endforeach
                {{-- printing value per month ends --}}
            </div>
        </div>
    </div>    
</div>
@endforeach

@endif
<!-- cost sheet operation ends -->
@stop
