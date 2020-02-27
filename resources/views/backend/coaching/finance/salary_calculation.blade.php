@extends('layouts.backend')

@section('title') {{ auth()->user()->abbreviation . ' Salary Calculation For '.$teacher->name}} @stop

@section('css')

<style>

    /** The wrapper that will contain our two forms **/
    .content-wrapper {
        border-left: 20px solid white;
    }
    #wrapper{
        width: 80%;
        right: 0px;
        min-height: 560px;  
        margin: 0px auto;
        position: relative; 
    }

    #wrapper h1 {
        font-size: 41px;
        margin-top: 50px;
    }
    /**** Styling the form elements **/

  /** The wrapper that will contain our two forms **/
    .content-wrapper {
        border-left: 5px solid white;
        padding: 1.5rem 0.5rem;
        border-radius: 30px;
    }
    .card{
        border-radius: 5px;
    }
#hint{
    overflow-x: auto;
    white-space: pre-wrap;
    white-space: -moz-pre-wrap;
    white-space: -pre-wrap;
    white-space: -o-pre-wrap;
    word-wrap: break-word;
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
    font-family: 'Ubuntu', sans-serif;
}
.card-title-resize{
    border-right: 2px solid;
    margin: 0 30px;
    border-radius: 4px;
    padding: 10px;
}
</style>

@stop
@section('foisal')


<div class="row" style="margin-bottom: -18%;">

    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between align-items-center">
            <div id="container_demo" >
                

                <!-- Printing all error message fild -->
                @if($errors->any())
                <div class="alert alert-warning">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li> {{ $error }} </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- end of error message fild -->
                <!-- submission f lash message starts -->
                @if(session()->has('message'))
                <div class="alert alert-info">
                    {{ session('message') }}
                </div>
                @endif
                <!-- submission flash message ends -->


                <div id="wrapper">
                    <div class="animate form">
                        <form method="post" action="{{ route('salary.store')}}"> 
                            @csrf

                            <h1>{{ auth()->user()->abbreviation . ' Salary Calculation For '.$teacher->name}}</h1> 

                            <div style="width: 45%;float: left;margin-right: 5%;">
                                <p> 
                                    <label for="name"> Employee Name: </label>
                                    <input id="name" value="{{$teacher->name}}" name="name" required="required" type="text" readonly />
                                </p> 
                            </div>

                            <div style="width: 48%;float: left;">
                                <p> 
                                    <label for="comment"> Comment (if any): </label>
                                    <input id="comment" name="comment" type="text" placeholder="1 extra class instade of karim sir" />
                                </p> 
                            </div>

                            <div style="width: 45%;float: left;margin-right: 5%;">
                                <div style="width: 45%;float: left;margin-right: 8%;">
                                    <p> 
                                        <label for="bonus"> Bonus (if any): </label>
                                        <input id="bonus" name="bonus" value="0" type="number"/>
                                    </p> 
                                </div>

                                <div style="width: 45%;float: left;">
                                    <p> 
                                        <label for="classes"> Number of Classes: </label>
                                        <input id="classes" name="class" required="required" type="number" placeholder="5"/>
                                    </p> 
                                </div>
                            </div>

                            <div style="width: 48%;float: left;">
                                <div style="width: 45%;float: left;margin-right: 8%;">
                                    <p> 
                                        <label for="per_class"> TK- Per Class: </label>
                                        <input id="per_class" value="{{$teacher->salary}}" name="per_class" required="required" type="number" readonly />
                                    </p> 
                                </div>

                                <div style="width: 45%;float: left;">
                                    <p> 
                                        <label for="total"> Total: </label>
                                        <input id="total" name="total" readonly required="required" type="number"/>
                                    </p> 
                                </div>
                            </div>

                            <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
                            <p class="login button"> 
                                <input type="submit" onclick="return confirm('Are you sure you want to submit this item?');" value="Add Payment" /> 
                            </p>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


@php 
    //select all the salary list under a single per day paid teacher
    $teachers = \App\Models\Coaching\CoachingDailyTeacherSalary::where('teacher_id',$teacher->id)->where('inst_identity',auth()->user()->FI)->orderBy('updated_at','desc')->get();
    $pending_count = \App\Models\Coaching\CoachingDailyTeacherSalary::where('teacher_id',$teacher->id)->where('inst_identity',auth()->user()->FI)->where('status','pending')->count();
    $paid_count = \App\Models\Coaching\CoachingDailyTeacherSalary::where('teacher_id',$teacher->id)->where('inst_identity',auth()->user()->FI)->where('status','paid')->count();

@endphp

<div id="f" class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            
            <div class="card-body">
                <p class="card-title mb-0">
                    <b class="card-title-resize">
                        Pending: {{ $pending_count }}
                    </b>
                    <b class="card-title-resize">
                        Paid: {{ $paid_count }}
                    </b>
                </p> <hr>
                <div class="table-responsive">
                    <table class="table table-hover table-sm table-bordered">
                        <thead>
                            <tr>
                                <th id="hint">Employee Name</th>
                                <th id="hint">Comment</th>
                                <th id="hint">Bonus</th>
                                <th id="hint">Class No.</th>
                                <th id="hint">Per Class</th>
                                <th id="hint">Total</th>
                                <th id="hint">Created/Paid at</th>
                                <th id="hint">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($teachers as $per_day)
                            @php 
                            $style = date("Y-m-d")==$per_day->updated_at->format("Y-m-d") ? 'red' : 'none';
                            @endphp
                            <tr @if($per_day->status !== 'pending') style="color:{{ $style }};" @endif>
                                <td id="hint">{{ $per_day->name }}</td>
                                <td id="hint">{{ $per_day->comment }}</td>
                                <td id="hint">{{ $per_day->bonus }}</td>
                                <td id="hint">{{ $per_day->class }}</td>
                                <td id="hint">{{ $per_day->per_class }}</td>
                                <td id="hint">{{ $per_day->total }}</td>
                            @if($per_day->status === 'pending')
                                <td id="hint">{{ $per_day->created_at }}</td>
                            @else
                                <td id="hint">{{ $per_day->updated_at }}</td>
                            @endif
                                
                            @if($per_day->status === 'pending')
                                <td>
                                    <form action="{{ route('salary.update') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$per_day->id}}">
                                        <button onclick="return confirm('Are you sure you want to PAID this item?');" type="submit" class="btn btn-outline-success btn-sm">Pending</button>
                                    </form>
                                </td>
                            @else
                                <td id="hint">PAID</td>
                            @endif
                            </tr>
                            @endforeach      
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')

<script type="text/javascript">
    $(function() {
        $("#bonus, #classes, #per_class").on("keydown keyup", sum);
        function sum() {
           $("#total").val(Number($("#bonus").val()) + Number($("#classes").val()) * Number($("#per_class").val()));
       }
   });
</script>

@stop