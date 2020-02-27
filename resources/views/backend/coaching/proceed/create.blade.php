@extends('layouts.backend')

@section('title') {{ auth()->user()->abbreviation . ' Student Money Receipt'}} @stop

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

						<form  action="{{ route('coaching-proceeds.store') }}" method="post"> 
							@csrf
							<h1>{{ auth()->user()->abbreviation . ' Student Money Receipt'}}</h1> 

							<div style="width: 75%;float: left;margin-right: 5%;">
								<p> 
									<label for="first_input_title"> CASE 1: </label>
									<input id="first_input_title" value="{{old('first_input_title')}}" name="first_input_title" required="required" type="text" placeholder="First cost title"/>
								</p> 
							</div>

							<div style="width: 18%;float: left;">
								<p> 
									<label for="first_money"> Money (Case 1): </label>
									<input id="first_money" value="{{old('first_money')}}" name="first_money" required="required" type="number" step="0.01" placeholder="0"/>
								</p> 
							</div>

							<div style="width: 75%;float: left;margin-right: 5%;">
								<p> 
									<label for="second_input_title"> CASE 2: </label>
									<input id="second_input_title" value="{{old('second_input_title')}}" name="second_input_title" required="required" type="text" placeholder="Second cost title"/>
								</p> 
							</div>

							<div style="width: 18%;float: left;">
								<p> 
									<label for="second_money"> Money (Case 2): </label>
									<input id="second_money" value="{{old('second_money')}}" name="second_money" required="required"  type="number"  placeholder="0"/>
								</p> 
							</div>

							<div style="width: 75%;float: left;margin-right: 5%;">
								<p> 
									<label for="third_input_title"> CASE 3: </label>
									<input id="third_input_title" value="{{old('third_input_title')}}" name="third_input_title" type="text"/>
								</p> 
							</div>

							<div style="width: 18%;float: left;">
								<p> 
									<label for="third_money"> Money (Case 3): </label>
									<input id="third_money" value="{{old('third_money')}}" name="third_money"  type="number" step="0.01"/>
								</p> 
							</div>

							<div style="width: 75%;float: left;margin-right: 5%;">
								<p> 
									<label for="fourth_input_title"> CASE 4: </label>
									<input id="fourth_input_title" value="{{old('fourth_input_title')}}" name="fourth_input_title" type="text"/>
								</p> 
							</div>

							<div style="width: 18%;float: left;">
								<p> 
									<label for="fourth_money"> Money (Case 4): </label>
									<input id="fourth_money" value="{{old('fourth_money')}}" name="fourth_money" type="number" step="0.01"/>
								</p> 
							</div>

							<div style="width: 75%;float: left;margin-right: 5%;">
								<p> 
									<label for="fifth_input_title"> CASE 5: </label>
									<input id="fifth_input_title" value="{{old('fifth_input_title')}}" name="fifth_input_title" type="text"/>
								</p> 
							</div>

							<div style="width: 18%;float: left;">
								<p> 
									<label for="fifth_money"> Money (Case 5): </label>
									<input id="fifth_money" value="{{old('fifth_money')}}" name="fifth_money" type="number" step="0.01"/>
								</p> 
							</div>

							<p class="login button"> 
								<input type="submit" onclick="return confirm('Are you sure you want to submit this item?');" value="Make Receipt" /> 
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