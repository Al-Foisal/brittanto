@extends('layouts.publicly_visible')

@section('title') List of institutions @stop

@section('css')

<style>
.middle-content-box{
	    padding: 25px;
    background: azure;
}
.bg-head{
	color: white;
    background: black;
    border-radius: 5px;
    }
</style>

@stop

@section('foisal')

	<div class="middle-content-box">
		

	@foreach ($users as $type => $users_list)
		<table class="table table-hover table-sm" style="width: 30%;float: left;margin-right: 3%;">
			
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