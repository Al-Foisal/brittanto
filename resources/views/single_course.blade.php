@extends('layouts.publicly_visible')

@section('title') {{ $course->course_title }} @stop

@section('css')
<style>
#hint{
    overflow-x: auto;
    white-space: pre-wrap;
    white-space: -moz-pre-wrap;
    white-space: -pre-wrap;
    white-space: -o-pre-wrap;
    word-wrap: break-word;
    font-family: 'Ubuntu', sans-serif;
    font-size: 21px;
    font-style: normal;
    font-weight: 400;
    color: rgba(0, 0, 0, 0.84);
    line-height: 1.58;
    letter-spacing: -0.004em;
    line-height: 1.58;
}

</style>
@stop

@section('foisal')

<!-- Start Breadcrumbs -->
<section class="breadcrumbs overlay">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h2>Course Pages</h2>
				<ul class="bread-list">
					<li><a href="{{ route('institution.details',$course->inst_identity) }}">Home<i class="fa fa-angle-right"></i></a></li>
					<li class="active"><a href="{{ route('institution.single_course',$course) }}">Course Single</a></li>
				</ul>
			</div>
		</div>
	</div>
</section>
<!--/ End Breadcrumbs -->

<!-- Courses -->
<section class="courses single section">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="single-main">
					<div class="row">
						<div class="col-lg-8 col-12">
							<!-- Single Course -->
							<div class="single-course">
								<div class="course-head">		
									<img src="{{ asset('storage/storage/'.$course->inst_identity.'/course/'.$course->course_banar)}}" alt="{{ $course->course_title}}">
								</div>			
							</div>
							<!--/ End Single Course -->
						</div>	
						<div class="col-lg-4 col-12">
							<!-- Course Features -->
							<div class="course-feature">
								<div class="feature-main">
									<h4>Course Features</h4>
									<!-- Single Feature -->
									@foreach($features as $feature)
									<div class="single-feature">
										<i class="fa fa-check-square-o"></i>
										<span class="label">
											{{ $feature->course_category_title}}
										</span>
										<span class="value">
											{{ $feature->course_category_value }}
										</span>
									</div>
									@endforeach
									<!--/ End Single Feature -->
								</div>
							</div>
							<!--/ End Course Features -->
						</div>	
					</div>	
					<div class="row" style="margin-top: 100px;">
						
						<div class="col-12">
							<div class="content">
								<h2 style="color:#00b16a;">{{ $course->course_title }}</h2>
								<p id="hint">{{ $course->course_description }}</p>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--/ End Courses -->	

@stop