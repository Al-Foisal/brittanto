@extends('layouts.backend')

@section('title') {{ auth()->user()->abbreviation . ' Employee Registration'}} @stop

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

						<form  action="{{ route('coaching-employees.store') }}" enctype="multipart/form-data" method="post"> 
							@csrf
							<h1>{{ auth()->user()->abbreviation . ' Employee Registration'}}</h1> 
							<p> 
								<label for="name"> Employee Name: </label>
								<input id="name" name="name" value="{{old('name')}}" required="required" type="text" placeholder="Bangladesh"/>
							</p>

							<p> 
								<label for="thr_study_inst"> Studied Institution Name: </label>
								<input id="thr_study_inst" name="thr_study_inst" value="{{old('thr_study_inst')}}" required="required" type="text" placeholder="Bangladesh"/>
							</p>

							<div style="width: 45%;float: left;margin-right: 5%;">
								<p>
									<label for="role"> Enrollment As (select one): </label>
									<select id="role" type="text" name="role" required>
										<option value="" selected>--select option--</option>
										<option value="teacher">Teacher</option>
										<option value="staff">Staff</option>
									</select> 
								</p>
							</div>

							<div style="width: 48%;float: left;">
								<p>
									<label for="study"> Educational Eligibility (select one): </label>
									<select id="study" type="text" name="study" required>
										<option value="" selected>--select option--</option>
										<option value="hsc">HSC</option>
										<option value="honurs">Honurs</option>
										<option value="masters">Masters or High</option>
									</select> 
								</p>
							</div>

							<div style="width: 45%;float: left;margin-right: 5%;">
								<p> 
									<label for="phone"> Employee Phone: </label>
									<input id="phone" value="{{old('phone')}}" name="phone" required="required" type="number" step="0.01" placeholder="1"/>
								</p> 
							</div>

							<div style="width: 48%;float: left;">
								<p> 
									<label for="salary"> Employee Salary: </label>
									<input id="salary" value="{{old('salary')}}" name="salary" required="required" type="number" step="0.01" placeholder="888"/>
								</p> 
							</div>

							<p> 
								<label for="address"> Address </label>
								<textarea id="address" value="{{old('address')}}" name="address" required="required" rows="2" cols="60" placeholder="eg. X8df!90EO"></textarea>
							</p>

							<div style="width: 45%;float: left;margin-right: 5%;">
								<p>
									<label for="commitment"> Salary Commitment (select one): </label>
									<select id="commitment" type="text" name="commitment" required>
										<option value="" selected>--select option--</option>
										<option value="per_class">Per Class Payment</option>
										<option value="fixed">Fixed Payment</option>
									</select> 
								</p>
							</div>

							<div style="width: 48%;float: left;">
								<p> 
									<label for="image"> Employee Image (optional): </label>
									<input id="image" name="image" value="{{old('image')}}" type="file" />
								</p>							
							</div>
				{{-- employee limitation condition --}}
						@if($employee >= 0)
							<p class="login button"> 
								<input type="submit" onclick="return confirm('Are you sure you want to submit this item?');" value="Add Employee" /> 
							</p>	
						@else
							<p class="btn btn-danger">
								<input disabled value="Employee Overflow" /> 
							</p>
						@endif
							
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