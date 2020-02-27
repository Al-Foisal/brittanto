
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>@yield('title','AHF') </title>


	<!-- Bootstrap core CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link href="css/forntend/style1.css" rel="stylesheet" >
	<link href="css/forntend/formdemo.css" rel="stylesheet"/>
	<link href="css/forntend/formstyle.css" rel="stylesheet"/>
	<link href="css/forntend/formanimate-custom.css" rel="stylesheet"/>
	<link href="css/app.css" rel="stylesheet"/>

	
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('pv/css/color.css') }}" >
    <link rel="stylesheet" href="{{ asset('pv/css/style.css') }}" >

	@yield('css')
</head>
<body>

	
	@include('partials._navbar')
	@yield('foisal')
	@include('partials._footer')


	<script src="js/forntend/jquery.min.js"></script>
	<script src="js/forntend/boopatrap.min.js"></script>
	<script src="js/app.js"></script>
</body>
	</html>
