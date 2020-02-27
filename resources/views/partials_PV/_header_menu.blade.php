<div class="header-menu">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-default">
                    <div class="navbar-collapse">
                        <!-- Main Menu -->
                        <ul id="nav" class="nav menu navbar-nav">
                            <li class="active"><a href="{{-- {{ route('institution.details') }} --}}">Home</a></li>
                        @if(count($courses) !== 0)
                            <li><a href="#courses">Courses</i></a></li>
                        @endif
                        @if(count($teachers) !== 0)
                            <li><a href="#teachers">teachers</i></a></li>
                        @endif
                        @if(count($events) !== 0)
                            <li><a href="#events">Events</i></a></li>
                        @endif
                        @if(count($notices) !== 0)
                            <li><a href="#news">Latest news</a></li>
                        @endif
                        </ul>
                        <!-- End Main Menu -->
                        <!-- button -->
                        <div class="button">
                            <a href="#enroll" class="btn"><i class="fa fa-pencil"></i>Apply Now</a>
                        </div>
                        <!--/ End Button -->
                    </div> 
                </nav>
            </div>
        </div>
    </div>
</div>