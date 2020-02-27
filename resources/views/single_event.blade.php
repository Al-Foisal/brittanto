@extends('layouts.publicly_visible')

@section('title') {{ $event->event_title }} @stop

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
				<h2>Event Pages</h2>
				<ul class="bread-list">
					<li><a href="{{ route('institution.details',$event->inst_identity) }}">Home<i class="fa fa-angle-right"></i></a></li>
					<li class="active"><a href="{{ route('institution.single_event',$event) }}">Event Single</a></li>
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
									<img src="{{ asset('storage/storage/'.$event->inst_identity.'/event/'.$event->event_banar)}}" alt="{{ $event->event_title}}">
								</div>			
							</div>
							<!--/ End Single Course -->
						</div>	
						<div class="col-lg-4 col-12">
							<!-- Course Features -->
							<div class="course-feature">
								<div class="feature-main">
									<h4>Event Features</h4>
									<!-- Single Feature -->
									@foreach($features as $feature)
									<div class="single-feature">
										<i class="fa fa-check-square-o"></i>
										<span class="label">
											{{ $feature->event_category_title}}
										</span>
										<span class="value">
											{{ $feature->event_category_value }}
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
								<h2 style="color:#00b16a;">{{ $event->event_title }}</h2>
								<p id="hint">{{ $event->event_description }}</p>
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