@extends('layouts.backend')

@section('title') {{ auth()->user()->abbreviation . ' Student Money Receipt Demo'}} @stop

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


</style>

@stop
@section('foisal')


<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">

            <!-- submission f lash message starts -->
            @if(session()->has('message'))
            <div class="alert alert-info">
                {{ session('message') }}
            </div>
            @endif
            <!-- submission flash message ends -->

            <div class="card-body">
                <p class="card-title mb-0">
                    <i class="ti-printer menu-icon"></i>
                </p> 

                <hr>

                <div class="table-responsive">
                    <div class="receipt-outlet">

                        {{-- receipt for left --}}
                        <div class="receipt">
                            <div class="receipt-top text-center">
                                
                                <h6>{{ $user->name }}</h6>
                                <p>{{ $user->address }}</p>
                                
                                <p class="text-right">{{ 'Date: '.date("d-m-Y") }}</p><br>

                                <div class="money">
                                    <p>money recept</p>
                                    <p>Student's Copy</p>
                                    <table class="table table-borderless">
                                        <tr>
                                            <td style="float: left;font-weight: bold;">Payment method:<br>CASH</td>
                                            <td  style="float: right;">Deposit TK: {{ number_format(0000,2)}}</td>
                                        </tr>

                                    </table>
                                </div>
                                <hr>

                                <table class="table table-sm ">
                                    <thead>
                                        <tr>
                                            <th scope="col">Description</th>
                                            <th scope="col">Tk</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        

                                        @if(!empty($receipt->first_input_title))
                                        <tr>
                                            <td class="text-left">{{ $receipt->first_input_title}}</td>
                                            <td class="text-right">{{ $receipt->first_money }}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($receipt->second_input_title))
                                        <tr>
                                            <td class="text-left">{{ $receipt->second_input_title}}</td>
                                            <td class="text-right">{{ $receipt->second_money }}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($receipt->third_input_title))
                                        <tr>
                                            <td class="text-left">{{ $receipt->third_input_title}}</td>
                                            <td class="text-right">{{ $receipt->third_money }}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($receipt->fourth_input_title))
                                        <tr>
                                            <td class="text-left">{{ $receipt->fourth_input_title}}</td>
                                            <td class="text-right">{{ $receipt->fourth_money }}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($receipt->fifth_input_title))
                                        <tr>
                                            <td class="text-left">{{ $receipt->fifth_input_title}}</td>
                                            <td class="text-right">{{ $receipt->fifth_money }}</td>
                                        </tr>
                                        @endif

{{-- summation of recepit defined money except admission fee --}}
@php 
if(!empty($receipt->first_money)){
    $total = $receipt->first_money + $receipt->second_money + $receipt->third_money + $receipt->fourth_money + $receipt->fifth_money;
}
@endphp

                                        

                                        <tr>
                                            <td style="text-align: right;font-weight: bold;">Total</td>
                                            <td style="text-align: right;font-weight: bold;">
                                                {{ number_format($total ?? '0000', 2) }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr>
                                <div class="textleft">

{{-- converting money in word --}}
@php 
$f = new \NumberFormatter( locale_get_default(), \NumberFormatter::SPELLOUT );        $words = $f->format($total ?? '0000'); @endphp

                                    <p>In word: {{$words}}</p>
                                    <p>Name: The student name</p>
                                    <p>ID# 000000000, Class: 00</p>
                                    <p>Batch name: B-000</p>

                                </div>
                                <div class="textright"><br><br>
                                    <p style="border-top: 1px solid;">
                                        Signature
                                    </p>
                                    <p>
                                        SI. No 0000
                                    </p>
                                </div>

                            </div>
                        </div>

                        {{-- receipt right side --}}

                        <div class="receipt">
                            <div class="receipt-top text-center">
                                
                                <h6>{{ $user->name }}</h6>
                                <p>{{ $user->address }}</p>
                                
                                <p class="text-right">{{ 'Date: '.date("d-m-Y") }}</p><br>

                                <div class="money">
                                    <p>money recept</p>
                                    <p>Office Copy</p>
                                    <table class="table table-borderless">
                                        <tr>
                                            <td style="float: left;font-weight: bold;">Payment method:<br>CASH</td>
                                            <td  style="float: right;">Deposit TK: {{ number_format(0000,2)}}</td>
                                        </tr>

                                    </table>
                                </div>
                                <hr>

                                <table class="table table-sm table-borderless">
                                    <thead>
                                        <tr>
                                            <th scope="col">Description</th>
                                            <th scope="col">Tk</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        

                                        @if(!empty($receipt->first_input_title))
                                        <tr>
                                            <td class="text-left">{{ $receipt->first_input_title}}</td>
                                            <td class="text-right">{{ $receipt->first_money }}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($receipt->second_input_title))
                                        <tr>
                                            <td class="text-left">{{ $receipt->second_input_title}}</td>
                                            <td class="text-right">{{ $receipt->second_money }}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($receipt->third_input_title))
                                        <tr>
                                            <td class="text-left">{{ $receipt->third_input_title}}</td>
                                            <td class="text-right">{{ $receipt->third_money }}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($receipt->fourth_input_title))
                                        <tr>
                                            <td class="text-left">{{ $receipt->fourth_input_title}}</td>
                                            <td class="text-right">{{ $receipt->fourth_money }}</td>
                                        </tr>
                                        @endif

                                        @if(!empty($receipt->fifth_input_title))
                                        <tr>
                                            <td class="text-left">{{ $receipt->fifth_input_title}}</td>
                                            <td class="text-right">{{ $receipt->fifth_money }}</td>
                                        </tr>

                                      @endif

{{-- summation of recepit defined money except admission fee --}}
@php 
if(!empty($receipt->first_money)){
    $total = $receipt->first_money + $receipt->second_money + $receipt->third_money + $receipt->fourth_money + $receipt->fifth_money;
}
@endphp

                                        

                                        <tr>
                                            <td style="text-align: right;font-weight: bold;">Total</td>
                                            <td style="text-align: right;font-weight: bold;">
                                                {{ number_format($total ?? '0000', 2) }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr>
                                <div class="textleft">

{{-- converting money in word --}}
@php 
$f = new \NumberFormatter( locale_get_default(), \NumberFormatter::SPELLOUT );        $words = $f->format($total ?? '0000'); @endphp

                                    <p>In word: {{$words}}</p>
                                    <p>Name: The student name</p>
                                    <p>ID# 000000000, Class: 00</p>
                                    <p>Batch name: B-000</p>

                                </div>
                                <div class="textright"><br><br>
                                    <p style="border-top: 1px solid;">
                                        Signature
                                    </p>
                                    <p>
                                        SI. No 0000
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@stop