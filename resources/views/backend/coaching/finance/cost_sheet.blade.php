@extends('layouts.backend')

@section('title') {{ auth()->user()->abbreviation }} total cost and income details @stop

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

                                
                                <div class="row">
                                    <div class="col-md-12 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body" >

@php
    $income_from_student = DB::table('coaching_paid_receipts')
                ->whereYear('created_at',$set_year->year)
            ->whereMonth('created_at',$set_month->month)
            ->where('inst_identity',auth()->user()->FI)
            ->sum('total_paid');

        $extra_income = DB::table('coaching_vouchers')
                ->whereYear('created_at',$set_year->year)
            ->whereMonth('created_at',$set_month->month)
            ->where('cost_type','extra_income')
            ->where('inst_identity',auth()->user()->FI)
            ->sum('cost');

        $per_class_paid = DB::table('coaching_vouchers')
                ->whereYear('created_at',$set_year->year)
            ->whereMonth('created_at',$set_month->month)
            ->where('cost_type','per_class')
            ->where('inst_identity',auth()->user()->FI)
            ->sum('cost');

        $daily_cost = DB::table('coaching_vouchers')
                ->whereYear('created_at',$set_year->year)
            ->whereMonth('created_at',$set_month->month)
            ->where('cost_type','daily_cost')
            ->where('inst_identity',auth()->user()->FI)
            ->sum('cost');

        $fixed_paid = DB::table('coaching_employees')
            ->where('commitment','fixed')
            ->where('inst_identity',auth()->user()->FI)
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
@stop