@extends('layouts.publicly_visible')

@section('title') {{ $user->name }} @stop

@section('css')
	<style>
		.enroll .form-group select {
			width: 100%;
			height: 40px;
			color: #999999;
			box-shadow: none;
			text-shadow: none;
			border: none;
			border-bottom: 1px solid #e2e2e2;
			font-weight: 500;
			border-radius: 0px;
			padding: 0;
		}
	</style>
@stop

@section('foisal')

<!-- submission f lash message starts -->
@if(session()->has('message'))
	<div class="alert alert-danger">
		{{ session('message') }}
	</div>

@endif
<!-- submission flash message ends -->


	<div class="middle-content-box">
		<!-- Features -->

@if(count($solutions) !== 0)
		<section class="our-features section" id="pages">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section-title">
							<h2>We Provide <span>Educational</span> Solutions</h2>

						</div>
					</div>
				</div>
				<div class="row">

					@foreach($solutions as $solution)

					<div class="col-lg-4 col-md-4 col-12">
						<!-- Single Feature -->
						<div class="single-feature">
							<div class="feature-head">
								<img src="{{ URL::asset('images/solution.jpg') }}" alt="#">
							</div>
							<h2>{{ $solution->solution_title }}</h2>
							<p>{{ $solution->description }}</p>	
						</div>
						<!--/ End Single Feature -->
					</div>

					@endforeach

				</div>
			</div>
		</section>

@endif
		<!-- End Features -->

		<!-- Enroll -->
		<section class="enroll overlay section" data-stellar-background-ratio="0.5" id="enroll">
			<div class="container">
				<div class="row">
					<div class="col-lg-10 offset-lg-1">
						<div class="row">
							<div class="col-lg-6 col-12">
								<!-- Single Enroll -->
								<div class="enroll-form">
									<div class="form-title">
										<h2>Enroll Today</h2>
										<p>Before you miss the chance to get your seat!</p>
									</div>
									<!-- Form -->
									<form class="form" action="{{ route('institution.online_student.store') }}" method="post">
										@csrf
										<div class="form-group">
											<label>Enter Your Name*</label>
											<input name="full_name" required type="text" placeholder="John Mathew">
										</div>
										<div class="form-group">
											<label>Enter Your Email</label>
											<input name="email" type="email" placeholder="john@youremail.com">
										</div>
										<div class="form-group">
											<label>Enter Your Phone*</label>
											<input name="phone_number" required type="string" placeholder="017........">
										</div>
										<div class="form-group">
											<label>Type Your Messages*</label>
											
											<select required type="text"name="message" required>
												<option value="" selected>--select option--</option>
												
												@foreach($courses as $course)
												<option value="{{ $course->course_title }}">{{ $course->course_title }}</option>
												@endforeach

												@foreach($events as $event)
												<option value="{{ $event->event_title }}" >{{ $event->event_title }}</option>
												@endforeach
											</select>
										</div>
										<input type="hidden" name="inst_identity" value="{{ $user->FI }}">
										<div class="form-group button">
											<button type="submit" class="btn">Register Now</button>
										</div>
									</form>
									<!--/ End Form -->
								</div>
								<!-- Single Enroll -->
							</div>
							<div class="col-lg-6 col-12">
								<div class="enroll-right">
									<div class="section-title">
										<h2>Ability to think about or plan the future with imagination or wisdom!</h2>
										<p>{{ $mission->vision_description ?? '' }}</p>
									</div>
								</div>
								<!-- Skill Main -->
								<div class="skill-main">
									<div class="row">
										<div class="col-lg-4 col-md-3 col-6 wow zoomIn" data-wow-delay="0.8s">
											<!-- Single Skill -->
											<div class="single-skill">
												<div class="circle" data-value="0.7" data-size="130">
													<strong>{{ $count->student_count ?? '' }}+</strong>
												</div>
												<h4>Students</h4>
											</div>
											<!--/ End Single Skill -->
										</div>
										<div class="col-lg-4 col-md-3 col-6 wow zoomIn" data-wow-delay="1s">
											<!-- Single Skill -->
											<div class="single-skill">
												<div class="circle" data-value="0.9" data-size="130">
													<strong>{{ $count->course_count ?? '' }}+</strong>
												</div>
												<h4>Courses</h4>
											</div>
											<!--/ End Single Skill -->
										</div>
										<div class="last col-lg-4 col-md-3 col-6 wow zoomIn" data-wow-delay="1.2s">
											<!-- Single Skill -->
											<div class="single-skill">
												<div class="circle" data-value="0.8" data-size="130">
													<strong>{{ $count->event_count ?? '' }}+</strong>
												</div>
												<h4>Events</h4>
											</div>
											<!--/ End Single Skill -->
										</div>
										<div class="col-lg-4 col-md-3 col-6 wow zoomIn" data-wow-delay="1.2s" style="display: none;">
											<!-- Single Skill -->
											<div class="single-skill">
												<div class="circle" data-value="0.8" data-size="130">
													<strong>33+</strong>
												</div>
												<h4>Teachers</h4>
											</div>
											<!--/ End Single Skill -->
										</div>
									</div>
								</div>
								<!--/ End Skill Main -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/ End Enroll -->

		<!-- Courses -->

