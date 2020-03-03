@extends('layouts.backend')

@section('title') {{ auth()->user()->abbreviation . ' Exam Details for '.$exam_title}} @stop

@section('css')

<style>

	/** The wrapper that will contain our two forms **/
	.content-wrapper {
		border-left: 20px solid white;
	}
	#wrapper{
		width: 100%;
		right: 0px;
		min-height: 560px;	
		margin: 0px auto;
		position: relative;	
	}

	label {
		display: inline-block;
		margin-bottom: 0; 
	}

	.table td { font-size: 20px; }
	tbody { font-family: 'Ubuntu', sans-serif; }
	/**** Styling the form elements **/
	
</style>

@stop
@section('foisal')


<div class="row" style="margin-bottom: -20%;">
	
	<div class="col-md-12 grid-margin">
		<div class="d-flex justify-content-between align-items-center">
			<div id="container_demo"  style="width: -webkit-fill-available;width: -moz-available;">


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

						<form  action="{{ route('exam.section.subject_store') }}" method="post"> 
							@csrf
							<h1>{{ auth()->user()->abbreviation . ' Exam Details for '.$exam_title}}</h1>

							<table class="table table-bordered" id="dynamicTable">  
								<tr>
									<th>Class (select one)</th>
									<th>Section (select one)</th>
									<th>Subject</th>
									<th>Mark</th>
								</tr>
								<tr>  
									<td>
										<select required id="class" class="dynamic" data-dependent="section" type="text" name="class">
											<option value="" selected>--select option--</option>

											<option value="20">Play Group</option>
											<option value="21">Nursery</option>

											@for( $i=1; $i<=12; $i++)
											<option value="{{ $i }}">{{ 'Class - '.$i }}</option>
											@endfor
										</select>
									</td>  
									<td>
										<select required id="section" name="section">
											<option value="" selected>--select option--</option>
											
										</select> 
									</td>  
									<td>
										<select required name="subject">
											<option value="" selected>--select option--</option>

											@foreach($lists as $list)
											<option value="{{ $list->subject_code }}">{{ $list->subject_name }}</option>
											@endforeach
										</select>
									</td>  
									<td>
										<input id="Mark" name="Mark" required="required" type="number"/> 
									</td>  
									<input required type="hidden" name="exam_title" type="text" value="{{ $exam_title }}">
								</tr>  
							</table> 

							<p class="login button"> 
								<input type="submit" onclick="return confirm('Are you sure you want to submit this item?');" value="Add Exam" /> 
							</p>
							
						</form>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>

<!-- display all class and subject under distinct test -->
@php
	$examination = \App\Models\Coaching\CoachingExamSectionSubject::where('inst_identity',auth()->user()->FI)->where('exam_title',$exam_title)->orderBy('section','asc')->get();
@endphp

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            
            <div class="card-body">
                <p class="card-title mb-0">Examination List</p> <hr>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Exam Name</th>
                                <th>Class</th>
                                <th>Section</th>
                                <th>Subject</th>
                                <th>Mark</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($examination as $exam)
                            <tr>
                                <td>{{ $exam->exam_title }}</td>
                                <td>{{ $exam->class_type }}</td>
                                <td>{{ $exam->section }}</td>
                                <td>{{ $exam->subject }}</td>
                                <td>{{ $exam->mark }}</td>
                                <td>{{ date('m/d/Y || h:i:s a', strtotime($exam->created_at)) }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Dropdown
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

       	{{-- checking weather this subject mark is inserted or not, if not then show the insert option by distinct year --}}
										@php
											$check = \App\Models\Coaching\CoachingMark::select('mark')->where(
												[
													'inst_identity' => $exam->inst_identity,
													'section' => $exam->section,
													'subject' => $exam->subject,
													'exam_title' => $exam_title,
												])->whereYear('created_at',$exam->created_at)->first();
										@endphp

										@if(!$check)
	                                        <a href="{{ route('exam.number.area_show',$exam) }}" class="btn btn-outline-info dropdown-item">
	                                            Add Number
	                                        </a>
										@endif

	                                        <a href="{{ route('exam.number.area_detail',$exam) }}" class="btn btn-outline-info dropdown-item">
	                                            Exam Details
	                                        </a>

                                            <form action="{{ route('exam.section.subject_delete',$exam) }}" method="post">
                                                @csrf
                                                <button onclick="return confirm('Are you sure you want to delete this item?');" type="submit" class="btn btn-outline-danger dropdown-item">Delete</button>
                                            </form>
                                        </div>
                                    </div>  
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
