@extends('layouts.backend')

@section('title') {{ auth()->user()->abbreviation }} educational solutions @stop

@section('foisal')

<div class="container box">
    <h3 align="center">Educational Solutions Max:3</h3><br />
    <div class="card card-default">
        <div class="card-heading">Sample Data</div>
        <div class="card-body">
            <div id="message"></div>
            <div class="table-responsive">
                <table class="table table-sm table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Solution Title(32)</th>
                            <th>Description(98)</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
                {{ csrf_field() }}
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function(){

        ES_fetch_data();

        function ES_fetch_data()
        {
            $.ajax({
                url:"{{ route('fornt.ES.fetch_data') }}",
                dataType:"json",
                success:function(data)
                {
                    var html = '';
                    html += '<tr>';
                    html += '<td contenteditable id="solution_title"></td>';
                    html += '<td contenteditable id="description"></td>';
                    html += '<td><button type="button" class="btn btn-success btn-xs" id="add">Add</button></td></tr>';
                    for(var count=0; count < data.length; count++)
                    {
                        html +='<tr>';
                        html +='<td contenteditable class="column_name" data-column_name="solution_title" data-id="'+data[count].id+'">'+data[count].solution_title+'</td><span id="characters"><span>';
                        html += '<td contenteditable class="column_name" data-column_name="description" data-id="'+data[count].id+'">'+data[count].description+'</td>';
                        html += '<td><button type="button" class="btn btn-danger btn-xs delete" id="'+data[count].id+'">Delete</button></td></tr>';
                    }
                    $('tbody').html(html);
                }
            });
        }

        var _token = $('input[name="_token"]').val();

        $('input[name="solution_title"]').on('keyup keydown', updateCount);

        function updateCount() {
          $('#characters').text($(this).val().length);
      }

        $(document).on('click', '#add', function(){
            var solution_title = $('#solution_title').text();
            var description = $('#description').text();
            if(solution_title != '' && description != '')
            {
                $.ajax({
                    url:"{{ route('fornt.ES.add_data') }}",
                    method:"POST",
                    data:{solution_title:solution_title, description:description, _token:_token},
                    success:function(data)
                    {
                        $('#message').html(data);
                        ES_fetch_data();
                    }
                });
            }
            else
            {
                $('#message').html("<div class='alert alert-danger'>Both Fields are required</div>");
            }
        });

        $(document).on('blur', '.column_name', function(){
            var column_name = $(this).data("column_name");
            var column_value = $(this).text();
            var id = $(this).data("id");

            if(column_value != '')
            {
                $.ajax({
                    url:"{{ route('fornt.ES.update_data') }}",
                    method:"POST",
                    data:{column_name:column_name, column_value:column_value, id:id, _token:_token},
                    success:function(data)
                    {
                        $('#message').html(data);
                    }
                })
            }
            else
            {
                $('#message').html("<div class='alert alert-danger'>Enter some value</div>");
            }
        });

        $(document).on('click', '.delete', function(){
            var id = $(this).attr("id");
            if(confirm("Are you sure you want to delete this records?"))
            {
                $.ajax({
                    url:"{{ route('fornt.ES.delete_data') }}",
                    method:"POST",
                    data:{id:id, _token:_token},
                    success:function(data)
                    {
                        $('#message').html(data);
                        ES_fetch_data();
                    }
                });
            }
        });


    });
</script>


@stop