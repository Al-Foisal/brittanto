@extends('layouts.backend')

@section('title') {{ auth()->user()->abbreviation . ' Student List'}} @stop

@section('css')

<style>

    /** The wrapper that will contain our two forms **/
    .content-wrapper {
        border-left: 5px solid white;
        padding: 1.5rem 0.5rem;
        border-radius: 30px;
    }
    .card{
        border-radius: 5px;
    }

    .table td { font-size: 20px; }
    tbody { font-family: 'Ubuntu', sans-serif; }
    /**** Styling the form elements **/

    .card .card-title {
    color: #787878;
    margin-bottom: 1.2rem;
    text-transform: uppercase;
    font-size: 0.975rem;
    font-weight: 500;
}.card .card-title {
    color: #787878;
    margin-bottom: 1.2rem;
    text-transform: uppercase;
    font-size: 0.975rem;
    font-weight: 500;
    font-family: 'Ubuntu', sans-serif;
}
.card-title-resize{
    border-right: 2px solid;
    margin: 0 30px;
    border-radius: 4px;
    padding: 10px;
}


/** css for auto popup */
#popup_this {
    top: 50%;
    left: 50%;
    text-align:center;
    margin-top: -50px;
    margin-left: -100px;
    position: fixed;
    background: #fff;
    padding: 30px;
}
.b-close {
    position: absolute;
    right: 0;
    top: 0;
    cursor: pointer;
    color: #fff;
    padding: 5px 10px;
}

/*-------------------------
    36.Preloader css
---------------------------*/
.book_preload {
  position: fixed;
  width: 100%;
  height: 100%;
  background: #00B16A;
  opacity: 0.9;
  z-index: 999999;
}
.book {
  top: 50%;
  left: 0;
  -webkit-transform: translateY(-50%);
  transform: translateY(-50%);
  position: relative;
  margin: 0 auto;
  border: 5px solid #ecf0f1;
  width: 100px;
  height: 60px;
}
.book__page {
  position: absolute;
  left: 50%;
  top: -5px;
  margin: 0 auto;
  border-top: 5px solid #ecf0f1;
  border-bottom: 5px solid #ecf0f1;
  border-right: 5px solid #ecf0f1;
  background: #15D588;
  width: 50px;
  height: 60px;
  -webkit-transform-origin: 0% 50%;
  transform-origin: 0% 50%;
  -webkit-animation: flip 1.2s infinite linear;
  animation: flip 1.2s infinite linear;
  -webkit-animation-fill-mode: forwards;
  animation-fill-mode: forwards;
}
.book__page:nth-child(1) {
  z-index: -1;
  -webkit-animation-delay: 1.4s;
  animation-delay: 1.4s;
}
.book__page:nth-child(2) {
  z-index: -2;
  -webkit-animation-delay: 2.8s;
  animation-delay: 2.8s;
}
.book__page:nth-child(3) {
  z-index: -3;
  -webkit-animation-delay: 4.2s;
  animation-delay: 4.2s;
}
@-webkit-keyframes flip {
  0% {
    -webkit-transform: perspective(600px) rotateY(0deg);
    transform: perspective(600px) rotateY(0deg);
  }
  20% {
    background: #00B16A;
  }
  29.9% {
    background: #00B16A;
  }
  30% {
    -webkit-transform: perspective(200px) rotateY(-90deg);
    transform: perspective(200px) rotateY(-90deg);
    background: #15D588;
  }
  54.999% {
    opacity: 1;
  }
  55% {
    opacity: 0;
  }
  60% {
    -webkit-transform: perspective(200px) rotateY(-180deg);
    transform: perspective(200px) rotateY(-180deg);
    background: #15D588;
  }
  100% {
    -webkit-transform: perspective(200px) rotateY(-180deg);
    transform: perspective(200px) rotateY(-180deg);
    background: #15D588;
  }
}
@keyframes flip {
  0% {
    -webkit-transform: perspective(600px) rotateY(0deg);
    transform: perspective(600px) rotateY(0deg);
  }
  20% {
    background: #00B16A;
  }
  29.9% {
    background: #00B16A;
  }
  30% {
    -webkit-transform: perspective(200px) rotateY(-90deg);
    transform: perspective(200px) rotateY(-90deg);
    background: #15D588;
  }
  54.999% {
    opacity: 1;
  }
  55% {
    opacity: 0;
  }
  60% {
    -webkit-transform: perspective(200px) rotateY(-180deg);
    transform: perspective(200px) rotateY(-180deg);
    background: #15D588;
  }
  100% {
    -webkit-transform: perspective(200px) rotateY(-180deg);
    transform: perspective(200px) rotateY(-180deg);
    background: #15D588;
  }
}

