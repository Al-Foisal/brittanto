@extends('layouts.backend')

@section('title') {{ auth()->user()->abbreviation . ' Owner Registration '}} @stop

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

						<form  action="{{ route('coaching-owners.store') }}" enctype="multipart/form-data" method="post"> 
							@csrf
							<h1>
								{{ auth()->user()->abbreviation . ' Owner Registration '}}
							</h1> 
							<p> 
								<label for="name"> Owner Name: </label>
								<input id="name" name="name" value="{{old('name')}}" required="required" type="text" placeholder="Bangladesh"/>
							</p>
							
							<div style="width: 45%;float: left;margin-right: 5%;">
								<p> 
									<label for="email"> Owner Email: </label>
									<input id="email" name="email" value="{{old('email')}}" required="required" type="email" placeholder="example@gmail.com"/>
								</p>	
							</div>
							<div style="width: 48%;float: left;">
								<p> 
									<label for="image"> Owner Image (optional): </label>
									<input id="image" name="image" value="{{old('image')}}" type="file" />
								</p>	
							</div>					

							<div style="width: 45%;float: left;margin-right: 5%;">
								<p> 
									<label for="position"> Position: </label>
									<input id="position" value="{{old('position')}}" name="position" required="required" type="text" placeholder="President"/>
								</p> 
							</div>

							<div style="width: 48%;float: left;">
								<p> 
									<label for="phone"> Phone: </label>
									<input id="phone" value="{{old('phone')}}" name="phone" required="required" type="number" step="0.01" placeholder="888"/>
								</p> 
							</div>

							<p> 
								<label for="message"> Message </label>
								<textarea id="message" name="message" required="required" rows="3" cols="60">{{old('message')}}</textarea>
							</p>

							<p class="login button"> 
								<input type="submit" onclick="return confirm('Are you sure you want to submit this item?');" value="Add Owners" /> 
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