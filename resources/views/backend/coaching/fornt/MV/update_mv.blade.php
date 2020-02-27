@extends('layouts.backend')

@section('title') {{ auth()->user()->abbreviation . ' Mission and Vision Correction'}} @stop

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

						<form  action="{{ route('mission-and-visions.update',$mv) }}" method="post"> 
							@method('PUT')
							@csrf
							<h1>{{ auth()->user()->abbreviation . ' Mission and Vision Correction'}}</h1> 
							

							<p> 
								<label for="mission_description"> Mission Description </label>
								<textarea id="mission_description" value="" name="mission_description" required="required" rows="6" cols="60">{{ $mv->mission_description }}</textarea>
							</p>

							<p> 
								<label for="vision_description"> Vision Description </label>
								<textarea id="vision_description" value="" name="vision_description" required="required" rows="6" cols="60">{{ $mv->vision_description }}</textarea>
							</p>

							
							<p class="login button"> 
								<input type="submit" onclick="return confirm('Are you sure you want to submit this item?');" value="Correct Mission" /> 
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