</style>

@stop
@section('foisal')
<!-- Book Preloader -->
<div class="book_preload">
    <div class="book">
        <div class="book__page"></div>
        <div class="book__page"></div>
        <div class="book__page"></div>
    </div>
</div>
<!--/ End Book Preloader -->

<!-- submission f lash message starts -->
@if(session()->has('message'))
<div class="alert alert-info">
    @if (is_numeric(session('message')))

        {{-- student admission invoice starts printable --}}
        @php
            $student_id = session('message');
            $amd_student = \App\Models\Coaching\CoachingStudent::where('std_id',$student_id)->first();
        @endphp
        <div id="popup_this" style="width: 50%;">
            <div >
                <div class="card text-center">
                    <h5 class="card-header bg-success">Student added successfully <a href="javascript:void(0);" id="print_button2" class="btn btn-info btn-sm b-close" style="float: right;">print </a></h5>
                    <div class="card-body foisal">
                        <h3>{{ auth()->user()->name }}</h3>
                        <p>{{ auth()->user()->address.', Phone: '.auth()->user()->inst_phone }}</p>
                        <hr>
                        <h4>Student Name: {{ $amd_student->name }}</h4>
                        <h4>Student ID# {{ $amd_student->std_id }}</h4>
                        <h4>Tution Fee: {{ $amd_student->tution_fee }}</h4>
                        <h4>Guardian Name: {{ $amd_student->guardian_name }}</h4>
                        <h4>Student Admitted Class: {{ $amd_student->class_type }}</h4>
                        <h4>Student Admitted Section: {{ $amd_student->section }}</h4>
<p class="font-italic">N.B. This receipt is auto-generated by <b>https://brittanto.com</b></p>
                    </div>
                </div>
            </div>
        </div>

        {{-- student admission invoice ends --}}

    @else
        {{session('message')}}
    @endif
</div>
@endif


{{-- js code student admission invoice starts --}}
<script>
    $(document).ready(function(){

        $("#print_button2").click(function(){
            var mode = 'iframe'; // popup
            var close = mode == "popup";
            var options = { mode : mode, popClose : close};
            $("div.foisal").printArea( options  );
        });
    });
</script>
{{-- js code student admission invoice ends --}}


<!-- submission flash message ends -->
<ul style="width: 15%;padding-left: 0;list-style: none;">
    <li class="nav-item">
        <a class="nav-link btn btn-secondary" href="{{ route('coaching-students.create') }}">
            <i class="material-icons">add</i>
            <span class="menu-title">Add Student</span>
        </a>
    </li>
</ul>

{{-- student limitation variable named $count --}}
@php $count = 0; @endphp

@foreach($classes as $set_class)
@php

//select all the Section under a single classes
    $sections = \App\Models\Coaching\CoachingSection::select(['id','name','type','class','gender'])->where('class',$set_class->amd_class)->where('inst_identity',auth()->user()->FI)->get();

//count total Section under a single classes
    $total_section = \App\Models\Coaching\CoachingSection::where('class',$set_class->amd_class)->where('inst_identity',auth()->user()->FI)->count();

//making class in words
    $f = new \NumberFormatter( locale_get_default(), \NumberFormatter::SPELLOUT );        
    $class_in_words = $f->format($set_class->amd_class);
    $replace_class = str_replace(' ','_',$class_in_words);
@endphp

