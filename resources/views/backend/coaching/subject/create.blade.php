@extends('layouts.backend')

@section('title') {{ auth()->user()->abbreviation . ' Subject Lists'}} @stop

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

						<form  action="{{ route('subject-lists.store') }}"  method="post"> 
							@csrf
							<h1>{{ auth()->user()->abbreviation . ' Subject'}}</h1> 
							<p> 
								<label for="subject_name"> Subject Name: </label>
								<input id="subject_name" name="subject_name" value="{{old('subject_name')}}" required="required" type="text" placeholder="Bangladesh"/>
							</p>
							<p class="login button"> 
								<input type="submit" onclick="return confirm('Are you sure you want to submit this item?');" value="Add Subject" /> 
							</p>
							
						</form>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

@php

$subjects = \App\Models\Coaching\CoachingSubjectList::where('inst_identity',auth()->user()->FI)->orderBy('id','desc')->get();
@endphp
@if($subjects)
<div class="row" style="margin-top: -20%;">
	<div class="col-md-12 grid-margin stretch-card">
		<div class="card">

			<div class="card-body">
				<p class="card-title mb-0">Subject List</p> <hr>
				<div class="table-responsive">
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Serial No.</th>
								<th>Subject Name</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($subjects as $subject)
							<tr>
								<td>{{ $loop->iteration }}</td>
								<td>{{ $subject->subject_name }}</td>
								<td>
									<form action="{{ route('subject-lists.destroy',$subject) }}" method="post">
										@method('DELETE')
										@csrf
										<button onclick="return confirm('Are you sure you want to delete this item?');" type="submit" class="btn btn-outline-danger">Delete</button>
									</form>
								</td>
							</tr>
							@endforeach      
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endif

@stop