@extends('layouts.publicly_visible')

@section('title') List of institutions @stop

@section('css')

<style>
.middle-content-box{
	    padding: 10px 0 10px 20px;
    background: azure;
}
.bg-head{
	color: white;
    background: darkgrey;
    border-radius: 5px;
    }
.table-view {
    width: 31%;
    float: left;
    margin-right: 2%;
  }


@media only screen and (max-width: 720px)  {
	.middle-content-box .table-view {
    width: 98%;
    margin: auto;
  }
}
</style>

@stop

@section('foisal')

	<div class="middle-content-box">
		

	@foreach ($users as $type => $users_list)
		<table class="table-view table table-hover table-sm " style="margin-bottom: 10px;">
			
		@if($type !== 'admin')
			<tr>
				<th class="bg-head">{{ ucwords($type) }}: {{ $users_list->count() }} </th>
				<th class="bg-head">Area</th>
			</tr>

			@if($type === 'coaching')
				@foreach ($users_list as $user)
				<tr class="table-active">
					<td>
						<a href="{{ route('institution.details',$user->FI) }}">{{ $user->name }}
						</a>
					</td>

					<td>
						{{ ucwords($user->area) }}
					</td>
				</tr>
				@endforeach
			@elseif($type === 'kindergarten')
				@foreach ($users_list as $user)
				<tr class="table-active">
					<td>
						<a href="{{ route('institution.details',$user->FI) }}">{{ $user->name }}
						</a>
					</td>

					<td>
						{{ ucwords($user->area) }}
					</td>
				</tr>
				@endforeach
			@else
				@foreach ($users_list as $user)
				<tr class="table-active">
					<td>
						<a href="{{ route('institution.details',$user->FI) }}">{{ $user->name }}
						</a>
					</td>

					<td>
						{{ ucwords($user->area) }}
					</td>
				</tr>
				@endforeach
			@endif
		@endif
		</table>

	@endforeach
	
	</div>

@stop