<div class="accordion" id="accordionExample{{$replace_class}}">
    <div class="card">
        <div class="card-header" id="headingOne{{$replace_class}}">
            <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne{{$replace_class}}" aria-expanded="true" aria-controls="collapseOne{{$replace_class}}">
                    @if($set_class->amd_class == 20 || $set_class->amd_class == 21 )
                        <h4 class="text-capitalize">{{'Class: '.$set_class->class_type.' | Batch: '.$total_section}}</h4>
                    @else
                        <h4 class="text-capitalize">{{'Class: '.$set_class->amd_class.' | ('.$class_in_words.') | Batch: '.$total_section}}</h4>
                    @endif
                </button>
            </h5>
        </div>

        <div id="collapseOne{{$replace_class}}" class="collapse" aria-labelledby="headingOne{{$replace_class}}" data-parent="#accordionExample{{$replace_class}}">

            <div class="card-body">

                {{-- printing section per class starts --}}
                @foreach($sections as $section)

                @php 

                //select all student under a class
                    $students = \App\Models\Coaching\CoachingStudent::select(['id','name','std_id','amd_class','amd_type','image','inst_identity'])->where('amd_class',$section->class)->where('section',$section->name)->where('inst_identity',auth()->user()->FI)->get();

                //count total student under a class
                    $total_student = \App\Models\Coaching\CoachingStudent::where('amd_class',$section->class)->where('section',$section->name)->where('inst_identity',auth()->user()->FI)->count();

                @endphp


                @if(!empty($section) && $total_student != 0 )
                <div class="accordion" id="accordionExample{{$section->name}}">
                    <div class="card">
                        <div class="card-header" id="headingOne{{$section->name}}">
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne{{$section->name.'_'.$replace_class}}" aria-expanded="true" aria-controls="collapseOne{{$section->name.'_'.$replace_class}}">
                                    <h4 class="text-capitalize">{{'Batch: '.$section->name.' | Batch Type: '.$section->section_type.' | Gender: '.$section->gender}}</h4>
                                </button>
                            </h5>
                        </div>

                        <div id="collapseOne{{$section->name.'_'.$replace_class}}" class="collapse" aria-labelledby="headingOne{{$section->name}}" data-parent="#accordionExample{{$section->name}}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body" >

                                                <p class="card-title mb-0">
                                                    <b class="card-title-resize">
                                                        Class: {{ $section->class_type }}
                                                    </b>
                                                    <b class="card-title-resize">
                                                        Students: {{ $total_student }}
                                                    </b>
                                                    @php 

                                                //data for printing attendence sheet
                                                        $attendence = [
                                                            'class' => $section->class,
                                                            'section_name' => $section->name,
                                                            'section_type' => $section->section_type,
                                                            'total' => $total_student,
                                                        ];
                                                        $attendence = Crypt::encrypt($attendence);
                                                    @endphp

                                                    <a href="{{ route('pdf.student.attendence', $attendence) }}" target="_blank" class="btn btn-secondary"> Attendence sheet</a>

                                                    <div class="btn-group" role="group">
                                                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                          Sent SMS Form Here    
                                                      </button>
                                                      <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

                                                        <form action="{{ route('sms.exam.show') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="section_name" value="{{ $section->name }}">
                                                            <button type="submit" class="btn btn-secondary dropdown-item">Exam Number SMS</button>
                                                        </form>
                                                    </div>
                                                </div>

                                                    

                                                </p> <hr>

                                                <div class="table-responsive">
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Student Image</th>
                                                                <th>Student Name</th>
                                                                <th>Student ID</th>
                                                                <th>Class</th>
                                                                <th>Admitted as</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($students as $student)
{{-- code for student limitation according to service --}}
@php 
if($count >= auth()->user()->service )
break;
++$count; 
@endphp
                                                            <tr>
                                                                <td>
                                                                    <img src="{{ asset('storage/storage/'.$student->inst_identity.'/student/'.$student->image)}}">
                                                                </td>
                                                                <td>{{ $student->name }}</td>
                                                                <td>{{ $student->std_id }}</td>
                                                            @if($student->amd_class==20||$student->amd_class==21)
                                                                <td>{{ $student->class_type }}</td>
                                                            @else
                                                                <td>{{ 'Class - '.$student->class_type }}</td>
                                                            @endif
                                                                <td>{{ $student->admission_type }}</td>
                                                                <td>
                                                                    <div class="btn-group" role="group">
                                                                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                          Dropdown
                                                                        </button>
                                                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                                            <a href="{{ route('coaching-students.show',$student) }}" class="btn btn-outline-success dropdown-item">
                                                                            Details
                                                                            </a>

                                                                            <a href="{{ route('coaching-students.edit',$student)}}" class="btn btn-outline-info dropdown-item">
                                                                                Edit
                                                                            </a>

                                                                            <form action="{{ route('coaching-students.destroy',$student) }}" method="post">
                                                                                @method('DELETE')
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
                            </div>
                        </div>
                    </div>    
                </div>
                @endif
                @endforeach
                {{-- printing section per class ends --}}
            </div>
        </div>
    </div>
