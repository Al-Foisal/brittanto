@extends('layouts.backend')

@section('title') {{ auth()->user()->abbreviation . ' Notice Board' }} @stop

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
            <div id="container_demo" style="width: -webkit-fill-available;width: -moz-available;">


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
                        <form method="post" action="{{ route('notice-boards.store')}}" enctype="multipart/form-data"> 
                            @csrf

                            <h1>{{ auth()->user()->abbreviation . ' Notice Board' }}</h1> 

                            <p> 
                                <label for="notice_title"> Notice Title: </label>
                                <input id="notice_title" value="{{old('notice_title')}}" name="notice_title" required="required" type="text" placeholder="Enter the notice title" />
                            </p> 

                            <p> 
                                <label for="notice_content"> Notice: </label>
                                <input id="notice_content" name="notice_content" required="required" type="file"/>
                            </p> 

                            <p class="login button"> 
                                <input type="submit" onclick="return confirm('Are you sure you want to submit this item?');" value="Add Notice" /> 
                            </p>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>



@stop

