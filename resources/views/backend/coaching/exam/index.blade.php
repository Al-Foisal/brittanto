@extends('layouts.backend')

@section('title') {{ auth()->user()->abbreviation }} Examination details @stop
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
<ul style="width: 15%;padding-left: 0;list-style: none;">
    <li class="nav-item">
        <a class="nav-link btn btn-secondary" href="{{ route('coaching-exam-titles.create') }}">
            <i class="material-icons">add</i>
            <span class="menu-title">Add Test/Exam</span>
        </a>
    </li>
</ul>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body" >

                <p class="card-title mb-0">
                    
                </p> <hr>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Exam Title</th>
                                <th>Exam Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($exam as $test)
                            <tr>
                                <td>{{ $test->exam_title }}</td>
                                <td>{{ $test->exam_date }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          Dropdown
                                      </button>
                                      <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                          <a href="{{ route('exam.section.subject_show',$test) }}" class="btn btn-success dropdown-item">
                                            Add Details
                                        </a>

                                        <form action="{{ route('coaching-exam-titles.destroy',$test) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Are you sure you want to delete this item?');" type="submit" class="btn btn-danger dropdown-item">Delete</button>
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