@extends('layouts.backend')

@section('title') {{ auth()->user()->abbreviation . ' Section List'}} @stop

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
#hint{
    overflow-x: auto;
    white-space: pre-wrap;
    white-space: -moz-pre-wrap;
    white-space: -pre-wrap;
    white-space: -o-pre-wrap;
    word-wrap: break-word;
}
/**** Styling the form elements **/

</style>

@stop
@section('foisal')

<ul style="width: 15%;padding-left: 0;list-style: none;">
    <li class="nav-item">
        <a class="nav-link btn btn-secondary" href="{{ route('coaching-sections.create') }}">
            <i class="material-icons">add</i>
            <span class="menu-title">Add Batch</span>
        </a>
    </li>
</ul>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">

            <!-- submission f lash message starts -->
            @if(session()->has('message'))
            <div class="alert alert-info">
                {{ session('message') }}
            </div>
            @endif
            <!-- submission flash message ends -->
            
            <div class="card-body">
                <p class="card-title mb-0">Batch List</p> <hr>
                <div class="table-responsive">
                    <table class="table table-hover table-sm">
                        <thead>
                            <tr>
                                <th>Batch Name</th>
                                <th>Gender</th>
                                <th>Batch Starts and End</th>
                                <th>Batch Type</th>
                                <th>Class</th>
                                <th>Hints</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sections as $section)
                            <tr>
                                <td>{{ $section->name }}</td>
                                <td>{{ $section->gender }}</td>
                                <td>{{ $section->start_time.' TO '.$section->end_time }}</td>
                                <td>{{ $section->section_type }}</td>
                                <td>{{ $section->class_type }}</td>
                                <td id="hint">{{ $section->hint }}</td>
                                <td>
                                    <a href="{{ route('coaching-sections.edit',$section)}}" class="btn btn-info btn-sm">
                                        Edit
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