@extends('layouts.backend')

@section('title') {{ auth()->user()->abbreviation . ' Student Money Receipt'}} @stop

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

    .table td { font-size: 15px; }
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
/*
*
* ==========================================
* CUSTOM UTIL CLASSES
* ==========================================
*
*/

.form-control:focus {
    box-shadow: none;
}

.form-control-underlined {
    border-width: 0;
    border-bottom-width: 1px;
    border-radius: 0;
    padding-left: 0;
}

body {
    background: #ffd89b;
    background: -webkit-linear-gradient(to right, #ffd89b, #19547b);
    background: linear-gradient(to right, #ffd89b, #19547b);
    min-height: 100vh;
}

.form-control::placeholder {
    font-size: 0.95rem;
    color: #aaa;
    font-style: italic;
}
.p-5 {
    padding: 1rem !important;
}
.form-group{
    width: 25%;
    float: right;
}

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    /* display: none; <- Crashes Chrome on hover */
    -webkit-appearance: none;
    margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
}

input[type=number] {
    -moz-appearance:textfield; /* Firefox */
}
</style>

@stop
@section('foisal')


@if(!empty($students) && !empty($receipt))

{{-- summation of recepit defined money except admission fee --}}
@php $total = $students->tution_fee + $receipt->first_money + $receipt->second_money + $receipt->third_money + $receipt->fourth_money + $receipt->fifth_money  @endphp

{{-- converting money in word --}}
@php 
$f = new \NumberFormatter( locale_get_default(), \NumberFormatter::SPELLOUT );        $words = $f->format($total);
            $class = $f->format($students->amd_class);
 @endphp


<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title mb-0">
                    <button onclick="goBack()" class="btn btn-primary">
                        Back
                    </button>

                    <a href="javascript:void(0);" id="print_button2" class="btn btn-secondary" style="float: right;">print money receipt</a>


<script>
    $(document).ready(function(){

        $("#print_button2").click(function(){
            var mode = 'iframe'; // popup
            var close = mode == "popup";
            var options = { mode : mode, popClose : close};
            $("div.foisal").printArea( options  );
        });
    });
</script>

                </p> 

                <hr>
                <div class="table-responsive foisal">
                    <div class="receipt-outlet">

                        {{-- receipt for left --}}
                        <div class="receipt" style="width:50%;float:left;padding: 30px;">
                            <div class="receipt-top text-center">

                                <h6>{{ $user->name }}</h6>
                                <p>{{ $user->address }}</p>

                                <p class="text-right">{{ 'Paid: '.$serial->created_at->format("d-m-Y") }}</p><br>

                                <div class="money">
                                    <p>money recept</p>
                                    <small>Student's Copy</small>
                                    <table class="table table-borderless">
                                        <tr>
                                            <td style="float: left;font-weight: bold;">Payment method:<br>CASH</td>
                                            <td  style="float: right;">Deposit TK: {{ number_format($total, 2)}}</td>
                                        </tr>

                                    </table>
                                </div>
                                <hr>

                                <table class="table table-sm table-borderless">
                                    <thead style="border-bottom: 2px solid;">
                                        <tr>
                                            <th scope="col">Description</th>
                                            <th scope="col" style="float: right;">Tk</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-left">{{ 'Tution fees'}}</td>
                                            <td class="text-right">{{ number_format($students->tution_fee, 2) }}</td>
                                        </tr>

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

                                        <tr style="border-top: 2px solid;">
                                            <td style="text-align: right;font-weight: bold;">Total</td>
                                            <td style="text-align: right;font-weight: bold;">
                                                {{ number_format($total, 2) }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr>
                                <div style="width:70%;float:left;text-align: left;">
                                    <p>{{'In word: '.$words}}</p>
                                    <p>{{ 'Name: '.$students->name}}</p>
                                    <p>
                                        ID# <b>{{$students->std_id}}</b>
                                        , Class: {{$class.'('.$students->amd_class.')'}}
                                    </p>
                                    <p>
                                        Batch Name: <b>{{$students->section}}</b>
                                    </p>
                                </div>
                                <div style="width:30%;float:left;text-align: right;font-weight: bold;"><br><br>
                                    <p style="border-top: 1px solid;">
                                        Signature
                                    </p>
                                    <p>
                                        SI. No {{ str_pad( number_format($serial->receipt_serial), 2, 0, STR_PAD_LEFT ) }}
                                    </p>
                                </div>

                            </div>
                        </div>

                        {{-- receipt right side --}}

                        <div class="receipt" style="width:50%;float:left;padding: 30px;">
                            <div class="receipt-top text-center">

                                <h6>{{ $user->name }}</h6>
                                <p>{{ $user->address }}</p>

                                <p class="text-right">{{ 'Paid: '.$serial->created_at->format("d-m-Y") }}</p><br>

                                <div class="money">
                                    <p>money recept</p>
                                    <small>Office Copy</small>
                                    <table class="table table-borderless">
                                        <tr>
                                            <td style="float: left;font-weight: bold;">Payment method:<br>CASH</td>
                                            <td  style="float: right;">Deposit TK: {{ number_format($total, 2)}}</td>
                                        </tr>

                                    </table>
                                </div>
                                <hr>

                                <table class="table table-sm table-borderless">
                                    <thead style="border-bottom: 2px solid;">
                                        <tr>
                                            <th scope="col">Description</th>
                                            <th scope="col" style="float: right;">Tk</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-left">{{ 'Tution fees'}}</td>
                                            <td class="text-right">{{ number_format($students->tution_fee, 2) }}</td>
                                        </tr>

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

                                        <tr style="border-top: 2px solid;">
                                            <td style="text-align: right;font-weight: bold;">Total</td>
                                            <td style="text-align: right;font-weight: bold;">
                                                {{ number_format($total, 2) }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr>
                                <div style="width:70%;float:left;text-align: left;">
                                    <p>{{'In word: '.$words}}</p>
                                    <p>{{ 'Name: '.$students->name}}</p>
                                    <p>
                                        ID# <b>{{$students->std_id}}</b>
                                        , Class: {{$class.'('.$students->amd_class.')'}}
                                    </p>
                                    <p>
                                        Batch Name: <b>{{$students->section}}</b>
                                    </p>

                                </div>
                                <div style="width:30%;float:left;text-align: right;font-weight: bold;"><br><br>
                                    <p style="border-top: 1px solid;">
                                        Signature
                                    </p>
                                    <p>
                                        SI. No {{ str_pad( number_format($serial->receipt_serial), 2, 0, STR_PAD_LEFT ) }}
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

@endif


@stop

@section('js')
<script>
    function goBack() {
      window.history.back();
  }
</script>
@stop

