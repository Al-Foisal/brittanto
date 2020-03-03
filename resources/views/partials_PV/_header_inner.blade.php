<div class="header-inner">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-12">
                <div class="logo">
                    <a href="https://brittanto.com/"><img src="{{ URL::asset('pv/images/logo.png') }}" alt="#"></a>
                </div>
                <div class="mobile-menu"></div>
            </div>
            <div class="col-lg-9 col-md-9 col-12">
                <!-- Header Widget -->
                <div class="header-widget">
                    <div class="single-widget">
                        <i class="fa fa-phone"></i>
                        <h4>Call Now<span>{{ $user->inst_phone }}</span></h4>
                    </div>
                    <div class="single-widget">
                        <i class="fa fa-envelope-o"></i>
                        <h4>Send Message<span>{{ $user->email }}</span></h4>
                    </div>
                    <div class="single-widget">
                        <i class="fa fa-map-marker"></i>
                        <h4>Location<span>{{ $user->address }}</span></h4>
                    </div>
                </div>
                <!--/ End Header Widget -->
            </div>
        </div>
    </div>
</div>