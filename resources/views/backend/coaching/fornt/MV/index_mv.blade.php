@extends('layouts.backend')

@section('title') {{auth()->user()->abbreviation }} Mission and Vision @stop

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

@if($mvc==0)
<ul style="width: 15%;padding-left: 0;list-style: none;">
    <li class="nav-item">
        <a class="nav-link btn btn-secondary" href="{{ route('mission-and-visions.create') }}">
            <i class="material-icons">add</i>
            <span class="menu-title">Add Mission and Vision</span>
        </a>
    </li>
</ul>
@endif

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
                                <th id="hint">Institution Mission</th>
                                <th id="hint">Institution Vision</th>
                                <th id="hint">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($mvs as $mv )
                            <tr>
                                <td id="hint">{{ $mv->mission_description }}</td>
                                <td id="hint">{{ $mv->vision_description }}</td>
                                <td>
                                    <a href="{{ route('mission-and-visions.edit',$mv) }}" class="btn btn-info">UPDATE</a>
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