@if(count($courses) !== 0)
		<section class="courses section-bg section" id="courses">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section-title">
							<h2>Popular <span>Courses</span> We Offer</h2>
							
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="course-slider">
							<!-- Single Course -->

							@foreach($courses as $course )

							<div class="single-course">
								<div class="course-head overlay">

									<img src="{{ asset('storage/storage/'.$course->inst_identity.'/course/'.$course->course_banar)}}" alt="{{ $course->course_title}}">

									<a href="{{ route('institution.single_course',$course) }}" class="btn"><i class="fa fa-link"></i></a>

								</div>
								<div class="single-content">
									<h4>
										<a href="{{ route('institution.single_course',$course) }}">
											<span>
												{{ $course->course_label }}
											</span>{{ $course->course_title }}
										</a>
									</h4>

									<p>{{ substr($course->course_description,0,141) }} </p>

								</div>
								<div class="course-meta">
									<div class="meta-left">
										<span>
											<i class="fa fa-users"></i>
											{{ $course->total_seat }} Seat
										</span>
										<span>
											<i class="fa fa-clock-o"></i>
											{{ $course->course_duration }}
										</span>
									</div>
									<span class="price">BDT: {{ $course->course_fee}}/=</span>
								</div>
							</div>

							@endforeach

							<!--/ End Single Course -->
						</div>
					</div>
				</div>
			</div>
		</section>

@endif
		<!--/ End Courses -->	

		<!-- Call To Action -->
		<section class="cta" data-stellar-background-ratio="0.5">
			<div class="container">
				<div class="row">
					<div class="col-lg-5 offset-lg-6 col-12">
						<div class="cta-inner overlay">
							<div class="text-content">
								<h2>Deeds that we believe it is our duty to do</h2>
								<p>{{ $mission->mission_description ?? '' }}</p>
								<div class="button">
									<a class="btn primary" href="#enroll" >Register Now</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/ End Call To Action -->

		<!-- Team -->

@if(count($teachers) !== 0)
		<section class="team section" id="teachers">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section-title">
							<h2>Our Awesome <span>Teachers</span></h2>
							
						</div>
					</div>
				</div>
				<div class="row">

					@foreach($teachers as $teacher)

					<div class="col-lg-3 col-md-6 col-6">
						<!-- Single Team -->
						<div class="single-team teacher-one">

							{{-- <img src="{{ asset('storage/storage/'.$teacher->inst_identity.'/employee/'.$teacher->image)}}" alt="{{ $teacher->name}}"> --}}
							<img src="{{ URL::asset('pv/images/foisal.jpg') }}" alt="#">

							<div class="team-hover">
								<h4>{{ $teacher->name }}<span>Education: {{ $teacher->study }}</span></h4>

								<p>{{ $teacher->thr_study_inst }}</p>
							</div>
						</div>
						<!--/ End Single Team -->
					</div>

					@endforeach
					
				</div>
			</div>
		</section>

@endif
		<!--/ End Team -->

		<!-- Testimonials -->

@if(count($owners) !== 0)
		<section class="testimonials overlay section" data-stellar-background-ratio="0.5">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section-title">
							<h2>Our Intelligence  <span>Controller</span></h2>
							
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="testimonial-slider">
							<!-- Single Testimonial -->

							@foreach($owners as $owner)

							<div class="single-testimonial">

								<img src="{{ asset('storage/storage/'.$owner->inst_identity.'/owner/'.$owner->image) }}">

								<div class="main-content">
									<h4 class="name">{{ $owner->name }}
										<p>{{ 'Phone: '.$owner->position }}</p>
									</h4>
									<p> {{ $owner->message }} </p>
								</div>
							</div>

							@endforeach
	
							<!--/ End Single Testimonial -->
						</div>
					</div>
				</div>
			</div>
		</section>

