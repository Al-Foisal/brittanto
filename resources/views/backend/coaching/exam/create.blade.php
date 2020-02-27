@extends('layouts.backend')

@section('title') {{ auth()->user()->abbreviation . ' Examination Area'}} @stop
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

	label {
		display: inline-block;
		margin-bottom: 0; 
	}
	/**** Styling the form elements **/
	
</style>

@stop
@section('foisal')

<button onclick="goBack()" class="btn btn-secondary" style="float: left;">
    Back
</button>

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

						<form  action="{{ route('coaching-exam-titles.store') }}" method="post"> 
							@csrf
							<h1>{{ auth()->user()->abbreviation . ' Examination Area'}}</h1> 

							<div style="width: 45%;float: left;margin-right: 5%;">
								<p> 
									<label for="exam_title">Exam Title:</label>
									<input readonly id="exam_title" value="Test-{{ $focus }}" name="exam_title" required="required" type="text"/> 
								</p>
							</div>

							<div style="width: 48%;float: left;">
								<p> 
									<label for="exam_date">Exam Date:</label>
									<input id="exam_date" value="{{old('exam_date')}}" name="exam_date" required="required" type="date"/> 
								</p> 
							</div>

							<p> 
								<label for="start_time"> Exam Starts At: </label>
								<input id="start_time" value="{{old('start_time')}}" name="start_time" required="required" type="time"/>
							</p>

							<p class="login button"> 
								<input type="submit" onclick="return confirm('Are you sure you want to submit this item?');" value="Add Test" /> 
							</p>
							
						</form>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>


@stop


@section('js')

<script>
    function goBack() {
      window.history.back();
  }
</script>
@stop