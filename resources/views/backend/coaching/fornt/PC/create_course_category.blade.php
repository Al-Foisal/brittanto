@extends('layouts.backend')

@section('title') {{ auth()->user()->abbreviation . ' Popular Course Area' }} @stop

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


<div class="row">

    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between align-items-center">
            <div id="container_demo"  style="width: -webkit-fill-available;width: -moz-available;">
                

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
                        <form method="post" action="{{ route('store.course.category')}}"> 
                            @csrf

                            <h1>{{ auth()->user()->abbreviation . ' Popular Course Area' }}</h1> 

                            <table class="table table-sm table-bordered" id="dynamicTable">  
                                <tr>
                                    <th>Category Name</th>
                                    <th>Category Value</th>
                                    <th></th>
                                    <th></th>
                                    <th>Action</th>
                                </tr>
                                <tr>  
                                    <td><input type="text" name="createCourseCategory[0][course_category_title]" placeholder="Enter Category Name" class="form-control" /></td>

                                    <td><input type="text" name="createCourseCategory[0][course_category_value]" placeholder="Enter Category Value" class="form-control" /></td>  

                                    <td><input type="hidden" name="createCourseCategory[0][course_id]" value="{{ $course_data->id }}" class="form-control" /></td>  

                                    <td><input type="hidden" name="createCourseCategory[0][inst_identity]" value="{{ $course_data->inst_identity }}"  class="form-control" /></td>  

                                    <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>  
                                </tr>  
                            </table> 

                            <p class="login button"> 
                                <input type="submit" onclick="return confirm('Are you sure you want to submit this item?');" value="Add Course Category" /> 
                            </p>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script type="text/javascript">
   
    var i = 0;
       
    $("#add").click(function(){
   
        ++i;
   
        $("#dynamicTable").append('<tr><td><input type="text" name="createCourseCategory['+i+'][course_category_title]" placeholder="Enter Category Name" class="form-control" /></td><td><input type="text" name="createCourseCategory['+i+'][course_category_value]" placeholder="Enter Category Value" class="form-control" /></td><td><input type="hidden" name="createCourseCategory['+i+'][course_id]" value="{{ $course_data->id }}"  class="form-control" /></td><td><input type="hidden" name="createCourseCategory['+i+'][inst_identity]" value="{{ $course_data->inst_identity }}"  class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
    });
   
    $(document).on('click', '.remove-tr', function(){  
         $(this).parents('tr').remove();
    });  
   
</script>

@stop

