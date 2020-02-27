@extends('layouts.backend')

@section('title') {{ auth()->user()->abbreviation . ' Student Data Correction'}} @stop

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

						<form  action="{{ route('coaching-students.update',$student->id) }}" method="post">
							@method('PUT') 
							@csrf
							<h1>{{ auth()->user()->abbreviation . ' Student Data Correction'}}</h1> 
							<p> 
								<label for="name"> Student Name: </label>
								<input id="name" name="name" value="{{ $student->name }}" required="required" type="text"/>
							</p>

							<p> 
								<label for="school_name"> Current School Name: </label>
								<input id="school_name" name="school_name" value="{{ $student->school_name }}" type="text"/>
							</p>

							<div style="width: 45%;float: left;margin-right: 5%;">
								<p> 
									<label for="tution_fee"> Tution Fees: </label>
									<input id="tution_fee" value="{{ $student->tution_fee }}" name="tution_fee" required="required" type="number" step="0.01"/>
								</p> 
							</div>

							<div style="width: 48%;float: left;">
								<p>
									<label for="amd_type"> Admission Type (select one): </label>
									<select id="amd_type" type="text" name="amd_type" required>
										<option value="regular" @if($student->amd_type === 'regular') selected @endif>
											Regular Batch
										</option>
										<option value="special" @if($student->amd_type === 'special') selected @endif>
											Special Batch
										</option>
									</select> 
								</p>
							</div>

							<div style="width: 45%;float: left;margin-right: 5%;">
								<p> 
									<label for="grd_phone"> Guardian Phone: </label>
									<input id="grd_phone" value="{{ $student->grd_phone }}" name="grd_phone" required="required" type="number" step="0.01"/>
								</p> 
							</div>

							<div style="width: 48%;float: left;">
								<p> 
									<label for="std_phone"> Student Phone: </label>
									<input id="std_phone" value="{{ $student->std_phone }}" name="std_phone" type="number" step="0.01"/>
								</p> 
							</div>

							<div style="width: 45%;float: left;margin-right: 5%;">
								<p>
									<label for="amd_class"> Admitted Class (select one): </label>
									<select id="class" class="dynamic" data-dependent="section" name="amd_class" required>
										<option value="{{ $student->amd_class }}" selected>{{ $student->class_type }}</option>

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
									<label for="section"> Batch (select one): </label>
									<select id="section" type="text" name="section" required>
										<option value="{{$student->section}}" selected>{{$student->section}}</option>

										
									</select> 
								</p> 
							</div>

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