@endif
		<!--/ End Testimonials -->

		<!-- Events -->

@if(count($events) !== 0)
		<section class="events section" id="events">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section-title">
							<h2>Upcoming <span>Events</span></h2>
							
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="event-slider">
							<!-- Single Event -->

							@foreach($events as $event)

							<div class="single-event">
								<div class="head overlay">

									<img src="{{ asset('storage/storage/'.$event->inst_identity.'/event/'.$event->event_banar) }}" alt="{{ $event->event_title }}">

									<a href="{{ route('institution.single_event', $event) }}" class="btn btn-info">
										<i class="fa fa-search"></i>
									</a>

								</div>

								<div class="event-content">
									<div class="meta"> 
										<span>
											<i class="fa fa-calendar"></i>
											{{ $event->event_start }}
										</span>

										<span>
											<i class="fa fa-clock-o"></i>
											{{ $event->event_end }}
										</span>

									</div>

									<h4>
										<a href="{{ route('institution.single_event', $event) }}">
											{{ $event->event_title }}
										</a>
									</h4>

									<p>{{ substr($event->event_description,0,91) }}</p>

									<div class="button">
										<a href="#enroll" class="btn">Join Event</a>
									</div>

								</div>
							</div>

							@endforeach

							<!--/ End Single Event -->
							
						</div>
					</div>
				</div>
			</div>
		</section>

@endif
		<!--/ End Events -->

		<!-- Fun Facts -->
		<div class="fun-facts overlay" data-stellar-background-ratio="0.5">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-6 col-6">
						<!-- Single Fact -->
						<div class="single-fact">
							<i class="fa fa-institution"></i>
							<div class="number"><span class="counter">{{ count($courses) }}</span>+</div>
							<p>Active Cources</p>
						</div>
						<!--/ End Single Fact -->
					</div>
					<div class="col-lg-3 col-md-6 col-6">
						<!-- Single Fact -->
						<div class="single-fact">
							<i class="fa fa-graduation-cap"></i>
							<div class="number"><span class="counter">{{ count($students) }}</span>+</div>
							<p>Active Students</p>
						</div>
						<!--/ End Single Fact -->
					</div>
					<div class="col-lg-3 col-md-6 col-6">
						<!-- Single Fact -->
						<div class="single-fact">
							<i class="fa fa-video-camera"></i>
							<div class="number"><span class="counter">{{ count($teachers) }}</span>+</div>
							<p>Active Teacher</p>
						</div>
						<!--/ End Single Fact -->
					</div>
					<div class="col-lg-3 col-md-6 col-6">
						<!-- Single Fact -->
						<div class="single-fact">
							<i class="fa fa-trophy"></i>
							<div class="number"><span class="counter">{{ $count->teacher_count ?? '' }}</span>+</div>
							<p>Trainers</p>
						</div>
						<!--/ End Single Fact -->
					</div>
				</div>
			</div>
		</div>
		<!--/ End Fun Facts -->

		<!-- Blogs -->

@if(count($notices) !== 0)
		<section class="blog section" id="news">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="section-title">
							<h2>Latest <span>News</span></h2>
							
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="blog-slider">
							<!-- Single Blog -->

							@foreach($notices as $notice)

							<div class="single-blog">
								<div class="blog-head overlay">
									<div class="date">
										<h4>10<span>May</span></h4>
									</div>
									<a href="{{ asset('storage/storage/'.$notice->inst_identity.'/notice/'.$notice->notice_content)}}" target="_blank">
										<img src="{{ URL::asset('images/noticeboard.png') }}" alt="#">
									</a>
								</div>

								<div class="blog-content">
									<h4 class="blog-title">
										<a href="{{ asset('storage/storage/'.$notice->inst_identity.'/notice/'.$notice->notice_content)}}" target="_blank">{{ $notice->notice_title }}</a>
									</h4>
								</div>
							</div>

							@endforeach

							<!-- End Single Blog -->
							
						</div>
					</div>
				</div>
			</div>
		</section>

@endif
		<!--/ End Blogs -->

	</div>

@stop