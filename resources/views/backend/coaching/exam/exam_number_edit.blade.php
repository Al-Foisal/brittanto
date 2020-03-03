@extends('layouts.backend')

@section('title') {{ auth()->user()->abbreviation . ' Examination Number Update Area'}} @stop

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


<div class="row">
    
    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between align-items-center">
            <div id="container_demo"  style="width: -webkit-fill-available;width: -moz-available;">


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

                        <form  action="{{ route('exam.number.area_update',$number) }}" method="post"> 
                            @csrf
                            <h1>{{ auth()->user()->abbreviation . ' Examination Number Update Area'}}</h1> 

                            <table class="table table-bordered">
                                <tr class=" text-center">
                                    <th>Examination/Test Details</th>
                                </tr>
                                <tr>
                                    <td>
                                        <ol>
                                            <li>Exam Name: {{ $number->exam_title }}</li>
                                            <li>Class: {{ $number->class_type }}</li>
                                            <li>Section: {{ $number->section }}</li>
                                            <li>Subject: {{ $number->subject }}</li>
                                            <li>Total Marks: {{ $number->defined_mark }}</li>
                                        </ol>
                                    </td>
                                </tr> 
                            </table>
<hr>
                            <table class="table table-bordered"> 
                                <tr>
                                    <th>Student Name</th>
                                    <th>Student ID</th>
                                    <th>Mark</th>
                                </tr>

                                <tr> 
                                    <td>
                                        <input id="student_name" name="student_name" required value="{{ $number->student_name }}" readonly type="text"/>
                                    </td>  
                                    <td>
                                        <input id="student_id" name="student_id" required="required" type="number" value="{{ $number->student_id }}" readonly />
                                    </td>  
                                    <td>
                                        <input id="mark" name="mark" required="required" value="{{ $number->mark }}" type="number"/>
                                    </td>  
                                </tr> 
                            </table> 
                            
                            

                            <p class="login button"> 
                                <input type="submit" onclick="return confirm('Are you sure you want to submit this item?');" value="Update Number" /> 
                            </p>
                            
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


@stop

