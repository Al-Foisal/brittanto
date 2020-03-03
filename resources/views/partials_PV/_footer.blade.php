@php
$latest_course =\App\Models\Coaching\Fornt\CoachingForntPopularCourse::
				where('inst_identity',$user->FI)
				->orderBy('id','desc')->first();

$latest_event = \App\Models\Coaching\Fornt\CoachingForntUpcomingEvent::
				where('inst_identity',$user->FI)
				->orderBy('id','desc')->first();

$latest_notice = \App\Models\Coaching\Fornt\CoachingForntNoticeBoard::
				where('inst_identity',$user->FI)
				->orderBy('id','desc')->first();
@endphp

<!-- Footer Section Start -->
<section>
	<!-- Footer -->
	<footer class="footer overlay section">
		<!-- Footer Top -->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-6 col-12">
						<!-- About -->
						<div class="single-widget useful-links">
							<h2>{{$user->name}}</h2>

							<p>The ability to make good judgments based on what you have learned from your experience or the knowledge and understanding that give you this ability.</p>
							<ul class="list">
								<li><i class="fa fa-phone"></i> {{ $user->inst_phone }} </li>
								<li><i class="fa fa-envelope"></i> {{ $user->email }}</li>
								<li><i class="fa fa-map-o"></i> {{ $user->address }}</li>
							</ul>
						</div>
						<!--/ End About -->
					</div>
					<div class="col-lg-2 col-md-6 col-12">
						<!-- Useful Links -->
						<div class="single-widget useful-links">
							<h2>Useful Links</h2>
							<ul>

								<li class="active"><a href="{{ route('institution.details',$user->FI) }}"><i class="fa fa-angle-right"></i>Home</a></li>

								@if(!empty($courses))
								<li><a href="#courses"><i class="fa fa-angle-right"></i>Courses</i></a></li>
								@endif

								@if(!empty($teachers))
								<li><a href="#teachers"><i class="fa fa-angle-right"></i>teachers</i></a></li>
								@endif

								@if(!empty($events))
								<li><a href="#events"><i class="fa fa-angle-right"></i>Events</i></a></li>
								@endif

								@if(!empty($notices))
								<li><a href="#news"><i class="fa fa-angle-right"></i>Notice Board</a></li>
								@endif

							</ul>
						</div>
						<!--/ End Useful Links -->
					</div>
					<div class="col-lg-4 col-md-6 col-12">
						<!-- Latest News -->
						<div class="single-widget latest-news">
							<h2>Latest Posts</h2>
							<div class="news-inner">
								<div class="single-news">
									@if(!empty($latest_course))
									<img src="{{ URL::asset('images/latest_news.jpg') }}" alt="LS">
									<h4>
										<a href="{{ route('institution.single_course',$latest_course) }}" title="{{ $latest_course->course_title }}">
											{{ substr($latest_course->course_title,0,30) }} ...
										</a>
									</h4>
									<p>{{ substr($latest_course->course_description,0,65) }} ...</p>
									@endif
								</div>

								<div class="single-news">
									@if(!empty($latest_event))
									<img src="{{ URL::asset('images/latest_news.jpg') }}" alt="LS">
									<h4>
										<a href="{{ route('institution.single_event',$latest_event) }}" title="{{ $latest_event->event_title }}">
											{{ substr($latest_event->event_title,0,30) }} ...
										</a>
									</h4>
									<p>{{ substr($latest_event->event_description,0,65) }} ...</p>
									@endif
								</div>

								<div class="single-news">
									@if(!empty($latest_notice))
									<img src="{{ URL::asset('images/latest_news.jpg') }}" alt="LS">
									<h4>
										<a href="{{ asset('storage/storage/'.$latest_notice->inst_identity.'/notice/'.$latest_notice->notice_content)}}" title="{{ $latest_notice->notice_title }}">
											{{ substr($latest_notice->notice_title,0,80) }} ...
										</a>
									</h4>
									@endif
								</div>
							</div>
						</div>
						<!--/ End Latest News -->
					</div>
					<div class="col-lg-3 col-md-6 col-12">
						<!-- Newsletter -->
						<div class="single-widget newsletter">
							<h2>Subscribe Newsletter</h2>
							<div class="mail">
								<p>Don't miss to  subscribe to our news feed, Get the latest updates from us!</p>
								<div class="form">
									<input type="email" placeholder="Enter your email">
									<button class="button" type="submit"><i class="fa fa-envelope"></i></button>
								</div>
							</div>
						</div>
						<!--/ End Newsletter -->
					</div>
				</div>
			</div>
		</div>
		<!--/ End Footer Top -->
		<!-- Footer Bottom -->
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="bottom-head">
							<div class="row">
								<div class="col-12">
									<!-- Social 
									<ul class="social">
										<li><a href="#"><i class="fa fa-twitter"></i></a></li>
										<li><a href="#"><i class="fa fa-facebook"></i></a></li>
										<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
										<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
										<li><a href="#"><i class="fa fa-youtube"></i></a></li>
									</ul>
									 End Social -->
									<!-- Copyright -->
									<div class="copyright">
										<p>© Copyright {{ date("Y") }} <a href="http://brittanto.com" target="_blank">, Brittanto</a>.</p>
									</div>
									<!--/ End Copyright -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/ End Footer Bottom -->
	</footer>
	<!--/ End Footer -->
</section>
			<!-- Footer Section End -->