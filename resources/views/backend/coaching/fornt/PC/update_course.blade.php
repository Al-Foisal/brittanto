@extends('layouts.backend')

@section('title') {{ auth()->user()->abbreviation . ' Popular Course Correction' }} @stop

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


<div class="row">

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
                        <form method="post" action="{{ route('popular-courses.update',$course)}}" enctype="multipart/form-data"> 
                            @method('PUT')
                            @csrf

                            <h1>{{ auth()->user()->abbreviation . ' Popular Course Correction Area' }}</h1> 

                            <div style="width: 45%;float: left;margin-right: 5%;">
                                <p> 
                                    <label for="course_title"> Course Title: </label>
                                    <input id="course_title" value="{{$course->course_title}}" name="course_title" required="required" type="text" placeholder="Enter the course title" />
                                </p> 
                            </div>

                            <div style="width: 48%;float: left;">
                                <p> 
                                    <label for="course_banar"> Course Banar: </label>
                                    <input id="course_banar" name="course_banar" value="{{ $course->course_banar }}" type="file"/>
                                </p> 
                            </div>

                            <div style="width: 45%;float: left;margin-right: 5%;">
                                <div style="width: 45%;float: left;margin-right: 8%;">
                                    <p> 
                                        <label for="course_label"> Course Label: </label>
                                        <input id="course_label" required name="course_label" value="{{ $course->course_label }}" type="text" placeholder="Class 1,2" />
                                    </p> 
                                </div>

                                <div style="width: 45%;float: left;">
                                    <p> 
                                        <label for="total_seat"> Number of Seats: </label>
                                        <input id="total_seat" name="total_seat" value="{{ $course->total_seat }}" required="required" type="number" placeholder="50"/>
                                    </p> 
                                </div>
                            </div>

                            <div style="width: 48%;float: left;">
                                <div style="width: 45%;float: left;margin-right: 8%;">
                                    <p> 
                                        <label for="course_duration"> Coerse Duration: </label>
                                        <input id="course_duration" value="{{ $course->course_duration }}" name="course_duration" required="required" type="text"/>
                                    </p> 
                                </div>

                                <div style="width: 45%;float: left;">
                                    <p> 
                                        <label for="course_fee"> Course Fee: </label>
                                        <input id="course_fee" name="course_fee" value="{{ $course->course_fee }}" required="required" type="number" placeholder="1500" />
                                    </p> 
                                </div>
                            </div>

                            <p> 
                                <label for="course_description"> Course Description </label>
                                <textarea id="course_description" name="course_description" required="required" rows="10" cols="60">{{$course->course_description}}</textarea>
                            </p>

                            <p class="login button"> 
                                <input type="submit" onclick="return confirm('Are you sure you want to submit this item?');" value="Add Course" /> 
                            </p>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>



@stop

