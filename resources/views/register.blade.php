@extends('layouts.forntend')

@section('title') {{ config('app.name') }} register form @stop

@section('foisal')

<section>				
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

				<form  action="{{ route('register') }}" method="post"> 
					@csrf
					<h1>Institution Membership Form</h1> 
					<p> 
						<label for="name"> Institution Name: </label>
						<input id="name" name="name" value="{{old('name')}}" required="required" type="text" placeholder="Bangladesh"/>
					</p>

					<div style="width: 45%;float: left;margin-right: 5%;">
						<p> 
							<label for="abbreviation"> Institution Abbreviation: </label>
							<input id="abbreviation" value="{{old('abbreviation')}}" name="abbreviation" required="required" type="text" placeholder="BD"/>
						</p> 
					</div>

					<div style="width: 48%;float: left;">
						<p> 
							<label for="area"> Institution Area: </label>
							<input id="area" value="{{old('area')}}" name="area" required="required" type="text" placeholder="Dhaka"/>
						</p> 
					</div>

					<p> 
						<label for="address"> Institution Address </label>
						<textarea id="address" value="{{old('address')}}" name="address" required="required" rows="2" cols="60" placeholder="eg. X8df!90EO"></textarea>
					</p>

					<p> 
						<label for="email"> Institution Email </label>
						<input id="email" value="{{old('email')}}" name="email" required="required" type="email" placeholder="example@gmail.com" /> 
					</p>

					<p> 
						<label for="password">Password </label>
						<input id="password" name="password" required="required" type="password" placeholder="eg. X8df!90EO" /> 
					</p>

					<p> 
						<label for="owner_name">Institution Owner Name </label>
						<input id="owner_name" value="{{old('owner')}}" name="owner" required="required" type="text" placeholder="eg. X8df!90EO" /> 
					</p>

					<div style="width: 45%;float: left;margin-right: 5%;">
						<p> 
							<label for="owner_phone"> Institution Owner Phone: </label>
							<input id="owner_phone" value="{{old('owner_phone')}}" name="owner_phone" required="required" type="text" placeholder="123-123-132"/>
						</p> 
					</div>

					<div style="width: 48%;float: left;">
						<p> 
							<label for="inst_phone"> Institution Phone: </label>
							<input id="inst_phone" value="{{old('indt_phone')}}" name="inst_phone" required="required" type="text" placeholder="123-123-132"/>
						</p> 
					</div>

					<div style="width: 45%;float: left;margin-right: 5%;">
						<p>
							<label for="type"> Institution Type (select one): </label>
							<select id="type" type="text" name="type">
								<option value="coaching">Coaching</option>
								<option value="kindergarten">Kindergarten</option>
								<option value="school">School</option>
							</select> 
						</p>
					</div>

					<div style="width: 48%;float: left;">
						<p>
							<label for="service"> Institution Service (select one): </label>
							<select id="service" type="text" name="service">
								<option value="100">100</option>
								<option value="150">150</option>
								<option value="200">200</option>
							</select> 
						</p>
					</div>

					<p class="login button"> 
						<input type="submit" onclick="return confirm('Are you sure you want to submit this item?');" value="Register" /> 
					</p>
					<p class="change_link">
						Already a member ?
						<a href="{{ route('login') }}" class="to_register">Go and login</a>
					</p>
				</form>
			</div>
		</div>
	</div>  
</section>


@stop