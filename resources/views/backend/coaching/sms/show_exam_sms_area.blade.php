@extends('layouts.backend')

@section('title') {{ auth()->user()->abbreviation . ' SMS Area'}} @stop

@section('foisal')
<!-- submission f lash message starts -->
@if(session()->has('message'))
<div class="alert alert-info">
	{{ session('message') }}
</div>
@endif
<!-- submission flash message ends -->
<div class="table-responsive">
	<form action="{{ route('sms.exam.send') }}" method="post">
		@csrf
		<button type="submit" {{ $disabled }} onclick="return confirm('Are you sure want to send SMS?');" class="btn btn-primary"> Sent SMS All Selected Number</button>

		<p>
			<label for="role"> Test Name (select one): </label>
			<select id="role" type="text" name="exam_title" required>
				<option value="" selected>--select option--</option>
				@foreach($exam_title as $title)
				<option value="{{ $title->exam_title }}">{{ $title->exam_title }}</option>
				@endforeach
			</select>
		</p>
	<table class="table table-hover">
		<thead>
			<tr>
				<th>
					<input type="checkbox" name="permission" id="selecctall"/>All
				</th>
				<th>Student Name</th>
				<th>Student ID</th>
				<th>Section</th>
			</tr>
		</thead>
		<tbody>
			@foreach($students as $student)
			<tr>
				<td>
					<input class="permission" type="checkbox" name="std_id[]" value="
					{{ $student->std_id }}">
				</td>
				<td>{{ $student->name }}</td>
				<td>{{ $student->std_id }}</td>
				<td><input type="hidden" name="section" value="{{ $student->section }}">{{ $student->section }}</td>
			</tr>
			@endforeach      
		</tbody>
	</table>
	

</form>
</div>
@stop

@section('js')
<script>
	$(document).ready(function() {
	    $('#selecctall').click(function(event) { 
	        if(this.checked) { // check select status
	            $('.permission').each(function() { 
	                this.checked = true;  //select all 
	            });
	        }else{
	            $('.permission').each(function() { 
	                this.checked = false; //deselect all             
	            });        
	        }
	    });
	   
	});
</script>
@stop