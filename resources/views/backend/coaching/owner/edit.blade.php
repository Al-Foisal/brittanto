@extends('layouts.backend')

@section('title') {{ auth()->user()->abbreviation . ' Owner Data Correction'}} @stop

@section('css')

<style>

	/** The wrapper that will contain our two forms **/
	.content-wrapper {
		border-left: 20px solid white;
	}
	#container_demo{
		width: 85%;	
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

						<form  action="{{ route('coaching-owners.update',$owner->id) }}" method="post">
							@method('PUT') 
							@csrf
							<h1>{{ auth()->user()->abbreviation . ' Owner Data Correction'}}</h1> 
							<p> 
								<label for="name"> Owner Name: </label>
								<input id="name" name="name" value="{{ $owner->name}}" required="required" type="text"/>
							</p>							

							<div style="width: 45%;float: left;margin-right: 5%;">
								<p> 
									<label for="position"> Position: </label>
									<input id="position" value="{{ $owner->position}}" name="position" required="required" type="text"/>
								</p> 
							</div>

							<div style="width: 48%;float: left;">
								<p> 
									<label for="phone"> Phone: </label>
									<input id="phone" value="{{ $owner->phone}}" name="phone" required="required" type="number" step="0.01"/>
								</p> 
							</div>

							<p> 
								<label for="message"> Message </label>
								<textarea id="message" name="message" required="required" rows="2" cols="60">{{ $owner->message}}</textarea>
							</p>

							<p class="login button"> 
								<input type="submit" onclick="return confirm('Are you sure you want to submit this item?');" value="Add Correction" /> 
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