@extends('layouts.publicly_visible')

@section('title') List of institutions @stop

@section('foisal')

	<div class="middle-content-box">
		

	@foreach ($users as $type => $users_list)
		<table style="width: 30%;margin-right: 3%;float: left;border: 1px solid;">
			
		@if($type !== 'admin')
			<tr>
				<th
				style="background-color: #F7F7F7">{{ ucwords($type) }}: {{ $users_list->count() }} </th>
				<th 
				style="background-color: #F7F7F7">Area</th>
			</tr>

			@if($type === 'coaching')
				@foreach ($users_list as $user)
				<tr style="border: 1px solid;">
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
				<tr style="border: 1px solid;">
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
				<tr style="border: 1px solid;">
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