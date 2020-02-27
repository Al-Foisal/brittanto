@extends('layouts.backend')

@section('title') {{ auth()->user()->abbreviation . ' Event Correction' }} @stop

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
                        <form method="post" action="{{ route('upcoming-events.update',$event)}}" enctype="multipart/form-data"> 
                            @method('PUT')
                            @csrf

                            <h1>{{ auth()->user()->abbreviation . ' Event Correction Area' }}</h1> 

                            
                            <p> 
                                <label for="event_title"> Event Title: </label>
                                <input id="event_title" value="{{$event->event_title}}" name="event_title" required="required" type="text" placeholder="Enter the event title" />
                            </p>

                            <div style="width: 45%;float: left;margin-right: 5%;">
                                <div style="width: 45%;float: left;margin-right: 8%;">
                                    <p> 
                                        <label for="event_date"> Event Date: </label>
                                        <input id="event_date" name="event_date" value="{{ $event->event_date }}" type="date"/>
                                    </p> 
                                </div>

                                <div style="width: 45%;float: left;">
                                    <p> 
                                        <label for="event_start"> Event Starts: </label>
                                        <input id="event_start" name="event_start" required="required" value="{{ date('h:i',strtotime($event->event_start)) }}" type="time"/>
                                    </p> 
                                </div>
                            </div>

                            <div style="width: 48%;float: left;">
                                <div style="width: 45%;float: left;margin-right: 8%;">
                                    <p> 
                                        <label for="event_end"> Event End Time: </label>
                                        <input id="event_end" value="{{ date('h:i',strtotime($event->event_end)) }}" name="event_end" required="required" type="time"/>
                                    </p> 
                                </div>

                                <div style="width: 45%;float: left;">
                                    <p> 
                                        <label for="event_banar"> Event Banar: </label>
                                        <input id="event_banar" name="event_banar" type="file"/>
                                    </p> 
                                </div>
                            </div>

                            <p> 
                                <label for="event_description"> Event Description </label>
                                <textarea id="event_description" name="event_description" required="required" rows="10" cols="60">{{$event->event_description}}</textarea>
                            </p>

                            <p class="login button"> 
                                <input type="submit" onclick="return confirm('Are you sure you want to submit this item?');" value="Add Event" /> 
                            </p>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>



@stop

