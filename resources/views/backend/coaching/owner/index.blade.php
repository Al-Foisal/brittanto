@extends('layouts.backend')

@section('title') {{ auth()->user()->abbreviation . ' Owner List'}} @stop

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

<ul style="width: 15%;padding-left: 0;list-style: none;">
    <li class="nav-item">
        <a class="nav-link btn btn-secondary" href="{{ route('coaching-owners.create') }}">
            <i class="material-icons">add</i>
            <span class="menu-title">Add Owner</span>
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
                <p class="card-title mb-0">Owner List</p> <hr>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Owner Image</th>
                                <th>Owner Name</th>
                                <th>Position</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Message</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($owners as $owner)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/storage/'.$owner->inst_identity.'/owner/'.$owner->image)}}">
                                </td>
                                <td>{{ $owner->name }}</td>
                                <td>{{ $owner->position }}</td>
                                <td>{{ $owner->email }}</td>
                                <td>{{ $owner->phone }}</td>
                                <td>{{ $owner->message }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Dropdown
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                          <a href="{{ route('coaching-owners.edit',$owner)}}" class="btn btn-outline-info dropdown-item">
                                            Edit
                                        </a>

                                            <form action="{{ route('coaching-owners.destroy',$owner) }}" method="post">
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