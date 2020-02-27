@extends('layouts.forntend')

@section('title') {{ config('app.name') }} logni form @stop

@section('foisal')

<section>				
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
                <form  action="{{ route('login') }}" method="post">
                    @csrf 
                    <h1>Log in</h1> 
                    <p> 
                        <label for="username"> Your email </label>
                        <input id="username" value="{{old('email')}}" name="email" required="required" type="email" placeholder="mymail@mail.com"/>
                    </p>
                    <p> 
                        <label for="password"> Your password </label>
                        <input id="password" name="password" required="required" type="password" placeholder="eg. X8df!90EO" /> 
                    </p>



                    <p class="login button"> 
                        <input type="submit" value="Login" /> 
                    </p>
                    <p class="change_link">
                        <a style="float: left;" class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>

                        Not a member yet ?
                        <a href="{{ route('register') }}" class="to_register">Join us</a>
                    </p>
                </form>
            </div>
        </div>
    </div>  
</section>

@stop