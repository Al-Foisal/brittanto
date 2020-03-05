@extends('layouts.backend')

@section('title') {{ auth()->user()->abbreviation}} Dashboard @stop

@section('css')

<style>
    /* Full-width input fields */
input[type=text], input[type=password] {
  width: 40%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 40%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
@stop

@section('foisal')


@if(auth()->user()->type == 'coaching' || auth()->user()->type == 'kindergarten' || auth()->user()->type == 'school')

<!-- submission f lash message starts -->
@if(session()->has('message'))
<div class="alert alert-info">
    {{session('message')}}
</div>
@endif
<!-- partial -->
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="font-weight-bold mb-0">{{ auth()->user()->abbreviation}} Dashboard</h4>
            </div>
            <div>
                <button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">     Feedback      </button>

                
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title text-md-center text-xl-left">Students</p>
                <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{ $student_number }}</h3>
                    {{-- <i class="ti-calendar icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i> --}}
                    <i class="material-icons md-48">people</i>
                </div>  
                <p class="mb-0 mt-2 text-danger">{{ $student_service-$student_number }} <span class="text-black ml-1"><small>({{$student_service}})</small></span></p>
            </div>
        </div>
    </div>
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title text-md-center text-xl-left">Employees</p>
                <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{$employee_number }}</h3>
                    <i class="material-icons md-48">supervisor_account</i>
                </div>  
                <p class="mb-0 mt-2 text-danger"> {{ $employee_service-$employee_number }} <span class="text-black ml-1"><small>({{ $employee_service }})</small></span></p>
            </div>
        </div>
    </div>
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title text-md-center text-xl-left">Section</p>
                
                @foreach($sections as $section)
                {{$section->section_type.'='.$section->count.','}}
                @endforeach
                
            </div>
        </div>
    </div>
    <div class="col-md-3 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <p class="card-title text-md-center text-xl-left">Serial No.</p>
                <div class="d-flex flex-wrap justify-content-between justify-content-md-center justify-content-xl-between align-items-center">
                    <h3 class="mb-0 mb-md-2 mb-xl-0 order-md-1 order-xl-0">{{ auth()->user()->FI }}</h3>
                    <i class="ti-layers-alt icon-md text-muted mb-0 mb-md-3 mb-xl-0"></i>
                </div> 
            </div>
        </div>
    </div>
</div>



{{-- feedback area starts --}}
<div id="id01" class="modal">
<form class="modal-content animate" action="{{ route('feedback') }}" method="post">
    @csrf
    <div class="container">
        <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>

        <label for="feedback"><b>Feedback</b></label>
        <textarea name="feedback" id="feedback" cols="10" rows="5" required></textarea>

        <input type="hidden" name="inst_identity" value="{{ auth()->user()->FI }}">

        <button type="submit">Submit</button>
    </div>
</form>
<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
{{-- feedback area ends --}}

@else

<table class="table table-bordered table-sm">
    <tr>
        <th>name</th>
        <th>owner phone</th>
        <th>fi</th>
        <th>service</th>
        <th>type</th>
        <th>action</th>
    </tr>
        @foreach($users as $user)
        @if($user->FI == 11)
        @continue
        @endif
    <tr>
        <td>{{ $user->name }}</td>
        <td>{{ $user->owner_phone }}</td>
        <td>{{ $user->FI }}</td>
        <td>{{ $user->service }}</td>
        <td>{{ $user->type }}</td>
        <td>
            <a href="{{ route('admin.request',$user->FI) }}">
                details
            </a>
        </td>
    </tr>
        @endforeach
</table>

@endif
@stop

