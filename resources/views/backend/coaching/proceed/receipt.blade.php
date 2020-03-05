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


</style>

@stop
@section('foisal')


<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">

            <!-- submission f lash message starts -->
            @if(session()->has('message'))
            <div class="alert alert-danger">
                {{ session('message') }}
            </div>
            @endif
            <!-- submission flash message ends -->

            <div class="bg-white p-5 rounded shadow">

                <!-- Underlined search bars -->
                <form action="{{ route('proceed.show') }}" method="post">
                    @csrf
                    <div class="form-group mb-4">
                        <input type="number" placeholder="Enter student ID only" class="form-control form-control-underlined border-success" name="std_id" required step="0.01" autofocus>
                        <input type="submit" style="display:none"/>
                    </div>
                </form>
                <!-- End -->
            </div>
        </div>
    </div>
</div>



@if(!empty($students) && !empty($receipt))

{{-- summation of recepit defined money except admission fee --}}
@php $total = $students->tution_fee + $receipt->first_money + $receipt->second_money + $receipt->third_money + $receipt->fourth_money + $receipt->fifth_money;  
@endphp

{{-- converting money in word --}}
@php 
$f = new \NumberFormatter( locale_get_default(), \NumberFormatter::SPELLOUT );        $words = $f->format($total);
            $class = $f->format($students->amd_class);

            $save_proceed = [
                'id' => $receipt->id,   //proceed table id
                'std_id' => $students->std_id,
                'name' => $students->name,
                'amd_class' => $students->amd_class,
                'amd_type' => $students->amd_type,
                'section' => $students->section,
                'total' => $total, //total according to above id
                'serial' => $serial, 
            ];

            $save_proceed = Crypt::encrypt($save_proceed);
 @endphp



<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title mb-0">
                    <a href="{{ route('proceed.save',$save_proceed) }}" onclick="return confirm('Are you print this money receipt?');" class="btn btn-danger" style="font-weight: bold;">
                        SAVE AFTER PRINT
                    </a>
                    
<a href="javascript:void(0);" id="print_button2" class="btn btn-secondary" style="float: right;">print money receipt</a>
                </p> 


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

                <hr>

                <div class="table-responsive foisal">
                    <div class="receipt-outlet">

                        {{-- receipt for left --}}
                        <div class="receipt" style="width:50%;float:left;padding: 30px;">
                            <div class="receipt-top text-center">

                                <h5 style="font-weight: bold;">{{ $user->name }}</h5>
                                <p>{{ $user->address }}</p>

                                <p class="text-right" style="font-weight: bold;">{{ 'Date: '.date("d-m-Y") }}</p><br>

                                <div class="money">
                                    <p>money recept</p>
                                    <small>Student's Copy</small>
                                    <table class="table table-borderless">
                                        <tr>
                                            <td style="float: left;font-weight: bold;">Payment method:<br>CASH</td>
                                            <td  style="float: right;font-weight: bold;">Deposit TK: {{ number_format($total, 2)}}</td>
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
                                        ID# <b>{{$students->std_id}}</b>, 
                                        @if($students->amd_class==20||$students->amd_class==21)
                                            Class: {{ $students->class_type }}
                                        @else
                                        Class: {{$class.'('.$students->amd_class.')'}}
                                        @endif
                                        
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
                                        SI. No {{ str_pad( number_format($serial), 2, 0, STR_PAD_LEFT ) }}
                                    </p>
                                </div>

                            </div>
                        </div>

                        {{-- receipt right side --}}

                        <div class="receipt" style="width:50%;float:left;padding: 30px;">
                            <div class="receipt-top text-center">

                                <h5 style="font-weight: bold;">{{ $user->name }}</h5>
                                <p>{{ $user->address }}</p>

                                <p class="text-right" style="font-weight: bold;">{{ 'Date: '.date("d-m-Y") }}</p><br>

                                <div class="money">
                                    <p>money recept</p>
                                    <small>Office Copy</small>
                                    <table class="table table-borderless">
                                        <tr>
                                            <td style="float: left;font-weight: bold;">Payment method:<br>CASH</td>
                                            <td  style="float: right;font-weight: bold;">Deposit TK: {{ number_format($total, 2)}}</td>
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
                                        ID# <b>{{$students->std_id}}</b>, 
                                        @if($students->amd_class==20||$students->amd_class==21)
                                            Class: {{ $students->class_type }}
                                        @else
                                        Class: {{$class.'('.$students->amd_class.')'}}
                                        @endif
                                        
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
                                        SI. No {{ str_pad( number_format($serial), 2, 0, STR_PAD_LEFT ) }}
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
@else 
    @php
        $receipt = \App\Models\Coaching\CoachingProceed::where('inst_identity',auth()->user()->FI)->first();
    @endphp
    @if(empty($receipt))
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <h1 style="font-weight: bold;" class="text-danger">
                    At least make two title in money receipt form.
                </h1>
            </div>
        </div>
    </div>
    @endif
@endif


@stop