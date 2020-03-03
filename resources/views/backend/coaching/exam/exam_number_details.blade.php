@extends('layouts.backend')

@section('title') {{ auth()->user()->abbreviation . ' Examination Number Details'}} @stop

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

    

</style>

@stop
@section('foisal')

<!-- submission f lash message starts -->
@if(session()->has('message'))
<div class="alert alert-info">
    {{ session('message') }}
</div>
@endif
<!-- submission flash message ends -->

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body" >

                <p class="card-title mb-0">
                    {{ $exam->exam_title }} | {{$exam->subject}} | {{ $exam->class_type }} | {{ $exam->section }}
                    <b>  (Number Details)</b>
                </p> <hr>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Student Name</th>
                                <th>Student ID</th>
                                <th>Exam Marks</th>
                                <th>Obtain Marks</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subject_number as $number)
                            <tr>
                                <td>{{ $number->student_name }}</td>
                                <td>{{ $number->student_id }}</td>
                                <td>{{ $number->defined_mark }}</td>
                                <td>{{ $number->mark }}</td>
                                <td>
                                    <a href="{{ route('exam.number.area_edit',$number) }}" class="btn btn-info">
                                        Update Number
                                    </a>
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