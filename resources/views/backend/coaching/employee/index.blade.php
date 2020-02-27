@extends('layouts.backend')

@section('title') {{ auth()->user()->abbreviation . ' Employee List'}} @stop

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
    font-family: 'Ubuntu', sans-serif;
}
.card-title-resize{
    border-right: 2px solid;
    margin: 0 30px;
    border-radius: 4px;
    padding: 10px;
}
#hint{
    overflow-x: auto;
    white-space: pre-wrap;
    white-space: -moz-pre-wrap;
    white-space: -pre-wrap;
    white-space: -o-pre-wrap;
    word-wrap: break-word;
}
</style>

@stop
@section('foisal')

<ul style="width: 15%;padding-left: 0;list-style: none;">
    <li class="nav-item">
        <a class="nav-link btn btn-secondary" href="{{ route('coaching-employees.create') }}">
            <i class="material-icons">add</i>
            <span class="menu-title">Add Employee</span>
        </a>
    </li>
</ul>

<div id="f" class="row">
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
                <p class="card-title mb-0">
                    <b class="card-title-resize">
                        Teachers: {{ $teacher }}
                    </b>
                    <b class="card-title-resize">
                        Staff: {{ $staff }}
                    </b>
                </p> <hr>
                <div class="table-responsive">
                    <table class="table table-hover table-sm table-bordered">
                        <thead>
                            <tr>
                                <th id="hint">Employee Image</th>
                                <th id="hint">Employee Name</th>
                                <th id="hint">Enrollment</th>
                                <th id="hint">Education</th>
                                <th id="hint">Institution</th>
                                <th id="hint">Address</th>
                                <th id="hint">Phone</th>
                                <th id="hint">Salary</th>
                                <th id="hint">Commitment</th>
                                <th id="hint">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/storage/'.$employee->inst_identity.'/employee/'.$employee->image)}}">
                                </td>
                                <td id="hint">{{ $employee->name }}</td>
                                <td id="hint">{{ $employee->role }}</td>
                                <td id="hint">{{ $employee->study }}</td>
                                <td id="hint">{{ $employee->thr_study_inst }}</td>
                                <td id="hint">{{ $employee->address }}</td>
                                <td id="hint">{{ $employee->phone }}</td>
                                <td id="hint">{{ $employee->salary }}</td>
                                <td id="hint">{{ $employee->commit_type }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Dropdown
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                            <a href="{{ route('coaching-employees.edit',$employee)}}" class="btn btn-outline-info dropdown-item">
                                                Edit
                                            </a>
                                            
@if($employee->commitment === 'per_class' && $employee->role ==='teacher')

    <a href="{{ route('salary.show',$employee)}}" class="btn btn-outline-info dropdown-item">
        Per Day Salary
    </a>

@endif

                                            <form action="{{ route('coaching-employees.destroy',$employee) }}" method="post">
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


@stop