</div>

@endforeach
@stop


@section('js')
<script>
/*=====================================
    Preloader JS
    ======================================*/ 
    $(window).on('load', function() {
        $('.book_preload').fadeOut('slow', function(){
            $(this).remove();
        });
    });
</script>


{{-- for auto popup script --}}

<script>
$( document ).ready(function() {
    $('#popup_this').bPopup();
});
</script>

<script>
    /*================================================================================
 * @name: bPopup - if you can't get it up, use bPopup
 * @author: (c)Bjoern Klinggaard (twitter@bklinggaard)
 * @demo: http://dinbror.dk/bpopup
 * @version: 0.11.0.min
 ================================================================================*/
 (function(c){c.fn.bPopup=function(A,E){function L(){a.contentContainer=c(a.contentContainer||b);switch(a.content){case "iframe":var d=c('<iframe class="b-iframe" '+a.iframeAttr+"></iframe>");d.appendTo(a.contentContainer);t=b.outerHeight(!0);u=b.outerWidth(!0);B();d.attr("src",a.loadUrl);l(a.loadCallback);break;case "image":B();c("<img />").load(function(){l(a.loadCallback);F(c(this))}).attr("src",a.loadUrl).hide().appendTo(a.contentContainer);break;default:B(),c('<div class="b-ajax-wrapper"></div>').load(a.loadUrl,a.loadData,function(d,b,e){l(a.loadCallback,b);F(c(this))}).hide().appendTo(a.contentContainer)}}function B(){a.modal&&c('<div class="b-modal '+e+'"></div>').css({backgroundColor:a.modalColor,position:"fixed",top:0,right:0,bottom:0,left:0,opacity:0,zIndex:a.zIndex+v}).appendTo(a.appendTo).fadeTo(a.speed,a.opacity);C();b.data("bPopup",a).data("id",e).css({left:"slideIn"==a.transition||"slideBack"==a.transition?"slideBack"==a.transition?f.scrollLeft()+w:-1*(x+u):m(!(!a.follow[0]&&n||g)),position:a.positionStyle||"absolute",top:"slideDown"==a.transition||"slideUp"==a.transition?"slideUp"==a.transition?f.scrollTop()+y:z+-1*t:p(!(!a.follow[1]&&q||g)),"z-index":a.zIndex+v+1}).each(function(){a.appending&&c(this).appendTo(a.appendTo)});G(!0)}function r(){a.modal&&c(".b-modal."+b.data("id")).fadeTo(a.speed,0,function(){c(this).remove()});a.scrollBar||c("html").css("overflow","auto");c(".b-modal."+e).unbind("click");f.unbind("keydown."+e);k.unbind("."+e).data("bPopup",0<k.data("bPopup")-1?k.data("bPopup")-1:null);b.undelegate(".bClose, ."+a.closeClass,"click."+e,r).data("bPopup",null);clearTimeout(H);G();return!1}function I(d){y=k.height();w=k.width();h=D();if(h.x||h.y)clearTimeout(J),J=setTimeout(function(){C();d=d||a.followSpeed;var e={};h.x&&(e.left=a.follow[0]?m(!0):"auto");h.y&&(e.top=a.follow[1]?p(!0):"auto");b.dequeue().each(function(){g?c(this).css({left:x,top:z}):c(this).animate(e,d,a.followEasing)})},50)}function F(d){var c=d.width(),e=d.height(),f={};a.contentContainer.css({height:e,width:c});e>=b.height()&&(f.height=b.height());c>=b.width()&&(f.width=b.width());t=b.outerHeight(!0);u=b.outerWidth(!0);C();a.contentContainer.css({height:"auto",width:"auto"});f.left=m(!(!a.follow[0]&&n||g));f.top=p(!(!a.follow[1]&&q||g));b.animate(f,250,function(){d.show();h=D()})}function M(){k.data("bPopup",v);b.delegate(".bClose, ."+a.closeClass,"click."+e,r);a.modalClose&&c(".b-modal."+e).css("cursor","pointer").bind("click",r);N||!a.follow[0]&&!a.follow[1]||k.bind("scroll."+e,function(){if(h.x||h.y){var d={};h.x&&(d.left=a.follow[0]?m(!g):"auto");h.y&&(d.top=a.follow[1]?p(!g):"auto");b.dequeue().animate(d,a.followSpeed,a.followEasing)}}).bind("resize."+e,function(){I()});a.escClose&&f.bind("keydown."+e,function(a){27==a.which&&r()})}function G(d){function c(e){b.css({display:"block",opacity:1}).animate(e,a.speed,a.easing,function(){K(d)})}switch(d?a.transition:a.transitionClose||a.transition){case "slideIn":c({left:d?m(!(!a.follow[0]&&n||g)):f.scrollLeft()-(u||b.outerWidth(!0))-200});break;case "slideBack":c({left:d?m(!(!a.follow[0]&&n||g)):f.scrollLeft()+w+200});break;case "slideDown":c({top:d?p(!(!a.follow[1]&&q||g)):f.scrollTop()-(t||b.outerHeight(!0))-200});break;case "slideUp":c({top:d?p(!(!a.follow[1]&&q||g)):f.scrollTop()+y+200});break;default:b.stop().fadeTo(a.speed,d?1:0,function(){K(d)})}}function K(d){d?(M(),l(E),a.autoClose&&(H=setTimeout(r,a.autoClose))):(b.hide(),l(a.onClose),a.loadUrl&&(a.contentContainer.empty(),b.css({height:"auto",width:"auto"})))}function m(a){return a?x+f.scrollLeft():x}function p(a){return a?z+f.scrollTop():z}function l(a,e){c.isFunction(a)&&a.call(b,e)}function C(){z=q?a.position[1]:Math.max(0,(y-b.outerHeight(!0))/2-a.amsl);x=n?a.position[0]:(w-b.outerWidth(!0))/2;h=D()}function D(){return{x:w>b.outerWidth(!0),y:y>b.outerHeight(!0)}}c.isFunction(A)&&(E=A,A=null);var a=c.extend({},c.fn.bPopup.defaults,A);a.scrollBar||c("html").css("overflow","hidden");var b=this,f=c(document),k=c(window),y=k.height(),w=k.width(),N=/OS 6(_\d)+/i.test(navigator.userAgent),v=0,e,h,q,n,g,z,x,t,u,J,H;b.close=function(){r()};b.reposition=function(a){I(a)};return b.each(function(){c(this).data("bPopup")||(l(a.onOpen),v=(k.data("bPopup")||0)+1,e="__b-popup"+v+"__",q="auto"!==a.position[1],n="auto"!==a.position[0],g="fixed"===a.positionStyle,t=b.outerHeight(!0),u=b.outerWidth(!0),a.loadUrl?L():B())})};c.fn.bPopup.defaults={amsl:50,appending:!0,appendTo:"body",autoClose:!1,closeClass:"b-close",content:"ajax",contentContainer:!1,easing:"swing",escClose:!0,follow:[!0,!0],followEasing:"swing",followSpeed:500,iframeAttr:'scrolling="no" frameborder="0"',loadCallback:!1,loadData:!1,loadUrl:!1,modal:!0,modalClose:!0,modalColor:"#000",onClose:!1,onOpen:!1,opacity:.7,position:["auto","auto"],positionStyle:"absolute",scrollBar:!0,speed:250,transition:"fadeIn",transitionClose:!1,zIndex:9997}})(jQuery);
</script>

@stop