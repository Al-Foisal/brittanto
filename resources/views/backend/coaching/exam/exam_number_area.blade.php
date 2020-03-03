@extends('layouts.backend')

@section('title') {{ auth()->user()->abbreviation . ' Examination Number Area'}} @stop

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
<!-- sending $exam paramiter from coaching_exam_section_subjects_table to reach our distination and mark validation -->
                        <form  action="{{ route('exam.number.area_store',$exam) }}" method="post"> 
                            @csrf
                            <h1>{{ auth()->user()->abbreviation . ' Examination Number Area'}}</h1> 

                            <table class="table table-bordered">
                                <tr class=" text-center">
                                    <th>Examination/Test Details</th>
                                </tr>
                                <tr>
                                    <td>
                                        <ol>
                                            <li>Exam Name: {{ $exam->exam_title }}</li>
                                            <li>Class: {{ $exam->class_type }}</li>
                                            <li>Section: {{ $exam->section }}</li>
                                            <li>Subject: {{ $exam->subject }}</li>
                                            <li>Total Marks: {{ $exam->mark }}</li>
                                        </ol>
                                    </td>
                                </tr> 
                            </table>
<hr>
                            <table class="table table-bordered"> 
                                <tr>
                                    <th>SI.</th>
                                    <th>Student Name</th>
                                    <th>Student ID</th>
                                    <th>Mark</th>
                                </tr>

                            @php $j=0 @endphp
                            @foreach($students as $student)
                                <tr>  
                                    <td>{{++$j}}</td>
                                    <td>
                                        <input id="student_name" name="student_name[]" required value="{{ $student->name }}" readonly type="text"/>
                                    </td>  
                                    <td>
                                        <input id="student_id" name="student_id[]" required="required" type="number" value="{{ $student->std_id }}" readonly />
                                    </td>  
                                    <td>
                                        <input id="mark" name="mark[]" required="required" type="number"/>
                                    </td>  
                                </tr> 
                                <input type="hidden" name="test_id[]" value="{{ $exam->id }}"> 
                                <input type="hidden" name="section[]" value="{{ $exam->section }}"> 
                                <input type="hidden" name="exam_title[]" value="{{ $exam->exam_title }}"> 
                                <input type="hidden" name="subject[]" value="{{ $exam->subject }}"> 
                                <input type="hidden" name="class[]" value="{{ $exam->class }}"> 
                                <input type="hidden" name="defined_mark[]" value="{{ $exam->mark }}"> 
                                <input type="hidden" name="inst_identity[]" value="{{ $exam->inst_identity }}"> 
                            @endforeach
                            </table> 
                            
                            

                            <p class="login button"> 
                                <input type="submit" onclick="return confirm('Are you sure you want to submit this item?');" value="Add Exam" /> 
                            </p>
                            
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


@stop

