@extends('layouts.backend')

@section('title') {{ auth()->user()->abbreviation . ' Student Admission'}} @stop

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

						<form  action="{{ route('coaching-students.store') }}" enctype="multipart/form-data" method="post"> 
							@csrf
							<h1>{{ auth()->user()->abbreviation . ' Student Admission'}}</h1> 
							<p> 
								<label for="name"> Student Name: </label>
								<input id="name" name="name" value="{{old('name')}}" required="required" type="text" placeholder="Bangladesh"/>
							</p>

							<p> 
								<label for="school_name"> Current School Name (optional): </label>
								<input id="school_name" name="school_name" value="{{old('school_name')}}" type="text" placeholder="Bangladesh"/>
							</p>

							<div style="width: 45%;float: left;margin-right: 5%;">
								<p>
									<label for="amd_class"> Admitted Class (select one): </label>
									<select id="class" class="dynamic" data-dependent="section" name="amd_class" required>
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
									<label for="amd_type"> Admission Type (select one): </label>
									<select id="amd_type" type="text" name="amd_type" required>
										<option value="" selected>--select option--</option>
										<option value="regular">Regular Batch</option>
										<option value="special">Special Batch</option>
									</select> 
								</p>
							</div>

							<div style="width: 45%;float: left;margin-right: 5%;">
								<p> 
									<label for="class_roll"> Class Roll (number only): </label>
									<input id="class_roll" value="{{old('class_roll')}}" name="class_roll" required="required" type="number" step="0.01" placeholder="1"/>
								</p> 
							</div>

							<div style="width: 48%;float: left;">
								<p> 
									<label for="tution_fee"> Tution Fees (number only): </label>
									<input id="tution_fee" value="{{old('tution_fee')}}" name="tution_fee" required="required" type="number" step="0.01" placeholder="888"/>
								</p> 
							</div>

							<p> 
								<label for="address"> Address </label>
								<textarea id="address" value="" name="address" required="required" rows="2" cols="60" placeholder="eg. X8df!90EO">{{old('address')}}</textarea>
							</p>

							<p> 
								<label for="guardian_name"> Guardian Name </label>
								<input id="guardian_name" value="{{old('guardian_name')}}" name="guardian_name" required="required" type="text" placeholder="MR. ABC" /> 
							</p>

							<div style="width: 45%;float: left;margin-right: 5%;">
								<p> 
									<label for="grd_phone"> Guardian Phone: </label>
									<input id="grd_phone" value="{{old('grd_phone')}}" name="grd_phone" required="required" type="number" step="0.01" placeholder="8801xxxxxxxxx"/>
								</p> 
							</div>

							<div style="width: 48%;float: left;">
								<p> 
									<label for="std_phone"> Student Phone (optional): </label>
									<input id="std_phone" value="{{old('std_phone')}}" name="std_phone" type="number" placeholder="8801xxxxxxxxx"/>
								</p> 
							</div>
							
							<div style="width: 45%;float: left;margin-right: 5%;">
								<p> 
									<label for="commitment">Commitment (optional) {{-- Only For Special Batch Student --}}:</label>
									<input id="commitment" value="{{old('commitment')}}" name="commitment" type="text" placeholder="eg. X8df!90EO" /> 
								</p>
							</div>

							<div style="width: 48%;float: left;">
								<p> 
									<label for="image"> Student Image (optional): </label>
									<input id="image" name="image" value="{{old('image')}}" type="file" />
								</p> 
							</div>

							<div style="width: 45%;float: left;margin-right: 5%;">
								<p> 
									<label for="reference">Reference By (nick name):</label>
									<input id="reference" value="{{old('reference')}}" name="reference" required="required" type="text" placeholder="foisal" /> 
								</p>
							</div>

							<div style="width: 48%;float: left;">
								<p>
									<label for="section"> Batch (select one): </label>
									<select id="section" type="text" name="section" required>
										<option value="" selected>--select option--</option>
										
									</select> 
								</p> 
							</div>
			
			{{-- limitation of student registration --}}			
						@if($student >= 0)
							<p class="login button"> 
								<input type="submit" onclick="return confirm('Are you sure you want to submit this item?');" value="Add Student" /> 
							</p>	
						@else
							<p class="btn btn-danger">
								<input disabled value="Student Overflow" /> 
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
	$(document).ready(function(){

		$('.dynamic').change(function(){
			if($(this).val() != '')
			{
				var select = $(this).attr("id");
				var value = $(this).val();
				var dependent = $(this).data('dependent');
				var _token = $('input[name="_token"]').val();
				$.ajax({
					url:"{{ route('class.assigned_section') }}",
					method:"POST",
					data:{select:select, value:value, _token:_token, dependent:dependent},
					success:function(result)
					{
						$('#'+dependent).html(result);
					}

				})
			}
		});

		$('#class').change(function(){
			$('#section').val('');
		});



	});
</script>

@stop