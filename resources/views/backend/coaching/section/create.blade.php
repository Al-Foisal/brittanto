@extends('layouts.backend')

@section('title') {{ auth()->user()->abbreviation . ' Section Setup'}} @stop

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

						<form  action="{{ route('coaching-sections.store') }}" method="post"> 
							@csrf
							<h1>{{ auth()->user()->abbreviation . ' Section Setup'}}</h1> 
							<div style="width: 45%;float: left;margin-right: 5%;">
								<p> 
									<label for="name"> Batch Numer: </label>
									<input id="name" name="name" value="{{ $focus }}" readonly required="required" type="number" step="0.01" placeholder="Bangladesh"/>
								</p>
							</div>

							<div style="width: 48%;float: left;">
								<p>
									<label for="type"> Gender (select one): </label>
									<select id="type" type="text" name="gender">
										<option value="" selected>--select option--</option>
										<option value="Male">Male</option>
										<option value="Female">Female</option>
										<option value="Both">Both</option>
									</select> 
								</p>
							</div>

							<div style="width: 45%;float: left;margin-right: 5%;">
								<p>
									<label for="class"> Section for Class (select one): </label>
									<select id="class" type="text" name="class" required>
										<option value="" selected>--select option--</option>
										
										<option value="20">Play Group</option>
										<option value="21">Nursery</option>
										
										@for( $i=1; $i<=12; $i++)
										<option value="{{ $i }}">{{ 'Class - '.$i }}</option>
										@endfor
									</select> 
								</p>
							</div>

							<div style="width: 48%;float: left;">
								<p>
									<label for="type"> Batch Type (select one): </label>
									<select id="type" type="text" name="type">
										<option value="" selected>--select option--</option>
										<option value="regular">Regular Batch</option>
										<option value="special">Special Batch</option>
										<option value="bm">Bangla Medium</option>
										<option value="bv">Bangla Varsion</option>
										<option value="em">English Medium</option>
										<option value="ev">English Varsion</option>
									</select> 
								</p>
							</div>

							<div style="width: 45%;float: left;margin-right: 5%;">
								<p> 
									<label for="start_time"> Batch Starts At: </label>
									<input id="start_time" value="{{old('start_time')}}" name="start_time" required="required" type="time"/>
								</p> 
							</div>

							<div style="width: 48%;float: left;">
								<p> 
									<label for="end_time"> Batch End At: </label>
									<input id="end_time" value="{{old('end_time')}}" name="end_time" required="required" type="time"/>
								</p> 
							</div>

							<p> 
								<label for="hint"> Hint </label>
								<textarea id="hint" name="hint" required="required" rows="2" cols="60" placeholder="Any text">{{old('hint')}}</textarea>
							</p>							

							<p class="login button"> 
								<input type="submit" onclick="return confirm('Are you sure you want to submit this item?');" value="Add Batch" /> 
							</p>
							
						</form>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>


@stop