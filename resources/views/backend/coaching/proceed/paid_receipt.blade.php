@extends('layouts.backend')

@section('title') {{ auth()->user()->abbreviation . ' Paid Money Receipt'}} @stop

@section('css')

<style>
.card-title-resize{
    border-right: 2px solid;
    margin: 0 10px;
    border-radius: 4px;
    padding: 10px;
}
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

    .receipt-outlet{
        margin: 15px 10px;
        min-height: 500px;
    }
    .receipt{
        width: 50%;
        margin: 0 auto;
        float: left;
        padding: 20px;
    }
    .money p{
        text-transform: uppercase;
        font-weight: bold;
        font-size: 17px;
        line-height: 10px;
    }
    .textleft{
        width: 80%;
        float: left;
        text-align: left;
    }

    .textright{
        width: 20%;
        float: left;
        font-weight: bold;
        text-align: right;
        line-height: 26px;
    }
    /**** Styling the form elements **/
    #hint{
        overflow-x: auto;
        white-space: pre-wrap;
        white-space: -moz-pre-wrap;
        white-space: -pre-wrap;
        white-space: -o-pre-wrap;
        word-wrap: break-word;
    }

</style>

@stop
@section('foisal')


<!-- submission f lash message starts -->
@if(session()->has('message'))
<div class="alert alert-info">
    {{ session('message') }}
</div>
@endif
<!-- submission flash message ends -->

@foreach($get_year as $set_year)
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
                    $get_month = \App\Models\Coaching\CoachingPaidReceipt::selectRaw("MONTH(created_at) month")->where('inst_identity',auth()->user()->FI)->whereYear('created_at',$set_year->year)->distinct()->orderBy('month','asc')->get();
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
                                $paid_proceeds = \App\Models\Coaching\CoachingPaidReceipt::where('amd_class',$proceed->amd_class)->where('inst_identity',auth()->user()->FI)->whereMonth('created_at',$set_month->month)->whereYear('created_at',$set_year->year)->orderBy('std_id','asc')->get();

                                //select total row under distinct month in distinct year
                                $total = \App\Models\Coaching\CoachingPaidReceipt::select('id')->where('amd_class',$proceed->amd_class)->where('inst_identity',auth()->user()->FI)->whereMonth('created_at',$set_month->month)->whereYear('created_at',$set_year->year)->count();

                                $money = \App\Models\Coaching\CoachingPaidReceipt::select('total_paid')->where('amd_class',$proceed->amd_class)->where('inst_identity',auth()->user()->FI)->whereMonth('created_at',$set_month->month)->whereYear('created_at',$set_year->year)->sum('total_paid');

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
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            {{-- select all row groupby class under a date --}}
                                                            @foreach($paid_proceeds as $paid)
                                                            <tr>
                                                                @php
                                                                //to see receipt details of a student
                                                                $selfview = [
                                                                    'proceed_id' => $paid->proceed_id, 
                                                                    'std_id' => $paid->std_id, 
                                                                    'id' => $paid->id,
                                                                ];
                                                                $selfview = Crypt::encrypt($selfview);
                                                                @endphp

                                                                <td id="hint"> {{ $paid->name }} </td>
                                                                <td id="hint">{{ $paid->std_id }}</td>
                                                                <td id="hint">{{ 'Class - '.$paid->amd_class }}</td>
                                                                <td id="hint">{{ $paid->admission_type }}</td>
                                                                <td id="hint">{{ $paid->section }}</td>
                                                                <td id="hint">{{ $paid->total_paid }}</td>
                                                                <td id="hint">{{ $paid->receipt_serial }}</td>
                                                                <td id="hint">{{ $paid->created_at }}</td>
                                                                <td id="hint"><a href="{{ route('proceed.selfview',$selfview) }}" class="btn btn-link">Details</a></td>
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
@stop