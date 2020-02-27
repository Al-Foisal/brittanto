<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title','AHF') </title>

    @yield('head')
    
    <link href="{{ URL::asset('css/forntend/formdemo.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('css/forntend/formstyle.css')}}" rel="stylesheet">
    <link href="{{ URL::asset('css/forntend/formanimate-custom.css')}}" rel="stylesheet">

<script src="jquery.js" type="text/JavaScript" language="javascript"></script>
    <script src="jquery.PrintArea.js" type="text/JavaScript" language="javascript"></script>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ URL::asset('vendors/ti-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('vendors/base/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ URL::asset('pv/images/favicon.png') }}" />
    
    <link rel="stylesheet" href="{{ URL::asset('css/style.css')}}">
    {{-- font-family: 'Ubuntu', sans-serif; --}}
    <link href="https://fonts.googleapis.com/css?family=Ubuntu&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">

      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
 
</style>
    @yield('css')
</head>
<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper">
            {{-- for form design starts --}}
            <div class="main-panel">
                <div class="content-wrapper">

                    @yield('foisal')
                    
                </div>
            </div>
            {{-- for form design starts --}}
        </div>
    </div>

    <!-- plugins:js -->
    <script src="{{ URL::asset('vendors/base/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <script src="{{ URL::asset('vendors/chart.js/Chart.min.js') }}"></script>
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{ URL::asset('js/dashboard/off-canvas.js') }}"></script>
    <script src="{{ URL::asset('js/dashboard/hoverable-collapse.js') }}"></script>
    <script src="js/dashboard/template.js"></script>
    <script src="{{ URL::asset('js/dashboard/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ URL::asset('js/dashboard/dashboard.js') }}"></script>
    <script src="{{ URL::asset('js/print.js') }}"></script>
    <!-- End custom js for this page-->
    @yield('js')
</body>
</html>
