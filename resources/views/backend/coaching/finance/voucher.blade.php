@extends('layouts.backend')

@section('title') {{ auth()->user()->abbreviation . ' Daily Cost Sheet'}} @stop

@section('css')

<style>

    /** The wrapper that will contain our two forms **/
    .content-wrapper {
        border-left: 20px solid white;
    }
    #wrapper{
        width: 80%;
        right: 0px;
        min-height: 560px;  
        margin: 0px auto;
        position: relative; 
    }

    #wrapper h1 {
        font-size: 41px;
        margin-top: 50px;
    }
    /**** Styling the form elements **/

  /** The wrapper that will contain our two forms **/
    .content-wrapper {
        border-left: 5px solid white;
        padding: 1.5rem 0.5rem;
        border-radius: 30px;
    }
    .card{
        border-radius: 5px;
    }
#hint{
    overflow-x: auto;
    white-space: pre-wrap;
    white-space: -moz-pre-wrap;
    white-space: -pre-wrap;
    white-space: -o-pre-wrap;
    word-wrap: break-word;
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

</style>

@stop
@section('foisal')


<div class="row" style="margin-bottom: -18%;">

    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between align-items-center">
            <div id="container_demo" >
                

                <!-- Printing all error message fild -->
                @if($errors->any())
                <div class="alert alert-warning">
                    <ul>
                        @foreach($errors->all() as $error)
                        <li> {{ $error }} </li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- end of error message fild -->
                <!-- submission f lash message starts -->
                @if(session()->has('message'))
                <div class="alert alert-info">
                    {{ session('message') }}
                </div>
                @endif
                <!-- submission flash message ends -->


                <div id="wrapper">
                    <div class="animate form">
                        <form method="post" action="{{ route('voucher.store')}}"> 
                            @csrf

                            <h1>{{ auth()->user()->abbreviation . ' Daily Cost Sheet'}}</h1> 

                            <div style="width: 45%;float: left;margin-right: 5%;">
                                <p> 
                                    <label for="cost_name"> Cost Name: </label>
                                    <input id="cost_name" name="cost_name" required="required" type="text"/>
                                </p> 
                            </div>

                            <div style="width: 48%;float: left;">
                                <p> 
                                    <label for="comment"> Comment (if any): </label>
                                    <input id="comment" name="comment" type="text" placeholder="service for guardian" />
                                </p> 
                            </div>

                            <div style="width: 45%;float: left;margin-right: 5%;">
                                <label for="cost_type"> Cost Type (select one): </label>
                                <select id="cost_type" type="text" name="cost_type">
                                    <option value="daily_cost">Daily Cost</option>
                                    <option value="extra_income">Extra Income</option>
                                </select>
                            </div>

                            <div style="width: 48%;float: left;">
                                <p> 
                                    <label for="cost"> Cost: </label>
                                    <input id="cost" name="cost" required="required" type="number"/>
                                </p> 
                            </div>

                            <p class="login button"> 
                                <input type="submit" onclick="return confirm('Are you sure you want to submit this item?');" value="Add Voucher" /> 
                            </p>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            
            <div class="card-body">
                <p class="card-title mb-0">
                    {{'Voucher List for: '.date("M, Y")}} 
                </p> <hr>
                <div class="table-responsive">
                    <table class="table table-hover table-sm table-bordered">
                        <thead>
                            <tr>
                                <th id="hint">Cost Name</th>
                                <th id="hint">Comment</th>
                                <th id="hint">Cost Type</th>
                                <th id="hint">Cost</th>
                                <th id="hint">Created At</th>
                                <th id="hint">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($vouchers as $voucher)
                            <tr>
                                <td id="hint">{{ $voucher->cost_name }}</td>
                                <td id="hint">{{ $voucher->comment }}</td>
                                <td id="hint">{{ $voucher->set_cost_type }}</td>
                                <td id="hint">{{ $voucher->cost }}</td>
                                <td id="hint">{{ $voucher->created_at }}</td>
                                <td>
                                    <form action="{{ route('voucher.delete',$voucher) }}" method="post">
                                        @csrf
                                        <button onclick="return confirm('Are you sure you want to delete this item?');" type="submit" class="btn btn-danger btn-sm">Delete</button>
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