@extends('layouts.backend')

@section('title') {{ auth()->user()->abbreviation . ' Notice Board' }} @stop

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
        <a class="nav-link btn btn-secondary" href="{{ route('notice-boards.create') }}">
            <i class="material-icons">add</i>
            <span class="menu-title">Add Notice</span>
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
                
                <div class="table-responsive">
                    <table class="table table-hover table-sm table-bordered">
                        <thead>
                            <tr>
                                <th id="hint">Notice Name</th>
                                <th id="hint">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($notices as $notice)
                            <tr>
                                
                                <td id="hint"><a href="{{ asset('storage/storage/'.$notice->inst_identity.'/notice/'.$notice->notice_content)}}" target="_blank">{{ $notice->notice_title }}</a></td>
                                <td>
                                    <form action="{{ route('notice-boards.destroy',$notice) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Are you sure you want to delete this item?');" type="submit" class="btn btn-danger">Delete</button>
                                    </form>
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